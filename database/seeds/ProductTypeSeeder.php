<?php

use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thisCategory = DB::table('producttype')->insertGetId([
            'name'=>'Select Product Category',
            'parent_id'=>0,
            'root'=>TRUE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Product Category Top'
        ]);

        $handbagCategory = DB::table('producttype')->insertGetId([
            'name'=>'Handbags',
            'parent_id'=>$thisCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Lady\'s Handbags'
        ]);

        $jewlryCategory = DB::table('producttype')->insertGetId([
            'name'=>'Jewlrey',
            'parent_id'=>$thisCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Jewlrey'
        ]);

        $dressCategory = DB::table('producttype')->insertGetId([
            'name'=>'Dresses',
            'parent_id'=>$thisCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Lady\'s Dresses'
        ]);

        $ringCategory = DB::table('producttype')->insertGetId([
            'name'=>'Rings',
            'parent_id'=>$jewlryCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Rings'
        ]);

        $chainCategory = DB::table('producttype')->insertGetId([
            'name'=>'Chains',
            'parent_id'=>$jewlryCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Chains'
        ]);

        $leatherPurseCategory = DB::table('producttype')->insertGetId([
            'name'=>'Leather Purses',
            'parent_id'=>$handbagCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Leather Purses'
        ]);

        $decorativeHandbagCategory = DB::table('producttype')->insertGetId([
            'name'=>'Decorative Handbags',
            'parent_id'=>$handbagCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Decorative Handbags'
        ]);
        $braceletCategory = DB::table('producttype')->insertGetId([
            'name'=>'Bracelets',
            'parent_id'=>$thisCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Bracelets'
        ]);

        $goldBraceletCategory = DB::table('producttype')->insertGetId([
            'name'=>'Gold Bracelets',
            'parent_id'=>$braceletCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Gold Bracelets'
        ]);

        $silverBraceletCategory = DB::table('producttype')->insertGetId([
            'name'=>'Silver Bracelets',
            'parent_id'=>$braceletCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Silver Bracelets'
        ]);

        $plasticBraceletCategory = DB::table('producttype')->insertGetId([
            'name'=>'Plastic Bracelets',
            'parent_id'=>$braceletCategory,
            'root'=>FALSE,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Plastic Bracelets'
        ]);






    }
}
