<?php


include_once '../Model/DAO.Class.php';
include_once '../Controller/DAOUsuario.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/Usuario.Class.php';
$ObjUsuario = new Usuario();
$ObjFuncionalidades = new Funcionalidades();


$ObjDao = new DAO();
$ObjUsuario->setUsuario(strtoupper($_POST['Usuario']));
$ObjUsuario->setSenha(md5(strtoupper($_POST['password'])));

if (UpdateSenhaUsuario($ObjUsuario) > 0) {
    $ObjFuncionalidades->Redirecionar("../View/Login.php");
} else {
    $ObjFuncionalidades->ExibeMensagem("Erro ao cadastrar senha, tente novamente!");
    $ObjFuncionalidades->Redirecionar("../View/Login.php");
}



