<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;


class NestedCategoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $thisNestedCategory = new \App\NestedCategory;
        $this->assertTrue(true);
        // testing add category
        try {
            $thisNestedCategory->addCategory('Summer Dress', 'Light Summer Dress for tranvestites', 'Blouses');
        } catch (Exception $e) {
            echo('##'.$e->getMessage());
            $this->assertTrue(false);
        }
        // testing find a sub category just added
        try {
            $childList = $thisNestedCategory->findChildNodes('Blouses');
        } catch (Exception $e) {
            echo('##'.$e->getMessage());
            $this->assertTrue(false);
        }
        // testing check for duplicate add
        $this->assertTrue($childList[0]=='Summer Dress');
        try {
            $thisNestedCategory->addCategory('Summer Dress', 'Light Summer Dress for tranvestites', 'Blouses');
            echo('did not catch the duplicate add');
            $this->assertTrue(false);
        } catch (Exception $e) {
        }
        //testing immediate parent
        $thisImmediateParent = $thisNestedCategory->immediateParent('Summer Dress');
        $this->assertTrue($thisImmediateParent['name']=='Blouses');
        $rootImmediateParent = $thisNestedCategory->immediateParent('Select Product Category');
        $this->assertTrue($rootImmediateParent==null);

        try {
            $thisNestedCategory->addCategory('Tank Top', 'Skimpy tank top suitable for hookers', 'Summer Dress');
        } catch (Exception $e) {
            echo('##'.$e->getMessage());
            $this->assertTrue(false);
        }

        try {
            $thisNestedCategory->addCategory('Transparent Shirt', 'Transparent shirt', 'Summer Dress');
        } catch (Exception $e) {
            echo('##'.$e->getMessage());
            $this->assertTrue(false);
        }


        // testing remove category
        try {
            $thisNestedCategory->deleteCategory('Summer Dress');
        } catch (Exception $e) {
            echo($e->getMessage());
            $this->assertTrue(false);
        }
        $this->assertFalse(DB::table('nested_category')->where('name','Summer Dress')->exists());
        $this->assertFalse(DB::table('nested_category')->where('name','Tank Top')->exists());
        $this->assertFalse(DB::table('nested_category')->where('name','Transparent Shirt')->exists());





    }
}
