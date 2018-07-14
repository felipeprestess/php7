<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemVenda
 *
 * @author Forge
 */
include_once '../Model/Base.Class.php';
include_once '../Model/IClass.php';

class ItemVenda extends Base implements IClass {

    private $id;
    private $codigo;
    private $empresa;
    private $desc_item;
    private $especificacao;
    private $quantidade;
    private $precoUnit;
    private $situacao;

    const _TABLENAME = "PTC_ITEM_VENDA_IVD";
    const _ID = "IVD_ID";
    const _CODIGO = "IVD_CODIGO";
    const _EMPRESA = "IVD_EMPRESA";
    const _DESCRICAO = "IVD_DESCRICAO";
    const _ESPECIFICACAO = "IVD_ESPECIFICACAO";
    const _QUANTIDADE = "IVD_QUANTIDADE";
    const _PRECO_UNIT = "IVD_PRECO_UNIT";
    const _SITUACAO = "IVD_SITUACAO";

    public function __construct() {
        parent::__construct();
    }

    function getId() {
        return $this->id;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getDesc_item() {
        return $this->desc_item;
    }

    function getEspecificacao() {
        return $this->especificacao;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getPrecoUnit() {
        return $this->precoUnit;
    }

    function getSituacao() {
        return $this->situacao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setDesc_item($desc_item) {
        $this->desc_item = $desc_item;
    }

    function setEspecificacao($especificacao) {
        $this->especificacao = $especificacao;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setPrecoUnit($precoUnit) {
        $this->precoUnit = $precoUnit;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function alimentaObj($retorno) {
        $this->setId($retorno[self::_ID]);
        $this->setCodigo($retorno[self::_CODIGO]);
        $this->setEmpresa($retorno[self::_EMPRESA]);
        $this->setDesc_item($retorno[self::_DESCRICAO]);
        $this->setEspecificacao($retorno[self::_ESPECIFICACAO]);
        $this->setQuantidade($retorno[self::_QUANTIDADE]);
        $this->setPrecoUnit($retorno[self::_PRECO_UNIT]);
        $this->setSituacao($retorno[self::_SITUACAO]);
    }

}
