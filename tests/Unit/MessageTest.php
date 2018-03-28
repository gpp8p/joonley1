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

        $thisUser=DB::table('users')->where('name','gcorkery')->first();
        $msgs = $thisMessage->getMessagesToUser($thisUser);
        $this->assertTrue($msgs[2]->title=='New Collection');
    }
}
