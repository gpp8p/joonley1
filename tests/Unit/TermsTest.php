<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;


class TermsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisTerms = new \App\Terms;
        $thisTermsTypes = $thisTerms->getTermsTypes();
        $this->assertTrue($thisTermsTypes[0]->name == "Shipping");
        $this->assertTrue($thisTermsTypes[0]->id == 1);

        $thisTermsList = $thisTerms->getTerms('shipping');
        $this->assertTrue($thisTermsList[0]->specification == "buyer pays for shipping");
        $this->assertTrue($thisTermsList[0]->id == 1);

        try {
            $newTermId = $thisTerms->addTerm("Net 60-day", 2, 'net60');
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $newTerm = DB::table('terms')->where('slug', 'net60')->first();
        $this->assertTrue($newTerm->id == $newTermId);
        $this->assertTrue(DB::table('terms')->where('slug', 'net60')->exists());
        $detetedTermsRecords = $thisTerms->removeTerm($newTerm->id);
        $this->assertTrue($detetedTermsRecords>0);
        $this->assertFalse(DB::table('terms')->where('slug', 'net60')->exists());
        $net30Terms = DB::table('terms')->where('slug', 'net30')->first();
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();
        try {
            $newDefaultTermsId = $thisTerms->addDefaultTerms($company->id, $net30Terms->id);
        } catch (Exception $e) {
            if(!$e->getMessage()=='That default term already exists')
            {
                $this->assertTrue(false);
            }
        }
        $newTerm = DB::table('terms')->where('slug', 'sellerpays')->first();
        try {
            $newDefaultTermsId = $thisTerms->addDefaultTerms($company->id, $newTerm->id);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }

        try {
            $detetedDefaultTermsRecords = $thisTerms->removeDefaultTerms($company->id, $newTerm->id);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $this->assertTrue($detetedDefaultTermsRecords>0);
        $product = DB::table('product')->where('name', 'Gold pinky ring')->first();
        $terms = DB::table('terms')->where('slug', 'sellerpays')->first();
        try {
            $newTermsId = $thisTerms->addHasTerms($product->id, $terms->id);
            if($newTermsId ==NULL)
            {
                $this->assertTrue(false);
            }
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $termsDeleted = $thisTerms->removeHasTerms($product->id, $terms->id);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $this->assertTrue($termsDeleted>0);
        $termsReturned = $thisTerms->getTermsForProductId($product->id);
        $this->assertTrue($termsReturned[0]->slug == "buyerpays");
    }
}
