<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificacao
 *
 * @author William S. Keller
 */

include_once '../Model/Base.Class.php';

class Notificacao extends Base{
    
    private $Id;
    private $Titulo;
    private $Descricao;
    private $Vizualizado;
    private $Programa;
    private $Valor;
    private $UsuarioId;
    private $Expiracao;
    
    public function __construct() {
        parent::__construct();
        define('NOTIFICACAO_TABLENAME', $this->getSchema().'PTC_NOTIFICACAO_NOT');
        define('NOTIFICACAO_ID', 'NOT_ID');
        define('NOTIFICACAO_TITULO', 'NOT_TITULO');
        define('NOTIFICACAO_DESCRICAO', 'NOT_DESCRICAO');
        define('NOTIFICACAO_VIZUALIZADO', 'NOT_VIZUALIZADO');
        define('NOTIFICACAO_PROGRAMA', 'NOT_PROGRAMA');
        define('NOTIFICACAO_USUARIO_ID', 'NOT_USU_ID');
        define('NOTIFICACAO_VALOR', 'NOT_VALOR');
        define('NOTIFICACAO_EXPIRACAO', 'NOT_EXPIRACAO');
    }
    
    function getExpiracao() {
        return $this->Expiracao;
    }

    function setExpiracao($Expiracao) {
        $this->Expiracao = $Expiracao;
    }

    function getValor() {
        return $this->Valor;
    }

    function getUsuarioId() {
        return $this->UsuarioId;
    }

    function setValor($Valor) {
        $this->Valor = $Valor;
    }

    function setUsuarioId($UsuarioId) {
        $this->UsuarioId = $UsuarioId;
    }

    function getId() {
        return $this->Id;
    }

    function getTitulo() {
        return $this->Titulo;
    }

    function getDescricao() {
        return $this->Descricao;
    }

    function getVizualizado() {
        return $this->Vizualizado;
    }

    function getPrograma() {
        return $this->Programa;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setTitulo($Titulo) {
        $this->Titulo = $Titulo;
    }

    function setDescricao($Descricao) {
        $this->Descricao = $Descricao;
    }

    function setVizualizado($Vizualizado) {
        $this->Vizualizado = $Vizualizado;
    }

    function setPrograma($Programa) {
        $this->Programa = $Programa;
    }
}
