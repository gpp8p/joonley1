<?php

use Illuminate\Database\Seeder;

class OrderTermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $terms = DB::table('terms')->where('specification', 'buyer pays for shipping')->first();
        DB::table('orderterms')->insert([
            'order_id'=>1,
            'terms_id'=>$terms->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $terms = DB::table('terms')->where('specification', 'Net 30-day')->first();
        DB::table('orderterms')->insert([
            'order_id'=>1,
            'terms_id'=>$terms->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
