<?php

function buscaDescricaoCampoPorNome($nome) {
    include_once '../Model/AuditoriaCampo.Class.php';
    include_once '../Model/DAO.Class.php';

    $objDao = new DAO();
    $objAuditoriaCampo = new AuditoriaCampo();

    $auditoria = $objDao->Consultar(AUDITORIACAMPO_TABLENAME, "*", WHERE . AUDITORIACAMPO_CAMPO . IGUAL . "'" . $nome . "'");

    $objAuditoriaCampo->setId($auditoria[0][AUDITORIACAMPO_ID]);
    $objAuditoriaCampo->setCampo($auditoria[0][AUDITORIACAMPO_CAMPO]);
    $objAuditoriaCampo->setIdPrograma($auditoria[0][AUDITORIACAMPO_ID_PROGRAMA]);
    $objAuditoriaCampo->setDescricaoCampo(strtoupper($auditoria[0][AUDITORIACAMPO_DESCRICAO]));
    
    return $objAuditoriaCampo;
}
