<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductType extends Model
{
    protected $table = 'producttype';

    public function topLevelCategoryMembersAndIds(){
        $tList = [];
        $categories = DB::table('producttype')->where('parent_id', '=',1)->get();
        foreach($categories as $catagory)
        {
            $tList[] = [$catagory->name, $catagory->id];
        }
        return $tList;
    }

    public function subCategoryMembersAndIds($parentId)
    {
        $tList = [];
        $categories = DB::table('producttype')->where('parent_id', '=', $parentId)->get();
        foreach($categories as $catagory)
        {
            $tList[] = [$catagory->name, $catagory->id];
        }
        return $tList;
    }

    public function productsWithType($categoryId)
    {
        $query = 'select product.id, product.name, product.description, medialink.url from product, medialink '.
        'where product.type_id = ? '.
        'and medialink.pertainsto=\'product\' '.
        'and medialink.reference_id = product.id';

        $products =  DB::select($query, [$categoryId]);
        return $products;
    }



}
