<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class OrdersController extends Controller
{
    public function show(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'orders', 'contentWindow'=>'ordersContent']);
    }

    public function orderConfirm(Request $request){
        $inData = $request->all();
        $dataKeys = array_keys($inData);
        foreach($dataKeys as $thisDataKey){
            if($this->startsWith($thisDataKey, "subval")){
                $thisOrderData = $inData[$thisDataKey];
            }
        }


        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'orders', 'contentWindow'=>'ordersConfirm']);
    }




    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === ''
            || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

}
