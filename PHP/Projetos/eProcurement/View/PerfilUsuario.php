<?php
include_once '../Controller/Session.php';
include_once '../Controller/DAOPerfilUsuario.php';

include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/PerfilUsuario.Class.php';
include_once '../Model/DAO.Class.php';

$ObjDao = new DAO();
$objPerfilUsuario = new PerfilUsuario();

$ObjFuncionalidades = new Funcionalidades();
if (isset($_POST['Cadastrar'])) {
    if ($_POST['Acao'] == "Inserir") {

        $id = CadastraPerfilUsuario($_POST);
        $ObjFuncionalidades->ExibeMensagem("Perfil atribuido com sucesso!");
        $ObjFuncionalidades->Redirecionar("PerfilUsuario.php");
    } elseif ($_POST['Acao'] == "Atualizar") {
        $id = CadastraPerfilUsuario($_POST);
        $ObjFuncionalidades->ExibeMensagem("Perfil atribuido com sucesso!");
        $ObjFuncionalidades->Redirecionar("PerfilUsuario.php?id={$_POST[PERFILUSUARIO_USUARIO_ID]}&Acao=" . $_POST['Acao']);
    }
}

if (isset($_REQUEST['Acao'])) {
    $Acao = $_REQUEST['Acao'];
} else {
    $Acao = "";
}

if ($Acao == "Deletar") {
    $id = deletarPerfilUsuario($_REQUEST);
    $ObjFuncionalidades->Redirecionar("PerfilUsuario.php");
}
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

        <title>Perfil Usuario</title>

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

        <link href="../Public/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

        <!--dynamic table-->
        <link href="../Public/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
        <link href="../Public/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
        <link rel="stylesheet" href="../Public/assets/data-tables/DT_bootstrap.css" />

        <!-- Yamm styles-->
        <link href="../Public/css/yamm.css" rel="stylesheet">

        <!--toastr-->
        <link href="../Public/assets/toast/jquery.toast.css" rel="stylesheet" type="text/css" />


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
                        <?PHP
                        include './MenuUsuario.php';

                       include_once '../Model/PerfilUsuario.Class.php';
                        include_once '../Model/Perfil.Class.php';
                        include_once '../Model/Usuario.Class.php';
                        include_once '../Controller/DAOPerfilUsuario.php';
                        include_once '../Controller/DAOUsuario.php';
                        include_once '../Controller/DAOPerfil.php';

                        //Objetos para operacoes

                        $objPerfilUsuario = new PerfilUsuario();
                        $objPerfil = new Perfil();
                        $objUsuario = new Usuario();

                        if ($Acao == "Atualizar") {
                            $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($_REQUEST['id']);
                        }
                        ?>
                        <form id="carregar" action="PerfilUsuario.php" name="carregar" method="post">
                            <div>

                                <div class="row">
                                    <div class="col-lg-12">

                                        <section class="panel">
                                            <header class="panel-heading">

                                                Usuario por Perfil
                                            </header>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                        <input type="hidden" name="<?PHP echo PERFILUSUARIO_ID; ?>" class="form-control" id="<?PHP echo PERFILUSUARIO_ID; ?>" value="<?PHP echo $_REQUEST['id']; ?>" />

                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <select required="" name="<?PHP echo PERFILUSUARIO_USUARIO_ID; ?>" id="<?PHP echo PERFILUSUARIO_USUARIO_ID; ?>" class="form-control m-bot15">
                                                                    <?PHP
                                                                    $listaUsuario = ListaTodosUsuarios();
                                                                    foreach ($listaUsuario as $chave_do_indice => $valor_do_indice) {
                                                                        if ($objPerfilUsuario->getIDUsuario() == $valor_do_indice[USUARIO_ID]) {
                                                                            echo "<option  id='" . PERFILUSUARIO_USUARIO_ID . "' selected value='" . $valor_do_indice[USUARIO_ID] . "'>" . $valor_do_indice[USUARIO_NOME] . "</option>";
                                                                        } else {
                                                                            if (isset($_REQUEST['id']) && $_REQUEST['id'] == $valor_do_indice[USUARIO_ID]) {
                                                                                echo "<option selected id='" . PERFILUSUARIO_USUARIO_ID . "' value='" . $valor_do_indice[USUARIO_ID] . "'>" . $valor_do_indice[USUARIO_NOME] . "</option>";
                                                                            } 
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <select required="" name="<?PHP echo PERFILUSUARIO_PERFIL_ID; ?>" id="<?PHP echo PERFILUSUARIO_PERFIL_ID; ?>" class="form-control m-bot15">
                                                                    <?PHP
                                                                    $listaPerfil = ListaPerfil();
                                                                    foreach ($listaPerfil as $chave_do_indice => $valor_do_indice) {
                                                                        if ($objPerfilUsuario->getIDPerfil() == $valor_do_indice[PERFIL_ID]) {
                                                                            echo "<option id='" . PERFILUSUARIO_PERFIL_ID . "' selected value='" . $valor_do_indice[PERFIL_ID] . "'>" . $valor_do_indice[PERFIL_NOME] . "</option>";
                                                                        } else {
                                                                            echo "<option  id='" . PERFILUSUARIO_PERFIL_ID . "' value='" . $valor_do_indice[PERFIL_ID] . "'>" . $valor_do_indice[PERFIL_NOME] . "</option>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row"><div class="col-lg-12"></div></div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label>   </label>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label>   </label>
                                                                <?PHP if (($Acao == "Atualizar" && $Permissoes['PTC0013']['ALTERAR'] == 1) || ($Acao == "Inserir" && $Permissoes['PTC0013']['INCLUIR'] == 1)) { ?>                                                                   <input type="submit" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    <?PHP } ?><a class="btn btn-info" href="Usuario.php">Voltar</a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>

                                </div>

                                <!-- page end-->
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
        <script src="../Public/js/typeahead.bundle.js"></script>
        <script src="../Public/js/bloodhound.js"></script>
        <script src="../Public/js/handlebars.min.js"></script>
    </body>
</html>
