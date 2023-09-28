<?php

namespace BinUtil\Controller;

use BinUtil\Model\Bin;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;


class BinUtilController extends AbstractActionController
{
    private $bin;
    public function indexAction()
    {
        $response;
        $inputArray = array(0.1, 3.4, 3.5, 3.6, 7.0, 9.0, 6.0, 4.4, 2.5, 3.9, 4.5, 2.8);
        $bin = new Bin("width",$inputArray);
        if ($bin->getFilterType() == "width"){
            $response = $bin->widthFilter();
        }
        var_dump(php_ini_loaded_file(), php_ini_scanned_files());
        echo "hello world!!";
    }
    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}