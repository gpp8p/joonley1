<?php

use Illuminate\Database\Seeder;

class OptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('optiontype')->insert([
            'name' => 'Color',
            'slug' => 'color',
            'description'=> 'Color',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('optiontype')->insert([
            'name' => 'Size',
            'slug' => 'size',
            'description'=> 'Size',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('optiontype')->insert([
            'name' => 'null',
            'slug' => 'null',
            'description'=> 'null',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);


    }
}
