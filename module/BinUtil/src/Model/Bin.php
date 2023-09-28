<?php
namespace BinUtil\Model;

class Bin{

    public $filterType;

    function __construct($filterType){
        $this->filterType = $filterType;
    }

    public function getFitlerType(){
        return $this->filterType;
    }



}
