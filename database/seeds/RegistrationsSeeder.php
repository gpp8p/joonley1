<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RegistrationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $limit = 33;

        for ($i = 0; $i < $limit; $i++) {
            if ($i % 2 == 0) {
                $regtype = 'B';
                $rolesel = 2;
            }else{
                $regtype = 'S';
                $rolesel=1;
            }
            DB::table('registrations')->insert([
                'fname' => $faker->lastname,
                'lname' => $faker->firstNameMale,
                'email' => $faker->unique()->email,
                'phone' => $faker->phoneNumber,
                'comment' => $faker->paragraph,
                'strname' => $faker->company,
                'roleselected' => $rolesel,
                'strwebsite' => $faker->url,
                'straddr1' => $faker->address,
                'straddr2' => $faker->secondaryAddress,
                'strcity' => $faker->city,
                'strstate' => $faker->stateAbbr,
                'strzip' => $faker->postcode,
                'country' => $faker->country,
                'strid' => $faker->randomNumber,
                'strestab' => '2018',
                'password' => bcrypt('n1tad0g'),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'buysell_type'=>$regtype,
                'reg_status'=>'A'
            ]);
        }

    }
}
