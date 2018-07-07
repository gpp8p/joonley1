<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntroController extends Controller
{
    public function show(Request $request)
    {
        if(Auth::guest()) {
            return view('jintro');
        }else{
            return redirect()->route('feed');
        }
    }
}
