<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include_once '../Controller/Session.php';
include_once '../Controller/DAOUsuarioPrograma.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/UsuarioPrograma.Class.php';
include_once '../Model/Perfil.Class.php';
include_once '../Model/DAO.Class.php';

$ObjFuncionalidades = new Funcionalidades();
$ObjDao = new DAO();
$objProgramaUsuario = new UsuarioPrograma();
$objPerfil = new Perfil();

if (isset($_POST['Cadastrar'])) {
    $id = CadastraUsuarioPrograma($_POST);
    $ObjFuncionalidades->Redirecionar("ProgramaPorUsuario.php?Acao=Atualizar&id=" . $_REQUEST[USUARIOPROGRAMA_USUARIO_ID]);
}

if (isset($_REQUEST['Acao'])) {
    $Acao = $_REQUEST['Acao'];
} else {
    $Acao = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <link rel="shortcut icon" href="img/favicon.html">

        <title>Programa por Usuario</title>

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


        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

        <!--right slidebar-->
        <link href="../Public/css/slidebars.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../Public/css/style.css" rel="stylesheet">
        <link href="../Public/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>


    <body class="full-width">
        <section id="container" class="">
            <?php include_once './Menu.php'; ?>
            <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <?PHP
                        include './MenuUsuario.php';

                        include_once '../Model/UsuarioPrograma.Class.php';
                        include_once '../Model/Programa.Class.php';
                        include_once '../Controller/DAOUsuarioPrograma.php';
                        include_once '../Controller/DAOPrograma.php';

                        //Objetos para operacoes

                        $objUsuarioPrograma = new UsuarioPrograma();
                        $objPrograma = new Programa();
                        ?>
                        <form id="carregar" action="ProgramaPorUsuario.php" name="carregar" method="post">
                            <div>

                                <div class="row">
                                    <div class="col-lg-12">

                                        <section class="panel">
                                            <header class="panel-heading">

                                                Programa por Usuario
                                            </header>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                        <input type="hidden" name="<?PHP echo USUARIOPROGRAMA_USUARIO_ID; ?>" class="form-control" id="<?PHP echo USUARIOPROGRAMA_USUARIO_ID; ?>" value="<?PHP echo $_REQUEST['id']; ?>" />
                                                        <?PHP
                                                        $ListaPrograma = ListaPrograma();
                                                        foreach ($ListaPrograma as $chave_do_indice => $valor_do_indice) {
                                                            $objUsuarioPrograma = buscaUsuarioProgramaPorIdPrograma($valor_do_indice[PROGRAMA_ID], $_REQUEST['id']);
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <input type="text"  readonly="" name="<?PHP echo PROGRAMA_DESCRICAO_CURTA; ?>" class="form-control" id="<?PHP echo PROGRAMA_DESCRICAO_CURTA; ?>" value="<?PHP echo $valor_do_indice[PROGRAMA_DESCRICAO_CURTA]; ?>" />
                                                                    <input type="hidden"  readonly="" name="<?PHP echo USUARIOPROGRAMA_PROGRAMA_ID; ?>" class="form-control" id="<?PHP echo USUARIOPROGRAMA_PROGRAMA_ID; ?>" value="<?PHP echo $valor_do_indice[PROGRAMA_ID]; ?>" />

                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label for="UF">Incluir</label>
                                                                    <div class="col-sm-6 text-center">
                                                                        <div>
                                                                            <?PHP
                                                                            if ($objUsuarioPrograma->getIncluir() == 1) {
                                                                                $checked = "checked";
                                                                            } else {
                                                                                $checked = "";
                                                                            }
                                                                            ?>
                                                                            <input type="checkbox" <?PHP echo $checked; ?> onclick="return habilitaIncluir();" name="<?PHP echo $valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_INCLUIR; ?>" id="<?PHP echo $valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_INCLUIR; ?>"/> 

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label for="UF">Alterar</label>
                                                                    <div class="col-sm-6 text-center">
                                                                        <div>
                                                                            <?PHP
                                                                            if ($objUsuarioPrograma->getAlterar() == 1) {
                                                                                $checked = "checked";
                                                                            } else {
                                                                                $checked = "";
                                                                            }
                                                                            ?>
                                                                            <input type="checkbox" <?PHP echo $checked; ?> name="<?PHP echo $valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_ALTERAR; ?>" id="<?PHP echo $valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_ALTERAR; ?>"/>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label for="UF">Pesquisar</label>
                                                                    <div class="col-sm-6 text-center">
                                                                        <div>
                                                                            <?PHP
                                                                            if ($objUsuarioPrograma->getAcessar() == 1) {
                                                                                $checked = "checked";
                                                                            } else {
                                                                                $checked = "";
                                                                            }
                                                                            ?>
                                                                            <input type="checkbox" <?PHP echo $checked; ?> name="<?PHP echo $valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_ACESSAR; ?>" id="<?PHP echo $valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_ACESSAR; ?>"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label for="UF">Lixeira</label>
                                                                    <div class="col-sm-6 text-center">
                                                                        <div>
                                                                            <?PHP
                                                                            if ($objUsuarioPrograma->getLixeira() == 1) {
                                                                                $checked = "checked";
                                                                            } else {
                                                                                $checked = "";
                                                                            }
                                                                            ?>
                                                                            <input type="checkbox" <?PHP echo $checked; ?> name="<?PHP echo $valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_LIXEIRA; ?>" id="<?PHP echo $valor_do_indice[PROGRAMA_ID] . USUARIOPROGRAMA_LIXEIRA; ?>"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row"><div class="col-lg-12"></div></div>
                                                        <?PHP } ?>
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
                                                                <?PHP ?>                                                                    <input type="submit" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    <?PHP ?><a class="btn btn-info" href="Usuario.php">Voltar</a>
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

        <script src="../Public/assets/toastr-master/toastr.js"></script>

        <!--right slidebar-->
        <script src="../Public/js/slidebars.min.js"></script>

        <!--dynamic table initialization -->
        <script src="../Public/js/dynamic_table_init.js"></script>


        <!--common script for all pages-->
        <script src="../Public/js/common-scripts.js"></script>

        <!--custom switch-->
        <script src="../Public/js/bootstrap-switch.js"></script>



    </body>
</html>





















