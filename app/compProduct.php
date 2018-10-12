<?php
/**
 * Created by PhpStorm.
 * User: georgepipkin
 * Date: 10/8/18
 * Time: 9:44 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class compProduct extends Model
{
    var $images;
    var $medialinkId;
    var $optionTypes;
    var $optionTypeId;
    var $thisOptionType;

    var $id;
    var $name;
    var $thisPriceQ1;
    var $thisPriceQ10;

    function __construct($row){
        if(is_null($this->optionTypes)){
            $this->thisOptionType = new compOptionType($row);
            $this->optionTypes = array();
            $this->optionTypeId = $row->optiontype_id;
            $this->medialinkId = $row->medialink_id;
            $this->images = array($row->url);
            $this->id=$row->product_id;
            $this->name = $row->product_name;
            $this->thisPriceQ1 = $row->price_q1;
            $this->thisPriceQ10 = $row->price_q10;
        }
    }

    function processRow($row){
        if($row->medialink_id != $this->medialinkId){
            array_push($this->images, $row->url);
        }
        if($row->optiontype_id != $this->thisOptionType->getId()){
            array_push($this->optionTypes, $this->thisOptionType);
            $this->thisOptionType = new compOptionType($row);
        }else{
            $this->thisOptionType->processRow($row);
        }
    }

    function getId(){
        return $this->id;
    }

    function getName(){
        return $this->name;
    }
     function getOptionTypes(){
        return $this->optionTypes;
     }

    function getImageUrl(){
         return $this->images[0];
    }

    function getPriceQ1(){
        return $this->thisPriceQ1;
    }

    function getPriceQ10(){
        return $this->thisPriceQ10;
    }

    function cleanUp(){
        foreach($this->optionTypes as $ot){
            $ot->cleanUp();
        }
        $this->thisOptionType->cleanUp();
        array_push($this->optionTypes, $this->thisOptionType);
    }
}