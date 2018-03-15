<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $thisUser = new \App\User;
        $thisUserList = $thisUser->getUserList();
        $this->assertTrue(count($thisUserList)==34);
    }
}
