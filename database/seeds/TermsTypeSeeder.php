<?php

use Illuminate\Database\Seeder;

class TermsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('termstype')->insert([
            'name' => 'Shipping',
            'slug' => 'shipping',
            'description'=> 'Shipping',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('termstype')->insert([
            'name' => 'Payment',
            'slug' => 'payment',
            'description'=> 'Payment',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('termstype')->insert([
            'name' => 'Tax',
            'slug' => 'tax',
            'description'=> 'Tax',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('termstype')->insert([
            'name' => 'Price',
            'slug' => 'price',
            'description'=> 'Price',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);




    }
}
