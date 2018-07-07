<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class OrdersController extends Controller
{
    public function show(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('orders',['adminView'=>$adminView]);
    }
}
