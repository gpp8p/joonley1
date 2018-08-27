<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Product extends Model
{
    protected $table = 'product';

    public function getAllSellableProductsByCategory($category)
    {

/*
        $categoryId = DB::table('nested_category')->where('name',$category)->first()->id;
        $query = 'select distinct product.name as product, product.description as description, medialink.url as media_url, mediatype.name as media_type, '.
                'company.name as company , collection.name as collection, locations.name as location '.
                'from product, medialink, mediatype, collectionhas, containedas, collection, '.
                'collectiontype, hascollection, company, locations, producthaslinks '.
                'where product.type_id = ? '.
                'and medialink.pertainsto = 'product' '.
                'and medialink.mediatype_id = mediatype.id '.
                'and collectionhas.product_id = product.id '.
                'and collectionhas.collection_id = collection.id '.
                'and collectionhas.containedas_id = containedas.id '.
                'and containedas.slug='issale' '.
                'and hascollection.collection_id = collection.id '.
                'and hascollection.company_id = company.id '.
                'and locations.id = company.location_id '.
                'and producthaslinks.product_id = product.id '.
                'and producthaslinks.medialink_id = medialink.id ';
*/

        $query = "select product.name as product, product.description as description, medialink.url as media_url, mediatype.name as media_type, collection.name as collection, company.name as company from product, nested_category, medialink, mediatype, producthaslinks, collection, collectionhas, containedas,  company, hascollection ".
            "where product.type_id=nested_category.id ".
            "and producthaslinks.product_id = product.id ".
            "and medialink_id = medialink.id ".
            "and collectionhas.product_id = product.id ".
            "and collectionhas.collection_id = collection.id ".
            "and collectionhas.containedas_id = containedas.id ".
            "and containedas.slug='issale' ".
            "and hascollection.collection_id = collection.id ".
            "and hascollection.company_id = company.id ".
            "and mediatype.id = medialink.mediatype_id ".
            "and nested_category.lft between ( ".
            "select nested_category.lft from nested_category where ".
            "nested_category.name = ? )".
            "and ".
            "(select nested_category.rgt from nested_category where ".
            "nested_category.name = ? )";



        $productsFound = DB::select($query, [$category, $category]);
        return $productsFound;
    }


    public function getCompanyProducts($companyId)
    {
        $query = 'select product.name as product, product.id as product_id, collection.name as collection, '.
        'containedas.name as status from company, hascollection, collection, collectionhas, product, containedas '.
        'where hascollection.company_id = company.id '.
        'and hascollection.collection_id = collection.id '.
        'and collectionhas.collection_id = collection.id '.
        'and collectionhas.product_id = product.id '.
        'and collectionhas.containedas_id = containedas.id '.
        'and company.id = ?';

        $productsFound = DB::select($query, [$companyId]);
        return $productsFound;


    }

    public function addProductUsingDefaults($productInfo)
    {

        $productType = $productInfo['productType'];
        $productName = $productInfo['productName'];
        $productDescription = $productInfo['productDescription'];
        $productMediaUrl = $productInfo['productMediaUrl'];
        $productMediaType = $productInfo['productMediaType'];
        $productCompany = $productInfo['productCompany'];
        $productCollection = $productInfo['productCollection'];
        $productContainedAs = $productInfo['productContainedAs'];
        $productq1Price = $productInfo['productq1Price'];
        $productq10Price = $productInfo['productq10Price'];
        $productShippingWeight = $productInfo['productShippingWeight'];

        if(!isset($productType, $productName,$productDescription, $productCompany, $productCollection, $productq1Price, $productq10Price, $productShippingWeight, $productMediaUrl, $productMediaType, $productContainedAs))
        {
            throw new Exception('Missing Parameters');
        }
        if(!DB::table('hascollection')->where('company_id',$productCompany->id)->where('collection_id', $productCollection->id)->exists())
        {
            throw new Exception($productCompany->name.' does not have collection '.$productCollection->name);
        }
        DB::beginTransaction();

        try {
            $newProductId = DB::table('product')->insertGetId([
                'name' => $productName,
                'type_id' => $productType->id,
                'description' => $productDescription,
                'price_q1'=>$productq1Price,
                'price_q10'=>$productq10Price,
                'ship_weight'=>$productShippingWeight,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not add this product:'.$e->getMessage());
        }
        if($productMediaType->slug != 'nomedia')
        {
            $thisMediaLink = new \App\MediaLink;
            try {
                $newMediaLinkId = $thisMediaLink->addMediaLink($productType, 'product', $productMediaUrl);
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception('Could not add media link:'.$e->getMessage());
            }
            try {
                DB::table('producthaslinks')->insert([
                    'product_id' => $newProductId,
                    'medialink_id' => $newMediaLinkId,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception('Could not associate new media link with new product'.$e->getMessage());
            }
            $thisCollection = new \App\Collections;
            try {
                $thisCollection->addProductToCollection($newProductId, $productCollection->id, $productContainedAs->id);
            } catch (Exception $e) {
                throw new Exception('Could not add product to collection:'.$e->getMessage());
            }
            $thisTerms = new \App\Terms;
            try {
                $termsAdded = $thisTerms->addDefaultTermsToProduct($productCompany->id, $newProductId);
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception('Could not add default terms to this product'.$e->getMessage());
            }
            $thisOptions = new \App\Options;
            try {
                $defaultOptionsLinkedToProduct = $thisOptions->linkDefaultOptionsToProduct($productType, $newProductId);
            } catch (Exception $e) {
                DB::rollback();
                throw new Exception('Could not associate default options with new product:'.$e->getMessage());
            }
            DB::commit();
            return $newProductId;

        }
    }

    public function removeProduct($productId)
    {
        DB::beginTransaction();
        $linkedMedia = DB::table('producthaslinks')->where('product_id',$productId)->get();
        // if no other medialink rows are linked to this product id, delete the medialink row
        foreach($linkedMedia as $thisLinkedMedia)
        {
            $thisMediaLinkId = $thisLinkedMedia->medialink_id;
            if(!DB::table('producthaslinks')->where('medialink_id',$thisMediaLinkId)->where('product_id','!=',$productId)->exists())
            {
                try {
                    echo('## deleting medialink-'.$thisMediaLinkId);
                    DB::table('medialink')->where('id', $thisMediaLinkId)->delete();
                } catch (Exception $e) {
                    DB::rollBack();
                    throw new Exception('Could not remove medialink row'.$e->getMessage());
                }
            }
        }
        DB::table('producthaslinks')->where('medialink_id',$thisMediaLinkId)->where('product_id',$productId)->delete();
        try {
            $nrd = DB::table('hasoptions')->where('product_id', $productId)->delete();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not remove option link row'.$e->getMessage());
        }
        try {
            $nrd = DB::table('hasterms')->where('product_id', $productId)->delete();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not remove terms linnk row'.$e->getMessage());
        }
        try {
            $nrd = DB::table('collectionhas')->where('product_id', $productId)->delete();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception('Could not remove collection association row'.$e->getMessage());
        }
        try {
            $nrd = DB::table('product')->where('id', $productId)->delete();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not removeproduct row'.$e->getMessage());
        }
        DB::commit();

    }

    public function getOneProduct($productId){
        $query = "select distinct product.name as product_name, product.id as product_id, nested_category.name as category_name, ".
            "medialink.url, product.price_q1, product.price_q10, product.created_at, product.ship_weight, product.ship_weight_oz, product.whenmade, ".
            "product.whomade, product.prodis, collection.name as collection_name from product, collection, collectionhas, producthaslinks, medialink, mediatype, nested_category ".
            "where product.id = ? ".
            "and collectionhas.product_id = product.id ".
            "and collectionhas.collection_id = collection.id ".
            "and producthaslinks.product_id = product.id ".
            "and producthaslinks.medialink_id = medialink.id ".
            "and nested_category.id = product.type_id ".
            "and medialink.mediatype_id = mediatype.id ".
            "and (mediatype.slug='thumb' or mediatype.slug='nomedia') ";

        $thisProductFound = DB::select($query, [$productId]);
        $productId = $thisProductFound[0]->product_id;
        $productName = $thisProductFound[0]->product_name;
        $productCategory = $thisProductFound[0]->category_name;
        $productQ1 = $thisProductFound[0]->price_q1;
        $productQ10 = $thisProductFound[0]->price_q10;
        $productCreatedAt = $thisProductFound[0]->created_at;
        $productShipWeight = $thisProductFound[0]->ship_weight;
        $productShipWeightOz = $thisProductFound[0]->ship_weight_oz;
        $productWhenMade = $thisProductFound[0]->whenmade;
        $productWhoMade = $thisProductFound[0]->whomade;
        if($thisProductFound[0]->prodis =='D'){
            $productIs = 'Digital Content';
        }elseif ($thisProductFound[0]->prodis =='T'){
            $productIs = 'Tool';
        }else{
            $productIs = 'Product';
        }
        $productCollection = $thisProductFound[0]->collection_name;
        $imageUrls = array();
        foreach($thisProductFound as $prod){
            array_push($imageUrls, $prod->url);
        }
        $result = array('product_id'=>$productId,
            'product_name'=>$productName,
            'category_name'=>$productCategory,
            'price_q1'=>$productQ1,
            'price_q10'=>$productQ10,
            'created_at'=>$productCreatedAt,
            'ship_weight'=>$productShipWeight,
            'ship_weight_oz'=>$productShipWeightOz,
            'whenmade'=>$productWhenMade,
            'whomade'=>$productWhoMade,
            'prodis'=>$productIs,
            'images'=>$imageUrls,
            );

        return $result;


    }

    public function getAllMyProductsWithPictures($thisUserId){
        $query = "select distinct product.name as product_name, product.id as product_id, nested_category.name as category_name,  medialink.url, product.price_q1, product.price_q10, product.created_at ".
            "from product, collectionhas, collection, hascollection, company, userincompany, users, producthaslinks, medialink, mediatype, nested_category ".
            "where collectionhas.product_id = product.id ".
            "and collectionhas.collection_id = collection.id ".
            "and hascollection.collection_id = collection.id ".
            "and hascollection.company_id = company.id ".
            "and userincompany.company_id = company.id ".
            "and userincompany.user_id = ? ".
            "and producthaslinks.product_id = product.id ".
            "and producthaslinks.medialink_id = medialink.id ".
            "and nested_category.id = product.type_id ".
            "and medialink.mediatype_id = mediatype.id ".
            "and (mediatype.slug='thumb' or mediatype.slug='nomedia')";

        $productsFound = DB::select($query, [$thisUserId]);
        $currentProductId = $productsFound[0]->product_id;
        $imageUrls=array();
        $results = array();
        $numberOfRecords = sizeof($productsFound);
        foreach($productsFound as $thisProductFound){
            if($thisProductFound->product_id==$currentProductId){
                array_push($imageUrls, $thisProductFound->url);
                $productId = $thisProductFound->product_id;
                $productName = $thisProductFound->product_name;
                $productCategory = $thisProductFound->category_name;
                $productQ1 = $thisProductFound->price_q1;
                $productQ10 = $thisProductFound->price_q10;
                $productCreatedAt = $thisProductFound->created_at;
            }else{
                $thisResultRow = ['product_id'=>$productId, 'product_name'=>$productName, 'category_name'=>$productCategory, 'price_q1'=>$productQ1, 'price_q10'=>$productQ10, 'created_at'=>$productCreatedAt, 'product_images'=>$imageUrls];
                array_push($results, $thisResultRow);
                $imageUrls = array();
                $currentProductId = $thisProductFound->product_id;
                array_push($imageUrls, $thisProductFound->url);
                $productId = $thisProductFound->product_id;
                $productName = $thisProductFound->product_name;
                $productCategory = $thisProductFound->category_name;
                $productQ1 = $thisProductFound->price_q1;
                $productQ10 = $thisProductFound->price_q10;
                $productCreatedAt = $thisProductFound->created_at;
            }
        }
        $thisResultRow = ['product_id'=>$productId, 'product_name'=>$productName, 'category_name'=>$productCategory, 'price_q1'=>$productQ1, 'price_q10'=>$productQ10, 'created_at'=>$productCreatedAt, 'product_images'=>$imageUrls];
        array_push($results, $thisResultRow);
        return $results;


    }

    public function getAllMyProducts($thisUserId){
        $query = "select distinct product.name as product_name, product.id as product_id, nested_category.name as category_name, product.price_q1, product.price_q10, product.created_at ".
            "from product, nested_category, collectionhas, collection, hascollection, company, userincompany, users ".
            "where collectionhas.product_id = product.id ".
            "and collectionhas.collection_id = collection.id ".
            "and hascollection.collection_id = collection.id ".
            "and hascollection.company_id = company.id ".
            "and userincompany.company_id = company.id ".
            "and userincompany.user_id = ? ".
            "and nested_category.id = product.type_id";

        $productsFound = DB::select($query, [$thisUserId]);
        return $productsFound;

    }
}
