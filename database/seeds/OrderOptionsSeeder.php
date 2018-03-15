<?php

use Illuminate\Database\Seeder;

class OrderOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderContains = DB::table('ordercontains')->where('product_id', 1)->first();
        $option = DB::table('options')->where('specification', 'small')->first();
        DB::table('orderoptions')->insert([
            'ord_contains_id'=>$orderContains->id,
            'options_id'=>$option->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
