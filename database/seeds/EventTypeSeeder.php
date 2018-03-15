<?php

use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eventtype')->insert([
            'name'=>'Message Sent',
            'slug'=>'message',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'A message was sent'
        ]);

        DB::table('eventtype')->insert([
            'name'=>'Order Placed',
            'slug'=>'order',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'An order was placed'
        ]);

        DB::table('eventtype')->insert([
            'name'=>'Product Shipped',
            'slug'=>'pship',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'A product was shipped'
        ]);

        DB::table('eventtype')->insert([
            'name'=>'Collection Added',
            'slug'=>'coladded',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'A collection was added'
        ]);

        DB::table('eventtype')->insert([
            'name'=>'New User Requested',
            'slug'=>'newuserreq',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'A new user requested to be  added'
        ]);


        DB::table('eventtype')->insert([
            'name'=>'New User',
            'slug'=>'newuser',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'A new user was added'
        ]);

        DB::table('eventtype')->insert([
            'name'=>'New Copmpany',
            'slug'=>'newcompany',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'A new company was added'
        ]);




    }
}
