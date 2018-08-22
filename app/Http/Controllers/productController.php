<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Terms;

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
    }
}
