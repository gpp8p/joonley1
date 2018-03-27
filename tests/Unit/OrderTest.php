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


        $company = DB::table('company')->where('name','Shop till you drop')->first();
        $user = DB::table('users')->where('name','gpp8p')->first();
        try {
            $orderId = $thisOrder->startNewOrder($company, $user);
        } catch (Exception $e) {
            echo('\n'.$e->getMessage());
            $this->assertTrue(false);
        }
        $incompleteOrders = $thisOrder->getIncompleteOrders($company->id);
        $this->assertTrue(count($incompleteOrders)>0);
        $orderJustAddedId = DB::table('orders')->where('id',$orderId)->first()->id;
        $this->assertTrue($orderJustAddedId==$orderId);
        $this->assertTrue(DB::table('event')->where('order_id',$orderId)->where('company_id',$company->id)->exists());
        $thisOrder->removeStartingOrder($orderId);
        if(DB::table('orders')->where('id',$orderId)->exists())
        {
            $this->assertTrue(false);
        }
        $this->assertTrue(!DB::table('event')->where('order_id',$orderId)->where('company_id',$company->id)->exists());
    }
}
