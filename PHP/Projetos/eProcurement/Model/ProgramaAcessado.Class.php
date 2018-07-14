<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProgramaAcessado
 *
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';
class ProgramaAcessado extends Base {

    private $DataHora;
    private $ID;
    private $IDPrograma;
    private $IDEmpresa;
    private $IDUsuario;

    function __construct() {
        define("PROGRAMA_ACESSADO_TABLENAME",  $this->getSchema()."joi_programa_acessado_pga");
        define("PROGRAMA_ACESSADO_ID", "pga_id");
        define("PROGRAMA_ACESSADO_EMPRESA", "pga_emp_id");
        define("PROGRAMA_ACESSADO_PROGRAMA", "pga_pro_id");
        define("PROGRAMA_ACESSADO_USUARIO", "pga_usu_id");
        define("PROGRAMA_ACESSADO_DATA_HORA", "pga_data_hora");
    }

    function getDataHora() {
        return $this->DataHora;
    }

    function getID() {
        return $this->ID;
    }

    function getPrograma() {
        return $this->Programa;
    }

    function getEmpresa() {
        return $this->Empresa;
    }

    function getUsuario() {
        return $this->Usuario;
    }

    function setDataHora($DataHora) {
        $this->DataHora = $DataHora;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setPrograma($Programa) {
        $this->Programa = $Programa;
    }

    function setEmpresa($Empresa) {
        $this->Empresa = $Empresa;
    }

    function setUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }

}
