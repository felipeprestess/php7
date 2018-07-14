<?php

function GeraMenus($IdUsuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Menu.Class.php';

    $ObjDao = new DAO();
    $ObjMenu = new Menu();
    $Menus = $ObjDao->Consultar(MENU_TABLENAME, MENU_ID . "," . MENU_PROGRAMA . "," . MENU_PRINCIPAL . "," . MENU_DESCRICAO_CURTA . "," . MENU_OWNER . "," . MENU_ORDEM . SEPARADOR . MENU_DESTINO, "WHERE " . MENU_OWNER . " IS NULL AND " . MENU_PRINCIPAL . " = 1" . ORDER . MENU_ORDEM);

    return $Menus;
}

function LinkPrincipalMenu($idMenu) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Menu.Class.php';

    $ObjDao = new DAO();
    $ObjMenu = new Menu();
    $Menus = $ObjDao->Consultar("ptv_telas_programa_tlp", "tlp_nome_arquivo", " WHERE tlp_pro_id = {$idMenu} AND tlp_vai_menu = 1");

    return $Menus;
}

function BuscaProgramasPorPerfilAcessar($idPerfil, $IdPrograma) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';

    $ObjDao = new DAO();
    $objPerfilprograma = new PerfilPrograma();
    $Consulta = $ObjDao->Consultar(PERFILPROGRAMA_TABLENAME, PERFILPROGRAMA_PROGRAMA_ID, WHERE . PERFILPROGRAMA_PERFIL_ID . IGUAL . $idPerfil . E . PERFILPROGRAMA_PROGRAMA_ID . IGUAL . $IdPrograma . E . PERFILPROGRAMA_ACESSAR . IGUAL . "1");

    return $Consulta;
}

function BuscaPermissoesProgramasPorUsuario($idUsuario, $IdPrograma) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/UsuarioPrograma.Class.php';

    $ObjDao = new DAO();
    $objUsuarioPrograma = new UsuarioPrograma();
    $Consulta = $ObjDao->Consultar(USUARIOPROGRAMA_TABLENAME, USUARIOPROGRAMA_PROGRAMA_ID .SEPARADOR.USUARIOPROGRAMA_ACESSAR . SEPARADOR . USUARIOPROGRAMA_INCLUIR . SEPARADOR . USUARIOPROGRAMA_ALTERAR . SEPARADOR . USUARIOPROGRAMA_LIXEIRA, WHERE . USUARIOPROGRAMA_USUARIO_ID . IGUAL . $idUsuario . E . USUARIOPROGRAMA_PROGRAMA_ID . IGUAL . $IdPrograma.E."(".USUARIOPROGRAMA_ACESSAR.IGUAL."1 OR ".USUARIOPROGRAMA_INCLUIR.IGUAL."1 OR ".USUARIOPROGRAMA_LIXEIRA.IGUAL."1 OR ".USUARIOPROGRAMA_ALTERAR.IGUAL."1)");
    
    return $Consulta;
}

function BuscaSubMenusProgramasAcessar($Owner) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Menu.Class.php';

    $ObjDao = new DAO();
    $ObjMenu = new Menu();
    $Menus = $ObjDao->Consultar(MENU_TABLENAME,"*", WHERE . MENU_OWNER . IGUAL . $Owner . E . MENU_PRINCIPAL . IGUAL . " 0 " . ORDER . MENU_ORDEM);

    return $Menus;
}
