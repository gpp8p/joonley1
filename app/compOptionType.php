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

    function __construct($row){
        if(is_null($this->options)){
            $this->thisOption = new compOption($row);
            $this->options = array($this->thisOption);
            $this->thisOptionId = $row->option_id;
            $this->id = $row-> optiontype_id;
        }
    }

    function getId(){
        return $this->id;
    }

    function processRow($row){
        if($row->optiontype_id != $this->getId()){
            array_push($this->options, $this->thisOption);
            $this->thisOption = new compOption($row);
        }
    }
}