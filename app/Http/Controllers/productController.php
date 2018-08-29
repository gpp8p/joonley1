<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Terms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $urlPrefix = 'http://localhost/joonley1/storage/app/public/';
        $thumbNailType = DB::table('mediatype')->where('slug', 'thumb')->first();
        $imageType = DB::table('mediatype')->where('slug', 'image')->first();
        $inData =  $request->all();
        $decodedData = json_decode($inData['productData']);
        $decodedValues = array();
        for($i=0;$i<sizeof($decodedData);$i++){
            $key=$decodedData[$i][0];
            $value=$decodedData[$i][1];
            $decodedValues[$key] = $value;
        }
        DB::beginTransaction();
        try {
            $thisUser = Auth::user();
            $newProductId = DB::table('product')->insertgetId([
                'name' => $decodedValues['product_name'],
                'type_id' => $decodedValues['lastAddedCat'],
                'price_q1' => $decodedValues['q1_price'],
                'price_q10' => $decodedValues['q10_price'],
                'ship_weight' => $decodedValues['weight_lbs'],
                'ship_weight_oz' => $decodedValues['weight_oz'],
                'whenmade' => $decodedValues['product_when'],
                'whomade' => $decodedValues['product_src'],
                'prodis' => $decodedValues['product_when'],
                'description' => $decodedValues['product_description'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            $uploadedFiles = DB::table('uploads')->where('user_id', $thisUser->id)->get();
            foreach ($uploadedFiles as $thisUploadedFile) {
                $uploadedThumbnailName = $thisUploadedFile->resized_name;
                $uploadedFileName = $thisUploadedFile->filename;
/*
                $newProductThumbnailLinkId = DB::table('medialink')->insertgetId([
                    'mediatype_id' => $thumbNailType->id,
                    'pertainsto' => 'product',
                    'url' => $urlPrefix . $thisUser->id . '/' . $uploadedThumbnailName,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                DB::table('producthaslinks')->insert([
                    'product_id' => $newProductId,
                    'medialink_id' => $newProductThumbnailLinkId,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);]
*/
                Storage::move('public/' . $thisUser->id . '/tmp/' . $uploadedThumbnailName, 'public/' . $thisUser->id . '/' . $uploadedThumbnailName);
                $newProductFileLinkId = DB::table('medialink')->insertgetId([
                    'mediatype_id' => $imageType->id,
                    'pertainsto' => 'product',
                    'url' => $urlPrefix . $thisUser->id . '/' . $uploadedFileName,
                    'url_thumb'=>$urlPrefix . $thisUser->id . '/' . $uploadedThumbnailName,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                DB::table('producthaslinks')->insert([
                    'product_id' => $newProductId,
                    'medialink_id' => $newProductFileLinkId,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                Storage::move('public/' . $thisUser->id . '/tmp/' . $uploadedFileName, 'public/' . $thisUser->id . '/' . $uploadedFileName);
            }
            DB::table('uploads')->where('user_id', $thisUser->id)->delete();
            $productStatus = DB::table('containedas')->where('slug', $decodedValues['prodStatus'])->first();
            DB::table('collectionhas')->insert([
                'product_id' => $newProductId,
                'collection_id' => $decodedValues['product_catalog'],
                'containedas_id' => $productStatus->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            for ($i = 0; $i < sizeof($decodedData); $i++) {
                $key = $decodedData[$i][0];
                if (strpos($key, 'option')) {
                    $optionId = substr($key, 6);
                    DB::table('hasoptions')->insert([
                        'product_id' => $newProductId,
                        'options_id' => $optionId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                }
                if (strpos($key, 'term')) {
                    $termId = substr($key, 4);
                    DB::table('hasterms')->insert([
                        'product_id' => $newProductId,
                        'terms_id' => $termId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);

                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $adminView =User::hasAccess(['\'admin-dashboard\'']);
            return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'productError', 'errorMessage'=>$e->getMessage()]);
        }
        DB::commit();
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

    public function getProductsForLoggedInUser(){
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        $thisUser = Auth::user();
        $thisProduct = new \App\Product;
        $productsFound = $thisProduct->getAllMyProductsWithPictures($thisUser->id);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'productsForUser', 'thisUsersProducts'=>$productsFound]);
    }

    public function showOneProduct(Request $request){
        $requestData = $request->all();
        $productId = $requestData['product_id'];
        $thisProduct = new \App\Product;
        $thisProductInfo = $thisProduct->getOneProduct($productId);
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'oneProduct', 'thisProduct'=>$thisProductInfo]);
    }
}
