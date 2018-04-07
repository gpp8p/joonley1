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
        $productType = DB::table('nested_category')->where('name', 'Rings')->first();
        DB::table('product')->insert([
            'name'=>'Gold pinky ring',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Solid Gold pinky ring',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('product')->insert([
            'name'=>'Zirconium ring',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Fake diamondring',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('product')->insert([
            'name'=>'Silver inlaid ring',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Silver ring with inlays',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productType = DB::table('nested_category')->where('name', 'Chains')->first();
        DB::table('product')->insert([
            'name'=>'Mr. T. Gold chain',
            'type_id'=>$productType->id,
            'price_q1'=>10.95,
            'price_q10'=>9.50,
            'ship_weight'=>0.2,
            'description'=>'Gold chain',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('product')->insert([
            'name'=>'Leather Necklace',
            'type_id'=>$productType->id,
            'price_q1'=>5.95,
            'price_q10'=>4.50,
            'ship_weight'=>0.2,
            'description'=>'Leather choker necklace',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productType = DB::table('nested_category')->where('name', 'Blouses')->first();
        DB::table('product')->insert([
            'name'=>'Parisian Blouse',
            'type_id'=>$productType->id,
            'price_q1'=>20.95,
            'price_q10'=>15.50,
            'ship_weight'=>1.9,
            'description'=>'Latest fashion blouse from Paris',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);




    }
}
