<?php

include_once '../Model/Base.Class.php';

class Moeda extends Base {

    private $ID;
    private $cod;
    private $descricao;
    private $abreviacao;

    const _TABLENAME = "PTC_MOEDA_MOD";
    const _ID = "MOD_ID";
    const _COD_ERP = "MOD_COD_ERP";
    const _DESCRICAO = "MOD_DESCRICAO";
    const _ABREVIACAO = "MOD_ABREVIACAO";

    function __construct() {
        parent::__construct();
    }

    function getAbreviacao() {
        return $this->abreviacao;
    }

    function setAbreviacao($abreviacao) {
        $this->abreviacao = $abreviacao;
    }

    function getID() {
        return $this->ID;
    }

    function getCod() {
        return $this->cod;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setCod($cod) {
        $this->cod = $cod;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function alimentaObj($dados) {
        $this->setID($dados[self::_ID]);
        $this->setCod($dados[self::_COD_ERP]);
        $this->setDescricao($dados[self::_DESCRICAO]);
        $this->setAbreviacao($dados[self::_ABREVIACAO]);
    }

}
