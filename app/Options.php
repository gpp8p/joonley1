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

    public function getOptionsByOptionTypeId($id){
        $optionTypes = DB::table('options')->where('optiontype_id', $id)->get();
        return $optionTypes;
    }

    public function addOption($optionSpecification, $optionTypeSlug)
    {
        if(!DB::table('optiontype')->where('slug', $optionTypeSlug)->exists())
        {
            throw new Exception($optionTypeSlug.' option type not found');
        }
        $thisOptionType = DB::table('optiontype')->where('slug', $optionTypeSlug)->get();
        $thisOptionTypeId  = $thisOptionType[0]->id;
        if(DB::table('options')->where('id', $thisOptionTypeId)->where('specification',$optionSpecification) ->exists())
        {
            throw new Exception($optionSpecification.' of type'.$optionTypeSlug.' already exists');
        }

        try {
            $newOptionId = DB::table('options')->insertGetId([
                'specification' => $optionSpecification,
                'optiontype_id' => $thisOptionTypeId,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } catch (Exception $e) {
            throw new Exception('New options could not be created:'.$e->getMessage());
        }
        return $newOptionId;
    }


}
