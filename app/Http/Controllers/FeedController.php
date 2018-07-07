<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\View;

class FeedController extends Controller
{
    public function show(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return View::make('feed', ['adminView'=>$adminView]);
    }
}
