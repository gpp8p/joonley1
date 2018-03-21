<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;


class OptionsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisOptions = new \App\Options;
        $allOptionTypes = $thisOptions->getAllOptionTypes();
        $this->assertTrue($allOptionTypes[0]->name=="Color");
        $allOptions = $thisOptions->getOptionsBySlug('size');
        $this->assertTrue($allOptions[1]->specification == 'medium');
        $allOptions = $thisOptions->getOptionsByOptionTypeId(2);
        $this->assertTrue($allOptions[1]->specification == 'medium');
        try {
            $thisOptions->addOption('huge', 'size');
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        // tests duplicate catch
        try {
            $thisOptions->addOption('huge', 'size');
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
        // tests delete
        try {
            $recordsDeleted = $thisOptions->removeOption('huge', 'size');
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $this->assertTrue($recordsDeleted>0);
        // tests bad optiontype catch
        try {
            $recordsDeleted = $thisOptions->removeOption('huge', 'baloney');
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
        // test adding a default option
        $thisProductType = DB::table('producttype')->where('name','Chains')->get();
        try {
            $thisDefaultOptionId = $thisOptions->addDefaultOption($allOptions[3], $thisProductType[0]);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        // test deleting a default option
        try {
            $defaultRecordsDeleted = $thisOptions->deleteDefaultOption($allOptions[3], $thisProductType[0]);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        // test catching an attempt to delete a non-existent default option
        $this->assertTrue($defaultRecordsDeleted>0);
        try {
            $defaultRecordsDeleted = $thisOptions->deleteDefaultOption($allOptions[3], $thisProductType[0]);
            $this->assertTrue(false);
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
        // test adding a product option
        $thisProduct = DB::table('product')->where('name', 'Leather Necklace')->get();
        try {
            $productOptionId = $thisOptions->addProductOption($allOptions[3], $thisProduct[0]);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        // test deleting a product option
        try {
            $productOptionsDeleted = $thisOptions->deleteProductOption($allOptions[3], $thisProduct[0]);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $this->assertTrue($productOptionsDeleted>0);
        // test creating links to a product from an option set using the set of default options for that type
        $productType = DB::table('producttype')->where('name', 'Chains')->first();
        $product = DB::table('product')->where('name', 'Leather Necklace')->first();
        try {
            $defaultOptionsLinkedToProduct = $thisOptions->linkDefaultOptionsToProduct($productType, $product->id);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        // test removing those links
        $this->assertTrue(count($defaultOptionsLinkedToProduct)>0);
        try {
            $numberOfDeletedLinks = $thisOptions->removeOptionLinksFromProduct($product);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $this->assertTrue(count($defaultOptionsLinkedToProduct)==$numberOfDeletedLinks);


    }
}
