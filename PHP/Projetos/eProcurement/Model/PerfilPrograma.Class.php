<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerfilPrograma
 *
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';
class PerfilPrograma extends Base{

    private $ID;
    private $IDPerfil;
    private $IDPrograma;
    private $Acessar;
    private $Lixeira;
    private $Alterar;
    private $Incluir;

    function __construct() {
        define("PERFILPROGRAMA_TABLENAME",  $this->getSchema()."PTC_PERFIL_PROGRAMA_PEP");
        define("PERFILPROGRAMA_ID", "PEP_ID");
        define("PERFILPROGRAMA_PROGRAMA_ID", "PEP_PRO_ID");
        define("PERFILPROGRAMA_PERFIL_ID", "PEP_PER_ID");
        define("PERFILPROGRAMA_ACESSAR", "PEP_ACESSAR");
        define("PERFILPROGRAMA_LIXEIRA", "PEP_LIXEIRA");
        define("PERFILPROGRAMA_INCLUIR", "PEP_INCLUIR");
        define("PERFILPROGRAMA_ALTERAR", "PEP_ALTERAR");
    }
    
    function getID() {
        return $this->ID;
    }

    function getIDPerfil() {
        return $this->IDPerfil;
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

    function setIDPerfil($IDPerfil) {
        $this->IDPerfil = $IDPerfil;
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
