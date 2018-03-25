<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;
use Faker\Factory as Faker;

class ShipInfoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


    public function testExample()
    {
        $this->assertTrue(true);
        $thisShipInfo = new \App\Shipinfo;
        $companyId = DB::table('company')->where('name','Rings With Bing')->first();
        try {
            $allShipInfoForCompany = $thisShipInfo->getShipInfoForCompany($companyId->id);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        foreach($allShipInfoForCompany as $shipRcd)
        {
            if($shipRcd->company_id !=$companyId->id)
            {
                echo('\nWrong shipping record company id'.$shipRcd->company_id);
                $this->assertTrue(false);
            }
        }
        $faker = Faker::create();
        $newInfo = array(
            'company_id'=>$companyId->id,
            'title' => $faker->title,
            'lname' => $faker->lastname,
            'fname' => $faker->firstNameMale,
            'addr1' =>$faker->address,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'phone' => $faker->phoneNumber,
        );

        try {
            $thisShipInfoId = $thisShipInfo->addShipInfo($companyId, $newInfo);
        } catch (Exception $e) {
            echo('\n'.$e->getMessage());
            $this->assertTrue(false);
        }
        $justAddedShippingInfo = DB::table('shipinfo')->where('id',$thisShipInfoId)->first();
        if($justAddedShippingInfo->company_id !=$companyId->id)
        {
            $this->assertTrue('false');
        }
        $editInfo = array(
            'lname' =>'edited lname',
            'fname' =>'edited fname',
        );
        $thisShipInfo->editShipInfo($justAddedShippingInfo->id, $editInfo);
        try {
            $rcdsRemoved = $thisShipInfo->removeShipInfo($thisShipInfoId);
        } catch (Exception $e) {
            echo('\n'.$e->getMessage());
            $this->assertTrue(false);
        }
        if(!$rcdsRemoved>0)
        {
            $this->assertTrue(false);
        }

    }
}
