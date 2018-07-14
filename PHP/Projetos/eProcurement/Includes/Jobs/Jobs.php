<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
/*include_once '../../Model/DaoErp.Class.php';
include_once '../../Model/Rotina.Class.php';
include_once '../../Model/DAO.Class.php';
include_once '../../Controller/DAORotina.php';
include_once '../../Controller/Base.php';

$objDaoErp = new DaoErp();
$objRotina = new Rotina();
$objBase = new Base();
$objDao = new DAO();

$rotinas = ListaRotina();

foreach ($rotinas as $keyMestre => $valueMestre) {
    $jaExecutada = $objDaoErp->ConsultaGenerica("select RTE_ID from PTV.PTV_ROTINA_EXEC_RTE where RTE_DATA_HORA = SYSDATE");
    $jaExecutada = $jaExecutada->fetch(PDO::FETCH_BOTH);
    $jaExecutada = $jaExecutada[0];
    if ($valueMestre[ROTINA_ATIVA] == 1 && !is_null($jaExecutada) && $jaExecutada != "") {
        include_once "./$valueMestre[ROTINA_ARQUIVO]";
        $rotinaIncluir = array();

        $BaseId = CadastraEntidade("Cadastro de execucao de rotida");

        $rotinaIncluir['RTE_ID'] = $BaseId;
        $rotinaIncluir['RTE_ROT_ID'] = $valueMestre[ROTINA_ID];
        $objDao->Inserir("PTV.PTV_ROTINA_EXEC_RTE", $rotinaIncluir);
    }
}*/



$client= new GearmanClient();