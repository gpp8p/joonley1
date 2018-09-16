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
        $productTypeReference = DB::table('nested_category')->where('name', 'Rings')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $optionReference = DB::table('options')->where('specification', 'medium')->first();
        $productTypeReference = DB::table('nested_category')->where('name', 'Rings')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $optionReference = DB::table('options')->where('specification', 'small')->first();
        $productTypeReference = DB::table('nested_category')->where('name', 'Rings')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $optionReference = DB::table('options')->where('specification', 'large')->first();
        $productTypeReference = DB::table('nested_category')->where('name', 'Chains')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $optionReference = DB::table('options')->where('specification', 'medium')->first();
        $productTypeReference = DB::table('nested_category')->where('name', 'Chains')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $optionReference = DB::table('options')->where('specification', 'small')->first();
        $productTypeReference = DB::table('nested_category')->where('name', 'Chains')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productTypeReference = DB::table('nested_category')->where('name', 'Dresses')->first();
        $optionReference = DB::table('options')->where('specification', 'Red')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productTypeReference = DB::table('nested_category')->where('name', 'Dresses')->first();
        $optionReference = DB::table('options')->where('specification', 'White')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productTypeReference = DB::table('nested_category')->where('name', 'Dresses')->first();
        $optionReference = DB::table('options')->where('specification', 'Blue')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productTypeReference = DB::table('nested_category')->where('name', 'Dresses')->first();
        $optionReference = DB::table('options')->where('specification', 'size 6')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productTypeReference = DB::table('nested_category')->where('name', 'Dresses')->first();
        $optionReference = DB::table('options')->where('specification', 'size 7')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productTypeReference = DB::table('nested_category')->where('name', 'Dresses')->first();
        $optionReference = DB::table('options')->where('specification', 'size 8')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productTypeReference = DB::table('nested_category')->where('name', 'Dresses')->first();
        $optionReference = DB::table('options')->where('specification', 'size 9')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productTypeReference = DB::table('nested_category')->where('name', 'Dresses')->first();
        $optionReference = DB::table('options')->where('specification', 'size 10')->first();
        DB::table('defaultoptions')->insert([
            'producttype_id'=>$productTypeReference->id,
            'options_id'=>$optionReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
