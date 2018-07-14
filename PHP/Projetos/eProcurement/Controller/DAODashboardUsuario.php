<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function CadastrarDashboardUsuario($dados){
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DashboardUsuario.Class.php';
    include_once '../Controller/Base.php';
    
    $ObjDAO = new DAO();
    $ObjDashboardUsuario = new DashboardUsuario();
       
    $ArrayDashboardUsuario = array();
    $ArrayDashboardUsuario = AlimentarArrayDashboardUsuario($dados);
   
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_ID] = CadastraEntidade("Cadastro de Dashboard x Usuario: {$ArrayDashboardUsuario[DASHBOARD_USUARIO_USU_ID]}");
    
    $ObjDAO->Inserir(DASHBOARD_USUARIO_TABLENAME, $ArrayDashboardUsuario);
}
function AtualizarDashboardUsuario($dados){
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DashboardUsuario.Class.php';
    
    if($dados[DASHBOARD_USUARIO_ID] == "" || is_null($dados[DASHBOARD_USUARIO_ID])){
        return FALSE;
    }
    
    $ObjDAO = new DAO();
    $ObjDashboardUsuario = new DashboardUsuario();
    $ArrayDashboardUsuario = array();
    $ArrayDashboardUsuario = AlimentarArrayDashboardUsuario($dados);
    
    $where = WHERE . DASHBOARD_USUARIO_ID . IGUAL . $dados[DASHBOARD_USUARIO_ID];
        
    $ObjDAO->Atualizar(DASHBOARD_USUARIO_TABLENAME, $ArrayDashboardUsuario, $where);
   
}
function deletarDashboardUsuario($id){
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DashboardUsuario.Class.php';
    
    if($id == "" || is_null($id)){
        return FALSE;
    }
    
    $ObjDAO = new DAO();
    $ObjDashboardUsuario = new DashboardUsuario();
    
    $where = WHERE.DASHBOARD_USUARIO_ID . IGUAL . $id;
    
    $ObjDAO->Deletar(DASHBOARD_USUARIO_TABLENAME, $where);
}
function buscarDashboardUsuarioPorId($id){
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DashboardUsuario.Class.php';
    
    if($id == "" || is_null($id)){
        return null;
    }    
    
    $ObjDAO = new DAO();
    $ObjDashboardUsuario = new DashboardUsuario();
    
    $filtro = DASHBOARD_USUARIO_ID . IGUAL . $id;
    
    $retorno = $ObjDAO->ConsultarComFiltro(DASHBOARD_USUARIO_TABLENAME, "*", $filtro,  0, 1000000, null, " ORDER BY ".DASHBOARD_USUARIO_ID);
    $dados = $retorno->fetchAll(PDO::FETCH_ASSOC);
 
    $ObjDashboardUsuario = AlimentarObjDashboardUsuario($dados[0]);
    
    return $ObjDashboardUsuario;
}

function AlimentarObjDashboardUsuario($dados){
    include_once '../Model/DashboardUsuario.Class.php';
  
    $ObjDashboardUsuario = new DashboardUsuario();
    $ObjDashboardUsuario->setId($dados[DASHBOARD_USUARIO_ID]);
    $ObjDashboardUsuario->setUsuarioId($dados[DASHBOARD_USUARIO_USU_ID]);
    $ObjDashboardUsuario->setDashboard_1(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_1]));
    $ObjDashboardUsuario->setDashboard_2(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_2]));
    $ObjDashboardUsuario->setDashboard_3(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_3]));
    $ObjDashboardUsuario->setDashboard_4(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_4]));
    $ObjDashboardUsuario->setDashboard_5(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_5]));
    $ObjDashboardUsuario->setDashboard_6(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_6]));
    $ObjDashboardUsuario->setDashboard_7(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_7]));
    $ObjDashboardUsuario->setDashboard_8(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_8]));
    $ObjDashboardUsuario->setDashboard_9(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_9]));
    $ObjDashboardUsuario->setDashboard_10(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_10]));
    $ObjDashboardUsuario->setDashboard_11(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_11]));
    $ObjDashboardUsuario->setDashboard_12(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_12]));
    $ObjDashboardUsuario->setDashboard_13(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_13]));
    $ObjDashboardUsuario->setDashboard_14(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_14]));
    $ObjDashboardUsuario->setDashboard_15(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_15]));
    $ObjDashboardUsuario->setDashboard_16(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_16]));
    $ObjDashboardUsuario->setDashboard_17(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_17]));
    $ObjDashboardUsuario->setDashboard_18(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_18]));
    $ObjDashboardUsuario->setDashboard_19(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_19]));
    $ObjDashboardUsuario->setDashboard_20(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_20]));
    $ObjDashboardUsuario->setDashboard_21(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_21]));
    $ObjDashboardUsuario->setDashboard_22(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_22]));
    $ObjDashboardUsuario->setDashboard_23(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_23]));
    $ObjDashboardUsuario->setDashboard_24(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_24]));
    $ObjDashboardUsuario->setDashboard_25(ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_25]));

    return $ObjDashboardUsuario;
}

function AlimentarArrayDashboardUsuario($dados){
    include_once '../Model/DashboardUsuario.Class.php';
    $ObjDashboardUsuario = new DashboardUsuario();

    $ArrayDashboardUsuario = array();
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_ID] = $dados[DASHBOARD_USUARIO_ID];
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_USU_ID] = $dados[DASHBOARD_USUARIO_USU_ID];
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_1] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_1]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_2] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_2]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_3] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_3]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_4] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_4]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_5] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_5]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_6] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_6]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_7] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_7]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_8] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_8]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_9] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_9]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_10] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_10]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_11] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_11]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_12] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_12]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_13] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_13]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_14] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_14]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_15] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_15]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_16] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_16]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_17] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_17]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_18] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_18]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_19] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_19]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_20] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_20]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_21] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_21]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_22] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_22]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_23] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_23]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_24] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_24]);
    $ArrayDashboardUsuario[DASHBOARD_USUARIO_DASH_25] = ConvertCheckToNumber($dados[DASHBOARD_USUARIO_DASH_25]);
    
    return $ArrayDashboardUsuario; 
}

function BuscaPermissoesDashPorUsuario($UsuarioId){
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DashboardUsuario.Class.php';
    
    if($UsuarioId == "" || is_null($UsuarioId)){
        return FALSE;
    }
    
    $ObjDAO = new DAO();
    $ObjDashboardUsuario = new DashboardUsuario();
    
    $filtro = DASHBOARD_USUARIO_USU_ID . IGUAL . $UsuarioId;
    
    $retorno = $ObjDAO->ConsultarComFiltro(DASHBOARD_USUARIO_TABLENAME, "*", $filtro,  0, 1000000, null, " ORDER BY ".DASHBOARD_USUARIO_ID);
    $dados = $retorno->fetchAll(PDO::FETCH_ASSOC);
 
    $ObjDashboardUsuario = AlimentarObjDashboardUsuario($dados[0]);
    
    return $ObjDashboardUsuario;
}

function ConvertCheckToNumber($var){
    if($var == 'on' || $var == 1){
        return '1';
    }else{
        return '0';
    }
}