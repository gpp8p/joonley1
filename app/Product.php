<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Product extends Model
{
    protected $table = 'product';

    public function getAllSellableProductsByCategory($categoryId)
    {
        $query = 'select distinct product.name as product, product.description as description, medialink.url as media_url, mediatype.name as media_type, '.
                'company.name as company , collection.name as collection, locations.name as location '.
                'from product, medialink, mediatype, collectionhas, containedas, collection, '.
                'collectiontype, hascollection, company, locations, producthaslinks '.
                'where product.type_id = ? '.
                'and medialink.pertainsto = \'product\' '.
                'and medialink.mediatype_id = mediatype.id '.
                'and collectionhas.product_id = product.id '.
                'and collectionhas.collection_id = collection.id '.
                'and collectionhas.containedas_id = containedas.id '.
                'and containedas.slug=\'issale\' '.
                'and hascollection.collection_id = collection.id '.
                'and hascollection.company_id = company.id '.
                'and locations.id = company.location_id '.
                'and producthaslinks.product_id = product.id '.
                'and producthaslinks.medialink_id = medialink.id ';

        $productsFound = DB::select($query, [$categoryId]);
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

    public function addProductUsingDefaults($productType, $productName, $productDescription, $productMediaUrl, $productMediaType, $productCompany, $productCollection,$productContainedAs)
    {
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
                    'updated_at' => \Carbon\Carbon::now()
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
            $thisMediaLinkId = $thisLinkedMedia->id;
            if(!DB::table('producthaslinks')->where('medialink_id',$thisMediaLinkId)->where('product_id','!=',$productId)->exists())
            {
                try {
                    DB::table('medialink')->where('id', $thisMediaLinkId)->delete();
                } catch (Exception $e) {
                    DB::rollBack();
                    throw new Exception('Could not remove medialink row'.$e->getMessage());
                }
            }
        }
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
}
