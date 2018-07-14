<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auditoria
 *
 * @author rodri
 */
include_once '../Model/Base.Class.php';
class Auditoria extends Base{

    private $id;
    private $programa;
    private $idregistro;
    private $campo;
    private $idUsuario;
    private $usuario;
    private $dataHora;
    private $acao;
    private $versao;
    private $valorAntigo;
    private $valorNovo;

    function __construct() {
        define("AUDITORIA_TABLENAME", $this->getSchema()."PTC_AUDITORIA_ADT");
        define("AUDITORIA_ID", "ADT_ID");
        define("AUDITORIA_ID_PROGRAMA", "ADT_PRO_ID");
        define("AUDITORIA_ID_REGISTRO", "ADT_ID_REGISTRO");
        define("AUDITORIA_CAMPO", "ADT_CAMPO");
        define("AUDITORIA_ID_USUARIO", "ADT_USU_ID");
        define("AUDITORIA_USUARIO", "ADT_USUARIO_DESCRICAO");
        define("AUDITORIA_DATA_HORA", "ADT_DATA_HORA");
        define("AUDITORIA_ACAO", "ADT_ACAO");
        define("AUDITORIA_VERSAO", "ADT_VERSAO");
        define("AUDITORIA_VALOR_ANTIGO", "ADT_VALOR_ANTIGO");
        define("AUDITORIA_VALOR_NOVO", "ADT_VALOR_NOVO");
    }

    function getId() {
        return $this->id;
    }

    function getPrograma() {
        return $this->programa;
    }

    function getIdregistro() {
        return $this->idregistro;
    }

    function getCampo() {
        return $this->campo;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getDataHora() {
        return $this->dataHora;
    }

    function getAcao() {
        return $this->acao;
    }

    function getVersao() {
        return $this->versao;
    }

    function getValorAntigo() {
        return $this->valorAntigo;
    }

    function getValorNovo() {
        return $this->valorNovo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPrograma($programa) {
        $this->programa = $programa;
    }

    function setIdregistro($idregistro) {
        $this->idregistro = $idregistro;
    }

    function setCampo($campo) {
        $this->campo = $campo;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setDataHora($dataHora) {
        $this->dataHora = $dataHora;
    }

    function setAcao($acao) {
        $this->acao = $acao;
    }

    function setVersao($versao) {
        $this->versao = $versao;
    }

    function setValorAntigo($valorAntigo) {
        $this->valorAntigo = $valorAntigo;
    }

    function setValorNovo($valorNovo) {
        $this->valorNovo = $valorNovo;
    }

}
