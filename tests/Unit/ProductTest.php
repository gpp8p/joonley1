<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;


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
        $productType = DB::table('producttype')->where('name', 'Rings')->first();
        $productName = 'Diamond Ring';
        $productDescription = 'Flashy diamond ring perfect for engagements';
        $productMediaUrl = 'http://www.rings.com/12345.jpg';
        $productMediaType = DB::table('mediatype')->where('slug', 'image')->first();
        $productCompany = DB::table('company')->where('name', 'Rings With Bing')->first();
        $productCollection = DB::table('collection')->where('name', 'Fall Ring Collection')->first();
        $productContainedAs = DB::table('containedas')->where('name','In Stock For Sale')->first();
        $productq1Price = 10.95;
        $productq10Price = 9.95;
        $productShippingWeight = 0.25;
        $productInfo = array(
            'productType'=>$productType,
            'productName'=>$productName,
            'productDescription'=>$productDescription,
            'productMediaUrl'=>$productMediaUrl,
            'productMediaType'=>$productMediaType,
            'productCompany'=>$productCompany,
            'productCollection'=>$productCollection,
            'productContainedAs'=>$productContainedAs,
            'productq1Price'=>$productq1Price,
            'productq10Price'=>$productq10Price,
            'productShippingWeight'=>$productShippingWeight,
        );
        try {
            $newProductId = $thisProduct->addProductUsingDefaults($productInfo);
        } catch (Exception $e) {
            echo('##'.$e->getMessage());
            $this->assertTrue(false);
        }
        $this->assertTrue(DB::table('product')->where('id',$newProductId)->exists());
        $this->assertTrue(DB::table('product')->where('description',$productDescription)->exists());
        $this->assertTrue(DB::table('medialink')->where('url',$productMediaUrl)->exists());
        $this->assertTrue(DB::table('collectionhas')->where('product_id',$newProductId)->exists());
        $this->assertTrue(DB::table('hasoptions')->where('product_id',$newProductId)->exists());
        $this->assertTrue(DB::table('hasterms')->where('product_id',$newProductId)->exists());

        try {
            $thisProduct->removeProduct($newProductId);
        } catch (Exception $e) {
            echo('## remove failed'.$e->getMessage());
            $this->assertTrue(false);
        }
        $this->assertFalse(DB::table('product')->where('id',$newProductId)->exists());
        $this->assertFalse(DB::table('medialink')->where('url',$productMediaUrl)->exists());
        $this->assertFalse(DB::table('collectionhas')->where('product_id',$newProductId)->exists());
        $this->assertFalse(DB::table('hasoptions')->where('product_id',$newProductId)->exists());
        $this->assertFalse(DB::table('hasterms')->where('product_id',$newProductId)->exists());

    }
}
