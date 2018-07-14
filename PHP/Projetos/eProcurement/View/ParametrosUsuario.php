<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
spl_autoload_register(function ($class_name) {
    include_once "../Model/".$class_name . '.Class.php';
    include_once "../Controller/DAO".$class_name . '.php';
});

include_once '../Controller/Session.php';

include_once '../Model/Perfil.Class.php';
include_once '../Model/Usuario.Class.php';
include_once '../Model/PerfilUsuario.Class.php';
include_once '../Model/Funcionalidades.Class.php';

include_once '../Controller/DAOPerfil.php';
include_once '../Controller/DAOUsuario.php';
include_once '../Controller/DAOPerfilUsuario.php';

$objPerfil = new Perfil();
$objUsuario = new Usuario();
$objPerfilUsuario = new PerfilUsuario();
$ObjFuncionalidades = new Funcionalidades();

if (isset($_POST['Cadastrar'])) {
    if ($_POST['Acao'] == "Inserir") {
        $id = cadastraUsuario($_POST, $_FILES);
        $ObjFuncionalidades->ExibeMensagem("Usuário cadastrado com sucesso!");
        $ObjFuncionalidades->Redirecionar("Usuario.php");
    } elseif ($_POST['Acao'] == "Atualizar") {
        $id = cadastraParamUsuario($_POST, $_FILES);
        $ObjFuncionalidades->ExibeMensagem("Usuário atualizado com sucesso!");
        $ObjFuncionalidades->Redirecionar("Usuario.php?id={$_POST[USUARIO_ID]}&Acao=" . $_POST['Acao']);
    }
} else {
    $ObjDao = new DAO();
    $objUsuario = new Usuario();

    if (isset($_REQUEST['Acao'])) {
        $Acao = $_REQUEST['Acao'];
    } else {
        $Acao = "";
    }
}
if ($Acao == "Deletar") {
    $id = deletarUsuario($_REQUEST);
    $ObjFuncionalidades->Redirecionar("Usuario.php");
}

$objPerfilUsuarioLogado = new PerfilUsuario();
$objUsuario = BuscaUsuarioPorID($_REQUEST['id']);
$PerfilUsuarioLogado = buscaPerfilDoUsuarioPorId($objUsuarioLogado->getID());
$objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($_SESSION['id']);
$objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keyword" content="">
        <link rel="shortcut icon" href="../Public/img/favicon/favicon-16x16.png">
        <link rel="apple-touch-icon" sizes="57x57" href="../Public/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../Public/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../Public/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../Public/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../Public/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../Public/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../Public/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../Public/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../Public/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="../Public/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../Public/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../Public/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../Public/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="../Public/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../Public/img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <title>Usuario</title>

        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-timepicker/compiled/timepicker.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/jquery-multi-select/css/multi-select.css" />

        <!-- Bootstrap core CSS -->
        <link href="../Public/css/bootstrap.min.css" rel="stylesheet">

        
        <!--toastr-->
        <link href="../Public/assets/toast/jquery.toast.css" rel="stylesheet" type="text/css" />
        
        <link href="../Public/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <!--dynamic table-->
        <link href="../Public/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
        <link href="../Public/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="../Public/assets/data-tables/DT_bootstrap.css" />

        <!-- Yamm styles-->
        <link href="../Public/css/yamm.css" rel="stylesheet">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

        <!--right slidebar-->
        <link href="../Public/css/slidebars.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../Public/css/style.css" rel="stylesheet">
        <link href="../Public/css/style-responsive.css" rel="stylesheet" />        
    </head>
    <body class="full-width">
        <section id="container" class="">
            <?php include_once './Menu.php'; ?>
            <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <form id="carregar" action="Usuario.php" name="carregar" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-12">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Parâmetros do usuário
                                        </header>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <label> Nome </label>
                                                            <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                            <input type="hidden" name="<?PHP echo USUARIO_ID; ?>" class="form-control" id="<?PHP echo USUARIO_ID; ?>" value="<?PHP echo $objUsuario->getId(); ?>" />
                                                            <input required=""  class="form-control" type="text" name="<?PHP echo USUARIO_NOME; ?>" id="<?PHP echo USUARIO_NOME; ?>" value="<?PHP echo $objUsuario->getNome(); ?>" />
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label> Usuario </label>
                                                            <input required="" class="form-control" type="text" name="<?PHP echo USUARIO_USUARIO; ?>" id="<?PHP echo USUARIO_USUARIO; ?>" value="<?PHP echo $objUsuario->getUsuario(); ?>"  />
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label> Ramal </label>
                                                            <input  class="form-control" type="text" name="<?PHP echo USUARIO_RAMAL; ?>" id="<?PHP echo USUARIO_RAMAL; ?>" value="<?PHP echo $objUsuario->getRamal(); ?>"  />
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label> Usuario ERP </label>
                                                            <input  class="form-control" type="text" style="text-transform: capitalize;" name="<?PHP echo USUARIO_ERP; ?>" id="<?PHP echo USUARIO_ERP; ?>" value="<?PHP echo $objUsuario->getUsuarioERP(); ?>"  />
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <label for="UF"> Interno </label>
                                                            <?PHP if ($objUsuario->getInterno() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_INTERNO; ?>" id="<?PHP echo USUARIO_INTERNO; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_INTERNO; ?>" id="<?PHP echo USUARIO_INTERNO; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <label> Representante ERP </label>
                                                            <input class="form-control" maxlength="4" type="text" name="<?PHP echo USUARIO_REPRESENTANTE_ERP; ?>" id="<?PHP echo USUARIO_REPRESENTANTE_ERP; ?>" value="<?PHP echo $objUsuario->getRepresentanteERP(); ?>"  />
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label> Email </label>
                                                            <input required="" class="form-control" type="email" name="<?PHP echo USUARIO_EMAIL; ?>" id="<?PHP echo USUARIO_EMAIL; ?>" value="<?PHP echo $objUsuario->getEmail(); ?>"  />
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label> Email Secundario </label>
                                                            <input class="form-control" type="email" name="<?PHP echo USUARIO_EMAIL_SECUNDARIO; ?>" id="<?PHP echo USUARIO_EMAIL_SECUNDARIO; ?>" value="<?PHP echo $objUsuario->getEmailSecundario(); ?>"  />
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF"> Visualiza cli. sem canal </label>
                                                            <?PHP if ($objUsuario->getVisualizaClienteSemCanal() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_VISUALIZA_CLIENTE_SEM_CANAL; ?>" id="<?PHP echo USUARIO_VISUALIZA_CLIENTE_SEM_CANAL; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_VISUALIZA_CLIENTE_SEM_CANAL; ?>" id="<?PHP echo USUARIO_VISUALIZA_CLIENTE_SEM_CANAL; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label> Telefone </label>
                                                            <input required="" class="form-control" type="text" name="<?PHP echo USUARIO_TELEFONE; ?>" id="<?PHP echo USUARIO_TELEFONE; ?>" value="<?PHP echo $objUsuario->getTelefone(); ?>"  />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <label for="UF">Inclui Ped.respr adici</label>
                                                            <?PHP if ($objUsuario->getCadastraPedidoOutro() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_CADASTRA_PEDIDO_OUTRO; ?>" id="<?PHP echo USUARIO_CADASTRA_PEDIDO_OUTRO; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_CADASTRA_PEDIDO_OUTRO; ?>" id="<?PHP echo USUARIO_CADASTRA_PEDIDO_OUTRO; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF"> Modifica Ped. ERP </label>
                                                            <?PHP if ($objUsuario->getModificaPedidoErp() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_MODIFICA_PEDIDO_ERP; ?>" id="<?PHP echo USUARIO_MODIFICA_PEDIDO_ERP; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_MODIFICA_PEDIDO_ERP; ?>" id="<?PHP echo USUARIO_MODIFICA_PEDIDO_ERP; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF"> Modifica Cli. ERP </label>
                                                            <?PHP if ($objUsuario->getModificaClienteErp() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_MODIFICA_CLIENTE_ERP; ?>" id="<?PHP echo USUARIO_MODIFICA_CLIENTE_ERP; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_MODIFICA_CLIENTE_ERP; ?>" id="<?PHP echo USUARIO_MODIFICA_CLIENTE_ERP; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF"> Libera Ped. Fechado</label>
                                                            <?PHP if ($objUsuario->getLiberaPedidoFechado() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_LIBERA_PEDIDO_FECHADO; ?>" id="<?PHP echo USUARIO_LIBERA_PEDIDO_FECHADO; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_LIBERA_PEDIDO_FECHADO; ?>" id="<?PHP echo USUARIO_LIBERA_PEDIDO_FECHADO; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <?PHP if ($Acao == "Atualizar") { ?>
                                                            <div class="col-lg-2">
                                                                <label for="UF"> Zera Senha? </label>
                                                                <input type="checkbox" class="form-control"  name="ZeraSenha" id="ZeraSenha" />
                                                            </div>
                                                        <?PHP } ?>
                                                        <div class="col-lg-2">
                                                            <label for="UF"> Visualiza hist. credito cliente </label>
                                                            <?PHP if ($objUsuario->getVisualizaHistoricoCredito() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_VISUALIZA_HIST_CREDITO; ?>" id="<?PHP echo USUARIO_VISUALIZA_HIST_CREDITO; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_VISUALIZA_HIST_CREDITO; ?>" id="<?PHP echo USUARIO_VISUALIZA_HIST_CREDITO; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <label for="UF">Cad. Parametros Cliente</label>                                                                    <?PHP if ($objUsuario->getCadastraDiasCondPatgo() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO; ?>" id="<?PHP echo USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO; ?>" id="<?PHP echo USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF">Libera mod. usuário</label>
                                                            <?PHP if ($objUsuario->getLiberaModificacaoUsuario() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_LIBERA_MODIFICACAO_USUARIO; ?>" id="<?PHP echo USUARIO_LIBERA_MODIFICACAO_USUARIO; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_LIBERA_MODIFICACAO_USUARIO; ?>" id="<?PHP echo USUARIO_LIBERA_MODIFICACAO_USUARIO; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF">Libera mod. representante</label>
                                                            <?PHP if ($objUsuario->getLiberaModificacaoRepresentante() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE; ?>" id="<?PHP echo USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE; ?>" id="<?PHP echo USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF">Recebe e-mails enviados</label>
                                                            <?PHP if ($objUsuario->getRecebeEmailEnviado() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_RECEBE_EMAIL_ENVIADO; ?>" id="<?PHP echo USUARIO_RECEBE_EMAIL_ENVIADO; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_RECEBE_EMAIL_ENVIADO; ?>" id="<?PHP echo USUARIO_RECEBE_EMAIL_ENVIADO; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF">Recebe e-mails aprov/reprov</label>
                                                            <select name="<?PHP echo USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO; ?>" id="<?PHP echo USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO; ?>" class="form-control m-bot15">
                                                                <option id='<?PHP echo USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO; ?>' selected value=''></option>
                                                                <?PHP
                                                                if ($objUsuario->getRecebeEmailAprovacaoReprovacao() == "A") {
                                                                    echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO . "' selected value='A'>Aprovação</option>";
                                                                } else {
                                                                    echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO . "' value='A'>Aprovação</option>";
                                                                }
                                                                if ($objUsuario->getRecebeEmailAprovacaoReprovacao() == "R") {
                                                                    echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO . "' selected value='R'>Reprovação</option>";
                                                                } else {
                                                                    echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO . "' value='R'>Reprovação</option>";
                                                                }
                                                                if ($objUsuario->getRecebeEmailAprovacaoReprovacao() == "AB") {
                                                                    echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO . "' selected value='AB'>Ambos</option>";
                                                                } else {
                                                                    echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO . "' value='AB'>Ambos</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF">Responde SAC</label>
                                                            <?PHP if ($objUsuario->getRespondeSac() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_RESPONDE_SAC; ?>" id="<?PHP echo USUARIO_RESPONDE_SAC; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_RESPONDE_SAC; ?>" id="<?PHP echo USUARIO_RESPONDE_SAC; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <label for="UF">Recebe Notificação Pedido</label>
                                                            <?PHP if ($objUsuario->getRecebeNotificacaoPedido() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_RECEBE_NOT_PEDIDO; ?>" id="<?PHP echo USUARIO_RECEBE_NOT_PEDIDO; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_RECEBE_NOT_PEDIDO; ?>" id="<?PHP echo USUARIO_RECEBE_NOT_PEDIDO; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label for="UF">Recebe Notificação Cliente</label>
                                                            <?PHP if ($objUsuario->getRecebeNotificacaoCliente() == 1) { ?>
                                                                <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo USUARIO_RECEBE_NOT_CLIENTE; ?>" id="<?PHP echo USUARIO_RECEBE_NOT_CLIENTE; ?>" />
                                                            <?PHP } else { ?>
                                                                <input type="checkbox" class="form-control"  name="<?PHP echo USUARIO_RECEBE_NOT_CLIENTE; ?>" id="<?PHP echo USUARIO_RECEBE_NOT_CLIENTE; ?>" />
                                                            <?PHP } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label> Imagem </label>
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                                    <?PHP if ($objUsuario->getImagem() != "") { ?>
                                                                        <img src="../Public/img/Usuarios/<?PHP echo $objUsuario->getImagem(); ?>" alt="" />
                                                                    <?PHP } else { ?>
                                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Selecione+a Imagem" alt="" />
                                                                    <?PHP } ?>
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                <div>
                                                                    <span class="btn btn-white btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar</span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                        <input type="file" class="default" name="<?PHP echo USUARIO_IMAGEM; ?>" id="<?PHP echo USUARIO_IMAGEM; ?>" />
                                                                    </span>
                                                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-1">
                                                            <label> Cor Menu </label>
                                                            <?php if (!empty($objUsuario->getCorMenu())) { ?>
                                                                <input type="color" class="form-control"  name="<?PHP echo USUARIO_COR_MENU; ?>" id="<?PHP echo USUARIO_COR_MENU; ?>" value="<?PHP echo $objUsuario->getCorMenu(); ?>"/>
                                                            <?php } else { ?>
                                                                <input type="color" class="form-control"  name="<?PHP echo USUARIO_COR_MENU; ?>" id="<?PHP echo USUARIO_COR_MENU; ?>" value="#ffffff"/>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label> Cor Texto Menu </label>
                                                            <?php if (!empty($objUsuario->getCorTextoMenu())) { ?>
                                                                <input type="color" class="form-control"  name="<?PHP echo USUARIO_COR_TEXTO_MENU; ?>" id="<?PHP echo USUARIO_COR_TEXTO_MENU; ?>" value="<?PHP echo $objUsuario->getCorTextoMenu(); ?>"/>
                                                            <?php } else { ?>
                                                                <input type="color" class="form-control"  name="<?PHP echo USUARIO_COR_TEXTO_MENU; ?>" id="<?PHP echo USUARIO_COR_TEXTO_MENU; ?>" value="#000000" />
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label> Carteira </label>
                                                        <input required="" class="form-control" type="text" name="<?PHP echo USUARIO_CARTEIRA; ?>" id="<?PHP echo USUARIO_CARTEIRA; ?>" value="<?PHP echo $objUsuario->getCarteira(); ?>"  />
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label> Empresas </label>
                                                        <input required="" class="form-control" type="text" name="<?PHP echo USUARIO_EMPRESA; ?>" id="<?PHP echo USUARIO_EMPRESA; ?>" value="<?PHP echo $objUsuario->getEmpresa(); ?>"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <label>   </label>
                                                        <?PHP if (($Acao == "Atualizar" && $Permissoes['PTV0069']['ALTERAR'] == 1) || ($Acao == "Inserir" && $Permissoes['PTV0069']['INCLUIR'] == 1)) { ?>
                                                            <input type="submit" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    <?PHP } ?><a class="btn btn-info" href="Usuario.php">Voltar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </section>

            <!--main content end-->
            <!-- Right Slidebar start -->
            <?PHP include_once './JanelaDireita.php'; ?>
            <!-- Right Slidebar end -->
            <!--footer start-->
            <?PHP include_once './Rodape.php'; ?>
            <!--footer end-->
        </section>

        <!-- js placed at the end of the document so the pages load faster -->

        <script src="../Public/js/jquery.js"></script>
        <script src="../Public/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script src="../Public/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="../Public/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../Public/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../Public/js/jquery.scrollTo.min.js"></script>
        <script src="../Public/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="../Public/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../Public/assets/data-tables/DT_bootstrap.js"></script>
        <script src="../Public/js/respond.min.js" ></script>


        <script type="text/javascript" src="../Public/assets/fuelux/js/spinner.min.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-daterangepicker/moment.min.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script type="text/javascript" src="../Public/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="../Public/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>

        <script src="../Public/assets/toastr-master/toastr.js"></script>

        <!--right slidebar-->
        <script src="../Public/js/slidebars.min.js"></script>

        <!--dynamic table initialization -->
        <script src="../Public/js/dynamic_table_init.js"></script>

        <!--common script for all pages-->
        <script src="../Public/js/common-scripts.js"></script>

        <script src="../Public/js/respond.min.js" ></script>
        <script type="text/javascript" src="../Public/assets/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="../Public/js/jquery.pulsate.min.js"></script>
        <script src="../Public/js/pulstate.js" type="text/javascript"></script>
    </body>
    <!-- Mirrored from thevectorlab.net/flatlab/dynamic_table.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Mar 2015 13:32:07 GMT -->
</html>