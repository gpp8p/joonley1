<?php

use Illuminate\Database\Seeder;
use \App\NestedCategory;

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

        $thisNestedCategory = new \App\NestedCategory;
        $thisNestedCategory->addCategory('Handbags', 'ladies handbags', 'Select Product Category');
        $thisNestedCategory->addCategory('Housewares', 'around the house..', 'Select Product Category');
        $thisNestedCategory->addCategory('Vases', 'flower vases', 'Housewares');
        $thisNestedCategory->addCategory('Candles', 'candles', 'Housewares');
        $thisNestedCategory->addCategory('Leather Purses', 'Leather Purses', 'Handbags');
        $thisNestedCategory->addCategory('Decorative Handbags', 'Leather Purses', 'Handbags');
        $thisNestedCategory->addCategory('Jewelry', 'Jewelry', 'Select Product Category');
        $thisNestedCategory->addCategory('Rings', 'Rings', 'Jewelry');
        $thisNestedCategory->addCategory('Keychains', 'keychains', 'Jewelry');
        $thisNestedCategory->addCategory('Leather Keychains', 'keychains made of leather', 'Keychains');
        $thisNestedCategory->addCategory('Silver Keychains', 'keychains made of silver', 'Keychains');
        $thisNestedCategory->addCategory('Chains', 'Chains', 'Jewelry');
        $thisNestedCategory->addCategory('Bracelets', 'Bracelets', 'Select Product Category');
        $thisNestedCategory->addCategory('Gold Bracelets', 'Gold Bracelets', 'Bracelets');
        $thisNestedCategory->addCategory('Silver Bracelets', 'Silver Bracelets', 'Bracelets');
        $thisNestedCategory->addCategory('Plastic Bracelets', 'Plastic Bracelets', 'Bracelets');
        $thisNestedCategory->addCategory('Blouses', 'Blouses', 'Select Product Category');


    }
}
