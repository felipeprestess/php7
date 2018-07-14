<?php
/**
 * Descricao de  Login
 *
 * @author Rodrigo Isensee
 * 
 * Versao: 1
 * 
 * Utilizacao: Classe de login do sistema
 * 
 */
class Login {

    private $usuario;
    private $senha;

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    public function Deslogar() {
        include_once './Funcionalidades.Class.php';
        include_once "./Seguranca.Class.php";

        $objFuncionalidades = new Funcionalidades();
        $ObjSeguranca = new Seguranca();

        $ObjSeguranca->DestroiSessao();
        $objFuncionalidades->Redirecionar("../View/Login.php");
    }

}
