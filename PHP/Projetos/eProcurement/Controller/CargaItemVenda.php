<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include_once '../Model/DAO.Class.php';
include_once '../Controller/DAOOrdemHistorico.php';
include_once '../Controller/Base.php';

$objDAO = new DAO();

$lista = $objDAO->ConsultarCustom("select id, id_fornecedor, id_empresa, num_ordem, id_acao, data, observacao from inovaweb_ordem_historico where data > MDY('01','01','2018') order by id desc");

while ($row = $lista->fetch(PDO::FETCH_BOTH)) {
    $dados = array();
    echo " INICIO id " . $row[0];
    $dados['ODH_ID_FORNECEDOR'] = $row[1];
    $dados['ODH_ID_EMPRESA'] = $row[2];
    $dados['ODH_NUM_ORDEM'] = $row[3];
    $dados['ODH_ACAO'] = $row[4];
    $dados['ODH_DATA'] = $row[5];

    $BaseId = CadastraEntidade("Cadastro de ordem historico " . $row[3]);
    $dados["ODH_ID"] = $BaseId;

    $id = $objDAO->InserirTeste("PTC_ORDEM_HISTORICO_ODH", $dados);

    echo " FIM id " . $row[0] . "<br/>";
}