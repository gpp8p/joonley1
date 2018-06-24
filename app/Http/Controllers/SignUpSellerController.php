<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpSellerController extends Controller
{
    public function showForm() {
        return view('registerSeller');
    }
}
