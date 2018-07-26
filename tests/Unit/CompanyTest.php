<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Exception;

class CompanyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisCompany = new \App\Company;
        $companyNameList = $thisCompany->names();
        $this->assertTrue(count($companyNameList)>0);
        $thisCompanyType = new \App\CompanyType;
        $companyTypesList = $thisCompanyType->getCompanyTypes();
        $this->assertTrue(count($companyTypesList)==7);
        $companyTypesList = $thisCompanyType->getCompanySellerTypes();
        $this->assertTrue(count($companyTypesList)==3);
        $companyTypesList = $thisCompanyType->getCompanyBuyerTypes();
        $this->assertTrue(count($companyTypesList)==4);
        try {
            $thisCompanyId = $thisCompany->getCompanyByName('Rings With Bing');
            $this->assertTrue($thisCompanyId==1);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $thisCompanyId = $thisCompany->getCompanyByName('baloney');
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
        try {
            $newCompanyId = $thisCompany->addNewCompany('New Company Name3', 'newweb.com', '999-999-9999', 2, 1, '98989898.jpg');
        } catch (Exception $e) {
            echo($e->getMessage());
            $this->assertTrue(false);
        }
        try {
            $thisCompanyId = $thisCompany->getCompanyByName('New Company Name3');
            $this->assertTrue($newCompanyId==$thisCompanyId);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $thisCompany->deleteCompany($thisCompanyId);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $thisCompanyId = $thisCompany->getCompanyByName('New Company Name3');
            $this->assertTrue($newCompanyId==$thisCompanyId);
        } catch (Exception $e) {
            $this->assertTrue(true);
        }
        try {
            $thisCompanyId = $thisCompany->getCompanyByName('Trinkets Unlimited');
            $this->assertTrue($thisCompanyId==3);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }

        try {
            $thisCompany->editCompany($thisCompanyId, 'Cheap Trinkets Unlimited', 'www.ultracheaptrinkets.com', '451) 307-2650 x71724', 9, [1, 3]);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $thisCompanyId = $thisCompany->getCompanyByName('Cheap Trinkets Unlimited');
            $this->assertTrue($thisCompanyId==3);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        try {
            $thisCompany->editCompany($thisCompanyId, 'Trinkets Unlimited', 'www.ultracheaptrinkets.com', '451) 307-2650 x71724', 9, [1, 3]);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }




    }
}
