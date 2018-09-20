<?php

namespace App\Http\Controllers;

use App\NestedCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $thisNestedCategory = new NestedCategory;
        $newNestedCategoryId = $thisNestedCategory->addCategory($inData['subcategory_name'], $inData['subcategory_name'], $inData['parent_category']);


        foreach($existingOptionValues as $existingOptionKey){
            $explodedOptionKey = explode('_',$existingOptionKey);
            $optionId = $explodedOptionKey[2];

            DB::table('defaultoptions')->insert([
                'producttype_id'=>$newNestedCategoryId,
                'options_id'=>$optionId,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);

        }
        $newOptions = array();
        foreach($newOptionTypes as $thisNewOptionType){
            $explodedNewOptionKey = explode('_',$thisNewOptionType);
            $newOptionIndex = $explodedNewOptionKey[1];
//            $optionId = $explodedOptionKey[2];

            $inseretedOptionTypeId = DB::table('optiontype')->insertGetId([
                'name' => $inData[$thisNewOptionType],
                'slug' => $inData[$thisNewOptionType],
                'description'=> $inData[$thisNewOptionType],
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now(),
            ]);

//            $newOptions[$newOptionIndex]=$inseretedOptionTypeId;
            $newOptions[$newOptionIndex]=999;
        }
        foreach($newOptionValues as $thisNewOptionValue){
            $explodedNewOptionValue = explode('_',$thisNewOptionValue);
            $optionTypeReference = $explodedNewOptionValue[1];
            $thisOptionTypeId = $newOptions[$optionTypeReference];
//            $optionTypeField = $explodedNewOptionValue[1];
            $newOptionVal = $inData[$thisNewOptionValue];

            $newOptionId = DB::table('options')->insertGetId([
                'optiontype_id'=>$inseretedOptionTypeId,
                'specification'=>$newOptionVal,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);

            DB::table('defaultoptions')->insert([
                'producttype_id'=>$newNestedCategoryId,
                'options_id'=>$newOptionId,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
            ]);


        }
       $request->file('example_image')->storeAs('public/categories',$newNestedCategoryId.'.jpg');
    }

    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === ''
            || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
