<?php

function CadastraNaoCotar($ValoresPost) {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/NaoCotar.Class.php';
    include_once '../Controller/Base.php';



    $ObjNaoCotar = new NaoCotar();
    $ObjDao = new DAO();

    $naoCotar = array();

    $naoCotar[NaoCotar::_ID] = $ValoresPost[NaoCotar::_ID];
    $naoCotar[NaoCotar::_COD_EMPRESA] = $ValoresPost[NaoCotar::_COD_EMPRESA];
    $naoCotar[NaoCotar::_ID_FORNECEDOR] = $ValoresPost[NaoCotar::_ID_FORNECEDOR];
    $naoCotar[NaoCotar::_TIPO] = $ValoresPost[NaoCotar::_TIPO];
    $naoCotar[NaoCotar::_CODIGO] = $ValoresPost[NaoCotar::_CODIGO];
    $naoCotar[NaoCotar::_ITEM] = $ValoresPost[NaoCotar::_ITEM];



    $BaseId = CadastraEntidade("Cadastro de nao cotar codigo: " . $naoCotar[NaoCotar::_CODIGO]);
    $naoCotar[NaoCotar::_ID] = $BaseId;

    $id = $ObjDao->Inserir(NaoCotar::_TABLENAME, $naoCotar);

    return $id;
}
