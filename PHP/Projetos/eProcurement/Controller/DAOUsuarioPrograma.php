<?php

function deletarUsuarioPrograma($Valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/UsuarioPrograma.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();
    $ObjUsuarioPrograma = new UsuarioPrograma();

    $id = $ObjDao->Deletar(USUARIOPROGRAMA_TABLENAME, WHERE . USUARIOPROGRAMA_ID . IGUAL . $Valores['id']);

    return $id;
}

function CadastraUsuarioPrograma($ValoresPost) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/UsuarioPrograma.Class.php';
    include_once '../Controller/Base.php';
    include_once '../Controller/DAOPrograma.php';

    $ObjUsuarioPrograma = new UsuarioPrograma();
    $ObjDao = new DAO();


    $usuarioPrograma = array();
    $usuarioPrograma[USUARIOPROGRAMA_USUARIO_ID] = $ValoresPost[USUARIOPROGRAMA_USUARIO_ID];

    $ListaPrograma = ListaPrograma();
    $ObjDao->Deletar(USUARIOPROGRAMA_TABLENAME, WHERE . USUARIOPROGRAMA_USUARIO_ID . IGUAL . $ValoresPost[USUARIOPROGRAMA_USUARIO_ID]);
    foreach ($ListaPrograma as $chave_do_indice => $valor_do_indice) {
        $usuarioPrograma[USUARIOPROGRAMA_PROGRAMA_ID] = $valor_do_indice[PROGRAMA_ID];

        if (isset($ValoresPost[$valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_INCLUIR])) {
            $usuarioPrograma[USUARIOPROGRAMA_INCLUIR] = 1;
        } else {
            $usuarioPrograma[USUARIOPROGRAMA_INCLUIR] = 0;
        }
        if (isset($ValoresPost[$valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_ALTERAR])) {
            $usuarioPrograma[USUARIOPROGRAMA_ALTERAR] = 1;
        } else {
            $usuarioPrograma[USUARIOPROGRAMA_ALTERAR] = 0;
        }
        if (isset($ValoresPost[$valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_ACESSAR])) {
            $usuarioPrograma[USUARIOPROGRAMA_ACESSAR] = 1;
        } else {
            $usuarioPrograma[USUARIOPROGRAMA_ACESSAR] = 0;
        }
        if (isset($ValoresPost[$valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_LIXEIRA])) {
            $usuarioPrograma[USUARIOPROGRAMA_LIXEIRA] = 1;
        } else {
            $usuarioPrograma[USUARIOPROGRAMA_LIXEIRA] = 0;
        }
        $BaseId = CadastraEntidade("Cadastro do usuario programa: " . $usuarioPrograma[USUARIOPROGRAMA_ID]);
        $usuarioPrograma[USUARIOPROGRAMA_ID] = $BaseId;
        $idPerfilPrograma = $ObjDao->Inserir(USUARIOPROGRAMA_TABLENAME, $usuarioPrograma);
    }

    return $ValoresPost[USUARIOPROGRAMA_PERFIL_ID];
}

function buscaUsuarioProgramaPorIdPrograma($id, $idUsuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';

    $objUsuarioPrograma = new UsuarioPrograma();
    $objDao = new DAO();

    $perfil = $objDao->Consultar(USUARIOPROGRAMA_TABLENAME, "*", WHERE . USUARIOPROGRAMA_PROGRAMA_ID . IGUAL . $id . E . USUARIOPROGRAMA_USUARIO_ID . IGUAL . $idUsuario);


    $objUsuarioPrograma->setID($perfil[0][USUARIOPROGRAMA_ID]);
    $objUsuarioPrograma->setIDUsuario($perfil[0][USUARIOPROGRAMA_USUARIO_ID]);
    $objUsuarioPrograma->setIDPrograma($perfil[0][USUARIOPROGRAMA_PROGRAMA_ID]);
    $objUsuarioPrograma->setIncluir($perfil[0][USUARIOPROGRAMA_INCLUIR]);
    $objUsuarioPrograma->setAlterar($perfil[0][USUARIOPROGRAMA_ALTERAR]);
    $objUsuarioPrograma->setAcessar($perfil[0][USUARIOPROGRAMA_ACESSAR]);
    $objUsuarioPrograma->setLixeira($perfil[0][USUARIOPROGRAMA_LIXEIRA]);

    return $objUsuarioPrograma;
}

function existePermissoesUsuario($idUsuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';

    $objUsuarioPrograma = new UsuarioPrograma();
    $objDao = new DAO();

    $perfil = $objDao->Consultar(USUARIOPROGRAMA_TABLENAME, "*", WHERE . USUARIOPROGRAMA_USUARIO_ID . IGUAL . $idUsuario.E."(".USUARIOPROGRAMA_ACESSAR.IGUAL."1 OR ".USUARIOPROGRAMA_INCLUIR.IGUAL."1 OR ".USUARIOPROGRAMA_LIXEIRA.IGUAL."1 OR ".USUARIOPROGRAMA_ALTERAR.IGUAL."1)");

    return count($perfil);
}
