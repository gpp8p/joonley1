<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;


class AdminController extends Controller
{
    public function show(Request $request)
    {
        $thisUserModel = new User;
        $allUserList = $thisUserModel->getUserList();
        $allUserList = $this->arrayPaginator($allUserList, $request);
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe', ['adminView'=>$adminView, 'sidebar'=>'admin', 'contentWindow'=>'viewUsers', 'allUsers'=>$allUserList]);
    }

    public function arrayPaginator($array, $request)
    {
        $page = Input::get('page', 1);
        $perPage = 25;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }
}
