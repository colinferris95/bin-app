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
        $this->$high = array();
        $this->$medium = array();
        $this->$low = array();
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

        foreach ($sortedArray as $arrVal){
            if ($arrVal <= $lowInterval[1]){
                $low[] = $arrVal;
            }
            else if ($arrVal <= $mediumInterval[1] && $arrVal > $mediumInterval[0]){
                $medium[] = $arrVal;
            }
            else if ($arrVal <= $highInterval[1] && $arrVal > $highInterval[0]){
                $high[] = $arrVal;
            }
            else{
                //throw exception
            }
        }

    }

    //divide high medium and low bins by equal amount of numbers
    public function frequencyFilter(){
        $sortedArray = $this->input;
        sort($sortedArray);
        $arrLength = count($sortedArray);
        $maxBinAmount = $arrLength/3;

        foreach ($sortedArray as $arrVal){
            if (count($low) < $maxBinAmount){
                $low[] = $arrVal;
            }
            else if (count($medium) < $maxBinAmount){
                $medium[] = $arrVal;
            }
            else if (count($high) < $maxBinAmount){
                $high[] = $arrVal;
            }
            else{
                //throw exception
            }
        }
        
    }



}
