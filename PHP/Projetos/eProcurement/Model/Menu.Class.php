<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';
class Menu extends Base{

    private $Principal;
    private $Owner;
    private $DescricaoCurta;
    private $ID;
    private $Programa;
    private $Ordem;
    private $Destino;

    function __construct() {
        define("MENU_TABLENAME",  $this->getSchema()."PTC_MENU_MEN");
        define("MENU_ID", "MEN_ID");
        define("MENU_PROGRAMA", "MEN_PRO_ID");
        define("MENU_PRINCIPAL", "MEN_PRINCIPAL");
        define("MENU_DESCRICAO_CURTA", "MEN_DESCRICAO_CURTA");
        define("MENU_OWNER", "MEN_ID_OWNER");
        define("MENU_ORDEM", "MEN_ORDEM");
        define("MENU_DESTINO", "MEN_DESTINO");
    }

    function getPrincipal() {
        return $this->Principal;
    }

    function getOwner() {
        return $this->Owner;
    }

    function getDescricaoCurta() {
        return $this->DescricaoCurta;
    }

    function getID() {
        return $this->ID;
    }

    function getPrograma() {
        return $this->Programa;
    }

    function getOrdem() {
        return $this->Ordem;
    }

    function setPrincipal($Principal) {
        $this->Principal = $Principal;
    }

    function setOwner($Owner) {
        $this->Owner = $Owner;
    }

    function setDescricaoCurta($DescricaoCurta) {
        $this->DescricaoCurta = $DescricaoCurta;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setPrograma($Programa) {
        $this->Programa = $Programa;
    }

    function setOrdem($Ordem) {
        $this->Ordem = $Ordem;
    }

    function getDestino() {
        return $this->Destino;
    }

    function setDestino($Destino) {
        $this->Destino = $Destino;
    }

}
