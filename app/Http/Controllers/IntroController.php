<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntroController extends Controller
{
    public function show(Request $request)
    {
        return view('jintro');
    }
}
