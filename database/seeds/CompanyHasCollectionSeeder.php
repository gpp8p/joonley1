<?php

use Illuminate\Database\Seeder;

class CompanyHasCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        $collection =  DB::table('collection')->where('slug', 'fcollect1')->first();

        DB::table('hascollection')->insert([
            'collection_id'=>$collection->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $company = DB::table('company')->where('name', 'Shop till you drop')->first();
        $collection =  DB::table('collection')->where('slug', 'scollect1')->first();

        DB::table('hascollection')->insert([
            'collection_id'=>$collection->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $company = DB::table('company')->where('name', 'Trinkets Unlimited')->first();
        $collection =  DB::table('collection')->where('slug', 'ldscollect1')->first();

        DB::table('hascollection')->insert([
            'collection_id'=>$collection->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $company = DB::table('company')->where('name', 'Trinkets Unlimited')->first();
        $collection =  DB::table('collection')->where('slug', 'basket1')->first();

        DB::table('hascollection')->insert([
            'collection_id'=>$collection->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $company = DB::table('company')->where('name', 'Junk From China')->first();
        $collection =  DB::table('collection')->where('slug', 'preview21')->first();


        DB::table('hascollection')->insert([
            'collection_id'=>$collection->id,
            'company_id'=>$company->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


    }
}
