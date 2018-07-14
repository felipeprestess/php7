<?php

function ListaPrograma() {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Programa.Class.php';

    $objPrograma = new Programa();
    $objDao = new DAO();
    
    $ListaPrograma = $objDao->ConsultarCustom("SELECT * FROM " . PROGRAMA_TABLENAME . " INNER JOIN " . $objDao->getSchema() . " PTC_PROGRAMA_MODULO_PGM ON (PGM_PRO_ID=" . PROGRAMA_ID . ") ORDER BY PGM_MOD_ID");

    return $ListaPrograma;
}

function buscaProgramaPorId($id) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Programa.Class.php';

    $objPrograma = new Programa();
    $objDao = new DAO();

    $programa = $objDao->ConsultarInnerEntidadePadrao(PROGRAMA_TABLENAME, "*", WHERE . PROGRAMA_ID . IGUAL . $id, PROGRAMA_ID);


    $objPrograma->setID($programa[0][PROGRAMA_ID]);
    $objPrograma->setCodPtv($programa[0][PROGRAMA_COD_PTC]);


    return $objPrograma;
}
