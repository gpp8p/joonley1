<?php
/**
 * Created by PhpStorm.
 * User: georgepipkin
 * Date: 10/8/18
 * Time: 9:44 AM
 */

namespace App;


class compProduct
{
    var $images;
    var $medialinkId;
    var $optionTypes;
    var $optionTypeId;
    var $thisOptionType;
    var $id;

    function __construct($row){
        if(is_null($this->optionTypes)){
            $this->thisOptionType = new compOptionType($row);
            $this->optionTypes = array($this->thisOptionType);
            $this->optionTypeId = $row->optiontype_id;
            $this->medialinkId = $row->medialink_id;
            $this->images = array($row->url);
            $this->id=$row->product_id;
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
}