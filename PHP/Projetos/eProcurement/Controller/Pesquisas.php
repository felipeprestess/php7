<?php

include_once '../Model/Session.php';

function PesquisaCotacao($db, $FiltroPesquisa, $FiltroID) {
    ini_set('display_errors', 1);
    ini_set('display_startup_erros', 1);
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    include_once '../Model/Cotacao.Class.php';
    include_once '../Controller/DAOCotacao.php';

    $objCotacao = new Cotacao();

    $objCotacao = BuscaCotacao($_REQUEST[Cotacao::_NUMERO], $_REQUEST[Cotacao::_FORNECEDOR], $_REQUEST[Cotacao::_ITEM]);

    $dados = array();

    $unidade = buscaDescricaoUnidadeMedidaByCod($_REQUEST[Cotacao::_UNIDADE_MEDIDA]);

    $cotacao = buscaCotacaoErp($_REQUEST[Cotacao::_COD_EMPRESA], $_REQUEST[Cotacao::_NUMERO], $_REQUEST[Cotacao::_FORNECEDOR]);

    $entregaPrevista = BuscaProgramacaoEntrega($_REQUEST[Cotacao::_NUMERO], $_REQUEST[Cotacao::_COD_EMPRESA], $cotacao->NUM_VERSAO, $unidade, true);

    $dados[Cotacao::_ID] = $objCotacao->getId();
    $dados[Cotacao::_COD_EMPRESA] = $objCotacao->getCod_empresa();
    $dados[Cotacao::_NUMERO] = $objCotacao->getNumero();
    $dados[Cotacao::_ITEM] = $objCotacao->getItem();
    $dados[Cotacao::_FABRICANTE] = $objCotacao->getFabricante();
    $dados[Cotacao::_FORNECEDOR] = $objCotacao->getFornecedor();
    $dados[Cotacao::_ENTREGA_PREVISTA] = $entregaPrevista;
    $dados[Cotacao::_DATA_LIMITE_COTACAO] = $objCotacao->getData_limite_cotacao();
    $dados[Cotacao::_PRECO_UNITARIO] = $objCotacao->getPreco_unit();
    $dados[Cotacao::_UNIDADE_MEDIDA] = $objCotacao->getUnidade_medida();
    $dados[Cotacao::_IPI] = ($objCotacao->getIpi() != "" ? $objCotacao->getIpi() : "0" );
    $dados[Cotacao::_ORCAMENTO_VALIDO] = $objCotacao->getOrcamento_valido();
    $dados[Cotacao::_PRAZO_ENTREGA] = $objCotacao->getPrazo_entrega();
    $dados[Cotacao::_CONDICOES_PAGAMENTO] = $objCotacao->getCondicoes_pagamento();
    $dados[Cotacao::_MOEDA] = $objCotacao->getMoeda();
    $dados[Cotacao::_MODO_ENVIO] = $objCotacao->getModo_envio();
    $dados[Cotacao::_CHAT] = $objCotacao->getChat();
    $dados[Cotacao::_OC] = $objCotacao->getOc();

    if ($_REQUEST[Cotacao::_DATA_LIMITE_COTACAO] >= date('Y-m-d')) {
        $dados['cotacaoexpirada'] = '0';
    } else {
        $dados['cotacaoexpirada'] = '1';
    }
    return json_encode($dados);
}

function PesquisaFabricanteItem($db, $FiltroPesquisa, $FiltroID) {
    include_once '../Model/Cotacao.Class.php';
    include_once '../Controller/DAOCotacao.php';


    $lista = getFabricantesByItem($_REQUEST[Cotacao::_ITEM], $_REQUEST[Cotacao::_COD_EMPRESA]);

    $html = "";
    $dados = array();
    $cont = 0;
    while ($fabricante = $lista->fetch(PDO::FETCH_OBJ)) {
        $dados[$cont]['cod'] = $fabricante->COD_REF_ITEM;
        $dados[$cont]['descricao'] = $fabricante->NOM_FABRICANTE;
        $cont++;
    }


    return json_encode($dados);
}

include_once '../Model/DAO.Class.php';

$objDao = new DAO();

$db = $objDao->Conectar();

$objBase = new Base();

$Pesquisa = $_GET['Pesquisa'];
$FiltroPesquisa = $_GET['Filtro'];
if (isset($_GET['ID'])) {
    $FiltroID = $_GET['ID'];
} else {
    $FiltroID = 0;
}

$Retorno = $Pesquisa($db, $FiltroPesquisa, $FiltroID);
echo $Retorno;
