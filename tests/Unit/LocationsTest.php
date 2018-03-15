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
        $this->assertTrue(count($thisLocationList)==9);
        $thisProductList = $thisLocation->getProductsByLocation(2);
        $this->assertTrue(count($thisProductList)==3);
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
