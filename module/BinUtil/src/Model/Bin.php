<?php
namespace BinUtil\Model;
use DomainException;
use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\StringLength;

class Bin implements InputFilterAwareInterface{

    public $filterType;
    public $input;
    public $high;
    public $medium;
    public $low;

    private $inputFilter;


    //initialize bin with filter type either "width" or "frequency", and then input numbers
    function __construct($filterType){
        $this->filterType = $filterType;
        $this->high = array();
        $this->medium = array();
        $this->low = array();
    }

    public function getFilterType(){
        return $this->filterType;
    }
    public function setInput($input){
        $this->input = $input;
    }
    public function getInput(){
        return $this->input;
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

    public function setInputFilter(InputFilterInterface $inputFilter){
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter(){
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'inputData',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
            ],
        ]);


        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }



}
