<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NaoCotar
 *
 * @author Forge
 */
include_once '../Model/Base.Class.php';
include_once '../Model/IClass.php';

class NaoCotar extends Base implements IClass {

    public function __construct() {
        parent::__construct();
    }

    private $id;
    private $codigo;
    private $item;
    private $cod_empresa;
    private $id_fornecedor;
    private $tipo;

    const _TABLENAME = "PTC_NAO_COTAR_NCT";
    const _ID = "NCT_ID";
    const _CODIGO = "NCT_CODIGO";
    const _COD_EMPRESA = "NCT_EMPRESA";
    const _ID_FORNECEDOR = "NCT_FORNECEDOR";
    const _TIPO = "NCT_TIPO";
    const _ITEM = "NCT_ITEM";

    function getId() {
        return $this->id;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getItem() {
        return $this->item;
    }

    function getCod_empresa() {
        return $this->cod_empresa;
    }

    function getId_fornecedor() {
        return $this->id_fornecedor;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setItem($item) {
        $this->item = $item;
    }

    function setCod_empresa($cod_empresa) {
        $this->cod_empresa = $cod_empresa;
    }

    function setId_fornecedor($id_fornecedor) {
        $this->id_fornecedor = $id_fornecedor;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function alimentaObj($retorno) {
        $this->setId($retorno[self::_ID]);
        $this->setCodigo($retorno[self::_CODIGO]);
        $this->setCod_empresa($retorno[self::_COD_EMPRESA]);
        $this->setId_fornecedor($retorno[self::_ID_FORNECEDOR]);
        $this->setTipo($retorno[self::_TIPO]);
        $this->setItem($retorno[self::_ITEM]);
    }

}
