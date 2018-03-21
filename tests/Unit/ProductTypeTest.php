<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTypeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $thisProductType = new \App\ProductType;
        $topLevelList = $thisProductType->topLevelCategoryMembersAndIds();
        $this->assertTrue(count($topLevelList)==4);
        $subList = $thisProductType->subCategoryMembersAndIds(2);
        $this->assertTrue(count($subList)==2);
        $subList = $thisProductType->subCategoryMembersAndIds(12);
        $this->assertTrue(count($subList)==0);
        $productList = $thisProductType->productsWithType(5);
        $this->assertTrue($productList[0]->name=="Gold pinky ring");

    }
}
