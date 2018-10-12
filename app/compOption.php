<?php
/**
 * Created by PhpStorm.
 * User: georgepipkin
 * Date: 10/8/18
 * Time: 9:47 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class compOption extends Model
{
    var $optionId;
    var $optionValue;

    function __construct($row){
        $this->optionId = $row->option_id;
        $this->optionValue = $row->option_specification;
    }

    function getId(){
        return $this->optionId;
    }

    function getValue(){
        return $this->optionValue;
    }
}