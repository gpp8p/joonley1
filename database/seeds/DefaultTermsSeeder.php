<?php

use Illuminate\Database\Seeder;

class DefaultTermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $termReference = DB::table('terms')->where('specification', 'buyer pays for shipping')->first();
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        DB::table('defaultterms')->insert([
            'terms_id'=>$termReference->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $termReference = DB::table('terms')->where('specification', 'Net 30-day')->first();
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        DB::table('defaultterms')->insert([
            'terms_id'=>$termReference->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
