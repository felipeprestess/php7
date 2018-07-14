<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PadraoModulo
 *
 * @author rodri
 */
include_once '../Model/Base.Class.php';

class PadraoModulo extends Base {

    private $id;
    private $tipo;
    private $pai_id;
    private $parametro;
    private $valor;
    private $tipo_campo;
    private $bloqueado;
    private $lixeira;
    private $descricao;

    function __construct() {

        define("PADRAOMODULO_TABLENAME", $this->getSchema() . "PTC_PADROES_MODULO_PROG_PMP");
        define("PADRAOMODULO_ID", "PMP_ID");
        define("PADRAOMODULO_TIPO", "PMP_TIPO");
        define("PADRAOMODULO_PAI_ID", "PMP_PRO_MOD_ID");
        define("PADRAOMODULO_PARAMETRO", "PMP_PARAMETRO");
        define("PADRAOMODULO_VALOR", "PMP_VALOR");
        define("PADRAOMODULO_TIPO_CAMPO", "PMP_TIPO_CAMPO");
        define("PADRAOMODULO_BLOQUEADO", "PMP_BLOQUEADO");
        define("PADRAOMODULO_DESCRICAO", "PMP_DESCRICAO");
        define("PADRAOMODULO_LIXEIRA", "PMP_LIXEIRA");
    }

    function getId() {
        return $this->id;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getPai_id() {
        return $this->pai_id;
    }

    function getParametro() {
        return $this->parametro;
    }

    function getValor() {
        return $this->valor;
    }

    function getTipo_campo() {
        return $this->tipo_campo;
    }

    function getBloqueado() {
        return $this->bloqueado;
    }

    function getLixeira() {
        return $this->lixeira;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setPai_id($pai_id) {
        $this->pai_id = $pai_id;
    }

    function setParametro($parametro) {
        $this->parametro = $parametro;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setTipo_campo($tipo_campo) {
        $this->tipo_campo = $tipo_campo;
    }

    function setBloqueado($bloqueado) {
        $this->bloqueado = $bloqueado;
    }

    function setLixeira($lixeira) {
        $this->lixeira = $lixeira;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
