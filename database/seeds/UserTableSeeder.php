<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thisUserRole = DB::table('userrole')->where('slug', 'admin')->first();
        $lastRcd =DB::table('users')->insertGetId([
            'name'=>    'gpp8p',
            'email'=>   'gpp8pvirginia@gmail.com',
            'password'=> Hash::make('n1tad0g'),
            'userrole_id'=>$thisUserRole->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $lastUserDetailsRcd =DB::table('userdetails')->insertGetId([
            'title'=>   'Mr.',
            'lname'=>   'Pipkin',
            'fname'=>   'George',
            'admin'=>   TRUE,
            'addr1'=>   '1051 Shannon Farm Lane',
            'addr2'=>   '',
            'addr3'=>   '',
            'city'=>    'Afton',
            'state'=>   'Va.',
            'zip'=>     '22920',
            'country'=> 'USA',
            'phone'=>   '434-123-4567',
            'user_id'=> $lastRcd,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $thisRole = DB::table('roles')->where('slug', 'admin')->first();


        $thisRoleId = $thisRole->id;

        DB::table('role_users')->insert([
            'user_id'=>$lastRcd,
            'role_id'=>$thisRoleId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $thisRole = DB::table('roles')->where('slug', 'user')->first();
        $thisUserRole = DB::table('userrole')->where('slug', 'user')->first();
        $thisRoleId = $thisRole->id;


        $faker = Faker::create();

        $limit = 33;

        for ($i = 0; $i < $limit; $i++) {
            $lastRcd=DB::table('users')->insertGetId([
                'name' => $faker->userName,
                'email' => $faker->unique()->email,
                'password'      => Hash::make('n1tad0g'),
                'userrole_id'=>$thisUserRole->id,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);
            $lastUserDetailsRcd =DB::table('userdetails')->insertGetId([
                'title' => $faker->title,
                'admin' => FALSE,
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
                'user_id'=> $lastRcd,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);
            DB::table('role_users')->insert([
                'user_id'=>$lastRcd,
                'role_id'=>$thisRoleId,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);

        }

    }
}
