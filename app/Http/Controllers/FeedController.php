<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class FeedController extends Controller
{
    public function show(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'feed', 'contentWindow'=>'feedContent']);

    }

    public function showFeedPreview(Request $request){
        $requestData = $request->all();
        $productId = $requestData['product_id'];
        $thisProduct = DB::table('product')->where('id', $productId)->first();
        $thisProductDescription = $thisProduct->description;
        $thisProductName = $thisProduct->name;
        $collectionId = $requestData['collection_id'];
        $companyId = DB::table('hascollection')->where('collection_id', $collectionId)->first()->id;
        $mediaLinkId = substr($requestData['feedSelect'],4);
        $imageUrl = DB::table('medialink')->where('id', $mediaLinkId)->first()->url_thumb;
        $viewData = array('product_id'=>$productId, 'product_description'=>$thisProductDescription, 'product_name'=>$thisProductName, 'collection_id'=>$collectionId, 'image_url'=>$imageUrl);

        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'products', 'contentWindow'=>'feedPreview', 'viewData'=>$viewData]);


    }

    public function addToFeed(Request $request){
        $requestData = $request->all();
        $productId = $requestData['product_id'];
        $collectionId = $requestData['collection_id'];
        $companyId = DB::table('hascollection')->where('collection_id', $collectionId)->first()->id;
        $mediaLinkId = substr($requestData['feedSelect'],4);
        $imageUrl = DB::table('medialink')->where('id', $mediaLinkId)->first()->url_thumb;

        DB::table('feed')->insert([
            'image_url'=>$imageUrl,
            'product_id'=>$productId,
            'collection_id'=>$collectionId,
            'company_id'=>$companyId,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'feed', 'contentWindow'=>'feedContent']);

    }
}
