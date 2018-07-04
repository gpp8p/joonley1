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
            'name' => 'Administrator',
            'slug' => 'admin',
            'permissions' => "{\"create-data\":true,\"update-data\":true,\"read-data\":true,\"delete-data\":true,\"edit-users\":true,\"admin-dashboard\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);


        DB::table('userrole')->insert([
            'name' => 'Admin-Editor',
            'slug' => 'adminedit',
            'permissions' => "{\"read-content\":true, \"update-content\":true, \"delete-content\":true }",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('userrole')->insert([
            'name' => 'Admin-Market',
            'slug' => 'adminmarket',
            'permissions' => "{\"read-content\":true, \"update-content\":true, \"delete-content\":true }",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('userrole')->insert([
            'name' => 'Admin-Feed',
            'slug' => 'adminfeed',
            'permissions' => "{\"read-content\":true, \"update-content\":true, \"delete-content\":true }",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);


        DB::table('userrole')->insert([
            'name' => 'Seller',
            'slug' => 'seller',
            'permissions' => "{\"read-own-data\":true, \"update-own-data\":true, \"delete-own-data\":true, \"read-own-content\":true, \"update-own-content\":true, \"delete-own-content\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('userrole')->insert([
            'name' => 'Seller-Owner',
            'slug' => 'sellerowner',
            'permissions' => "{\"read-own-data\":true, \"update-own-data\":true, \"delete-own-data\":true, \"read-own-content\":true, \"update-own-content\":true, \"delete-own-content\":true}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        DB::table('userrole')->insert([
            'name' => 'Buyer-Owner',
            'slug' => 'buyerowner',
            'permissions' => "{\"read-own-data\":true, \"update-own-data\":true, \"delete-own-data:true,}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);

        DB::table('userrole')->insert([
            'name' => 'Buyer',
            'slug' => 'buyer',
            'permissions' => "{\"read-own-data\":true, \"update-own-data\":true, \"delete-own-data:true,}",
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()

        ]);


    }
}
