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

    public function getDefaultOptionsForProducttype($productType)
    {
        $query = 'select optiontype.name, options.specification, options.id from optiontype, options, defaultoptions '.
                'where optiontype.id = options.optiontype_id '.
                'and defaultoptions.options_id = options.id '.
                'and defaultoptions.producttype_id = ? order by optiontype.name, options.specification';

        $optionsFound =  DB::select($query, [$productType]);
        $optionArray=array();
        foreach($optionsFound as $thisOption)
        {
            $optionArrayElement = array($thisOption->specification, $thisOption->id);
            if(!isset($optionArray[$thisOption->name]))
            {
                $optionArray[$thisOption->name] = array($optionArrayElement);
            }else{
                array_push($optionArray[$thisOption->name], $optionArrayElement);
            }
        }
        return $optionArray;
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

    public function deleteDefaultOption($option, $productType)
    {
        if(!DB::table('defaultoptions')->where('options_id',$option->id)->where('producttype_id',$productType->id)->exists())
        {
            throw new Exception('Default option does not exist');
        }
        try {
            $nrd = DB::table('defaultoptions')->where('options_id', $option->id)->where('producttype_id', $productType->id)->delete();
        } catch (Exception $e) {
            throw new Exception('Could not delete this default option:'.$e->getMessage());
        }
        return $nrd;
    }

    public function addProductOption($option, $product)
    {
        if(DB::table('hasoptions')->where('options_id',$option->id)->where('product_id', $product->id)->exists())
        {
            throw new Exception('That product is already linked to this option');
        }
        try {
            $newProductOptionId = DB::table('hasoptions')->insertGetId([
                'options_id' => $option->id,
                'product_id' => $product->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } catch (Exception $e) {
            throw new Exception('Could not add this option:'.$e->getMessage());
        }
    }

    public function deleteProductOption($option, $product)
    {
        if(!DB::table('hasoptions')->where('options_id',$option->id)->where('product_id', $product->id)->exists())
        {
            throw new Exception('That product is not linked to this option');
        }
        try {
            $nrd = DB::table('hasoptions')->where('options_id', $option->id)->where('product_id', $product->id)->delete();
        } catch (Exception $e) {
            throw new Exception('Could not link this option to this product:'.$e->getMessage());
        }
        return $nrd;

    }


    public function linkDefaultOptionsToProduct($productType, $productId)
    {
        $query = 'select options.id from options, defaultoptions '.
                'where options.id = defaultoptions.options_id '.
                'and defaultoptions.producttype_id = ? ';

        $optionsFound = DB::select($query, [$productType->id]);
        $linksCreated = [];
        foreach($optionsFound as $optionId)
        {
            try {
                $linksCreated[] = DB::table('hasoptions')->insertGetId([
                    'product_id' => $productId,
                    'options_id' => $optionId->id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            } catch (Exception $e) {
                throw new Exception('Could not create new link:'.$e->getMessage());
            }
        }
        return $linksCreated;
    }

    public function removeOptionLinksFromProduct($product)
    {
        try {
            $nrd = DB::table('hasoptions')->where('product_id', $product->id)->delete();
        } catch (Exception $e) {
            throw new Exception('Could not remove the links:'.$e->getMessage());
        }
        return $nrd;
    }
}
