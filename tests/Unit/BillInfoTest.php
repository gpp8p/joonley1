<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;
use Faker\Factory as Faker;


class BillInfoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisBillInfo = new \App\BillInfo;
        $companyId = DB::table('company')->where('name','Rings With Bing')->first();
        try {
            $allBillInfoForCompany = $thisBillInfo->getBillInfoForCompany($companyId->id);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        foreach($allBillInfoForCompany as $billRcd)
        {
            if($billRcd->company_id !=$companyId->id)
            {
                echo('\nWrong  record company id'.$billRcd->company_id);
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
            'wireinfo'=>'misc wire info',
        );

        try {
            $thisBillInfoId = $thisBillInfo->addBillInfo($companyId, $newInfo);
        } catch (Exception $e) {
            echo('\n'.$e->getMessage());
            $this->assertTrue(false);
        }
        $justAddedBillingInfo = DB::table('billinfo')->where('id',$thisBillInfoId)->first();
        if($justAddedBillingInfo->company_id !=$companyId->id)
        {
            $this->assertTrue('false');
        }
        $editInfo = array(
            'lname' =>'edited lname',
            'fname' =>'edited fname',
        );
        try {
            $thisBillInfo->editBillInfo($justAddedBillingInfo->id, $editInfo);
        } catch (Exception $e) {
            echo('\n'.$e->getMessage());
            $this->assertTrue(false);
        }
        $testBillInfoRcd = DB::table('billinfo')->where('id', $thisBillInfoId)->first();
        $this->assertTrue($testBillInfoRcd->lname=='edited lname');
        $this->assertTrue($testBillInfoRcd->fname=='edited fname');
        try {
            $rcdsRemoved = $thisBillInfo->removeBillInfo($thisBillInfoId);
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
