<?php


setlocale(LC_ALL, 'pt_BR');
header('Content-type: text/html; charset=UTF-8');
ini_set('default_charset', 'UTF-8');
date_default_timezone_set('America/Sao_Paulo');
set_time_limit(0);
ini_set('max_execution_time', '600000');
ini_set('upload_max_filesize', '1024M');



spl_autoload_register(function ($class_name) {
    include_once "../Model/" . $class_name . '.Class.php';
    include_once "../Controller/DAO" . $class_name . '.php';
});


session_start();
session_cache_expire(30);

/* include_once '../Model/Erros.Class.php';
  include_once '../Constroler/DAOPadroes.Class.php';
  include_once '../Model/Email.class.php';
  include_once '../Model/Padroes.Class.php';

  $ObjErro = new Erros();
  $ObjDao = new DAOPadroes();
  $ObjPadroes = new Padroes();
  $ObjPadroes = $ObjDao->BuscaPadroes();

  /* setando o novo manipulador de erros do sistema */
/* set_error_handler("$ObjErro->manipuladorErros($Padroes)");
 */

/*include_once '../Model/Seguranca.Class.php';
include_once '../Model/DAO.Class.php';
include_once '../Model/Usuario.Class.php';
include_once '../Model/PerfilPrograma.Class.php';

include_once '../Model/PadraoModulo.Class.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/Menu.Class.php';
include_once '../Model/Programa.Class.php';
include_once '../Model/Perfil.Class.php';
include_once '../Model/PerfilUsuario.Class.php';
include_once '../Controller/DAOPerfil.php';
include_once '../Controller/DAOPerfilUsuario.php';
include_once '../Controller/DAOPerfilPrograma.php';
include_once '../Controller/DAOPadroesModulo.php';

include_once '../Controller/DAOUsuario.php';
include_once '../Controller/DAOPadroesModulo.php';
*/
$objDao = new DAO();
$objMenu = new Menu();
$objUsuarioLogado = new Usuario();
$objPerfil = new Perfil();
$objPerfilUsuario = new PerfilUsuario();
$objSegurancaProtegePagina = new Seguranca();
$objSegurancaProtegePagina->ProtegePagina();
$objPerfilPrograma = new PerfilPrograma();
$objPadraoModulo = new PadraoModulo();
$objFuncionalidades = new Funcionalidades();
$objPrograma = new Programa();


$objFuncionalidades->RemoverAcentosGlobal();
//$objFuncionalidades->toUpperGlobal();

$objUsuarioLogado = BuscaUsuarioPorID($_SESSION['id']);
$objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($objUsuarioLogado->getID());
$objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

$pagina = basename($_SERVER['PHP_SELF']);
$pagina = explode(".php", $pagina);
$pagina = $pagina[0];
$objSegurancaProtegePagina->ChecaPermissao($pagina);

$PermissoesTela = array();
$PermissoesGeral = array();
$pagina = basename($_SERVER['PHP_SELF']);

//$menu = $objDao->Consultar(MENU_TABLENAME, MENU_PROGRAMA, WHERE . MENU_DESTINO . " LIKE '%" . $pagina . "%'");

$sql = "SELECT PRO." . PROGRAMA_COD_PTC . " FROM " . PROGRAMA_TABLENAME . " PRO 
        INNER JOIN " . MENU_TABLENAME . " MEN ON(PRO." . PROGRAMA_ID . " = MEN." . MENU_PROGRAMA . ") WHERE MEN." . MENU_DESTINO . " LIKE '%{$pagina}%'";
$menu = $objDao->ConsultarCustom($sql);
$menu = $menu->fetch(PDO::FETCH_BOTH);
unset($sql);

$Permissoes = $_SESSION['permissao'];

if (!is_null($menu[PROGRAMA_COD_PTC])) {
    $_SESSION['idProgramaAtual'] = $menu[PROGRAMA_COD_PTC];
}else{
    $_SESSION['idProgramaAtual'] = "PTV0008";
}
    


if ($objUsuarioLogado->getInterno() == 1) {
    $_SESSION['target'] = " target='_BLANK' ";
} else {
    $_SESSION['target'] = " ";
}
$dominio = $_SERVER['HTTP_HOST'];
$dominio = "http://" . $dominio . $_SERVER['REQUEST_URI'];
$dominio = explode("View", $dominio);
$dominio = $dominio[0];
$_SESSION['link'] = $dominio;
//var_dump($menu[0]['men_pro_id']);

$portalOnline = $objFuncionalidades->portalOnline();

/*if ($portalOnline == 0 && trim(strtoupper($objPerfil->getNome())) != "ADMINISTRADOR") {
    $objFuncionalidades->ExibeMensagem("Portal fora do ar para manutencao, por favor tente novamente mais tarde");
    session_destroy();
    $objFuncionalidades->Redirecionar("../View/Login.php");
}*/