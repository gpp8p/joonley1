<?php

use Illuminate\Database\Seeder;

class MediaLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = DB::table('mediatype')->where('slug', 'image')->first();
        DB::table('medialink')->insert([
            'mediatype_id'=>$type->id,
            'pertainsto'=>'product',
            'url'=>'http://localhost/joonley1/storage/app/public/no_images.jpg',
            'url_thumb'=>' http://localhost/joonley1/storage/app/public/no_images.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'image')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'product',
            'url'=>'http://localhost/joonley1/storage/app/public/no_images.jpg',
            'url_thumb'=>' http://localhost/joonley1/storage/app/public/no_images.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'image')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'url'=>'http://localhost/joonley1/storage/app/public/no_images.jpg',
            'url_thumb'=>' http://localhost/joonley1/storage/app/public/no_images.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'website')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'collection',
            'url'=>'http://localhost/joonley1/storage/app/public/no_images.jpg',
            'url_thumb'=>' http://localhost/joonley1/storage/app/public/no_images.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'icon')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'collection',
            'url'=>'http://localhost/joonley1/storage/app/public/no_images.jpg',
            'url_thumb'=>' http://localhost/joonley1/storage/app/public/no_images.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'icon')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'collection',
            'url'=>'http://localhost/joonley1/storage/app/public/no_images.jpg',
            'url_thumb'=>'http://localhost/joonley1/storage/app/public/no_images.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $type = DB::table('mediatype')->where('slug', 'nomedia')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'*',
            'url'=>'http://localhost/joonley1/storage/app/public/no_images.jpg',
            'url_thumb'=>' http://localhost/joonley1/storage/app/public/no_images.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
