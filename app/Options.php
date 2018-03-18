<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Options extends Model
{
    protected $table = 'options';

    public function getAllOptionTypes()
    {
        $optionTypes = DB::table('optiontype')->get();
        return $optionTypes;
    }

    public function getOptionsBySlug($slug)
    {
        $query = 'select options.specification as specification, optiontype.name as type, optiontype.slug as slug '.
            'from options, optiontype '.
            'where optiontype.id = options.optiontype_id '.
            'and optiontype.slug=?';

        $optionsFound = DB::select($query, [$slug]);
        return $optionsFound;

    }


}
