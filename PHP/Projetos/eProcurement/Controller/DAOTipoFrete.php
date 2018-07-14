<?php

function ListaTipoFrete() {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/TipoFrete.Class.php';

    $objTipoFrete = new TipoFrete();
    $objDao = new DAO();

    $ListaTipoFrete = $objDao->Consultar(TipoFrete::_TABLENAME, "*", " ORDER BY TFR_COD ASC ");

    return $ListaTipoFrete;
}

function CadastraTipoFrete($ValoresPost) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/TipoFrete.Class.php';
    include_once '../Controller/Base.php';

    $ObjTipoFrete = new TipoFrete();
    $ObjDao = new DAO();

    $tipoFrete = array();

    $tipoFrete[TipoFrete::_ID] = $ValoresPost[TipoFrete::_ID];
    $tipoFrete[TipoFrete::_COD] = $ValoresPost[TipoFrete::_COD];
    $tipoFrete[TipoFrete::_DESCRICAO] = strtoupper($ValoresPost[TipoFrete::_DESCRICAO]);

    if ($ValoresPost['Acao'] == "Inserir") {
        $BaseId = CadastraEntidade("Cadastro da Tipo de frete: " . $tipoFrete[TipoFrete::_DESCRICAO]);
        $tipoFrete[TipoFrete::_ID] = $BaseId;

        
        $idTipoFrete = $ObjDao->Inserir(TipoFrete::_TABLENAME, $tipoFrete);
    } else {
        $idTipoFrete = $ObjDao->Atualizar(TipoFrete::_TABLENAME, $tipoFrete, WHERE . TipoFrete::_ID . IGUAL . $ValoresPost[TipoFrete::_ID]);
    }
    return $idTipoFrete;
}

function buscaTipoFretePorId($idTipoFrete) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/TipoFrete.Class.php';

    $objTipoFrete = new TipoFrete();
    $objDao = new DAO();

    $tipoFrete = $objDao->ConsultarInnerEntidadePadrao(TipoFrete::_TABLENAME, "*", WHERE . TipoFrete::_ID . IGUAL . $idTipoFrete, TipoFrete::_ID);

    $objTipoFrete->alimentaobj($tipoFrete[0]);

    return $objTipoFrete;
}

## Busca frete por código erp e retorna um objeto ##

function buscaTipoFretePorCodErp($codTipoFrete) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/TipoFrete.Class.php';

    $objTipoFrete = new TipoFrete();
    $objDao = new DAO();

    $tipoFrete = $objDao->ConsultarInnerEntidadePadrao(TipoFrete::_TABLENAME, "*", WHERE . TipoFrete::_COD . IGUAL . $codTipoFrete, TipoFrete::_ID);

    $objTipoFrete->alimentaobj($tipoFrete[0]);

    return $objTipoFrete;
}

function deletarTipoFrete($Valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/TipoFrete.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();
    $ObjTipoFrete = new TipoFrete();

    $id = $ObjDao->Deletar(TipoFrete::_TABLENAME, WHERE . TipoFrete::_ID . IGUAL . $Valores['id']);

    return $id;
}

