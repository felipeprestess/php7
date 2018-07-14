<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerfilUsuario
 *
 * @author William
 */
include_once '../Model/Base.Class.php';

class DashboardUsuario extends Base {

    private $Id;
    private $UsuarioId;
    private $dashboard_1;
    private $dashboard_2;
    private $dashboard_3;
    private $dashboard_4;
    private $dashboard_5;
    private $dashboard_6;
    private $dashboard_7;
    private $dashboard_8;
    private $dashboard_9;
    private $dashboard_10;
    private $dashboard_11;
    private $dashboard_12;
    private $dashboard_13;
    private $dashboard_14;
    private $dashboard_15;
    private $dashboard_16;
    private $dashboard_17;
    private $dashboard_18;
    private $dashboard_19;
    private $dashboard_20;
    private $dashboard_21;
    private $dashboard_22;
    private $dashboard_23;
    private $dashboard_24;
    private $dashboard_25;
    private $dashboard_26;

    function __construct() {
        define("DASHBOARD_USUARIO_TABLENAME", $this->getSchema() . "PTC_DASHBOARD_USUARIO_DBU");
        define("DASHBOARD_USUARIO_ID", "DBU_ID");
        define("DASHBOARD_USUARIO_USU_ID", "DBU_USU_ID");
        define("DASHBOARD_USUARIO_DASH_1", "DBU_DASH_1");
        define("DASHBOARD_USUARIO_DASH_2", "DBU_DASH_2");
        define("DASHBOARD_USUARIO_DASH_3", "DBU_DASH_3");
        define("DASHBOARD_USUARIO_DASH_4", "DBU_DASH_4");
        define("DASHBOARD_USUARIO_DASH_5", "DBU_DASH_5");
        define("DASHBOARD_USUARIO_DASH_6", "DBU_DASH_6");
        define("DASHBOARD_USUARIO_DASH_7", "DBU_DASH_7");
        define("DASHBOARD_USUARIO_DASH_8", "DBU_DASH_8");
        define("DASHBOARD_USUARIO_DASH_9", "DBU_DASH_9");
        define("DASHBOARD_USUARIO_DASH_10", "DBU_DASH_10");
        define("DASHBOARD_USUARIO_DASH_11", "DBU_DASH_11");
        define("DASHBOARD_USUARIO_DASH_12", "DBU_DASH_12");
        define("DASHBOARD_USUARIO_DASH_13", "DBU_DASH_13");
        define("DASHBOARD_USUARIO_DASH_14", "DBU_DASH_14");
        define("DASHBOARD_USUARIO_DASH_15", "DBU_DASH_15");
        define("DASHBOARD_USUARIO_DASH_16", "DBU_DASH_16");
        define("DASHBOARD_USUARIO_DASH_17", "DBU_DASH_17");
        define("DASHBOARD_USUARIO_DASH_18", "DBU_DASH_18");
        define("DASHBOARD_USUARIO_DASH_19", "DBU_DASH_19");
        define("DASHBOARD_USUARIO_DASH_20", "DBU_DASH_20");
        define("DASHBOARD_USUARIO_DASH_21", "DBU_DASH_21");
        define("DASHBOARD_USUARIO_DASH_22", "DBU_DASH_22");
        define("DASHBOARD_USUARIO_DASH_23", "DBU_DASH_23");
        define("DASHBOARD_USUARIO_DASH_24", "DBU_DASH_24");
        define("DASHBOARD_USUARIO_DASH_25", "DBU_DASH_25");
        define("DASHBOARD_USUARIO_DASH_26", "DBU_DASH_26");
    }

    function getId() {
        return $this->Id;
    }

    function getUsuarioId() {
        return $this->UsuarioId;
    }

    function getDashboard_1() {
        return $this->dashboard_1;
    }

    function getDashboard_2() {
        return $this->dashboard_2;
    }

    function getDashboard_3() {
        return $this->dashboard_3;
    }

    function getDashboard_4() {
        return $this->dashboard_4;
    }

    function getDashboard_5() {
        return $this->dashboard_5;
    }

    function getDashboard_6() {
        return $this->dashboard_6;
    }

    function getDashboard_7() {
        return $this->dashboard_7;
    }

    function getDashboard_8() {
        return $this->dashboard_8;
    }

    function getDashboard_9() {
        return $this->dashboard_9;
    }

    function getDashboard_10() {
        return $this->dashboard_10;
    }

    function getDashboard_11() {
        return $this->dashboard_11;
    }

    function getDashboard_12() {
        return $this->dashboard_12;
    }

    function getDashboard_13() {
        return $this->dashboard_13;
    }

    function getDashboard_14() {
        return $this->dashboard_14;
    }

    function getDashboard_15() {
        return $this->dashboard_15;
    }

    function getDashboard_16() {
        return $this->dashboard_16;
    }

    function getDashboard_17() {
        return $this->dashboard_17;
    }

    function getDashboard_18() {
        return $this->dashboard_18;
    }

    function getDashboard_19() {
        return $this->dashboard_19;
    }

    function getDashboard_20() {
        return $this->dashboard_20;
    }

    function getDashboard_21() {
        return $this->dashboard_21;
    }

    function getDashboard_22() {
        return $this->dashboard_22;
    }

    function getDashboard_23() {
        return $this->dashboard_23;
    }

    function getDashboard_24() {
        return $this->dashboard_24;
    }

    function getDashboard_25() {
        return $this->dashboard_25;
    }

    function getDashboard_26() {
        return $this->dashboard_26;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setUsuarioId($UsuarioId) {
        $this->UsuarioId = $UsuarioId;
    }

    function setDashboard_1($dashboard_1) {
        $this->dashboard_1 = $dashboard_1;
    }

    function setDashboard_2($dashboard_2) {
        $this->dashboard_2 = $dashboard_2;
    }

    function setDashboard_3($dashboard_3) {
        $this->dashboard_3 = $dashboard_3;
    }

    function setDashboard_4($dashboard_4) {
        $this->dashboard_4 = $dashboard_4;
    }

    function setDashboard_5($dashboard_5) {
        $this->dashboard_5 = $dashboard_5;
    }

    function setDashboard_6($dashboard_6) {
        $this->dashboard_6 = $dashboard_6;
    }

    function setDashboard_7($dashboard_7) {
        $this->dashboard_7 = $dashboard_7;
    }

    function setDashboard_8($dashboard_8) {
        $this->dashboard_8 = $dashboard_8;
    }

    function setDashboard_9($dashboard_9) {
        $this->dashboard_9 = $dashboard_9;
    }

    function setDashboard_10($dashboard_10) {
        $this->dashboard_10 = $dashboard_10;
    }

    function setDashboard_11($dashboard_11) {
        $this->dashboard_11 = $dashboard_11;
    }

    function setDashboard_12($dashboard_12) {
        $this->dashboard_12 = $dashboard_12;
    }

    function setDashboard_13($dashboard_13) {
        $this->dashboard_13 = $dashboard_13;
    }

    function setDashboard_14($dashboard_14) {
        $this->dashboard_14 = $dashboard_14;
    }

    function setDashboard_15($dashboard_15) {
        $this->dashboard_15 = $dashboard_15;
    }

    function setDashboard_16($dashboard_16) {
        $this->dashboard_16 = $dashboard_16;
    }

    function setDashboard_17($dashboard_17) {
        $this->dashboard_17 = $dashboard_17;
    }

    function setDashboard_18($dashboard_18) {
        $this->dashboard_18 = $dashboard_18;
    }

    function setDashboard_19($dashboard_19) {
        $this->dashboard_19 = $dashboard_19;
    }

    function setDashboard_20($dashboard_20) {
        $this->dashboard_20 = $dashboard_20;
    }

    function setDashboard_21($dashboard_21) {
        $this->dashboard_21 = $dashboard_21;
    }

    function setDashboard_22($dashboard_22) {
        $this->dashboard_22 = $dashboard_22;
    }

    function setDashboard_23($dashboard_23) {
        $this->dashboard_23 = $dashboard_23;
    }

    function setDashboard_24($dashboard_24) {
        $this->dashboard_24 = $dashboard_24;
    }

    function setDashboard_25($dashboard_25) {
        $this->dashboard_25 = $dashboard_25;
    }

    function setDashboard_26($dashboard_26) {
        $this->dashboard_26 = $dashboard_26;
    }

}
