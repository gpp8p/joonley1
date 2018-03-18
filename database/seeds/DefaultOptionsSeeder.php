<?php

use Illuminate\Database\Seeder;

class DefaultOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $optionReference = DB::table('options')->where('specification', 'large')->first();
        $productTypeReference = DB::table('producttype')->where('name', 'Rings')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $optionReference = DB::table('options')->where('specification', 'medium')->first();
        $productTypeReference = DB::table('producttype')->where('name', 'Rings')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $optionReference = DB::table('options')->where('specification', 'small')->first();
        $productTypeReference = DB::table('producttype')->where('name', 'Rings')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
