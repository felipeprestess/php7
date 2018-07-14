<?php

include_once '../Model/DAO.Class.php';
include_once '../Model/Usuario.Class.php';
include_once '../Controller/DAOUsuario.php';
include_once '../Controller/Base.php';
include_once '../Model/PerfilUsuario.Class.php';
include_once '../Controller/DAOPerfilUsuario.php';

$objUsuario = new Usuario();
$objDAO = new DAO();
$objPerfilUsuario = new PerfilUsuario();

$lista = $objDAO->ConsultarCustom("select usu_id from ptc_usuario_usu");

while ($row = $lista->fetch(PDO::FETCH_BOTH)) {
    echo " INICIO usu " . $row[0];
// kalu69
    $ObjUsuario = new Usuario();

    $usuario = array();
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($row[0]);

    if ($objPerfilUsuario->getID() == "") {
        $usuario[PERFILUSUARIO_PERFIL_ID] = 150465;
        $usuario[PERFILUSUARIO_USUARIO_ID] = $row[0];


        $BaseId = CadastraEntidade("Cadastro perfil usuario: ");
        $usuario[PERFILUSUARIO_ID] = $BaseId;

        $idUsuario = $objDAO->InserirTeste(PERFILUSUARIO_TABLENAME, $usuario);
    }
    echo " FIM COND " . $row[1] . "<br/>";
}