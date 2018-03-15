<?php

use Illuminate\Database\Seeder;

class MessageToSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messageto')->insert([
            'message_id'=>1,
            'to_user_id'=>2,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('messageto')->insert([
            'message_id'=>1,
            'to_user_id'=>3,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('messageto')->insert([
            'message_id'=>1,
            'to_user_id'=>4,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('messageto')->insert([
            'message_id'=>2,
            'to_user_id'=>2,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('messageto')->insert([
            'message_id'=>2,
            'to_user_id'=>3,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('messageto')->insert([
            'message_id'=>2,
            'to_user_id'=>4,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('messageto')->insert([
            'message_id'=>3,
            'to_user_id'=>2,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('messageto')->insert([
            'message_id'=>3,
            'to_user_id'=>3,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        DB::table('messageto')->insert([
            'message_id'=>3,
            'to_user_id'=>4,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
