<?php

function buscaPerfilUsuarioPorId($id) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';

    $objPerfilUsuario = new PerfilUsuario();
    $objDao = new DAO();

    $tipoFrete = $objDao->ConsultarInnerEntidadePadrao(PERFILUSUARIO_TABLENAME, "*", WHERE . PERFILUSUARIO_ID . IGUAL . $id, PERFILUSUARIO_ID);


    $objPerfilUsuario->setID($tipoFrete[0][PERFILUSUARIO_ID]);
    $objPerfilUsuario->setIDPerfil($tipoFrete[0][PERFILUSUARIO_PERFIL_ID]);
    $objPerfilUsuario->setIDUsuario($tipoFrete[0][PERFILUSUARIO_USUARIO_ID]);

    return $objPerfilUsuario;
}
function buscaPerfilUsuarioPorIdUsuario($id) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';

    $objPerfilUsuario = new PerfilUsuario();
    $objDao = new DAO();

    $tipoFrete = $objDao->Consultar(PERFILUSUARIO_TABLENAME, "*", WHERE . PERFILUSUARIO_USUARIO_ID. IGUAL . $id);


    $objPerfilUsuario->setID($tipoFrete[0][PERFILUSUARIO_ID]);
    $objPerfilUsuario->setIDPerfil($tipoFrete[0][PERFILUSUARIO_PERFIL_ID]);
    $objPerfilUsuario->setIDUsuario($tipoFrete[0][PERFILUSUARIO_USUARIO_ID]);

    return $objPerfilUsuario;
}

function CadastraPerfilUsuario($ValoresPost) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';
    include_once '../Controller/Base.php';

    $objPerfilUsuario = new PerfilUsuario();
    $ObjDao = new DAO();


    $perfilUsuario = array();

    $perfilUsuario[PERFILUSUARIO_ID] = $ValoresPost[PERFILUSUARIO_ID];
    $perfilUsuario[PERFILUSUARIO_PERFIL_ID] = $ValoresPost[PERFILUSUARIO_PERFIL_ID];
    $perfilUsuario[PERFILUSUARIO_USUARIO_ID] = $ValoresPost[PERFILUSUARIO_USUARIO_ID];

	        $ObjDao->Deletar(PERFILUSUARIO_TABLENAME,WHERE . PERFILUSUARIO_USUARIO_ID . IGUAL . $ValoresPost[PERFILUSUARIO_USUARIO_ID]);
	
        $BaseId = CadastraEntidade("Cadastro do vinculo do perfil : " . $perfilUsuario[PERFILUSUARIO_PERFIL_ID] . " com o usuario" . $perfilUsuario[PERFILUSUARIO_USUARIO_ID]);
        $perfilUsuario[PERFILUSUARIO_ID] = $BaseId;
		
		

        $idPerfilUsuario = $ObjDao->Inserir(PERFILUSUARIO_TABLENAME, $perfilUsuario);
    
    return $idPerfilUsuario;
}
function deletarPerfilUsuario($Valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();
    $ObjPerfilUsuario= new PerfilUsuario();

    $id = $ObjDao->Deletar(PERFILUSUARIO_TABLENAME, WHERE . PERFILUSUARIO_ID . IGUAL . $Valores['id']);

    return $id;
}
