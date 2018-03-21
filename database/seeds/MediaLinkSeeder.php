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
            'url'=>'http://mymedia.com/ring5',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'image')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'product',
            'url'=>'http://mymedia.com/ring6',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'image')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'product',
            'url'=>'http://mymedia.com/ring6',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'website')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'collection',
            'url'=>'http://fashion.com/fcollect1',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'icon')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'collection',
            'url'=>'http://fashion.com/compicon.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('mediatype')->where('slug', 'icon')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'collection',
            'url'=>'http://fashion.com/compicon2.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $type = DB::table('mediatype')->where('slug', 'nomedia')->first();
        DB::table('medialink')->insert([

            'mediatype_id'=>$type->id,
            'pertainsto'=>'*',
            'url'=>'http://nomedia/nomedia.jpg',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
