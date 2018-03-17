<?php

use Illuminate\Database\Seeder;

class HasOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productReference = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $optionReference = DB::table('options')->where('specification', 'large')->first();
        DB::table('hasoptions')->insert([
            'product_id'=>$productReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $optionReference = DB::table('options')->where('specification', 'medium')->first();
        DB::table('hasoptions')->insert([
            'product_id'=>$productReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $optionReference = DB::table('options')->where('specification', 'small')->first();
        DB::table('hasoptions')->insert([
            'product_id'=>$productReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
