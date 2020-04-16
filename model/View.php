<?php

class View
{
    private $layout;

    public function __construct($layout='predlozak')
    {
     $this->layout=$layout;   
    }

    public function render($stranicaZaRender,$parametri=[])
    {
        ob_start(); 
        extract($parametri);
        include BP . 'view' . DIRECTORY_SEPARATOR 
        . $stranicaZaRender . '.phtml';
        $sadrzaj = ob_get_clean(); $sadrzaj;

        include BP . 'view' . DIRECTORY_SEPARATOR 
        . $this->layout . '.phtml';
    }

}