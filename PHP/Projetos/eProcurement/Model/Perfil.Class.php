<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Perfil
 * Classe dos perfis dos usuarios.
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';

class Perfil extends Base {

    private $ID;
    private $Nome;
    private $administrador;

    function __construct() {
        define("PERFIL_TABLENAME", $this->getSchema() . "PTC_PERFIL_PER");
        define("PERFIL_ID", "PER_ID");
        define("PERFIL_NOME", "PER_NOME");
        define("PERFIL_ADMINISTRADOR", "PER_ADMINISTRADOR");
    }

    function getID() {
        return $this->ID;
    }

    function getNome() {
        return $this->Nome;
    }

    function getAdministrador() {
        return $this->administrador;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setNome($Nome) {
        $this->Nome = $Nome;
    }

    function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }

}
