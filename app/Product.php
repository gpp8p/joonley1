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
}
