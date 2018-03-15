<?php

use Illuminate\Database\Seeder;

class MessageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messagetype')->insert([
            'name' => 'New User Notification',
            'slug' => 'nunotif',
            'description'=> 'Notification of a new user',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('messagetype')->insert([
            'name' => 'New Company Notification',
            'slug' => 'ncompnotif',
            'description'=> 'Notification of a new company',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('messagetype')->insert([
            'name' => 'New Collection Notification',
            'slug' => 'ncolnotif',
            'description'=> 'Notification of a new collection',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('messagetype')->insert([
            'name' => 'New Order Request',
            'slug' => 'nordereq',
            'description'=> 'Request for a new order',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('messagetype')->insert([
            'name' => 'New Order response',
            'slug' => 'orderresp',
            'description'=> 'Response to a new order',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);




    }
}
