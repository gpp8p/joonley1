<?php

use Illuminate\Database\Seeder;

class OrderContainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shiptype = DB::table('shiptype')->where('slug', 'air2')->first();
        $product = DB::table('product')->where('name', 'Gold pinky ring')->first();
        DB::table('ordercontains')->insert([
            'product_id'=>$product->id,
            'shiptype_id'=>$shiptype->id,
            'order_id'=>1,
            'subtotal'=>5.95,
            'quantity'=>10,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Zirconium ring')->first();
        DB::table('ordercontains')->insert([
            'product_id'=>$product->id,
            'shiptype_id'=>$shiptype->id,
            'order_id'=>1,
            'subtotal'=>5.95,
            'quantity'=>10,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $product = DB::table('product')->where('name', 'Silver inlaid ring')->first();
        DB::table('ordercontains')->insert([
            'product_id'=>$product->id,
            'shiptype_id'=>$shiptype->id,
            'order_id'=>1,
            'subtotal'=>5.95,
            'quantity'=>10,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


    }
}
