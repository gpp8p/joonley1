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



        $productToAdd = DB::table('product')->where('name', 'Parisian Blouse')->first();
        $thisOptions = new \App\Options;
        $optionTypeArray = $thisOptions->getDefaultOptionsForProducttype($productToAdd->type_id);
        $optionsSelected = array($optionTypeArray['Color'][0][1],$optionTypeArray['Size'][0][1]);
        $thisShipTypeId = DB::table('shiptype')->where('slug','air2')->first()->id;
        $quantity = 5;
        try {
            $thisLineItemId = $thisOrder->addProductToOrder($orderId, $productToAdd, $optionsSelected, $thisShipTypeId, $quantity);
        } catch (Exception $e) {
            echo('###Unable to add product:'.$e->getMessage());
            $this->assertTrue(false);
        }
        if(!DB::table('ordercontains')->where('id',$thisLineItemId)->exists())
        {
            echo('##could not find newly added line item entry');
            $this->assertTrue(false);
        }
        $lineItemAdded = DB::table('ordercontains')->where('id',$thisLineItemId)->first();
        $this->assertTrue($lineItemAdded->product_id==$productToAdd->id);

        if(!DB::table('orderoptions')->where('ord_contains_id',$thisLineItemId)->exists())
        {
            echo('##could not find newly added line item entry options');
            $this->assertTrue(false);
        }
        $optionAdded =DB::table('orderoptions')->where('ord_contains_id',$thisLineItemId)->first();
        $this->assertTrue($optionAdded->ord_contains_id==$thisLineItemId);

        $thisOrder->removeStartingOrder($orderId);
        if(DB::table('orders')->where('id',$orderId)->exists())
        {
            $this->assertTrue(false);
        }
        $this->assertTrue(!DB::table('event')->where('order_id',$orderId)->where('company_id',$company->id)->exists());
        if(DB::table('ordercontains')->where('id',$thisLineItemId)->exists())
        {
            echo('##Line item was not deleted');
            $this->assertTrue(false);
        }
        if(DB::table('orderoptions')->where('ord_contains_id',$thisLineItemId)->exists())
        {
            echo('##Line item options were not deleted');
            $this->assertTrue(false);
        }

    }
}
