<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Exception;

class LocationsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $thisLocation = new \App\Locations;
        $thisLocationList = $thisLocation->getLocations();
        $this->assertTrue($thisLocationList[0][0]=="Arizona");
        $thisProductList = $thisLocation->getProductsByLocation("Virginia");
        $this->assertTrue($thisProductList[0]->product_name == "Gold pinky ring");
        try {
            $thisLocationId = $thisLocation->getLocationId('Virginia');
            $this->assertTrue($thisLocationId==2);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $thisLocationId = $thisLocation->getLocationId('Baloney');
            $this->assertTrue($thisLocationId==2);
        } catch (Exception $e) {
            $this->assertTrue(true);
        }

    }

}
