<?php

include_once '../Model/DAO.Class.php';
include_once '../Model/CondicaoPagamento.Class.php';
include_once '../Controller/DAOCondicaoPagamento.php';
include_once '../Controller/Base.php';

$objCondicaoPagamento = new CondicaoPagamento();
$objDAO = new DAO();

$lista = $objDAO->ConsultarCustom("select cnd_pgto,des_cnd_pgto from cond_pgto_cap");

while ($row = $lista->fetch(PDO::FETCH_BOTH)) {
    $condicaoPagamento = array();
    echo " INICIO COND " . $row[0];

    $condicaoPagamento[CondicaoPagamento::_COD_ERP] = $row[0];
    $condicaoPagamento[CondicaoPagamento::_DESCRICAO] = $row[1];
    $condicaoPagamento[CondicaoPagamento::_CARTEIRAS] = "";
    $condicaoPagamento[CondicaoPagamento::_PARCELADO] = 0;
    $condicaoPagamento[CondicaoPagamento::_BNDS] = 0;
    $condicaoPagamento[CondicaoPagamento::_ANTECIPADO] = 0;
    $condicaoPagamento[CondicaoPagamento::_VALOR_MINIMO] = 0;

    $BaseId = CadastraEntidade("Cadastro da condicao pagamento: " . $row[1]);
    $condicaoPagamento[CondicaoPagamento::_ID] = $BaseId;

    $idCondicaoPagamento = $objDAO->Inserir(CondicaoPagamento::_TABLENAME, $condicaoPagamento);
    echo " FIM COND " . $row[0] . "<br/>";
}