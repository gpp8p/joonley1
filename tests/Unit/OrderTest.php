<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;


class OrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisOrder = new \App\Orders;

        $thisCompany = new \App\Company;
        $companyId = $thisCompany->getCompanyByName('Shop till you drop');
        try {
            $orderId = $thisOrder->startNewOrder($companyId);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $orderJustAddedId = DB::table('orders')->where('id',$orderId)->first()->id;
        $this->assertTrue($orderJustAddedId==$orderId);
        $thisOrder->removeStartingOrder($orderId);
        if(DB::table('orders')->where('id',$orderId)->exists())
        {
            $this->assertTrue(false);
        }
    }
}
