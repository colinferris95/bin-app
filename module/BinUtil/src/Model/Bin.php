<?php
namespace BinUtil\Model;

class Bin{

    public $filterType;
    public $high;
    public $medium;
    public $low;
    public $input;

    //initialize bin with filter type either "width" or "frequency", and then input numbers
    function __construct($filterType, $input){
        $this->filterType = $filterType;
        $this->input = $input;
    }

    public function getFitlerType(){
        return $this->filterType;
    }

    //divide high medium and low bins by width intervals
    public function widthFilter(){

    }

    //divide high medium and low bins by equal amount of numbers
    public function frequencyFilter(){

    }



}
