<?php

/* function listarMoedas($idPessoa = "") {
  function cadastrarMoeda($ValoresPost) {
  include_once './Session.php';
  include_once '../Model/DAO.Class.php';
  include_once '../Model/Moeda.Class.php';
  include_once '../Controller/Base.php';

  $ObjDao = new DAO();
  $ObjMoeda = new Moeda();

  $moeda = array();
  $moeda[Moeda::_ID] = $ValoresPost[Moeda::_ID];
  $moeda[Moeda::_COD_ERP] = $ValoresPost[Moeda::_COD_ERP];
  $moeda[Moeda::_DESCRICAO] = strtoupper($ValoresPost[Moeda::_DESCRICAO]);
  $moeda[Moeda::_ABREVIACAO] = strtoupper($ValoresPost[Moeda::_ABREVIACAO]);

  if ($ValoresPost['Acao'] == "Inserir") {
  $BaseId = CadastraEntidade("Cadastro da moeda: " . $moeda[Moeda::_DESCRICAO]);
  $moeda[Moeda::_ID] = $BaseId;

  $idMoeda = $ObjDao->Inserir(Moeda::_TABLENAME, $moeda);
  } else {
  $idMoeda = $ObjDao->Atualizar(Moeda::_TABLENAME, $moeda, WHERE . Moeda::_ID . IGUAL . $ValoresPost[Moeda::_ID]);
  }
  return $idMoeda;
  }
 */

function buscaMoedaPorId($idMoeda) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Moeda.Class.php';

    $ObjMoeda = new Moeda();
    $ObjDao = new DAO();

    $moeda = $ObjDao->ConsultarInnerEntidadePadrao(Moeda::_TABLENAME, "*", WHERE . Moeda::_ID . IGUAL . $idMoeda, Moeda::_ID);

    $ObjMoeda->alimentaObj($moeda[0]);

    return $ObjMoeda;
}

function buscaMoedaPorCodErp($codMoeda) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Moeda.Class.php';

    $objDao = new DAO();
    $objMoeda = new Moeda();

    $moeda = $objDao->ConsultarInnerEntidadePadrao(Moeda::_TABLENAME, "*", WHERE . Moeda::_COD_ERP . IGUAL . $codMoeda, Moeda::_ID);
    $objMoeda->alimentaObj($moeda[0]);

    return $objMoeda;
}

function deletarMoeda($Valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Moeda.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();
    $ObjMoeda = new Moeda();

    $id = $ObjDao->Deletar(Moeda::_TABLENAME, WHERE . Moeda::_ID . IGUAL . $Valores['id']);

    return $id;
}

function listarMoedas(){
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Moeda.Class.php';
    
    $objDao= new DAO();
    $Objmoeda = new Moeda();
    
    $moedas = $objDao->Consultar(Moeda::_TABLENAME,"*");
    $Objmoeda->alimentaObj($moedas[0]);
    return $moedas;
}

function cadastraMoeda($valoresPost){
    
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Moeda.Class.php';
    include_once '../Controller/Base.php';
    
    $objDaoMoeda = new DAO();
    $moeda = array();
    $objFuncionalidades = new Funcionalidades();
    
    $moeda[Moeda::_ID] = $valoresPost[Moeda::_ID];
    $moeda[Moeda::_COD_ERP] = $valoresPost[Moeda::_COD_ERP];
    $moeda[Moeda::_DESCRICAO] = $valoresPost[Moeda::_DESCRICAO];
    $moeda[Moeda::_ABREVIACAO] = $valoresPost[Moeda::_ABREVIACAO];
    
    if($valoresPost['Acao'] == 'Inserir'){
        $baseId = CadastraEntidade("Cadastro moeda: ".$moeda[Moeda::_DESCRICAO]);
        $moeda[Moeda::_ID] = $baseId;
        
        $idMoeda = $objDaoMoeda->Inserir(Moeda::_TABLENAME, $moeda);
    }else{
        $idMoeda = $objDaoMoeda->Atualizar(Moeda::_TABLENAME, $moeda, WHERE . Moeda::_ID . IGUAL . $valoresPost[Moeda::_ID]);
    }
    
}