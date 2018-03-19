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
        if(DB::table('options')->where('optiontype_id', $thisOptionTypeId)->where('specification',$optionSpecification) ->exists())
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

    public function removeOption($optionSpecification, $optionTypeSlug)
    {
        if(!DB::table('optiontype')->where('slug', $optionTypeSlug)->exists())
        {
            throw new Exception($optionTypeSlug." does not exist");
        }
        $optionType = DB::table('optiontype')->where('slug', $optionTypeSlug)->get();
        $optionTypeId = $optionType[0]->id;
        if(!DB::table('options')->where('specification',$optionSpecification)->where('optiontype_id', $optionTypeId)->exists())
        {
            throw new Exception($optionSpecification." as a ".$optionTypeSlug." does not exist");
        }
        $thisOption = DB::table('options')->where('specification',$optionSpecification)->where('optiontype_id', $optionTypeId)->get();
        $thisOptionId = $thisOption[0]->id;
        if(DB::table('defaultoptions')->where('options_id', $thisOptionId)->exists())
        {
            throw new Exception('This option: '.$optionSpecification.' is already associated with a default - cannot be deleted');
        }
        if(DB::table('hasoptions')->where('options_id', $thisOptionId)->exists())
        {
            throw new Exception('This option: '.$optionSpecification.' is already associated with a product - cannot be deleted');
        }

        try {
            $nrd = DB::table('options')->where('id', $thisOptionId)->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return $nrd;
    }

    public function addDefaultOption($option, $productType)
    {
        if(DB::table('defaultoptions')->where('options_id',$option->id)->where('producttype_id',$productType->id)->exists())
        {
            throw new Exception('Default option already exists');
        }
        try {
            $newDefaultOptionsId = DB::table('defaultoptions')->insertGetId([
                'options_id' => $option->id,
                'producttype_id' => $productType->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } catch (Exception $e) {
            throw new Exception('New default option could not be created:'.$e->getMessage());
        }
        return $newDefaultOptionsId;
    }


}
