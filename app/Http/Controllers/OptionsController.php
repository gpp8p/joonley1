<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Options;

class OptionsController extends Controller
{
    public function getOptionsForCategory(Request $request){
        $inData =  $request->all();
        $categoryId = $inData['categoryId'];
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

        return json_encode($returnArray);
    }
}
