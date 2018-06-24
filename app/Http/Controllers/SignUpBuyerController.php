<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpBuyerController extends Controller
{
    public function showForm() {
        return view('registerBuyer');
    }
}
