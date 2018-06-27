<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function showBuyerForm() {
        return view('registerBuyer');
    }

    public function showSellerForm() {
        return view('registerSeller');
    }

    public function processBuyerForm(Request $buyerRequest){
        $input = $buyerRequest->all();
    }

    public function processSellerForm(Request $sellerRequest){
        $input = $sellerRequest->all();
    }

}
