<?php

use Illuminate\Database\Seeder;

class ProductHasLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productReference = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $medialinkReference = DB::table('medialink')->where('url','http://mymedia.com/ring5')->first();
        DB::table('producthaslinks')->insert([
            'product_id'=>$productReference->id,
            'medialink_id'=>$medialinkReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productReference = DB::table('product')->where('name', 'Zirconium ring')->first();
        $medialinkReference = DB::table('medialink')->where('url','http://mymedia.com/ring6')->first();
        DB::table('producthaslinks')->insert([
            'product_id'=>$productReference->id,
            'medialink_id'=>$medialinkReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productReference = DB::table('product')->where('name', 'Silver inlaid ring')->first();
        DB::table('producthaslinks')->insert([
            'product_id'=>$productReference->id,
            'medialink_id'=>$medialinkReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
