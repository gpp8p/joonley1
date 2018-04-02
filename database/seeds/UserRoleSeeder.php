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
    }
}
