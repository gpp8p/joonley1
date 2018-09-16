<?php

namespace App\Http\Controllers;

use App\NestedCategory;
use App\User;
use Illuminate\Http\Request;

class NestedCategoryController extends Controller
{
    public function getCats(Request $request){
        $inData =  $request->all();
        $parentNodeName = $inData['parentCategoryName'];
        $thisNestedCategory = new NestedCategory();
        $categoryChildern = $thisNestedCategory->findChildNodes($parentNodeName);
        return json_encode($categoryChildern);
    }

    public function showCategoryEdit(Request $request){
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'admin', 'contentWindow'=>'createCategories']);

    }
}
