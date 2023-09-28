<?php
namespace BinUtil\Model;

class BinResp{

    public $high;
    public $medium;
    public $low;

    function __construct($high,$medium,$low){
        $this->high = $high;
        $this->medium = $medium;
        $this->low = $low;
    }
}