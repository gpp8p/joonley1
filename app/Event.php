<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;


class Event extends Model
{
    protected $table = 'event';

    public function addNewEvent($references, $eventType)
    {
        $eventData = [

            'from_user_id'=>0,
            'billing_id'=>0,
            'shipping_id'=>0,
            'shiptype_id'=>0,
            'company_id'=>0,
            'collection_id'=>0,
            'product_id'=>0,
            'order_id'=>0,
            'user_id'=>0,
            'message_id'=>0,
            'name'=>'',
            'comment'=>'',
            'eventtype_id'=>$eventType->id,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ];

        $insertData= array_merge($eventData, $references);
        try {
            $insertedEventId = DB::table('event')->insertGetId($insertData);
        } catch (Exception $e) {
            throw new Exception('Could not create this event:'.$e->getMessage());
        }

        return $insertedEventId;

    }
}
