<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoreController extends Controller
{
    public function show(Request $request)
    {
        return view('more');
    }
}
