<?php

use Illuminate\Database\Seeder;

class HasTermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productReference = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $termReference = DB::table('terms')->where('specification', 'buyer pays for shipping')->first();
        DB::table('hasterms')->insert([
            'product_id'=>$productReference->id,
            'terms_id'=>$termReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productReference = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $termReference = DB::table('terms')->where('specification', 'Net 30-day')->first();
        DB::table('hasterms')->insert([
            'product_id'=>$productReference->id,
            'terms_id'=>$termReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $productReference = DB::table('product')->where('name', 'Zirconium ring')->first();
        $termReference = DB::table('terms')->where('specification', 'Net 30-day')->first();
        DB::table('hasterms')->insert([
            'product_id'=>$productReference->id,
            'terms_id'=>$termReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);



    }
}
