<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'large',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'medium',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'small',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'size 6',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'size 7',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'size 8',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'size 9',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('optiontype')->where('slug', 'size')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'size 10',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('optiontype')->where('slug', 'color')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'Red',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $type = DB::table('optiontype')->where('slug', 'color')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'White',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $type = DB::table('optiontype')->where('slug', 'color')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'Blue',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $type = DB::table('optiontype')->where('slug', 'null')->first();
        DB::table('options')->insert([
            'optiontype_id'=>$type->id,
            'specification'=>'small',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);




    }
}
