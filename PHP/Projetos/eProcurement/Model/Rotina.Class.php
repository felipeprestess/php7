<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rotina
 *
 * @author rodri
 */
include_once '../Model/Base.Class.php';

class Rotina extends Base {

    private $id;
    private $rotina;
    private $qtdExecucaoDia;
    private $ativa;
    private $arquivo;

    function __construct() {
        define("ROTINA_TABLENAME", $this->getSchema() . "PTC_ROTINA_ROT");
        define("ROTINA_ID", "ROT_ID");
        define("ROTINA_ROTINA", "ROT_ROTINA");
        define("ROTINA_QTD_EXECUCAO_DIA", "ROT_QTD_EXECUCAO_DIA");
        define("ROTINA_ATIVA", "ROT_ATIVA");
        define("ROTINA_ARQUIVO", "ROT_ARQUIVO");
    }

    function getId() {
        return $this->id;
    }

    function getRotina() {
        return $this->rotina;
    }

    function getQtdExecucaoDia() {
        return $this->qtdExecucaoDia;
    }

    function getAtiva() {
        return $this->ativa;
    }

    function getArquivo() {
        return $this->arquivo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRotina($rotina) {
        $this->rotina = $rotina;
    }

    function setQtdExecucaoDia($qtdExecucaoDia) {
        $this->qtdExecucaoDia = $qtdExecucaoDia;
    }

    function setAtiva($ativa) {
        $this->ativa = $ativa;
    }

    function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

}
