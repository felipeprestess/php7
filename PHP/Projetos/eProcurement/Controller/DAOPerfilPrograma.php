<?php
function deletarPerfilPrograma($Valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();
    $ObjPerfilPrograma= new PerfilPrograma();

    $id = $ObjDao->Deletar(PERFILPROGRAMA_TABLENAME, WHERE . PERFILPROGRAMA_ID . IGUAL . $Valores['id']);

    return $id;
}
function buscaPerfilProgramaPorId($id) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';

    $objPerfilPrograma = new PerfilPrograma();
    $objDao = new DAO();

    $perfil = $objDao->ConsultarInnerEntidadePadrao(PERFILPROGRAMA_TABLENAME, "*", WHERE . PERFILPROGRAMA_ID . IGUAL . $id, PERFILPROGRAMA_ID);


    $objPerfilPrograma->setID($perfil[0][PERFILPROGRAMA_ID]);
    $objPerfilPrograma->setIDPerfil($perfil[0][PERFILPROGRAMA_PERFIL_ID]);
    $objPerfilPrograma->setIDPrograma($perfil[0][PERFILPROGRAMA_PROGRAMA_ID]);
    $objPerfilPrograma->setIncluir($perfil[0][PERFILPROGRAMA_INCLUIR]);
    $objPerfilPrograma->setAlterar($perfil[0][PERFILPROGRAMA_ALTERAR]);
    $objPerfilPrograma->setAcessar($perfil[0][PERFILPROGRAMA_ACESSAR]);
    $objPerfilPrograma->setLixeira($perfil[0][PERFILPROGRAMA_LIXEIRA]);

    return $objPerfilPrograma;
}

function buscaPerfilProgramaPorIdPrograma($id, $idPerfil) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';

    $objPerfilPrograma = new PerfilPrograma();
    $objDao = new DAO();

    $perfil = $objDao->Consultar(PERFILPROGRAMA_TABLENAME, "*", WHERE . PERFILPROGRAMA_PROGRAMA_ID . IGUAL . $id . E . PERFILPROGRAMA_PERFIL_ID . IGUAL . $idPerfil);


    $objPerfilPrograma->setID($perfil[0][PERFILPROGRAMA_ID]);
    $objPerfilPrograma->setIDPerfil($perfil[0][PERFILPROGRAMA_PERFIL_ID]);
    $objPerfilPrograma->setIDPrograma($perfil[0][PERFILPROGRAMA_PROGRAMA_ID]);
    $objPerfilPrograma->setIncluir($perfil[0][PERFILPROGRAMA_INCLUIR]);
    $objPerfilPrograma->setAlterar($perfil[0][PERFILPROGRAMA_ALTERAR]);
    $objPerfilPrograma->setAcessar($perfil[0][PERFILPROGRAMA_ACESSAR]);
    $objPerfilPrograma->setLixeira($perfil[0][PERFILPROGRAMA_LIXEIRA]);

    return $objPerfilPrograma;
}

function buscaPerfilProgramaPorIdPerfil($id) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';

    $objPerfilPrograma = new PerfilPrograma();
    $objDao = new DAO();

    $perfil = $objDao->Consultar(PERFILPROGRAMA_TABLENAME, "*", WHERE . PERFILPROGRAMA_PERFIL_ID . IGUAL . $id);


    $objPerfilPrograma->setID($perfil[0][PERFILPROGRAMA_ID]);
    $objPerfilPrograma->setIDPerfil($perfil[0][PERFILPROGRAMA_PERFIL_ID]);
    $objPerfilPrograma->setIDPrograma($perfil[0][PERFILPROGRAMA_PROGRAMA_ID]);
    $objPerfilPrograma->setIncluir($perfil[0][PERFILPROGRAMA_INCLUIR]);
    $objPerfilPrograma->setAlterar($perfil[0][PERFILPROGRAMA_ALTERAR]);
    $objPerfilPrograma->setAcessar($perfil[0][PERFILPROGRAMA_ACESSAR]);
    $objPerfilPrograma->setLixeira($perfil[0][PERFILPROGRAMA_LIXEIRA]);

    return $objPerfilPrograma;
}

function CadastraPerfilPrograma($ValoresPost) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';
    include_once '../Controller/Base.php';
    include_once '../Controller/DAOPrograma.php';

    $ObjPerfilPrograma = new PerfilPrograma();
    $ObjDao = new DAO();


    $perfilPrograma = array();
    $perfilPrograma[PERFILPROGRAMA_PERFIL_ID] = $ValoresPost[PERFILPROGRAMA_PERFIL_ID];

    $ListaPrograma = ListaPrograma();
    $ObjDao->Deletar(PERFILPROGRAMA_TABLENAME, WHERE . PERFILPROGRAMA_PERFIL_ID . IGUAL . $ValoresPost[PERFILPROGRAMA_PERFIL_ID]);
    foreach ($ListaPrograma as $chave_do_indice => $valor_do_indice) {
        $perfilPrograma[PERFILPROGRAMA_PROGRAMA_ID] = $valor_do_indice[PROGRAMA_ID];

        if (isset($ValoresPost[$valor_do_indice[PROGRAMA_ID] . PERFILPROGRAMA_INCLUIR])) {
            $perfilPrograma[PERFILPROGRAMA_INCLUIR] = 1;
        } else {
            $perfilPrograma[PERFILPROGRAMA_INCLUIR] = 0;
        }
        if (isset($ValoresPost[$valor_do_indice[PROGRAMA_ID] . PERFILPROGRAMA_ALTERAR])) {
            $perfilPrograma[PERFILPROGRAMA_ALTERAR] = 1;
        } else {
            $perfilPrograma[PERFILPROGRAMA_ALTERAR] = 0;
        }
        if (isset($ValoresPost[$valor_do_indice[PROGRAMA_ID] . PERFILPROGRAMA_ACESSAR])) {
            $perfilPrograma[PERFILPROGRAMA_ACESSAR] = 1;
        } else {
            $perfilPrograma[PERFILPROGRAMA_ACESSAR] = 0;
        }
        if (isset($ValoresPost[$valor_do_indice[PROGRAMA_ID] . PERFILPROGRAMA_LIXEIRA])) {
            $perfilPrograma[PERFILPROGRAMA_LIXEIRA] = 1;
        } else {
            $perfilPrograma[PERFILPROGRAMA_LIXEIRA] = 0;
        }
        $BaseId = CadastraEntidade("Cadastro do perfil programa: " . $perfilPrograma[PERFILPROGRAMA_ID]);
        $perfilPrograma[PERFILPROGRAMA_ID] = $BaseId;
        $idPerfilPrograma = $ObjDao->Inserir(PERFILPROGRAMA_TABLENAME, $perfilPrograma);
    }

    return $ValoresPost[PERFILPROGRAMA_PERFIL_ID];
}
