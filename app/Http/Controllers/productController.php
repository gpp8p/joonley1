<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Terms;
use App\Product;
use App\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

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
            $thisCompanyTerm = $thisTerms->getTermsForCompany($company->comp_id);
            foreach($thisCompanyTerm as $thisTerm){
                $thisId = 'term'.$thisTerm->id;
                array_push($thisCompanyTerms, $thisTerm);
            }
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

    public function newProductAdd(Request $request){
        $inData =  $request->all();
        $productName = $inData['product_name'];
        $imageType = DB::table('mediatype')->where('slug', 'image')->first();
        $urlPrefix = 'http://localhost/joonley1/storage/app/public/';
        $thisUser = Auth::user();
        $categoryTree = explode(',', $inData['lastAddedCat']);
        $productCategoryId = $categoryTree[count($categoryTree)-1];

        DB::beginTransaction();
        try {
            $newProductId = DB::table('product')->insertgetId([
                'name' => $inData['product_name'],
                'type_id' => $productCategoryId,
                'price_q1' => $inData['q1_price'],
                'price_q10' => $inData['q10_price'],
                'ship_weight' => $inData['weight_lbs'],
                'ship_weight_oz' => $inData['weight_oz'],
                'whenmade' => $inData['product_when'],
                'whomade' => $inData['product_src'],
                'prodis' => $inData['product_when'],
                'description' => $inData['product_description'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);

            $imagePrefix = "productImageInput";
            $inDataKeys = array_keys($inData);
            $imagePath = public_path() . '/storage/' . $thisUser->id;
            if (!file_exists($imagePath)) {
                $directoryCreated = mkdir($imagePath);
            }

            foreach ($inDataKeys as $thisInDataKey) {
                if (substr($thisInDataKey, 0, strlen($imagePrefix)) === $imagePrefix) {
                    $newFileName = str_random(40) . ".jpg";
                    $request->file($thisInDataKey)->storeAs('public/' . $thisUser->id, $newFileName);
                    $newProductFileLinkId = DB::table('medialink')->insertgetId([
                        'mediatype_id' => $imageType->id,
                        'pertainsto' => 'product',
                        'url' => $urlPrefix . $thisUser->id . '/' . $newFileName,
                        'url_thumb' => $urlPrefix . $thisUser->id . '/' . $newFileName,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                    DB::table('producthaslinks')->insert([
                        'product_id' => $newProductId,
                        'medialink_id' => $newProductFileLinkId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                }
            }
            $productStatus = DB::table('containedas')->where('slug', $inData['prodStatus'])->first();
            DB::table('collectionhas')->insert([
                'product_id' => $newProductId,
                'collection_id' => $inData['product_catalog'],
                'containedas_id' => $productStatus->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            foreach ($inDataKeys as $thisInDataKey) {
                if (strpos($thisInDataKey, 'option') === 0) {
                    $optionId = substr($thisInDataKey, 6);
                    DB::table('hasoptions')->insert([
                        'product_id' => $newProductId,
                        'options_id' => $optionId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                    if (strpos($thisInDataKey, 'term') === 0) {
                        $termId = substr($thisInDataKey, 4);
                        DB::table('hasterms')->insert([
                            'product_id' => $newProductId,
                            'terms_id' => $termId,
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now()
                        ]);

                    }
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            $adminView =User::hasAccess(['\'admin-dashboard\'']);
            return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'productError', 'errorMessage'=>$e->getMessage()]);
        }
        DB::commit();
        $thisCategoryName = DB::table('nested_category')->where('id', $productCategoryId)->first();
        $returnData = array();
        $catNameLine = array();
        $catNameLine[0]= 'categoryName';
        $catNameLine[1] = $thisCategoryName->name;
        array_push($returnData, $catNameLine);
        foreach($inDataKeys as $thisInDataKey){
                $thisIndataLine = array();
                $thisIndataLine[0]= $thisInDataKey;
                $thisIndataLine[1] = $inData[$thisInDataKey];
                array_push($returnData, $thisIndataLine);
        }
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        $currentUser = new User;
        $thisUsersCollections = $currentUser->getCollectionsForLoggedInUser();
        $thisTerms = new Terms();
        $thisUserCompanies = $currentUser->getCompaniesForLoggedInUser();
        $thisCompanyTerms = [];
        $i=0;
        foreach($thisUserCompanies as $company){
            $thisCompanyTerm = $thisTerms->getTermsForCompany($company->comp_id);
            foreach($thisCompanyTerm as $thisTerm){
                $thisId = 'term'.$thisTerm->id;
                $thisTerm->currentValue = $inData[$thisId];
                array_push($thisCompanyTerms, $thisTerm);
            }
        }
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'newProductsContent', 'thisUsersCollections'=>$thisUsersCollections, 'thisCompanyTerms'=>$thisCompanyTerms, 'lastEnteredData'=>$returnData]);
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
            $noOption=1;
            for ($i = 0; $i < sizeof($decodedData); $i++) {
                $key = $decodedData[$i][0];
                if (strpos($key, 'option')===0) {
                    $optionId = substr($key, 6);
                    DB::table('hasoptions')->insert([
                        'product_id' => $newProductId,
                        'options_id' => $optionId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                    $noOption=0;
                }
                if (strpos($key, 'term')===0) {
                    $termId = substr($key, 4);
                    DB::table('hasterms')->insert([
                        'product_id' => $newProductId,
                        'terms_id' => $termId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);

                }
            }
            if($noOption==1){
                $type = DB::table('optiontype')->where('slug', 'null')->first();
                DB::table('hasoptions')->insert([
                    'product_id' => $newProductId,
                    'options_id' => $type->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
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

    public function getProductsForLoggedInUser(Request $request){
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        $thisUser = Auth::user();
        $thisProduct = new \App\Product;
        $productsFound = $thisProduct->getAllMyProductsWithPictures($thisUser->id);
        $productsFound = $this->arrayPaginator($productsFound, $request);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'productsForUser', 'thisUsersProducts'=>$productsFound]);
    }

    public function getAllProducts(Request $request){
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        $thisUser = Auth::user();
        $thisProduct = new \App\Product;
        $productsFound = $thisProduct->getAllProductsWithPictures();
        $productsFound = $this->arrayPaginator($productsFound, $request);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'productsForUser', 'thisUsersProducts'=>$productsFound]);
    }

    public function getBuyerProductView(Request $request){
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        $thisUser = Auth::user();
        $thisProduct = new \App\Product;

        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'buyerProductsView']);

    }

    public function showCategoryProducts(Request $request){
        $iconPrefix = 'http://localhost/joonley1/storage/app/public/company_icons/';
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        $inData =  $request->all();
        $thisCategoryName = $inData['categoryName'];
        $thisCategoryId = $inData['categoryId'];
        $searchResult = array();
        $col1 = array();
        $col2 = array();
        $col3 = array();
        $col4 = array();
        $col = 0;
        $thisProduct = new Product;
        $productsForThisCategory = $thisProduct->getCategoryProductsWithPictures($thisCategoryId);
        foreach($productsForThisCategory as $prod){
            $companyName = $prod['company_name'];
            $companyCity = $prod['company_city'];
            $companyState = $prod['company_state'];
            $companyIcon = $iconPrefix.$prod['company_icon'];
            $companyId = $prod['company_id'];
            $productName = $prod['product_name'];
            $productId = $prod['product_id'];
            $productImages = $prod['url'][0];
            $productDescription = $prod['product_description'];
            $thisResultRow = ['company_name'=>$companyName, 'company_city'=>$companyCity, 'company_state'=>$companyState, 'company_icon'=>$companyIcon, 'company_id'=>$companyId, 'product_name'=>$productName, 'product_id'=>$productId, 'url'=>$productImages, 'product_description'=>$productDescription ];
            switch($col){
                case 0:
                    array_push($col1, $thisResultRow);
                    break;
                case 1:
                    array_push($col2, $thisResultRow);
                    break;
                case 2:
                    array_push($col3, $thisResultRow);
                    break;
                case 3:
                    array_push($col4, $thisResultRow);
                    break;
            }
            if($col==3){
                $col=0;
            }else{
                $col++;
            }
        }
        $productData = array('col1'=>$col1, 'col2'=>$col2, 'col3'=>$col3, 'col4'=>$col4);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'categoryProducts', 'thisCategoryProducts'=>$productData]);

    }





    public function showOneProduct(Request $request){
        $requestData = $request->all();
        $productId = $requestData['product_id'];
        $thisProduct = new \App\Product;
        $thisProductInfo = $thisProduct->getOneProduct($productId);
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'oneProduct', 'thisProduct'=>$thisProductInfo]);
    }

    public function productSearch(Request $request){
        $requestData = $request->all();
        $searchCriteria = json_decode($requestData['searchCriteria']);
        $categoryId = $searchCriteria[0];
    }

    public function showCompanyProducts(Request $request){
        $inData = $request->all();
        $thisCompanyId = $inData['companyId'];
        $thisCompany = new Company;
        $companyCategories = $thisCompany->getCompanyProductsWithOptionsImages($thisCompanyId);
        $companyCategoryKeys = array_keys($companyCategories);
        $categoryCompanyProducts = array();
        foreach($companyCategoryKeys as $thisCompanyCategoryKey){
            $companyProducts = $companyCategories[$thisCompanyCategoryKey];
            $col1 = array();
            $col2 = array();
            $col3 = array();
            $col4 = array();
            $col = 0;
            foreach($companyProducts as $thisCompanyProduct){
                switch($col){
                    case 0:
                        array_push($col1, $thisCompanyProduct);
                        break;
                    case 1:
                        array_push($col2, $thisCompanyProduct);
                        break;
                    case 2:
                        array_push($col3, $thisCompanyProduct);
                        break;
                    case 3:
                        array_push($col4, $thisCompanyProduct);
                        break;
                }
                if($col==3){
                    $col=0;
                }else{
                    $col++;
                }
            }
            $productData = array('col1'=>$col1, 'col2'=>$col2, 'col3'=>$col3, 'col4'=>$col4);
            $categoryCompanyProducts[$thisCompanyCategoryKey]=$productData;
        }
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'companyProducts', 'categoryCompanyProducts'=>$categoryCompanyProducts, 'categoryKeys'=>$companyCategoryKeys]);

    }

    public function arrayPaginator($array, $request)
    {
        $page = Input::get('page', 1);
        $perPage = 4;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }



}
