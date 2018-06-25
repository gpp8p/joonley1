<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userrole')->insert([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => "{\"create-data\":true,\"update-data\":true,\"read-data\":true,\"delete-data\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('userrole')->insert([
            'name' => 'Administrator',
            'slug' => 'admin',
            'permissions' => "{\"create-data\":true,\"update-data\":true,\"read-data\":true,\"delete-data\":true,\"edit-users\":true,\"admin-dashboard\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('userrole')->insert([
            'name' => 'Guest',
            'slug' => 'guest',
            'permissions' => "{\"read-data\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('userrole')->insert([
            'name' => 'Admin-Editor',
            'slug' => 'admineditor',
            'permissions' => "{\"read-content\":true, \"update-content\":true, \"delete-content\":true }",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('userrole')->insert([
            'name' => 'User-Seller',
            'slug' => 'userseller',
            'permissions' => "{\"read-own-data\":true, \"update-own-data\":true, \"delete-own-data:true, \"read-own-content\":true, \"update-own-content\":true, \"delete-own-content\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('userrole')->insert([
            'name' => 'User-Buyer',
            'slug' => 'userbuyer',
            'permissions' => "{\"read-own-data\":true, \"update-own-data\":true, \"delete-own-data:true,}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('userrole')->insert([
            'name' => 'Guest-Seller',
            'slug' => 'guestseller',
            'permissions' => "{\"feed\":true, \"msg-admin\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('userrole')->insert([
            'name' => 'Guest-Buyer',
            'slug' => 'guestbuyer',
            'permissions' => "{\"feed\":true, \"msg-sellers\":true, \"msg-admin\":true, \"create-orders-cc\",true, \"read-own-data\",\"update-own-data\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

    }
}
