<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Terms;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        $thisUser = Auth::user();
        $thisProduct = new \App\Product;

        return view('jframe',['adminView'=>$adminView,'sidebar'=>'search', 'contentWindow'=>'buyerProductsView']);
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
