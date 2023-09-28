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

    public function getFilterType(){
        return $this->filterType;
    }

    //divide high medium and low bins by width intervals
    public function widthFilter(){
        $sortedArray = $this->input;
        sort($sortedArray);
        $arrLength = count($sortedArray) -1;
        //find the highest and lowest number in the sorted array to use for interval widths
        $highestNumber = $sortedArray[$arrLength];
        $lowestNumber = $sortedArray[0];
        $intervalPacing = $highestNumber/3;
        //create interval bins
        $highInterval = array($intervalPacing*2, $highestNumber);
        $mediumInterval = array($intervalPacing, $intervalPacing*2);
        $lowInterval = array($lowestNumber,$intervalPacing);

    }

    //divide high medium and low bins by equal amount of numbers
    public function frequencyFilter(){

    }



}
