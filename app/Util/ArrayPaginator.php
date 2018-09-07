<?php
/**
 * Created by PhpStorm.
 * User: georgepipkin
 * Date: 3/9/18
 * Time: 9:37 AM
 */

namespace App\Util;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;

class ArrayPaginator
{
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}