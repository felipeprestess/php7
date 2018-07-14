<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include_once '../Model/Login.class.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/Seguranca.Class.php';
$ObjDesloga = new Login();
$ObjDesloga->Deslogar();
