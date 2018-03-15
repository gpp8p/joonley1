<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

//        $newTermId = $thisTerms->addTerm("Net 60-day", 2, 6);
    }
}
