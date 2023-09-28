<?php
namespace BinUtil\Form;

use Laminas\Form\Form;

class BinForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('bin');

    }
}