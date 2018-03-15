<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BillInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        DB::table('billinfo')->insert([
            'company_id'=>$company->id,
            'title' => $faker->title,
            'lname' => $faker->lastname,
            'fname' => $faker->firstNameMale,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'addr3' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'phone' => $faker->phoneNumber,
            'wireinfo'=>'',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
