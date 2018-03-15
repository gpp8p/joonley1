<?php

use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collectionType = DB::table('collectiontype')->where('slug', 'rcatalog')->first();
        DB::table('collection')->insert([
            'name'=>    'Fall Ring Collection',
            'slug'=> 'fcollect1',
            'description'=>'Fall collection of rings from bing',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collection')->insert([
            'name'=>    'Spring Catalog',
            'slug'=> 'scollect1',
            'description'=>'Spring acessories collection',
            'status'=>'open',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('collection')->insert([
            'name'=>    'Denise\'s Spring Catalog',
            'slug'=> 'ldscollect1',
            'status'=>'open',
            'description'=>'Spring catalog from Laurel Denise',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $collectionType = DB::table('collectiontype')->where('slug', 'basket')->first();
        DB::table('collection')->insert([
            'name'=>    'gpp8p basket 02282018',
            'slug'=> 'basket1',
            'description'=>'Unpurchased basket - gpp8p 02282018',
            'type_id'=>$collectionType->id,
            'status'=>'unpurchased',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $collectionType = DB::table('collectiontype')->where('slug', 'preview')->first();
        DB::table('collection')->insert([
            'name'=>    'Bing\'s Preview Collection',
            'slug'=> 'preview21',
            'status'=>'view',
            'description'=>'Preview collection for Spring 2018 from Bing',
            'type_id'=>$collectionType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

    }
}
