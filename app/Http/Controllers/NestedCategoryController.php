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

    public function createSubCategory(Request $request){
        $inData =  $request->all();
        $keys = array_keys($inData);
        $existingOptionValues=array();
        $newOptionTypes=array();
        $newOptionValues = array();
        foreach($keys as $thisKey){
            if($this->startsWith($thisKey, 'exo_')){
                array_push($existingOptionValues, $thisKey);
            }
            if($this->startsWith($thisKey, 'ots_')){
                array_push($newOptionTypes, $thisKey);
            }
            if($this->startsWith($thisKey, 'inf_')){
                array_push($newOptionValues, $thisKey);
            }
        }
//       $request->logo->storeAs('example_image', '/categories/cat1.png');
    }

    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === ''
            || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
