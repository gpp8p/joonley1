<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'product_id'=>$product->id,
            'optiontype_id'=>$type->id,
            'specification'=>'large',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'product_id'=>$product->id,
            'optiontype_id'=>$type->id,
            'specification'=>'medium',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'product_id'=>$product->id,
            'optiontype_id'=>$type->id,
            'specification'=>'small',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Leather Necklace')->first();
        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'product_id'=>$product->id,
            'optiontype_id'=>$type->id,
            'specification'=>'size 6',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Leather Necklace')->first();
        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'product_id'=>$product->id,
            'optiontype_id'=>$type->id,
            'specification'=>'size 7',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Leather Necklace')->first();
        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'product_id'=>$product->id,
            'optiontype_id'=>$type->id,
            'specification'=>'size 8',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Leather Necklace')->first();
        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'product_id'=>$product->id,
            'optiontype_id'=>$type->id,
            'specification'=>'size 9',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $product = DB::table('product')->where('name', 'Leather Necklace')->first();
        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'product_id'=>$product->id,
            'optiontype_id'=>$type->id,
            'specification'=>'size 10',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
