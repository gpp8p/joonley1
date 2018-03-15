<?php

use Illuminate\Database\Seeder;

class ShippingTypeOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = DB::table('product')->where('name', 'Gold pinky ring')->first();
        DB::table('shiptype')->insert([
            'product_id'=>$product->id,
            'slug'=>'upsground',
            'name'=>'ups ground',
            'description'=>'UPS ground',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('shiptype')->insert([
            'product_id'=>$product->id,
            'slug'=>'air2',
            'name'=>'second day air',
            'description'=>'Second day air',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('shiptype')->insert([
            'product_id'=>$product->id,
            'slug'=>'fedexovr',
            'name'=>'Fedex Overnight',
            'description'=>'Fedex Overnight Shipping',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
