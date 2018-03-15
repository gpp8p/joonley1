<?php

use Illuminate\Database\Seeder;

class CompanyCanBeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        $type = DB::table('companytype')->where('slug', 'rshop')->first();

        DB::table('compcanbe')->insert([
            'ctype_id'=>$type->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $company = DB::table('company')->where('name', 'Shop till you drop')->first();
        $type = DB::table('companytype')->where('slug', 'rshop')->first();

        DB::table('compcanbe')->insert([
            'ctype_id'=>$type->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $company = DB::table('company')->where('name', 'Trinkets Unlimited')->first();
        $type = DB::table('companytype')->where('slug', 'cprod')->first();

        DB::table('compcanbe')->insert([
            'ctype_id'=>$type->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $company = DB::table('company')->where('name', 'Trinkets Unlimited')->first();
        $type = DB::table('companytype')->where('slug', 'rshop')->first();

        DB::table('compcanbe')->insert([
            'ctype_id'=>$type->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $company = DB::table('company')->where('name', 'Junk From China')->first();
        $type = DB::table('companytype')->where('slug', 'distrib')->first();

        DB::table('compcanbe')->insert([
            'ctype_id'=>$type->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


    }
}
