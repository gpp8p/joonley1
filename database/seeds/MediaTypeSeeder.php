<?php

use Illuminate\Database\Seeder;

class MediaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mediatype')->insert([
            'name' => 'Picture',
            'slug' => 'image',
            'description'=> 'Picture',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('mediatype')->insert([
            'name' => 'Video',
            'slug' => 'video',
            'description'=> 'Video',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('mediatype')->insert([
            'name' => 'Website',
            'slug' => 'website',
            'description'=> 'website',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);

        DB::table('mediatype')->insert([
            'name' => 'Icon',
            'slug' => 'icon',
            'description'=> 'identifying icon',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
        ]);



    }
}
