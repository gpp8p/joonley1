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
        $loc1 = DB::table('locations')->where('name', 'Planet Mars')->first();
        $loc2 = DB::table('locations')->where('name', 'Quebec, Canada')->first();
        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Rings With Bing',
            'website'=> 'www.rings.com',
            'icon'=>'12345678.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisCompany->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companyloc')->insert([
            'location_id'=>$thisCompany->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('companyloc')->insert([
            'location_id'=>$loc1->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCompany = DB::table('locations')->where('name', 'New York')->first();
        $newCompanyId=DB::table('company')->insertGetId([
            'name'=>    'Shop till you drop',
            'website'=> 'www.shopanddrop.com',
            'icon'=>'2476831.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisCompany->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisCompany->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$loc2->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisCompany = DB::table('locations')->where('name', 'Hong Kong')->first();
        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Trinkets Unlimited',
            'website'=> 'www.trinkets.com',
            'icon'=>'987654321.jpg',
//            'location_id'=>$thisCompany->id,
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisCompany->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$loc1->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Junk From China',
            'website'=> 'www.chinajunk.com',
            'icon'=>'6666543.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisCompany->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$loc2->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$loc1->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisCompany = DB::table('locations')->where('name', 'New York')->first();
        $newCompanyId = DB::table('company')->insertGetId([
            'name'=>    'Accessories Today',
            'website'=> 'www.accessories.com',
            'icon'=>'23465432.jpg',
            'phone'=> $faker->phoneNumber,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'reseller_id'=>'1234567890',
//            'location_id'=>$thisCompany->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$thisCompany->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('companyloc')->insert([
            'location_id'=>$loc1->id,
            'company_id'=>$newCompanyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
