<?php

function buscaPerfilPorId($idPerfil) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Perfil.Class.php';

    $objPerfil = new Perfil();
    $objDao = new DAO();

    $perfil = $objDao->ConsultarInnerEntidadePadrao(PERFIL_TABLENAME, "*", WHERE . PERFIL_ID . IGUAL . $idPerfil, PERFIL_ID);

    $objPerfil->setID($perfil[0][PERFIL_ID]);
    $objPerfil->setNome($perfil[0][PERFIL_NOME]);
    $objPerfil->setAdministrador($perfil[0][PERFIL_ADMINISTRADOR]);

    return $objPerfil;
}

function deletarPerfil($Valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Perfil.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();
    $ObjPerfil = new Perfil();

    $id = $ObjDao->Deletar(PERFIL_TABLENAME, WHERE . PERFIL_ID . IGUAL . $Valores['id']);

    return $id;
}

function CadastraPerfil($ValoresPost) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Perfil.Class.php';
    include_once '../Controller/Base.php';

    $ObjPerfil = new Perfil();
    $ObjDao = new DAO();

    $perfil = array();

    $perfil[PERFIL_ID] = $ValoresPost[PERFIL_ID];
    $perfil[PERFIL_NOME] = strtoupper($ValoresPost[PERFIL_NOME]);

    if (isset($ValoresPost[PERFIL_ADMINISTRADOR])) {
        $perfil[PERFIL_ADMINISTRADOR] = 1;
    } else {
        $perfil[PERFIL_ADMINISTRADOR] = 0;
    }

    if ($ValoresPost['Acao'] == "Inserir") {
        $BaseId = CadastraEntidade("Cadastro do perfil: " . $perfil[PERFIL_NOME]);
        $perfil[PERFIL_ID] = $BaseId;



        $idPerfil = $ObjDao->Inserir(PERFIL_TABLENAME, $perfil);
    } else {
        $idPerfil = $ObjDao->Atualizar(PERFIL_TABLENAME, $perfil, WHERE . PERFIL_ID . IGUAL . $ValoresPost[PERFIL_ID]);
    }
    return $idPerfil;
}

function ListaPerfil() {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Perfil.Class.php';

    $objPerfil = new Perfil();
    $objDao = new DAO();

    $ListaPerfil = $objDao->Consultar(PERFIL_TABLENAME, "*");

    return $ListaPerfil;
}
