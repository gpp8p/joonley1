<?php

use Illuminate\Database\Seeder;

class CollectHasLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reference =  DB::table('collection')->where('slug', 'fcollect1')->first();
        $medialinkReference = DB::table('medialink')->where('url','http://localhost/joonley1/storage/app/public/no_images.jpg')->first()->id;
        DB::table('collecthaslinks')->insert([
            'collection_id'=>$reference->id,
            'medialink_id'=>$medialinkReference,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
