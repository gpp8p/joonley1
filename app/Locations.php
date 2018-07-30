<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Locations extends Model
{
    public function getLocations()
    {
        $locations = $this->all();
        $locationNames = [];
        foreach($locations as $thisLocation)
        {
            $locationNames[] = [$thisLocation->name, $thisLocation->id];
        }
        return $locationNames;

    }

    public function getProductsByLocation($locationId)
    {
/*
        $query = 'select product.id, product.name, product.description, medialink.url from product, medialink, collectionhas, collection, hascollection, company, locations, producthaslinks '.
            'where collectionhas.product_id = product.id '.
            'and collectionhas.collection_id = collection.id '.
            'and hascollection.collection_id = collection.id '.
            'and hascollection.company_id = company.id '.
            'and company.location_id = locations.id '.
            'and locations.id=? '.
            'and medialink.pertainsto=\'product\' '.
            'and producthaslinks.product_id = product.id '.
            'and producthaslinks.medialink_id = medialink.id';
*/

        $query = "select product.id, product.name as product_name, product.description as \'product_description\', ".
            "company.name as \'company_name\', collection.name as \'collection_name\', medialink.url as \'product_image\' ".
            "from company, locations, companyloc, collection, hascollection, product, collectionhas, medialink, producthaslinks ".
            "where company.id = companyloc.company_id ".
            "and companyloc.location_id = locations.id ".
            "and locations.name= ? ".
            "and company.id = hascollection.company_id ".
            "and collection.id = hascollection.collection_id ".
            "and collectionhas.collection_id = collection.id ".
            "and collectionhas.product_id = product.id ".
            "and (medialink.pertainsto=\'product\' or medialink.pertainsto=\'*\') ".
            "and producthaslinks.product_id = product.id ".
            "and producthaslinks.medialink_id = medialink.id ";

        $products = DB::select($query, [$locationId]);
        return $products;
    }

    public function getLocationId($locationName)
    {
        $query = "select id from locations where name = ?";

        $thisLocationId = DB::select($query, [$locationName]);

        if($thisLocationId==NULL){
            throw new Exception($locationName.' not found');
        }else{
            return $thisLocationId[0]->id;
        }
    }

}
