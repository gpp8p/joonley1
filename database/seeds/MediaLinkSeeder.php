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
        $reference = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $type = DB::table('mediatype')->where('slug', 'image')->first();
        DB::table('medialink')->insert([
            'reference_id'=>$reference->id,
            'mediatype_id'=>$type->id,
            'pertainsto'=>'product',
            'url'=>'http://mymedia.com/ring5',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $reference = DB::table('product')->where('name', 'Zirconium ring')->first();
        $type = DB::table('mediatype')->where('slug', 'image')->first();
        DB::table('medialink')->insert([
            'reference_id'=>$reference->id,
            'mediatype_id'=>$type->id,
            'pertainsto'=>'product',
            'url'=>'http://mymedia.com/ring6',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $reference = DB::table('product')->where('name', 'Silver inlaid ring')->first();
        $type = DB::table('mediatype')->where('slug', 'image')->first();
        DB::table('medialink')->insert([
            'reference_id'=>$reference->id,
            'mediatype_id'=>$type->id,
            'pertainsto'=>'product',
            'url'=>'http://mymedia.com/ring6',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $reference =  DB::table('collection')->where('slug', 'fcollect1')->first();
        $type = DB::table('mediatype')->where('slug', 'website')->first();
        DB::table('medialink')->insert([
            'reference_id'=>$reference->id,
            'mediatype_id'=>$type->id,
            'pertainsto'=>'collection',
            'url'=>'http://fashion.com/fcollect1',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
