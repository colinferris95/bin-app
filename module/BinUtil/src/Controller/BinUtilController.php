<?php

namespace BinUtil\Controller;

use BinUtil\Model\Bin;
use BinUtil\Form\BinForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;


class BinUtilController extends AbstractActionController
{
    private $bin;
    public function indexAction()
    {
        var_dump(php_ini_loaded_file(), php_ini_scanned_files());
        echo "hello world!!";
    }

    public function widthAction(){
        $request = $this->getRequest();
        if (!$request->isPost()) {
            //throw exception
        }
        //form to get input from post
        $form = new BinForm();
        $bin = new Bin("width");
        $data = $request->getPost();
        $form->setInputFilter($bin->getInputFilter());
        $form->setData($request->getPost());
        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $formData = $form->getData();
        $inputArray = preg_split ("/\, /", $formData["inputData"]); 
        $bin->setInput($inputArray);

        $response;
        if ($bin->getFilterType() == "width"){
            $response = $bin->widthFilter();
        }
    }

    public function frequencyAction(){
        $response;
        //$inputArray = array(0.1, 3.4, 3.5, 3.6, 7.0, 9.0, 6.0, 4.4, 2.5, 3.9, 4.5, 2.8);
        $inputArray = array(5, 9, 3, 13, 35, 60, 24, 43, 50, 55, 99, 87, 65);
        $bin = new Bin("frequency",$inputArray);
        if ($bin->getFilterType() == "frequency"){
            $response = $bin->frequencyFilter();
        }
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