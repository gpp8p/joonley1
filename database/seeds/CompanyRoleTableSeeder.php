<?php

use Illuminate\Database\Seeder;

class CompanyRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companyrole')->insert([
            'name'=>    'Owner',
            'slug'=>    'owner',
            'description'=> 'Owns the company',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companyrole')->insert([
            'name'=>    'C.E.O.',
            'slug'=>    'ceo',
            'description'=> 'Chief Executive Officer',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companyrole')->insert([
            'name'=>    'Head Buyer',
            'slug'=>    'hbuyer',
            'description'=> 'Supervising Buyer for the Company',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companyrole')->insert([
            'name'=>    'Buyer',
            'slug'=>    'buyer',
            'description'=> 'Buyer for the company',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companyrole')->insert([
            'name'=>    'Independent Buyer',
            'slug'=>    'ibuyer',
            'description'=> 'Independent Buyer associated with company',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companyrole')->insert([
            'name'=>    'Sales Representative',
            'slug'=>    'srep',
            'description'=> 'Sales or marketing representative for the company',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companyrole')->insert([
            'name'=>    'Customer',
            'slug'=>    'cust',
            'description'=> 'Independent Customer',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
