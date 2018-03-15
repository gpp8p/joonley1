<?php

use Illuminate\Database\Seeder;

class ContainedAsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('containedas')->insert([
            'name' => 'In Stock For Sale',
            'slug' => 'issale',
            'description'=> 'Product is in stock and avaiolable for order',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('containedas')->insert([
            'name' => 'Backordered For Sale',
            'slug' => 'bosale',
            'description'=> 'Product is backordered but available for order',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('containedas')->insert([
            'name' => 'Ordered not shipped',
            'slug' => 'ordnoship',
            'description'=> 'Product has been ordered but not yet shipped',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('containedas')->insert([
            'name' => 'Ordered and shipped',
            'slug' => 'ordship',
            'description'=> 'Product has been ordered and has been shipped',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('containedas')->insert([
            'name' => 'Preview no order',
            'slug' => 'prevnoord',
            'description'=> 'Product is being previewed but cannot be ordered yet',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);



    }
}
