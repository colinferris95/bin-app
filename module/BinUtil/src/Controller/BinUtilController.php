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
        $bin = new Bin('width');
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