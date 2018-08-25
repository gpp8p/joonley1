<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Terms;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    public function show(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'productsContent']);
    }

    public function newProduct(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        $currentUser = new User;
        $thisUsersCollections = $currentUser->getCollectionsForLoggedInUser();
        $thisTerms = new Terms();
        $thisUserCompanies = $currentUser->getCompaniesForLoggedInUser();
        $thisCompanyTerms = [];
        foreach($thisUserCompanies as $company){
           array_push($thisCompanyTerms,$thisTerms->getTermsForCompany($company->comp_id));
        }
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'newProductsContent', 'thisUsersCollections'=>$thisUsersCollections, 'thisCompanyTerms'=>$thisCompanyTerms]);
    }

    public function processNewProductInitial(Request $request){
        $inData =  $request->all();
        $dataKeys = array_keys($inData);
        $returnArray=[];
        for($a=0;$a<sizeof($dataKeys);$a++){
            $thisDataKey = $dataKeys[$a];
            $dataForThisKey = $inData[$thisDataKey];
            $dataElement = [$thisDataKey,$dataForThisKey];
            array_push($returnArray,$dataElement);
        }
        $encodedData = json_encode($returnArray);
        return view('upload',['productData'=>$encodedData, 'product_name'=>$inData['product_name']]);
    }

    public function newProductCreate(Request $request){
        $inData =  $request->all();
        $decodedData = json_decode($inData['productData']);
        $decodedValues = array();
        for($i=0;$i<sizeof($decodedData);$i++){
            $key=$decodedData[$i][0];
            $value=$decodedData[$i][1];
            $decodedValues[$key] = $value;
        }
        $thisUser = Auth::user();
        $newProductId = DB::table('product')->insertgetId([
            'name'=>$decodedValues['product_name'],
            'type_id'=>$decodedValues['lastAddedCat'],
            'price_q1'=>$decodedValues['q1_price'],
            'price_q10'=>$decodedValues['q10_price'],
            'ship_weight'=>$decodedValues['weight_lbs'],
            'ship_weight_oz'=>$decodedValues['weight_oz'],
            'whenmade'=>$decodedValues['product_when'],
            'whomade'=>$decodedValues['product_src'],
            'prodis'=>$decodedValues['product_when'],
            'description'=>$decodedValues['product_description'],
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        $uploadedFiles = DB::table('uploads')->where('user_id', $thisUser->id)->get();
        foreach ($uploadedFiles as $thisUploadedFile){
            
        }








    }
}
