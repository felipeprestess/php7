<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CondicaoPagamento
 *
 * @author Forge
 */
include_once '../Model/Base.Class.php';
include_once '../Model/IClass.php';

class CondicaoPagamento extends Base implements IClass {

    public function __construct() {
        parent::__construct();
    }
    
    const _TABLENAME = "PTC_CONDICAO_PAGAMENTO_CPGTO";
    const _ID = "CPGTO_ID";
    const _COD_ERP = "CPGTO_COD_ERP";
    const _DESCRICAO = "CPGTO_DESCRICAO";
    const _VALOR_MINIMO = "CPGTO_VALOR_MINIMO";
    const _PARCELADO = "CPGTO_PARCELADO";
    const _CARTEIRAS = "CPGTO_CARTEIRAS";
    const _BNDS = "CPGTO_BNDS";
    const _ANTECIPADO = "CPGTO_ANTECIPADO";
    
    private $id;
    private $cod_erp;
    private $descricao;
    private $valorMinimo;
    private $parcelado;
    private $carteiras;
    private $bnds;
    private $antecipado;
    
    function getId() {
        return $this->id;
    }

    function getCod_erp() {
        return $this->cod_erp;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getValorMinimo() {
        return $this->valorMinimo;
    }

    function getParcelado() {
        return $this->parcelado;
    }

    function getCarteiras() {
        return $this->carteiras;
    }

    function getBnds() {
        return $this->bnds;
    }

    function getAntecipado() {
        return $this->antecipado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCod_erp($cod_erp) {
        $this->cod_erp = $cod_erp;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setValorMinimo($valorMinimo) {
        $this->valorMinimo = $valorMinimo;
    }

    function setParcelado($parcelado) {
        $this->parcelado = $parcelado;
    }

    function setCarteiras($carteiras) {
        $this->carteiras = $carteiras;
    }

    function setBnds($bnds) {
        $this->bnds = $bnds;
    }

    function setAntecipado($antecipado) {
        $this->antecipado = $antecipado;
    }
    

    public function alimentaObj($retorno) {
        $this->setId($retorno[self::_ID]);
        $this->setCod_erp($retorno[self::_COD_ERP]);
        $this->setDescricao($retorno[self::_DESCRICAO]);
        $this->setValorMinimo($retorno[self::_VALOR_MINIMO]);
        $this->setParcelado($retorno[self::_PARCELADO]);
        $this->setCarteiras($retorno[self::_CARTEIRAS]);
        $this->setBnds($retorno[self::_BNDS]);
        $this->setAntecipado($retorno[self::_ANTECIPADO]);
    }

}
