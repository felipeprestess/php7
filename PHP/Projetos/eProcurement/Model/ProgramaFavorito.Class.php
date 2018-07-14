<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProgramaFavorito
 *
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';
class ProgramaFavorito extends Base {

    private $ID;
    private $DataHora;
    private $IDPrograma;
    private $IDUsuario;

    function __construct() {
        define("PROGRAMA_FAVORITO_TABLENAME", $this->getSchema(). "joi_programa_favorito_pgf");
        define("PROGRAMA_FAVORITO_ID", "pgf_id");
        define("PROGRAMA_FAVORITO_PROGRAMA", "pgf_pro_id");
        define("PROGRAMA_FAVORITO_USUARIO", "pgf_usu_id");
        define("PROGRAMA_FAVORITO_DATA_HORA", "pgf_data_hora");
    }

    function getID() {
        return $this->ID;
    }

    function getDataHora() {
        return $this->DataHora;
    }

    function getIDPrograma() {
        return $this->IDPrograma;
    }

    function getIDUsuario() {
        return $this->IDUsuario;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setDataHora($DataHora) {
        $this->DataHora = $DataHora;
    }

    function setIDPrograma($IDPrograma) {
        $this->IDPrograma = $IDPrograma;
    }

    function setIDUsuario($IDUsuario) {
        $this->IDUsuario = $IDUsuario;
    }

}
