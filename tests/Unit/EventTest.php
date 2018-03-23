<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;


class EventTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisEvent = new \App\Event;
        $thisEventType = DB::table('eventtype')->where('slug','newproduct')->first();
        $productCompany = DB::table('company')->where('name', 'Rings With Bing')->first();
        $productCollection = DB::table('collection')->where('name', 'Fall Ring Collection')->first();
        $product = DB::table('product')->where('name', 'Zirconium ring')->first();
        $thisUser=DB::table('users')->where('name','gpp8p')->first();
        $eventData = array(
            'product_id'=>$product->id,
            'collection_id'=>$productCollection->id,
            'company_id'=>$productCompany->id,
            'user_id'=>$thisUser->id,
            'name'=>'product added',
            'comment'=>$product->name.' was added to:'.$productCollection->name,
        );
        try {
            $eventAddedId = $thisEvent->addNewEvent($eventData, $thisEventType);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
        $eventAdded = DB::table('event')->where('id',$eventAddedId)->first();
        $this->assertTrue($eventAdded->product_id==$product->id);
        $this->assertTrue($eventAdded->collection_id==$productCollection->id);
        $this->assertTrue($eventAdded->company_id==$productCompany->id);
        $this->assertTrue($eventAdded->user_id==$thisUser->id);
        $this->assertTrue($eventAdded->name=='product added');
        $this->assertTrue($eventAdded->comment==$product->name.' was added to:'.$productCollection->name);

        $eventAdded = DB::table('event')->where('id',$eventAddedId)->delete();
        if($eventAdded = DB::table('event')->where('id',$eventAddedId)->exists())
        {
            $this->assertTrue(false);
        }
    }
}
