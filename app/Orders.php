<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Orders extends Model
{
    public function startNewOrder($companyId)
    {
        $startingOrderStatusId = DB::table('orderstatus')->where('name', 'In Preparation')->first()->id;
        if($startingOrderStatusId==NULL)
        {
            throw new Exception('Could not find preparation order status');
        }
        try {
            $newOrderId = DB::table('orders')->insertGetId([
                'cust_comp_id' => $companyId,
                'status' => $startingOrderStatusId,
                'shipping' => 0,
                'tax' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        } catch (Exception $e) {
            throw new Exception('Could not create new order:'.$e->getMessage());
        }
        return $newOrderId;
    }

    public function removeStartingOrder($orderId)
    {
        if(!DB::table('orders')->where('id',$orderId)->exists())
        {
            throw new Exception('Order does not exist - cannot remove it');
        }
        $orderToRemove = DB::table('orders')->where('id',$orderId)->first();
        $startingOrderStatusId = DB::table('orderstatus')->where('name', 'In Preparation')->first()->id;
        if($orderToRemove->status!=$startingOrderStatusId){
            throw new Exception('Order does not exist - cannot remove it');
        }
        try {
            $nrd = DB::table('orders')->where('id', $orderId)->delete();
        } catch (Exception $e) {
            throw new Exception('Order not in preparation status');
        }
    }
}
