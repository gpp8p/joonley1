<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productType = DB::table('producttype')->where('name', 'Rings')->first();
        DB::table('product')->insert([
            'name'=>'Gold pinky ring',
            'type_id'=>$productType->id,
            'description'=>'Solid Gold pinky ring',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('product')->insert([
            'name'=>'Zirconium ring',
            'type_id'=>$productType->id,
            'description'=>'Fake diamondring',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('product')->insert([
            'name'=>'Silver inlaid ring',
            'type_id'=>$productType->id,
            'description'=>'Silver ring with inlays',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productType = DB::table('producttype')->where('name', 'Chains')->first();
        DB::table('product')->insert([
            'name'=>'Mr. T. Gold chain',
            'type_id'=>$productType->id,
            'description'=>'Gold chain',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('product')->insert([
            'name'=>'Leather Necklace',
            'type_id'=>$productType->id,
            'description'=>'Leather choker necklace',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);



    }
}
