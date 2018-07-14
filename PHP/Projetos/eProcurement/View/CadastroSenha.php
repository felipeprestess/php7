<?PHP
include_once '../Model/Usuario.Class.php';
include_once '../Model/Funcionalidades.Class.php';

$ObjFuncionalidades = new Funcionalidades();
$ObjUsuario = new Usuario();

if (!isset($_REQUEST['Usuario'])) {
    $ObjFuncionalidades->ExibeMensagem("ID do usuario nao encontrado!");
    $ObjFuncionalidades->Redirecionar("Login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

    <!-- Mirrored from thevectorlab.net/flatlab/form_validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Mar 2015 13:31:46 GMT -->
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

        <title>Cadastro de Senha</title>

        <!-- Bootstrap core CSS -->
        <link href="../Public/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Public/css/bootstrap-reset.css" rel="stylesheet">
        
        <!--toastr-->
        <link href="../Public/assets/toast/jquery.toast.css" rel="stylesheet" type="text/css" />
        
        <!--external css-->
        <link href="../Public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!--right slidebar-->
        <link href="../Public/css/slidebars.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../Public/css/style.css" rel="stylesheet">
        <link href="../Public/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="../Public/js/html5shiv.js"></script>
          <script src="../Public/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <section id="container" class="">
            <section class="wrapper">
                <!-- page start-->

                <div class="row">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Defina sua senha
                            </header>
                            <div class="panel-body">
                                <div class="form">
                                    <form class="form-signin" method="POST" action="../Controller/CadastroSenha.php">
                                        <div class="form-group ">
                                            <label for="password" class="control-label col-lg-2">Senha</label>
                                            <div class="col-lg-12">
                                                <input class="form-control " id="password" name="password" type="password" />
                                                <input class="form-control " id="Usuario" name="Usuario" type="hidden" value="<?PHP echo $_REQUEST['Usuario']; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label for="confirm_password" class="control-label col-lg-2">Confirmar Senha</label>
                                            <div class="col-lg-12">
                                                <input class="form-control " id="confirm_password" name="confirm_password" type="password" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-danger" type="submit">Salvar</button>
                                                <a class="btn btn-danger" href="Login.php">Voltar</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- page end-->
            </section>

            <!--main content end-->
            <!-- Right Slidebar start -->
            <?PHP include_once './JanelaDireita.php'; ?>
            <!-- Right Slidebar end -->
            <!--footer start-->
            <!--footer end-->
        </section>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../Public/js/jquery.js"></script>
        <script src="../Public/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../Public/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../Public/js/jquery.scrollTo.min.js"></script>
        <script src="../Public/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script type="text/javascript" src="../Public/js/jquery.validate.min.js"></script>
        <script src="../Public/js/respond.min.js" ></script>

        <!--right slidebar-->
        <script src="../Public/js/slidebars.min.js"></script>

        <!--common script for all pages-->
        <script src="../Public/js/common-scripts.js"></script>

        <!--script for this page-->
        <script src="../Public/js/form-validation-script.js"></script>


    </body>

    <!-- Mirrored from thevectorlab.net/flatlab/form_validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Mar 2015 13:31:47 GMT -->
</html>
