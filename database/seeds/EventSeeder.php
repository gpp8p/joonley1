<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $initUser = DB::table('users')->where('name', 'gpp8p')->first();
        $user = DB::table('users')
            ->join('userdetails', 'users.id', '=', 'userdetails.user_id')
            ->where('users.id', 25)->first();
        $eventType = DB::table('eventtype')->where('slug', 'newuser')->first();
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        $shipType = DB::table('shiptype')->where('slug','air2')->first();
        DB::table('event')->insert([

            'from_user_id'=>$initUser->id,
            'billing_id'=>0,
            'shipping_id'=>0,
            'shiptype_id'=>$shipType->id,
            'company_id'=>$company->id,
            'collection_id'=>0,
            'product_id'=>0,
            'order_id'=>0,
            'user_id'=>$user->id,
            'message_id'=>0,
            'name'=>'New user created',
            'comment'=>'New user:'.$user->fname.' '.$user->lname.' was created',
            'eventtype_id'=>$eventType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $initUser = DB::table('users')->where('name', 'gpp8p')->first();
        $eventType = DB::table('eventtype')->where('slug', 'newcompany')->first();
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        DB::table('event')->insert([

            'from_user_id'=>$initUser->id,
            'billing_id'=>0,
            'shipping_id'=>0,
            'shiptype_id'=>$shipType->id,
            'company_id'=>$company->id,
            'collection_id'=>0,
            'product_id'=>0,
            'order_id'=>0,
            'user_id'=>$user->id,
            'message_id'=>0,
            'name'=>'New company created',
            'comment'=>'New Company:'.$company->name.' was added '.$company->website,
            'eventtype_id'=>$eventType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $initUser = DB::table('users')->where('name', 'gpp8p')->first();
        $eventType = DB::table('eventtype')->where('slug', 'coladded')->first();
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        $collection = DB::table('collection')->where('slug', 'fcollect1')->first();
        DB::table('event')->insert([

            'from_user_id'=>$initUser->id,
            'billing_id'=>0,
            'shipping_id'=>0,
            'shiptype_id'=>$shipType->id,
            'company_id'=>$company->id,
            'collection_id'=>0,
            'product_id'=>0,
            'order_id'=>0,
            'user_id'=>$user->id,
            'message_id'=>0,
            'name'=>'New collection created',
            'comment'=>'New Collection:'.$collection->name.' was added ',
            'eventtype_id'=>$eventType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);




    }
}
