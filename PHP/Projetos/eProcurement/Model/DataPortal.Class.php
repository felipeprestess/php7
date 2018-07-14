<?php

class DataPortal extends Base {

    private $date;

    function __construct($date) {
        parent::__construct();
        $this->date = $date;
        $this->Format();
    }

    function Format() {
        if ($this->getEmpresaPortal() == "GUABI" || $this->getEmpresaPortal() == "BR") {
            $this->setDate(" TO_DATE('{$this->getDate()}', '%Y-%m-%d') ");
        } elseif ($this->getEmpresaPortal() == "MP" || $this->getEmpresaPortal() == "HI") {   
            $this->setDate(" TO_DATE('{$this->getDate()}','yyyy-mm-dd') ");
        } elseif ($this->getEmpresaPortal() == "SA" || $this->getEmpresaPortal() == "TH") {
            $this->setDate(" CONVERT(DATETIME, '{$this->getDate()}', 120) ");
        }
    }

    function getDate() {
        return $this->date;
    }

    function setDate($date) {
        $this->date = $date;
    }
}
