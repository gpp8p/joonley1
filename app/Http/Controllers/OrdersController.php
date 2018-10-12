<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;

class OrdersController extends Controller
{
    public function show(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'orders', 'contentWindow'=>'ordersContent']);
    }

    public function orderConfirm(Request $request){
        $inData = $request->all();
        $dataIds = array();
        $lineItems = array();
        $categoryKeys= array();
        $dataKeys = array_keys($inData);
        foreach($dataKeys as $thisDataKey){
            if($this->startsWith($thisDataKey, "subval")){
                $thisOrderData = $inData[$thisDataKey];
                $thisOrder = json_decode($thisOrderData);
                $thisProductIdStr = strval($thisOrder->dataId);
                if(array_key_exists($thisProductIdStr, $lineItems)){
                    array_push($lineItems[$thisProductIdStr], $thisOrder);
                }else{
                    $thisLineItem = array($thisOrder);
                    $lineItems[$thisProductIdStr]= $thisLineItem;
                }
            }
            if($this->startsWith($thisDataKey, "productId")){
                $thisItemId = $inData[$thisDataKey];
                array_push($dataIds, strval($thisItemId));
            }
        }
        $thisCompany = new Company;
        $productIdsToSelect = "";
        foreach($dataIds as $thisDataId){
            $productIdsToSelect =  $productIdsToSelect.$thisDataId.",";
        }
        $productIdsToSelect = substr($productIdsToSelect, 0, (strlen($productIdsToSelect)-1));
        $thisCompanyProducts = $thisCompany->getSpecifiedCompanyProductsWithOptionsImages($inData['companyId'], $productIdsToSelect);

        foreach($thisCompanyProducts->getCategories() as $thisCategory){
            $col1 = array();
            $col2 = array();
            $col3 = array();
            $col4 = array();
            $col = 0;
            foreach($thisCategory->getProducts() as $thisProduct){
                switch($col){
                    case 0:
                        array_push($col1, $thisProduct);
                        break;
                    case 1:
                        array_push($col2, $thisProduct);
                        break;
                    case 2:
                        array_push($col3, $thisProduct);
                        break;
                    case 3:
                        array_push($col4, $thisProduct);
                        break;
                }
                if($col==3){
                    $col=0;
                }else{
                    $col++;
                }
            }
            $productData = array('col1'=>$col1, 'col2'=>$col2, 'col3'=>$col3, 'col4'=>$col4);
            $categoryCompanyProducts[$thisCategory->getName()]=$productData;
            array_push($categoryKeys, $thisCategory->getName());

        }


        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'orders', 'contentWindow'=>'ordersConfirm','categoryCompanyProducts'=>$categoryCompanyProducts, 'categoryKeys'=>$categoryKeys, 'companyId'=>$inData['companyId'], 'lineItems'=>$lineItems]);
    }




    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === ''
            || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

}
