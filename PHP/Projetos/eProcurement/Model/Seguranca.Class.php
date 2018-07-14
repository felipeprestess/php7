<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Seguranca
 *
 * @author Rodrigo
 */
class Seguranca {

    public function CriaSessao($ID) {
        include_once '../Model/Funcionalidades.Class.php';
        $ObjFuncionalidades = new Funcionalidades();
        session_start();
        $_SESSION['id'] = $ID;
        $_SESSION['datahora'] = date("Y-mm-dd h:m:s");
        $_SESSION['permissao'] = $ObjFuncionalidades->PermissoesDoUsuarioAoLogar($ID);
    }

    public function DestroiSessao() {
        unset($_SESSION['id']);
        unset($_SESSION['datahora']);
        unset($_SESSION['permissao']);
        unset($_SESSION);
        session_destroy();
    }

    public function ProtegePagina() {
        if (!isset($_SESSION['id'])) {
            echo"<script type='text/javascript'>alert('Sua sessão expirou, faça login novamente para continuar!');</script>";
            echo"<script type='text/javascript'>location.href = '../View/Login.php';</script>";
        }
    }

    public function ChecaPermissao($Programa) {
        $ArrayPermissoes = array();
        $ArrayPermissoes = $_SESSION['permissao'];
        $Retorno = FALSE;
        //if ()
        for ($i = 0; $i < count($ArrayPermissoes); $i++) {
            if ($ArrayPermissoes[$i] == $NomePagina) {
                $Retorno = TRUE;
            }
        }
        if ($Retorno == FALSE) {
            echo "<script type='text/javascript'>alert('Você não tem permissão para acessar esta tela!');</script>";
            echo"<script type='text/javascript'>location.href = '../View/index.php';</script>";
        }
    }

}
