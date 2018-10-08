<?php
/**
 * Created by PhpStorm.
 * User: georgepipkin
 * Date: 10/8/18
 * Time: 9:44 AM
 */

namespace App;


class compCategory
{
    var $products;
    var $productId;
    var $thisProduct;

    var $id;
    var $categoryName;

    function __construct($row){
        if(is_null($this->products)){
            $this->thisProduct = new compProduct($row);
            $this->products = array($this->thisProduct);
            $this->productId = $row->product_id;
            $this->id = $row->type;
            $this->categoryName = $row->category;
        }
    }

    function getId(){
        return $this->id;
    }

    function processRow($row){
        if($row->product_id != $this->thisProduct->getId()){
            array_push($this->products, $this->thisProduct);
            $this->thisProduct = new compProduct($row);
        }else{
            $this->thisProduct->processRow($row);
        }
    }
}