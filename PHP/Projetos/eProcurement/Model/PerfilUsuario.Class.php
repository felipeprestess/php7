<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerfilUsuario
 *
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';
class PerfilUsuario extends Base {

    private $ID;
    private $IDPerfil;
    private $IDUsuario;

    function __construct() {
        define("PERFILUSUARIO_TABLENAME", $this->getSchema()."PTC_PERFIL_USUARIO_PFU");
        define("PERFILUSUARIO_ID", "PFU_ID");
        define("PERFILUSUARIO_USUARIO_ID", "PFU_USU_ID");
        define("PERFILUSUARIO_PERFIL_ID", "PFU_PER_ID");
    }

    function getID() {
        return $this->ID;
    }

    function getIDPerfil() {
        return $this->IDPerfil;
    }

    function getIDUsuario() {
        return $this->IDUsuario;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setIDPerfil($IDPerfil) {
        $this->IDPerfil = $IDPerfil;
    }

    function setIDUsuario($IDUsuario) {
        $this->IDUsuario = $IDUsuario;
    }

}
