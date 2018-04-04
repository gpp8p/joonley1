<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Exception;
use Faker\Factory as Faker;

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
        $regularUser = DB::table('users')->where('id', 3)->first()->name;
        $access = $thisUser->hasAccessWithUserName(['admin-dashboard'],$regularUser);
        $thisUserRole = DB::table('userrole')->where('slug', 'user')->first();
        $this->assertFalse($access);
        $faker = Faker::create();
        $thisUserInfo = array(
            'name' => $faker->userName,
            'email' => $faker->unique()->email,
            'password_pw'=> 'n1tad0g',
            'userrole_id'=>$thisUserRole->id,
            'title' => $faker->title,
            'admin' => FALSE,
            'lname' => $faker->lastname,
            'fname' => $faker->firstNameMale,
            'addr1' =>$faker->address,
            'addr2' =>$faker->secondaryAddress,
            'addr3' =>$faker->secondaryAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'zip' => $faker->postcode,
            'country' => $faker->country,
            'phone' => $faker->phoneNumber,
        );
        try {
            $addedUserId = $thisUser->addUser($thisUserInfo);
        } catch (Exception $e) {
            echo('##'.$e->getMessage());
            $this->assertFalse(false);
        }
        $userJustAdded = $thisUser->getUserProfile($thisUserInfo['name']);
        $this->assertTrue($userJustAdded->email==$thisUserInfo['email']);
        $thisEditInfo = array (
            'addr1'=>'editedAddr1',
            'addr2'=>'editedAddr2',
        );
        $userToEdit = DB::table('users')->where('name', $userJustAdded->name)->first();
        $thisUser->editUserProfile($userToEdit, $thisEditInfo);
        $userJustEdited = $thisUser->getUserProfile($thisUserInfo['name']);
        $this->assertTrue($userJustEdited->addr1=='editedAddr1');
        $this->assertTrue($userJustEdited->addr2=='editedAddr2');
//        $deletedUserCount = $thisUser->removeUser($addedUserId, $thisUserInfo['name']);
//        $this->assertTrue($deletedUserCount==1);


    }
}
