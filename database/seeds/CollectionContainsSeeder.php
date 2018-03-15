<?php

use Illuminate\Database\Seeder;

class CollectionContainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $collection =  DB::table('collection')->where('slug', 'fcollect1')->first();
        $containedAs = DB::table('containedas')->where('slug', 'issale')->first();

        DB::table('collectionhas')->insert([
            'product_id'=>$product->id,
            'collection_id'=>$collection->id,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Zirconium ring')->first();
        $collection =  DB::table('collection')->where('slug', 'fcollect1')->first();
        $containedAs = DB::table('containedas')->where('slug', 'issale')->first();

        DB::table('collectionhas')->insert([
            'product_id'=>$product->id,
            'collection_id'=>$collection->id,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Silver inlaid ring')->first();
        $collection =  DB::table('collection')->where('slug', 'fcollect1')->first();
        $containedAs = DB::table('containedas')->where('slug', 'issale')->first();

        DB::table('collectionhas')->insert([
            'product_id'=>$product->id,
            'collection_id'=>$collection->id,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Mr. T. Gold chain')->first();
        $collection =  DB::table('collection')->where('slug', 'ldscollect1')->first();
        $containedAs = DB::table('containedas')->where('slug', 'issale')->first();

        DB::table('collectionhas')->insert([
            'product_id'=>$product->id,
            'collection_id'=>$collection->id,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Leather Necklace')->first();
        $collection =  DB::table('collection')->where('slug', 'ldscollect1')->first();
        $containedAs = DB::table('containedas')->where('slug', 'issale')->first();

        DB::table('collectionhas')->insert([
            'product_id'=>$product->id,
            'collection_id'=>$collection->id,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Leather Necklace')->first();
        $collection =  DB::table('collection')->where('slug', 'basket1')->first();
        $containedAs = DB::table('containedas')->where('slug', 'ordnoship')->first();

        DB::table('collectionhas')->insert([
            'product_id'=>$product->id,
            'collection_id'=>$collection->id,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Mr. T. Gold chain')->first();
        $collection =  DB::table('collection')->where('slug', 'basket1')->first();
        $containedAs = DB::table('containedas')->where('slug', 'ordnoship')->first();

        DB::table('collectionhas')->insert([
            'product_id'=>$product->id,
            'collection_id'=>$collection->id,
            'containedas_id'=>$containedAs->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
















    }
}
