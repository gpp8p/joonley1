<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messageType = DB::table('messagetype')->where('slug', 'nunotif')->first();
        $event = DB::table('event')->where('name', 'New user created')->first();
        $fromUser= DB::table('users')->where('name', 'gpp8p')->first();
        DB::table('message')->insert([
            'type_id'=>$messageType->id,
            'event_id'=>$event->id,
            'from_id'=>$fromUser->id,
            'content'=>'Easter Kovacek was created as a new user',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $messageType = DB::table('messagetype')->where('slug', 'ncompnotif')->first();
        $event = DB::table('event')->where('name', 'New company created')->first();
        $fromUser= DB::table('users')->where('name', 'gpp8p')->first();
        DB::table('message')->insert([
            'type_id'=>$messageType->id,
            'event_id'=>$event->id,
            'from_id'=>$fromUser->id,
            'content'=>'Rings With Bing was added as a new company',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $messageType = DB::table('messagetype')->where('slug', 'ncolnotif')->first();
        $event = DB::table('event')->where('name', 'New collection created')->first();
        $fromUser= DB::table('users')->where('name', 'gpp8p')->first();
        DB::table('message')->insert([
            'type_id'=>$messageType->id,
            'event_id'=>$event->id,
            'from_id'=>$fromUser->id,
            'content'=>'Collection: Fall Ring Collection was added',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);




    }
}
