<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisProduct = new \App\Product;
        $sellableProducts = $thisProduct->getAllSellableProductsByCategory(5);
        $this->assertTrue($sellableProducts[1]->product=="Zirconium ring");
        $companyProducts = $thisProduct->getCompanyProducts(1);
        $this->assertTrue($companyProducts[1]->product=="Zirconium ring");

    }
}
