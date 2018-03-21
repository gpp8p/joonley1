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
        $medialinkReference = DB::table('medialink')->where('url','http://fashion.com/fcollect1')->first();
        DB::table('collecthaslinks')->insert([
            'collection_id'=>$reference->id,
            'medialink_id'=>$medialinkReference->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
