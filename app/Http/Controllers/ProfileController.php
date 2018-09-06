<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function showProfileEdit(Request $request){
        $inData =  $request->all();
        $selectedUserId = $inData['selectedUser'];
        $userModel = new User;
        $thisUserData = $userModel->getUserProfileById($selectedUserId);
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'userEdit', 'thisUserData'=>$thisUserData]);
    }
}
