<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CampoTabela
 *
 * @author rodri
 */
include_once '../Model/Base.Class.php';
class AuditoriaCampo extends Base{

    private $id;
    private $idPrograma;
    private $campo;
    private $descricaoCampo;

    function __construct() {
        define("AUDITORIACAMPO_TABLENAME", $this->getSchema()."PTC_AUDITORIA_CAMPO_DESC_ACD");
        define("AUDITORIACAMPO_ID", "ACD_ID");
        define("AUDITORIACAMPO_ID_PROGRAMA", "ACD_PRO_ID");
        define("AUDITORIACAMPO_CAMPO", "ACD_CAMPO");
        define("AUDITORIACAMPO_DESCRICAO", "ADT_DESCRICAO_CAMPO");
    }

    function getId() {
        return $this->id;
    }

    function getIdPrograma() {
        return $this->idPrograma;
    }

    function getCampo() {
        return $this->campo;
    }

    function getDescricaoCampo() {
        return $this->descricaoCampo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdPrograma($idPrograma) {
        $this->idPrograma = $idPrograma;
    }

    function setCampo($campo) {
        $this->campo = $campo;
    }

    function setDescricaoCampo($descricaoCampo) {
        $this->descricaoCampo = $descricaoCampo;
    }

}
