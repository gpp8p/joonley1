<?php

use Illuminate\Database\Seeder;

class CollectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collectiontype')->insert([
            'name'=>'Retail Catalog',
            'slug'=>'rcatalog',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Catalog showing products for sale'
        ]);

        DB::table('collectiontype')->insert([
            'name'=>'Shopping Basket',
            'slug'=>'basket',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Basket of products for purchase'
        ]);

        DB::table('collectiontype')->insert([
            'name'=>'Preview Catalog',
            'slug'=>'preview',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Basket of products on preview but not yet for sale'
        ]);
    }
}
