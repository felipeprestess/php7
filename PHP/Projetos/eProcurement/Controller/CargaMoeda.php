<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include_once '../Model/DAO.Class.php';
include_once '../Model/Moeda.Class.php';
include_once '../Controller/DAOMoeda.php';
include_once '../Controller/Base.php';

$objMoeda = new Moeda();
$objDAO = new DAO();

$lista = $objDAO->ConsultarCustom("select cod_moeda, den_moeda,den_moeda_abrev from moeda");

while ($row = $lista->fetch(PDO::FETCH_BOTH)) {
    $moeda = array();
 

    $moeda[Moeda::_COD_ERP] = $row[0];
    $moeda[Moeda::_DESCRICAO] = $row[1];
    $moeda[Moeda::_ABREVIACAO] = $row[2];

    $BaseId = CadastraEntidade("Cadastro de moeda: " . $row[1]);
    $moeda[Moeda::_ID] = $BaseId;

    $idCondicaoPagamento = $objDAO->InserirTeste(moeda::_TABLENAME, $moeda);
    echo " FIM COND " . $row[0] . "<br/>";
}