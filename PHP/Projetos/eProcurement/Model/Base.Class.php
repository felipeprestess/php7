<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base
 *
 * @author rodri
 */
class Base {
    /*
     * Tabela de entidades do sistema
     */

    private $id;
    private $criadorId;
    private $proprietarioId;
    private $modificadoPor;
    private $descricao;
    private $observacao;
    private $createdtime;
    private $modifiedtime;
    private $statusPai;
    private $versao;
    private $lixeira;
    private $bloqueado;
    private $representante;
    
    public static $schema = "";        // GuabiFios: "PTV:"  |  Malharia Princesa: "PTV."  | BRANCO: "PTV:"  | Sampaio: "ptv.dbo."  | TERMO: ptv_teste.dbo.    public static $schemaErp = "";   // GuabiFios: "LOGIX:"  |  Malharia Princesa: "LOGIX."  |  Branco: "LOGIX:"  | Sampaio: "logixprd.dbo." | TERMO: dbo.
    public static $empresaPortal = 'PT'; // GuabiFios: "GUABI"   |  Malharia Princesa: "MP" |  BR: "LOGIX:"  | Sampaio: "SA" | TERMO: TH
    public static $base = 'PRD';           // Producao: "PRD"      |  Teste: "TST"
    public static $schemaErp = "";

    function __construct() {
        define("BASE_TABLENAME", $this->getSchema() . "PTC_ENTIDADE_ENT");
        define("BASE_ID", "ENT_ID");
        define("BASE_CRIADOR_ID", "ENT_CRIADOR_ID");
        define("BASE_PROPRIETARIO_ID", "ENT_PROPRIETARIO_ID");
        define("BASE_MODIFICADO_POR", "ENT_MODIFICADO_POR");
        define("BASE_DESCRICAO", "ENT_DESCRICAO");
        define("BASE_OBSERVACAO", "ENT_OBSERVACAO");
        define("BASE_CREATEDTIME", "ENT_CREATEDTIME");
        define("BASE_MODIFIEDTIME", "ENT_MODIFIEDTIME");
        define("BASE_REPRESENTANTE", "ENT_REPRESENTANTE");
        define("BASE_STATUS", "ENT_STATUS");
        define("BASE_VERSAO", "ENT_VERSAO");
        define("BASE_LIXEIRA", "ENT_LIXEIRA");
        define("BASE_BLOQUEADO", "ENT_BLOQUEADO");
    }

    function getId() {
        return $this->id;
    }

    function getCriadorId() {
        return $this->criadorId;
    }

    function getProprietarioId() {
        return $this->proprietarioId;
    }

    function getModificadoPor() {
        return $this->modificadoPor;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getObservacao() {
        return $this->observacao;
    }

    function getCreatedtime() {
        return $this->createdtime;
    }

    function getModifiedtime() {
        return $this->modifiedtime;
    }

    function getStatusPai() {
        return $this->statusPai;
    }

    function getVersao() {
        return $this->versao;
    }

    function getLixeira() {
        return $this->lixeira;
    }

    function getBloqueado() {
        return $this->bloqueado;
    }

    function getRepresentante() {
        return $this->representante;
    }

    static function getSchema() {
        return self::$schema;
    }

    static function getSchemaErp() {
        return self::$schemaErp;
    }

    static function getEmpresaPortal() {
        return self::$empresaPortal;
    }

    static function getBase() {
        return self::$base;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCriadorId($criadorId) {
        $this->criadorId = $criadorId;
    }

    function setProprietarioId($proprietarioId) {
        $this->proprietarioId = $proprietarioId;
    }

    function setModificadoPor($modificadoPor) {
        $this->modificadoPor = $modificadoPor;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    function setCreatedtime($createdtime) {
        $this->createdtime = $createdtime;
    }

    function setModifiedtime($modifiedtime) {
        $this->modifiedtime = $modifiedtime;
    }

    function setStatusPai($statusPai) {
        $this->statusPai = $statusPai;
    }

    function setVersao($versao) {
        $this->versao = $versao;
    }

    function setLixeira($lixeira) {
        $this->lixeira = $lixeira;
    }

    function setBloqueado($bloqueado) {
        $this->bloqueado = $bloqueado;
    }

    function setRepresentante($representante) {
        $this->representante = $representante;
    }

    static function setSchema($schema) {
        self::$schema = $schema;
    }

    static function setSchemaErp($schemaErp) {
        self::$schemaErp = $schemaErp;
    }

    static function setEmpresaPortal($empresaPortal) {
        self::$empresaPortal = $empresaPortal;
    }

    static function setBase($base) {
        self::$base = $base;
    }

}
