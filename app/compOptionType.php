<?php
/**
 * Created by PhpStorm.
 * User: georgepipkin
 * Date: 10/8/18
 * Time: 9:45 AM
 */

namespace App;


class compOptionType
{
    var $options;
    var $thisOption;
    var $thisOptionId;

    var $id;
    var $name;

    function __construct($row){
        if(is_null($this->options)){
            $this->thisOption = new compOption($row);
            $this->options = array();
            $this->thisOptionId = $row->option_id;
            $this->id = $row-> optiontype_id;
            $this->name = $row->optiontype_name;
        }
    }

    function getId(){
        return $this->id;
    }

    function getName(){
        return $this->name;
    }

    function getOptions(){
        return $this->options;
    }

    function processRow($row){
        if($row->option_id != $this->thisOption->getId()){
            array_push($this->options, $this->thisOption);
            $this->thisOption = new compOption($row);
        }
    }

    function cleanUp(){
        array_push($this->options, $this->thisOption);
    }
}