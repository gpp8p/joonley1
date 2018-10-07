<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Company extends Model
{
    protected $table = 'company';

    public function names()
    {
        $companies = $this->all();
        $companyNames = [];
        foreach($companies as $thisCompany)
        {
            $companyNames[] = $thisCompany->name;
        }
        return $companyNames;
    }


    public function addNewCompany($companyName, $companyWeb, $companyPhone, $companyLocations, $companyTypeId,$icon)
    {
        try {
            $this->getCompanyByName($companyName);
            throw new Exception($companyName.' already exists');
        } catch (Exception $e) {
            DB::beginTransaction();
            try {
                $newCompanyId = DB::table('company')->insertGetId([
                    'name' => $companyName,
                    'website' => $companyWeb,
                    'icon' => $icon,
                    'phone' => $companyPhone,
//                'location_id'=>$companyLocations,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);

                DB::table('compcanbe')->insert([
                    'ctype_id' => $companyTypeId,
                    'company_id' => $newCompanyId,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                foreach($companyLocations as $thisLoc)
                {
                    DB::table('companyloc')->insert([
                        'location_id' => $thisLoc,
                        'company_id' => $newCompanyId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception("Error updating database:".$e->getMessage());
            }
        }
        return $newCompanyId;
    }

    public function getCompanyByName($companyName)
    {
        $thisCompany = DB::table('company')->where('name', $companyName)->first();

        if($thisCompany==NULL){
            throw new Exception($companyName.' not found');
        }else{
            return $thisCompany->id;
        }
    }

    public function deleteCompany($companyId)
    {
        $nrd = DB::table('company')->where('id', '=', $companyId)->delete();
        if($nrd==0){
            throw new Exception('Nothing deleted');
        }else{
            $nrd = DB::table('compcanbe')->where('company_id', '=', $companyId)->delete();
            if($nrd==0){
                throw new Exception('No type records deleted');
            }
        }
    }

    public function getCompanyInfoByUserId($userId){
        $query = "select company.name as name, company.id as company_id, icon as icon, website as website, phone as phone, reseller_id as reseller_id, addr1 as addr1, addr2 as addr2, city as city, state as state, zip as zip, country as country, companyrole.name as companyrole_name, companyrole.slug as companyrole_slug ".
            "from company, userincompany, companyrole ".
            "where userincompany.company_id = company.id ".
            "and companyrole.id = userincompany.companyrole_id ".
            "and userincompany.user_id = ?";

        $thisCompany = DB::select($query, [$userId]);
        return $thisCompany;

    }

    public function getCompanyProductsWithOptionsImages($companyId){

        $query = "select distinct product.id as product_id, product.price_q1 as price_q1, product.price_q10 as price_q10, product.type_id as type, nested_category.name as category, product.name as product_name, options.specification as option_specification, ".
            "options.id as option_id, optiontype.name as optiontype_name, optiontype.id as optiontype_id, medialink.url as url, medialink.id as medialink_id ".
            "from options, hasoptions, optiontype, product, collectionhas, collectiontype, collection, containedas, hascollection, company, producthaslinks, medialink, nested_category ".
            "where hasoptions.product_id = product.id ".
            "and hasoptions.options_id = options.id ".
            "and options.optiontype_id = optiontype.id ".
            "and collectionhas.product_id = product.id ".
            "and collectionhas.containedas_id = containedas.id ".
            "and containedas.slug='issale' ".
            "and collectionhas.collection_id = collection.id ".
            "and hascollection.collection_id = collection.id ".
            "and hascollection.company_id = company.id ".
            "and producthaslinks.product_id = product.id ".
            "and producthaslinks.medialink_id = medialink.id ".
            "and nested_category.id = product.type_id ".
            "and company.id = ? order by type, product.id, optiontype.id, options.id, medialink.id " ;

        $thisCompanyProducts = DB::select($query, [$companyId]);
        $optionType = array();
        $options=array();
        $productRow = array();
        $results=array();
        $images=array();
        $categories = array();
        $currentProductId = $thisCompanyProducts[0]->product_id;
        $currentOptionTypeId = $thisCompanyProducts[0]->optiontype_id;
        $currentOptionId = $thisCompanyProducts[0]->option_id;
        $currentMediaLinkId = $thisCompanyProducts[0]->medialink_id;
        $currentCategoryId = $thisCompanyProducts[0]->type;
        $currentCategoryName = $thisCompanyProducts[0]->category;
        $thisOptionSpecification="";
        $thisOptionTypeName="";
        $currentImages = array();
        $unsavedImages =1;
        $unsavedOptionTypes = 1;
        $unsavedOptions=1;
        $unsavedCategories=1;
        $prodArray = array();
        $prod = $thisCompanyProducts[0];

        $optTypeArray = array();
        $thisOptType = $prod->optiontype_id;
        array_push($optTypeArray, $thisOptType);

        $optArray = array();
        foreach($thisCompanyProducts as $thisProduct){
            if($thisProduct->product_id==32){
                $b=0;
            }
            if($thisProduct->product_id != $prod->product_id){
                $optArray=array();
                $prodLine = array($prod, $optTypeArray);
                array_push($prodArray, $prodLine);
                $optTypeArray = array();
                $prod = $thisProduct;
                array_push($optArray, $prod->option_id);
                $thisOptType = $prod->optiontype_id;
                array_push($optTypeArray, $thisOptType);
            }else{
                $prod = $thisProduct;

                if($prod->optiontype_id!= $thisOptType){
                    $thisOptType = $prod->optiontype_id;
                    array_push($optTypeArray, $thisOptType);
                    $optArray=array();
                    array_push($optArray, $prod->option_id);
                }else{
                    array_push($optArray, $prod->option_id);
                }
            }
        }
        if($prod->optiontype_id!= $thisOptType){
            array_push($optTypeArray, $thisOptType);
        }
        $prodLine = array($prod, $optTypeArray);
        array_push($prodArray, $prodLine);



        foreach($thisCompanyProducts as $thisProduct){
                if ($thisProduct->option_id != $currentOptionId) {
                    $currentImages=$images;
                    $images=array();
                    array_push($options, $thisOptionSpecification);
                    $unsavedOptions++;
                    $currentOptionId = $thisProduct->option_id;
                    $thisOptionSpecification = $thisProduct->option_specification;
                    if ($thisProduct->optiontype_id != $currentOptionTypeId) {
                        $optionType[$thisOptionTypeName] = $options;
                        $options = array();
                        $unsavedOptions=0;
                        $currentOptionTypeId = $thisProduct->optiontype_id;
                        if ($thisProduct->product_id != $currentProductId) {
                            $currentProductId = $thisProduct->product_id;
                            $productRow = array( $thisProduct->product_name, $optionType, $currentImages[0], $thisProduct->price_q1, $thisProduct->price_q10);
                            array_push($results,$productRow);
                            $optionType=array();
                            $unsavedOptionTypes=0;
                            if($thisProduct->type != $currentCategoryId){
                                $categories[$currentCategoryName] = $results;
                                $currentCategoryId = $thisProduct->type;
                                $currentCategoryName = $thisProduct->category;
                                $results=array();
                            }else{
                                $categories[$currentCategoryName] = $results;
                                $unsavedCategories=0;
                            }
                        }
                    } else {
                        $thisOptionTypeName = $thisProduct->optiontype_name;
                        $unsavedOptionTypes++;
                    }
                } else {
                    $thisOptionSpecification = $thisProduct->option_specification;
                }
                array_push($images, $thisProduct->url);
                $unsavedImages++;
        }
        if($unsavedImages>0){
            $currentImages=$images;
        }
        if($unsavedOptionTypes>0){
            array_push($options, $thisOptionSpecification);
            $thisOptionTypeName = $thisProduct->optiontype_name;
            $optionType[$thisOptionTypeName] = $options;
        }
        if($unsavedCategories>0){
            $productRow = array( $thisProduct->product_name, $optionType, $currentImages[0], $thisProduct->price_q1, $thisProduct->price_q10);
            array_push($results,$productRow);
            $categories[$currentCategoryName] = $results;
        }
        return $categories;
    }

    public function getCompanyIdForProduct($productId){

        $query = "select company.id as company_id from company, collectionhas, collection, hascollection ".
                "where company.id = hascollection.company_id ".
                "and collection.id = hascollection.collection_id ".
                "and collectionhas.collection_id = collection.id ".
                "and collectionhas.product_id = ?";

        $thisCompanyId = DB::select($query, [$productId]);
        return $thisCompanyId[0]->company_id;
    }

    public function editCompany($companyId, $companyName, $companyWeb, $companyPhone, $companyLocations, $companyTypeIds)
    {
        try {
            $thisCompany = DB::table('company')->where('id', '=', $companyId)->get();
        } catch (Exception $e) {
            throw new Exception("Company with Id = ".$companyId."not found");
        }
        if($thisCompany[0]->name != $companyName){
            $newCompanyName = $companyName;
        }else{
            $newCompanyName = $thisCompany[0]->name;
        }
        if($thisCompany[0]->website != $companyWeb){
            $newCompanyWeb = $companyWeb;
        }else{
            $newCompanyWeb = $thisCompany[0]->website;
        }
        if($thisCompany[0]->phone != $companyPhone){
            $newCompanyPhone = $companyPhone;
        }else{
            $newCompanyPhone = $thisCompany[0]->phone;
        }
/*
        if($thisCompany[0]->location_id != $companyLocationId){
            $newCompanyLocationId = $companyLocationId;
        }else{
            $newCompanyLocationId = $thisCompany[0]->location_id;
        }
*/
        DB::table('company')->where('id', $companyId)->update([
            'name'=>    $newCompanyName,
            'website'=> $newCompanyWeb,
            'phone'=> $newCompanyPhone,
//            'location_id'=>$newCompanyLocationId,
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $canBeQuery = "select ctype_id from compcanbe where company_id = ?";
        $cbs = DB::select($canBeQuery, [$companyId]);


        $existingCtypes = array();
        foreach($cbs as $cb)
        {
            $thisCtypeId = $cb->ctype_id;
            $existingCtypes[] = $thisCtypeId;
        }
        foreach($companyTypeIds as $ct) {
            if (!in_array($ct, $existingCtypes))
            {
                DB::table('compcanbe')->insert([
                    'ctype_id'=>$ct,
                    'company_id'=>$companyId,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);
            }
        }
        foreach($existingCtypes as $et)
        {
            if( !in_array($et, $companyTypeIds))
            {
                DB::table('compcanbe')->where([
                    ['ctype_id', '=', $et],
                    ['company_id', '=', $companyId],
                ])->delete();
            }
        }

        $locationsQuery = "select location_id from companyloc where company_id = ?";
        $locs = DB::select($locationsQuery, [$companyId]);
        $existingLocations = array();
        foreach($locs as $l)
        {
            $thisLocId = $l->location_id;
            $existingLocations[] = $thisLocId;
        }
        foreach($companyLocations as $cloc)
        {
            if(!in_array($cloc, $existingLocations))
            {
                DB::table('companyloc')->insert([
                   'location_id'=>$cloc,
                   'company_id'=>$companyId,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);
            }
        }
        foreach($existingLocations as $eloc)
        {
            if(!in_array($eloc, $companyLocations))
            {
                DB::table('companyloc')->where([
                    ['location_id', '=', $eloc],
                    ['company_id', '=', $companyId]
                ])->delete();
            }
        }
    }
}


