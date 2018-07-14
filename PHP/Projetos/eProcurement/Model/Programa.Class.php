<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Programa
 *
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';
class Programa extends Base{

    private $Descricao;
    private $Codigo;
    private $DescricaoCurta;
    private $ID;
    private $Lixeira;
    private $CodPtv;

    function __construct() {
        define("PROGRAMA_TABLENAME",  $this->getSchema()."PTC_PROGRAMA_PRO");
        define("PROGRAMA_ID", "PRO_ID");
        define("PROGRAMA_CODIGO", "PRO_CODIGO");
        define("PROGRAMA_DESCRICAO_CURTA", "PRO_DESCRICAO_CURTA");
        define("PROGRAMA_DESCRICAO", "PRO_DESCRICAO");
        define("PROGRAMA_LIXEIRA", "PRO_LIXEIRA");
        define("PROGRAMA_COD_PTC", "PRO_COD_PTC");
    }
    function getCodPtv() {
        return $this->CodPtv;
    }

    function setCodPtv($CodPtv) {
        $this->CodPtv = $CodPtv;
    }

    function getDescricao() {
        return $this->Descricao;
    }

    function getCodigo() {
        return $this->Codigo;
    }

    function getDescricaoCurta() {
        return $this->DescricaoCurta;
    }

    function getID() {
        return $this->ID;
    }

    function getLixeira() {
        return $this->Lixeira;
    }

    function setDescricao($Descricao) {
        $this->Descricao = $Descricao;
    }

    function setCodigo($Codigo) {
        $this->Codigo = $Codigo;
    }

    function setDescricaoCurta($DescricaoCurta) {
        $this->DescricaoCurta = $DescricaoCurta;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setLixeira($Lixeira) {
        $this->Lixeira = $Lixeira;
    }

}
