<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = DB::table('orderstatus')->where('name','In Preparation')->first();
        $company = DB::table('company')->where('name', 'Shop till you drop')->first();
        DB::table('orders')->insert([
            'cust_comp_id'=>$company->id,
            'status'=>$status->id,
            'shipping'=>10.95,
            'tax'=>2.50,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $status = DB::table('orderstatus')->where('name','Accepted')->first();
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        DB::table('orders')->insert([
            'cust_comp_id'=>$company->id,
            'status'=>$status->id,
            'shipping'=>10.95,
            'tax'=>2.50,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $status = DB::table('orderstatus')->where('name','Declined')->first();
        $company = DB::table('company')->where('name', 'Trinkets Unlimited')->first();
        DB::table('orders')->insert([
            'cust_comp_id'=>$company->id,
            'status'=>$status->id,
            'shipping'=>10.95,
            'tax'=>2.50,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
