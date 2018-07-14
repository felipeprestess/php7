<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

include_once '../Controller/Session.php';
include_once '../Model/DashboardUsuario.Class.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Controller/DAODashboard.php';
include_once '../Controller/DAODashboardUsuario.php';
include_once '../Controller/DAONotificacao.php';

$ObjDashboardUsuario = new DashboardUsuario();
$ObjDashboardUsuario = BuscaPermissoesDashPorUsuario($_SESSION['id']);


/*
$ObjFuncionalidades = new Funcionalidades();
$destinatarios = array();
$destinatarios[0]['email'] = 'william@forgesolucoes.com.br';
$destinatarios[0]['nome'] = 'william';


$ObjFuncionalidades->enviaEmail($destinatarios, "assunto", "corpo");
*/
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        <title>Portal de Vendas</title>

        <!-- Bootstrap core CSS -->
        <link href="../Public/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Public/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="../Public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="../Public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="stylesheet" href="../Public/css/owl.carousel.css" type="text/css">

        <!-- To XCHART -->
        <link href="../Public/assets/xchart/xcharts.css" rel="stylesheet" />

        <!--toastr-->
        <link href="../Public/assets/toast/jquery.toast.css" rel="stylesheet" type="text/css" />

        <!--right slidebar-->
        <link href="../Public/css/slidebars.css" rel="stylesheet">

        <!-- Yamm styles-->
        <link href="../Public/css/yamm.css" rel="stylesheet">

        <!-- Custom styles for this template -->

        <link href="../Public/css/style.css" rel="stylesheet">
        <link href="../Public/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="../Public/js/html5shiv.js"></script>
          <script src="../Public/js/respond.min.js"></script>
        <![endif]-->

    </head>
    <body  class="full-width" >
        <section id="container">

            <!--sidebar start-->
            <?php include_once './Menu.php'; ?>
            <!--sidebar end-->
            <!--main content start-->
            <section id="main-content" style="margin-left: 0px;">
                <section class="wrapper site-min-height">
                    <!--<br> COMENTÁRIO REALIZADO PARA QUEBRA DE LINHA -->
                    <!-- FLAGS PADRÕES START -->
                    <div class="d-flex" style="display: table; margin: 0 auto;opacity: 0.6">            
                            <img src="../Public/img/logo_perto_letracaixa.png" alt="Fundo" >
                            <img src="../Public/img/logo_digicon_vermelho.png" alt="Fundo" style="margin-top: 35px">
                    </div> 
                </section>
            </section>
            <?PHP include_once './JanelaDireita.php'; ?>
            <!--footer start-->
            <?PHP include_once './Rodape.php'; ?>
            <!--footer end-->
        </section>
        <!-- js placed at the end of the document so the pages load faster -->
        <script>
            function link(url) {
                window.location = url;
            }

        </script>
        <script src="../Public/js/jquery.js"></script>
        <script src="../Public/js/bootstrap.min.js"></script>
        <script src="../Public/js/jquery.dcjqaccordion.2.7.js" type="text/javascript"></script>
        <script src="../Public/js/jquery.scrollTo.min.js"></script>
        <script src="../Public/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="../Public/js/respond.min.js" ></script>

        <!--right slidebar-->
        <script src="../Public/js/slidebars.min.js"></script>

        <!--common script for all pages-->
        <script src="../Public/js/common-scripts.js"></script>

        <!--script for this page-->
        <script src="../Public/js/jquery.sparkline.js" type="text/javascript"></script>
        <script src="../Public/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
        <script src="../Public/assets/morris.js-0.4.3/morris.min.js" type="text/javascript"></script>
        <script src="../Public/assets/morris.js-0.4.3/raphael-min.js" type="text/javascript"></script>
        <script src="../Public/assets/chart-master/Chart.js"></script>
        <script src="../Public/js/jquery.customSelect.min.js" ></script>
        <script src="../Public/js/owl.carousel.js" ></script>
        <script src="../Public/js/sparkline-chart.js"></script>
        <script src="../Public/js/easy-pie-chart.js"></script>
        <script src="../Public/assets/xchart/d3.v3.min.js"></script>
        <script src="../Public/assets/xchart/xcharts.min.js"></script>

        <!--  Dashboard JS includes -->
        <script src="../Public/assets/toast/jquery.toast.js"></script>

        <script type="text/javascript">
            <?php include_once 'DashboardScript.php'; ?>
        </script>
        <?php CriarNotificacao("SaleStation", "Bem vindo!", $_SESSION['idProgramaAtual'], $_SESSION['id'], "success"); ?>
    </body>
</html>