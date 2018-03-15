<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $thisCompany = DB::table('locations')->where('name', 'Virginia')->first();
        DB::table('company')->insert([
            'name'=>    'Rings With Bing',
            'website'=> 'www.rings.com',
            'phone'=> $faker->phoneNumber,
            'location_id'=>$thisCompany->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompany = DB::table('locations')->where('name', 'New York')->first();
        DB::table('company')->insert([
            'name'=>    'Shop till you drop',
            'website'=> 'www.shopanddrop.com',
            'phone'=> $faker->phoneNumber,
            'location_id'=>$thisCompany->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompany = DB::table('locations')->where('name', 'Hong Kong')->first();
        DB::table('company')->insert([
            'name'=>    'Trinkets Unlimited',
            'website'=> 'www.trinkets.com',
            'location_id'=>$thisCompany->id,
            'phone'=> $faker->phoneNumber,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('company')->insert([
            'name'=>    'Junk From China',
            'website'=> 'www.chinajunk.com',
            'phone'=> $faker->phoneNumber,
            'location_id'=>$thisCompany->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompany = DB::table('locations')->where('name', 'New York')->first();
        DB::table('company')->insert([
            'name'=>    'Accessories Today',
            'website'=> 'www.accessories.com',
            'phone'=> $faker->phoneNumber,
            'location_id'=>$thisCompany->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
