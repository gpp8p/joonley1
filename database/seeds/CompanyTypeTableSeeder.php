<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompanyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        DB::table('companytype')->insert([
            'name' => 'Retail Shop - Brick and Mortar',
            'slug' => 'rshop',
            'description'=> 'A real brick and mortar retail operation.',
            'role'=> 'buyer',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companytype')->insert([
            'name' => 'Online Only',
            'slug' => 'online',
            'description'=> $faker->sentence($nbWords = 15, $variableNbWords = true),
            'role'=> 'buyer',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companytype')->insert([
            'name' => 'Catalog',
            'slug' => 'catalog',
            'description'=> $faker->sentence($nbWords = 15, $variableNbWords = true),
            'role'=> 'buyer',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companytype')->insert([
            'name' => 'Pop-Up Retailer',
            'slug' => 'popup',
            'description'=> $faker->sentence($nbWords = 15, $variableNbWords = true),
            'role'=> 'buyer',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        DB::table('companytype')->insert([
            'name' => 'Distributer',
            'slug' => 'distrib',
            'description'=> $faker->sentence($nbWords = 15, $variableNbWords = true),
            'role'=> 'seller',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companytype')->insert([
            'name' => 'Factory Producer',
            'slug' => 'fprod',
            'description'=> $faker->sentence($nbWords = 15, $variableNbWords = true),
            'role'=> 'seller',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companytype')->insert([
            'name' => 'Craft Producer',
            'slug' => 'cprod',
            'description'=> $faker->sentence($nbWords = 15, $variableNbWords = true),
            'role'=> 'seller',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
