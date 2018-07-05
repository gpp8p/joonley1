<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show(Request $request)
    {
        return view('messages');
    }
}
