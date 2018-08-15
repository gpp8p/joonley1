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
        return json_encode($categoryOptions);
    }
}
