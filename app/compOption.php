<?php
/**
 * Created by PhpStorm.
 * User: georgepipkin
 * Date: 10/8/18
 * Time: 9:47 AM
 */

namespace App;


class compOption
{
    var $optionId;
    var $optionValue;

    function __construct($row){
        $this->optionId = $row->option_id;
        $this->optionValue = $row->option_specification;
    }
}