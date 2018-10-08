<?php
/**
 * Created by PhpStorm.
 * User: georgepipkin
 * Date: 10/8/18
 * Time: 10:06 AM
 */

namespace App;


class compShop
{
    var $categories;
    var $thisCategoryId;
    var $thisCategory;

    function __construct($row){
        $this->thisCategory = new compCategory($row);
        $this->categories = array($this->thisCategory);
        $this->thisCategoryId = $row->type;
    }

    function processRow($row){
        if($row->type != $this->thisCategory->getId()){
            array_push($this->categories, $this->thisCategory);
            $this->thisCategory = new compCategory($row);
        }else{
            $this->thisCategory->processRow($row);
        }
    }

}