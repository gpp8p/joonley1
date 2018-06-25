<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => "{\"message-admin\":true, \"read-message\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('roles')->insert([
            'name' => 'Administrator',
            'slug' => 'admin',
            'permissions' => "{\"create-data\":true,\"update-data\":true,\"read-data\":true,\"delete-data\":true,\"edit-users\":true,\"admin-dashboard\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('roles')->insert([
            'name' => 'Guest',
            'slug' => 'guest',
            'permissions' => "{\"feed\":true, \"msg-admin\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('roles')->insert([
            'name' => 'Admin-Editor',
            'slug' => 'admineditor',
            'permissions' => "{\"read-content\":true, \"update-content\":true, \"delete-content\":true }",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('roles')->insert([
            'name' => 'User-Seller',
            'slug' => 'userseller',
            'permissions' => "{\"read-own-data\":true, \"update-own-data\":true, \"delete-own-data:true, \"read-own-content\":true, \"update-own-content\":true, \"delete-own-content\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name' => 'User-Buyer',
            'slug' => 'userbuyer',
            'permissions' => "{\"read-own-data\":true, \"update-own-data\":true, \"delete-own-data:true,}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('roles')->insert([
            'name' => 'Guest-Seller',
            'slug' => 'guestseller',
            'permissions' => "{\"feed\":true, \"msg-admin\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('roles')->insert([
            'name' => 'Guest-Buyer',
            'slug' => 'guestbuyer',
            'permissions' => "{\"feed\":true, \"msg-sellers\":true, \"msg-admin\":true, \"create-orders-cc\",true, \"read-own-data\",\"update-own-data\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);






    }
}
