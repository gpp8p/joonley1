<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Orders extends Model
{
    public function startNewOrder($company, $user)
    {
        if(!isset($company)|!isset($user)){
            throw new Exception("Incomplete parameters passed to startNewOrder");
        }
        $startingOrderStatusId = DB::table('orderstatus')->where('name', 'In Preparation')->first()->id;
        if($startingOrderStatusId==NULL)
        {
            throw new Exception('Could not find preparation order status');
        }
        $startingOrderEventType = DB::table('eventtype')->where('slug', 'orderstart')->first();
        if($startingOrderEventType ==NULL)
        {
            throw new Exception('Could not find starting order event type');
        }
        $thisEvent = new \App\Event;
        try {
            DB::beginTransaction();
            $newOrderId = DB::table('orders')->insertGetId([
                'cust_comp_id' => $company->id,
                'status' => $startingOrderStatusId,
                'shipping' => 0,
                'tax' => 0,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            $eventData = array(
                'company_id' => $company->id,
                'from_user_id'=>$user->id,
                'order_id'=>$newOrderId,
                'name'=>'Order Initiated',
                'comment'=>'New Order was initiated by:'.$company->name.' - '.$user->name,
            );
            try {
                $thisEvent->addNewEvent($eventData, $startingOrderEventType);
            } catch (Exception $e) {
                throw new Exception('Could not add an event:'.$e->getMessage());
            }


        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not create new order:'.$e->getMessage());
        }
        DB::commit();
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
            throw new Exception('Order not in preparation status');
        }
        try {
            DB::beginTransaction();
            $nrd = DB::table('orders')->where('id', $orderId)->delete();
            $ned = DB::table('event')->where('order_id', $orderId)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not remove order:'.$e->getMessage());
        }
    }

    public function getIncompleteOrders($companyId)
    {
        $incompleteOrders = DB::table('orders')
            ->join('orderstatus', 'status','=', 'orderstatus.id')
            ->where('cust_comp_id',$companyId)->get();
        return $incompleteOrders;

    }
}
