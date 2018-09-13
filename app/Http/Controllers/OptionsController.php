<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Options;
use \App\NestedCategory;

class OptionsController extends Controller
{
    public function getOptionsForCategory(Request $request){
        $inData =  $request->all();
        $categoryId = $inData['categoryId'];
        $returnArray = $this->catOptions($categoryId);
        return json_encode($returnArray);
    }

    public function getOptionsForCategoryWithParents(Request $request){
        $inData =  $request->all();
        $categoryId = $inData['categoryId'];
        $thisNestedCategory = new NestedCategory;
        $parentIds = $thisNestedCategory->getAllParentIds($categoryId);
        $optionsFound = array();
        foreach($parentIds as $thisParentId){
            $categoryOptions = $this->catOptions($thisParentId);
            foreach($categoryOptions as $thisCategoryOptions){
                if(!array_key_exists ($thisCategoryOptions[0] , $optionsFound )){
                    $optionsFound[$thisCategoryOptions[0]]= $thisCategoryOptions[1];
                }
            }
        }
        $returnArray = array();
        $optionKeys = array_keys($optionsFound);
        foreach($optionKeys as $thisOptionKey){
            $optionValues = $optionsFound[$thisOptionKey];
            $returnOption = array($thisOptionKey, $optionValues);
            array_push($returnArray, $returnOption);
        }
        return json_encode($returnArray);
    }

    public function catOptions($categoryId){
        $thisOptions = new Options();
        $categoryOptions = $thisOptions->getDefaultOptionsForProducttype($categoryId);
        $optionKeys = array_keys($categoryOptions);
        $returnArray=[];
        for($a=0;$a<sizeof($optionKeys);$a++){
            $thisOptionKey = $optionKeys[$a];
            $optionsForThisKey = $categoryOptions[$thisOptionKey];
            $optionArrayElement = [$thisOptionKey,$optionsForThisKey];
            array_push($returnArray,$optionArrayElement);
        }
        return $returnArray;
    }
}
