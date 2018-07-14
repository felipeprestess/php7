<?php

function listaAuditoriaPorIdRegistro($id) {
    include_once "../Model/Auditoria.Class.php";
    include_once '../Model/DAO.Class.php';

    $objAuditoria = new Auditoria();
    $objDao = new DAO();

    $lista = $objDao->Consultar(AUDITORIA_TABLENAME, "*", WHERE . AUDITORIA_ID_REGISTRO . IGUAL . $id . ORDER . AUDITORIA_VERSAO);

    return $lista;
}

function listaAuditoriaPorIdRegistro_E_Versao($id, $versao) {
    include_once "../Model/Auditoria.Class.php";
    include_once '../Model/DAO.Class.php';

    $objAuditoria = new Auditoria();
    $objDao = new DAO();

    $lista = $objDao->Consultar(AUDITORIA_TABLENAME, "*", WHERE . AUDITORIA_ID_REGISTRO . IGUAL . $id . E . AUDITORIA_VERSAO . IGUAL . $versao . ORDER . AUDITORIA_VERSAO);

    return $lista;
}

function listaVersoesAuditoriaPorIdRegistro($id) {
    include_once "../Model/Auditoria.Class.php";
    include_once '../Model/DAO.Class.php';

    $objAuditoria = new Auditoria();
    $objDao = new DAO();

    $lista = $objDao->Consultar(AUDITORIA_TABLENAME, "DISTINCT " . AUDITORIA_VERSAO, WHERE . AUDITORIA_ID_REGISTRO . IGUAL . $id . ORDER . AUDITORIA_VERSAO);

    return $lista;
}

function listaAuditoriaPorIdRegistroUltimaVersao($id) {
    include_once "../Model/Auditoria.Class.php";
    include_once '../Model/DAO.Class.php';

    $objAuditoria = new Auditoria();
    $objDao = new DAO();

    $max = $objDao->ConsultarCustom("SELECT MAX(" . AUDITORIA_DATA_HORA . ") FROM " . AUDITORIA_TABLENAME . WHERE . AUDITORIA_ID_REGISTRO . IGUAL . $id);
    $max = $max->fetch(PDO::FETCH_BOTH);

    $max = explode(" ", $max[0]);

    $lista = $objDao->Consultar(AUDITORIA_TABLENAME, "*", WHERE . AUDITORIA_ID_REGISTRO . IGUAL . $id . E . AUDITORIA_DATA_HORA . " LIKE '%" . $max[0] . "%'" . E . AUDITORIA_VERSAO . " > 1 " . ORDER . AUDITORIA_VERSAO);

    return $lista;
}
