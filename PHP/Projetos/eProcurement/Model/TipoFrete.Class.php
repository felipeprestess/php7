<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoFrete
 *
 * @author rodri
 */
include_once '../Model/Base.Class.php';
include_once '../Model/IClass.php';

class TipoFrete extends Base implements IClass{

    private $id;
    private $cod;
    private $descricao;

    const _TABLENAME = "PTC_TIPO_FRETE_TFR";
    const _ID = "TFR_ID";
    const _COD = "TFR_COD";
    const _DESCRICAO = "TFR_DESCRICAO";

    function __construct() {
        parent::__construct();
    }

    function getId() {
        return $this->id;
    }

    function getCod() {
        return $this->cod;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function alimentaobj($dados) {
        $this->setId($dados[self::_ID]);
        $this->setCod($dados[self::_COD]);
        $this->setDescricao($dados[self::_DESCRICAO]);
    }

}
