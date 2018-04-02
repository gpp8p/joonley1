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
        $this->assertTrue($thisUserList[0]->name=='gpp8p');
        $this->assertTrue($thisUserList[0]->lname=='Pipkin');
        $allUserInfo = $thisUser->getUserProfile('gpp8p');
        $access = $thisUser->hasAccessWithUserName(['admin-dashboard'],'gpp8p');
        $this->assertTrue($access);
    }
}
