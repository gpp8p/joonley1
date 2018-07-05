<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpecialsController extends Controller
{
    public function show(Request $request)
    {
        return view('specials');
    }
}
