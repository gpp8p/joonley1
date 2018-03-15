<?php

use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = DB::table('termstype')->where('slug', 'shipping')->first();
        DB::table('terms')->insert([
            'termstype_id'=>$type->id,
            'specification'=>'buyer pays for shipping',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('termstype')->where('slug', 'shipping')->first();
        DB::table('terms')->insert([
            'termstype_id'=>$type->id,
            'specification'=>'seller pays for shipping',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


        $type = DB::table('termstype')->where('slug', 'payment')->first();
        DB::table('terms')->insert([
            'termstype_id'=>$type->id,
            'specification'=>'Net 30-day',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        



    }
}
