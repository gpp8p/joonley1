<?php

use Illuminate\Database\Seeder;

class CompHasLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        $medialinkReference = DB::table('medialink')->where('url','http://fashion.com/compicon.jpg')->first();
        DB::table('comphaslinks')->insert([
            'company_id'=>$company->id,
            'medialink_id'=>$medialinkReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $company = DB::table('company')->where('name', 'Shop till you drop')->first();
        $medialinkReference = DB::table('medialink')->where('url','http://fashion.com/compicon2.jpg')->first();
        DB::table('comphaslinks')->insert([
            'company_id'=>$company->id,
            'medialink_id'=>$medialinkReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
