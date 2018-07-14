<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function alimentaObjetoNotificacao($dados){
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Notificacao.php';
    
    $ObjDAO = new DAO();
    $ObjNotificacao = new Notificacao();
    
    $ObjNotificacao->setId($dados[0][NOTIFICACAO_ID]);
    $ObjNotificacao->setTitulo($dados[0][NOTIFICACAO_TITULO]);
    $ObjNotificacao->setDescricao($dados[0][NOTIFICACAO_DESCRICAO]);
    $ObjNotificacao->setVizualizado($dados[0][NOTIFICACAO_VIZUALIZADO]);
    $ObjNotificacao->setPrograma($dados[0][NOTIFICACAO_PROGRAMA]);
    $ObjNotificacao->setUsuarioId($dados[0][NOTIFICACAO_USUARIO_ID]);
    $ObjNotificacao->setValor($dados[0][NOTIFICACAO_VALOR]);
    $ObjNotificacao->setExpiracao($dados[0][NOTIFICACAO_EXPIRACAO]);
    
    return $ObjNotificacao;
}

function CriarNotificacao($Titulo, $Descricao, $Programa = 0, $UsuarioId = 0, $Valor = "success") {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Notificacao.Class.php';
    include_once '../Controller/Base.php';
    
    $ObjDAO = new DAO();
    $ObjNotificacao = new Notificacao();
    
    $expiracao = date('Y-m-d H:i:s', strtotime('+1 min'));
    
        $expiracao = " TO_DATE('{$expiracao}', '%Y-%m-%d %H:%M:%S') ";
    

    $data = array();
    $data[NOTIFICACAO_ID] = CadastraEntidade("Notificacao");
    $data[NOTIFICACAO_TITULO] = $Titulo;
    $data[NOTIFICACAO_DESCRICAO] = $Descricao;
    $data[NOTIFICACAO_PROGRAMA] = $Programa;
    $data[NOTIFICACAO_EXPIRACAO] = $expiracao;
    $data[NOTIFICACAO_VIZUALIZADO] = 0;
    $data[NOTIFICACAO_USUARIO_ID] = $UsuarioId;
    $data[NOTIFICACAO_VALOR] = $Valor;

    $ObjDAO->Inserir(NOTIFICACAO_TABLENAME, $data);

}
