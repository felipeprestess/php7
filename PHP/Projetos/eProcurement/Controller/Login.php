<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

include_once '../Model/Notificacao.Class.php';
include_once '../Controller/DAONotificacao.php';

include_once ("../Model/DAO.Class.php");
include_once("../Model/Usuario.Class.php");
include_once ("../Model/Funcionalidades.Class.php");

include_once("../Controller/DAOUsuario.php");
include_once("../Model/PadraoModulo.Class.php");
include_once("../Model/PerfilUsuario.Class.php");
include_once("../Controller/DAOPadroesModulo.php");

$objPadraoModulo = new PadraoModulo();

function FazLogin($ValoresPost) {
    $ObjFuncionalidades = new Funcionalidades();
    $ObjUsuario = new Usuario();
    $ObjDao = new DAO();
    $LoginOk = 1;
    $ValoresPostEscapados = $ObjDao->Escapar($ValoresPost);

    $Login = $ObjDao->Consultar(USUARIO_TABLENAME, USUARIO_ID, "WHERE " . USUARIO_USUARIO . "='" . strtoupper($_REQUEST[USUARIO_USUARIO]) . "' AND (" . USUARIO_SENHA . "='" . md5(strtoupper($_REQUEST[USUARIO_SENHA])) . "' OR " . USUARIO_SENHA . "='" . md5(strtolower($_REQUEST[USUARIO_SENHA])) . "')");

    if ($Login != false) {
        include_once("../Model/Seguranca.Class.php");
        $ObjSeguranca = new Seguranca();
        $ObjSeguranca->CriaSessao($Login[0][USUARIO_ID]);
        $LoginOk = 1;
    } else {
        $LoginOk = 0;
    }
    $senhaPadrao = buscaValorPadraoPorNome("Senha Padrao");
    if (strtoupper($_REQUEST[USUARIO_SENHA]) === strtoupper($senhaPadrao)) {
        $Login = $ObjDao->Consultar(USUARIO_TABLENAME, USUARIO_ID, "WHERE " . USUARIO_USUARIO . "='" . strtoupper($_REQUEST[USUARIO_USUARIO]) . "'");

        if ($Login != false) {
            include_once("../Model/Seguranca.Class.php");
            $ObjSeguranca = new Seguranca();
            $ObjSeguranca->CriaSessao($Login[0][USUARIO_ID]);
            $LoginOk = 1;
        } else {
            $LoginOk = 0;
        }
    }

    return $LoginOk;
}

$ObjFuncionalidades = new Funcionalidades();
$ObjPerfilUsuario = new PerfilUsuario();

$ObjUsuario = new Usuario();
$ObjDao = new DAO();

if (isset($_REQUEST['PrimeiroAcesso'])) {
    $usuario = $ObjDao->Consultar(USUARIO_TABLENAME, USUARIO_USUARIO, WHERE . USUARIO_USUARIO . IGUAL . "'" . strtoupper($_POST[USUARIO_USUARIO]) . "'" . E . USUARIO_SENHA . IGUAL . "''");
    if ($usuario != "" && !is_null($usuario)) {
        $ObjFuncionalidades->ExibeMensagem("Bem vindo ao seu primeiro acesso, voce esta sendo redirecionado para a tela de definicao de senha.");
        $ObjFuncionalidades->Redirecionar("../View/CadastroSenha.php?Usuario=" . $_POST[USUARIO_USUARIO]);
    } else {
        $ObjFuncionalidades->ExibeMensagem("Para cadastrar uma nova senha e necessario que a sua senha seja zerada pelo administrador antes.");
        $ObjFuncionalidades->Redirecionar("../View/Login.php");
    }
}
if (FazLogin($_REQUEST) == 1) {

    $ObjFuncionalidades->Redirecionar("../View/Home.php");
} else {
    $ObjFuncionalidades->ExibeMensagem("Dados de login incorretos, favor tentar novamente.");
    $ObjFuncionalidades->Redirecionar("../View/Login.php");
}