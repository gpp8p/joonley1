<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class MoreController extends Controller
{
    public function show(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'more', 'contentWindow'=>'moreContent']);
    }
}
