<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioPrograma
 *
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';
class UsuarioPrograma extends Base{

    private $ID;
    private $IDUsuario;
    private $IDPrograma;
    private $Acessar;
    private $Lixeira;
    private $Alterar;
    private $Incluir;

    function __construct() {
        define("USUARIOPROGRAMA_TABLENAME", $this->getSchema()."PTC_USUARIO_PROGRAMA_UPG");
        define("USUARIOPROGRAMA_ID", "UPG_ID");
        define("USUARIOPROGRAMA_PROGRAMA_ID", "UPG_PRO_ID");
        define("USUARIOPROGRAMA_USUARIO_ID", "UPG_USU_ID");
        define("USUARIOPROGRAMA_ACESSAR", "UPG_ACESSAR");
        define("USUARIOPROGRAMA_LIXEIRA", "UPG_LIXEIRA");
        define("USUARIOPROGRAMA_INCLUIR", "UPG_INCLUIR");
        define("USUARIOPROGRAMA_ALTERAR", "UPG_ALTERAR");
    }
    
    function getID() {
        return $this->ID;
    }

    function getIDUsuario() {
        return $this->IDUsuario;
    }

    function getIDPrograma() {
        return $this->IDPrograma;
    }

    function getAcessar() {
        return $this->Acessar;
    }

    function getLixeira() {
        return $this->Lixeira;
    }

    function getAlterar() {
        return $this->Alterar;
    }

    function getIncluir() {
        return $this->Incluir;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setIDUsuario($IDUsuario) {
        $this->IDUsuario = $IDUsuario;
    }

    function setIDPrograma($IDPrograma) {
        $this->IDPrograma = $IDPrograma;
    }

    function setAcessar($Acessar) {
        $this->Acessar = $Acessar;
    }

    function setLixeira($Lixeira) {
        $this->Lixeira = $Lixeira;
    }

    function setAlterar($Alterar) {
        $this->Alterar = $Alterar;
    }

    function setIncluir($Incluir) {
        $this->Incluir = $Incluir;
    }



}
