<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;


class MessageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
        $thisMessage = new \App\Message;
        $thisUser=DB::table('users')->where('name','gpp8p')->first();

        $msgs = $thisMessage->getAllMessagesFromUser($thisUser);
        $this->assertTrue($msgs[2]->title=='New Collection');

        $allUserNames = DB::table('users')->get();
        $sampleUserName = $allUserNames[2]->name;
        echo('**'.$sampleUserName.'**');

        $thisUser=DB::table('users')->where('name',$sampleUserName)->first();
        $msgs = $thisMessage->getMessagesToUser($thisUser);
        $this->assertTrue($msgs[2]->title=='New Collection');

        $thisMessageTypeId = DB::table('messagetype')->where('slug', 'ncompnotif')->first()->id;
        $thisEventId = DB::table('event')->where('name', 'New company created')->first()->id;
        $msginfo = array(
            'from_id'=>$allUserNames[2]->id,
            'to_id'=>$allUserNames[0]->id,
            'content'=>'Here is a new company notification for you',
            'type_id'=>$thisMessageTypeId,
            'event_id'=>$thisEventId,
            'title'=>'New Company',
        );
        try {
            $newMessageId = $thisMessage->addNewMessage($msginfo);
        } catch (Exception $e) {
            echo('***'.$e->getMessage().'***');
            $this->assertTrue(false);
        }
        try {
            $thisMessage->removeMessage($newMessageId);
        } catch (Exception $e) {
            echo('***'.$e->getMessage().'***');
            $this->assertTrue(false);
        }
    }
}
