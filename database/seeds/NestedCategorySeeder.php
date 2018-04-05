<?php

use Illuminate\Database\Seeder;

class NestedCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thisCategory = DB::table('nested_category')->insertGetId([
            'name'=>'Select Product Category',
            'lft'=>1,
            'rgt'=>2,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),
            'description'=>'Product Category Top'
        ]);
    }
}
