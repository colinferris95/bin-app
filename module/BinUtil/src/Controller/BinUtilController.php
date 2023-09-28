<?php

namespace BinUtil\Controller;

use BinUtil\Model\Bin;
use BinUtil\Model\BinResp;
use BinUtil\Form\BinForm;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\FeedModel;


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

        if ($bin->getFilterType() == "width"){
            $bin->widthFilter();
        }
        $binResp = new BinResp($bin->high,$bin->medium,$bin->low);


        $viewModel = new JsonModel();
        $viewModel->setVariable('High', $binResp->high);
        $viewModel->setVariable('Medium', $binResp->medium);
        $viewModel->setVariable('Low', $binResp->low);
        return $viewModel;
    }

    public function frequencyAction(){

        $request = $this->getRequest();
        if (!$request->isPost()) {
            //throw exception
        }
        //form to get input from post
        $form = new BinForm();
        $bin = new Bin("frequency");
        $data = $request->getPost();
        $form->setInputFilter($bin->getInputFilter());
        $form->setData($request->getPost());
        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $formData = $form->getData();
        $inputArray = preg_split ("/\, /", $formData["inputData"]); 
        $bin->setInput($inputArray);

        if ($bin->getFilterType() == "frequency"){
            $bin->frequencyFilter();
        }
        $binResp = new BinResp($bin->high,$bin->medium,$bin->low);


        $viewModel = new JsonModel();
        $viewModel->setVariable('High', $binResp->high);
        $viewModel->setVariable('Medium', $binResp->medium);
        $viewModel->setVariable('Low', $binResp->low);
        return $viewModel;
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