<?php

namespace App\Http\Controllers;

use App\NestedCategory;
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
}
