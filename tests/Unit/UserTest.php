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
        // testing get user list
        $thisUserList = $thisUser->getUserList();
        $this->assertTrue($thisUserList[0]->name=='gpp8p');
        $this->assertTrue($thisUserList[0]->lname=='Pipkin');

        $ubn = $thisUser->getUserByName('gpp8p');
        $this->assertTrue($ubn!=null);


        //testing get user profile
        $allUserInfo = $thisUser->getUserProfile('gpp8pvirginia@gmail.com');

        //testing has access
        $access = $thisUser->hasAccessWithUserName(['admin-dashboard'],'gpp8pvirginia@gmail.com');
        $this->assertTrue($access);
        $regularUser = DB::table('users')->where('id', 3)->first()->email;
        $access = $thisUser->hasAccessWithUserName(['admin-dashboard'],$regularUser);
        $thisUserRole = DB::table('userrole')->where('slug', 'buyer')->first();
        $this->assertFalse($access);

        // testing add user
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
        $userJustAdded = $thisUser->getUserProfile($thisUserInfo['email']);
        $this->assertTrue($userJustAdded->email==$thisUserInfo['email']);

        // testing user edit
        $thisEditInfo = array (
            'addr1'=>'editedAddr1',
            'addr2'=>'editedAddr2',
        );
        $userToEdit = DB::table('users')->where('email', $userJustAdded->email)->first();
        echo('user to edit name:'.$userToEdit->name);
        echo('user to edit email:'.$userToEdit->email);
        $thisUser->editUserProfile($userToEdit, $thisEditInfo);
        $userJustEdited = $thisUser->getUserProfile($thisUserInfo['email']);
        $this->assertTrue($userJustEdited->addr1=='editedAddr1');
        $this->assertTrue($userJustEdited->addr2=='editedAddr2');
        //testing set user role
        $newUserRole = DB::table('userrole')->where('slug', 'admin')->first();
       try {
            $thisUser->setUserRole($newUserRole, $userToEdit);
        } catch (Exception $e) {
            echo('##'.$e->getMessage());
            $this->assertTrue(false);
        }
        $userToEdit = DB::table('users')->where('name', $userJustAdded->name)->first();
        $this->assertTrue($userToEdit->userrole_id==$newUserRole->id);

        //testing add user to company
        $testCompanyRole = DB::table('companyrole')->where('slug','hbuyer')->first();
        $testCompany = DB::table('company')->where('name','Rings With Bing')->first();
        try {
            $thisUser->addUserToCompany($userToEdit, $testCompany, $testCompanyRole);
        } catch (Exception $e) {
            echo($e->getMessage());
            $this->assertTrue(false);
        }
        $companiesForThisUser = $thisUser->getUserCompanies($userToEdit);
        $this->assertTrue($companiesForThisUser[0]->comp_name==$testCompany->name);
        $this->assertTrue($companiesForThisUser[0]->comp_role==$testCompanyRole->name);

        // testing remove user from company
        try {
            $thisUser->removeUserFromCompany($userToEdit, $testCompany);
        } catch (Exception $e) {
            echo($e->getMessage());
            $this->assertTrue(false);
        }
        $companiesForThisUser = $thisUser->getUserCompanies($userToEdit);
        $this->assertTrue(count($companiesForThisUser)==0);


        //testing remove user
        $deletedUserCount = $thisUser->removeUser($addedUserId, $thisUserInfo['name']);
        $this->assertTrue($deletedUserCount==1);
        $testUser = DB::table('users')->where('name','gpp8p')->first();
        $userCompanies = $thisUser->getUserCompanies($testUser);
        $this->assertTrue($userCompanies[0]->comp_name == "The Trinket Factory");





    }
}
