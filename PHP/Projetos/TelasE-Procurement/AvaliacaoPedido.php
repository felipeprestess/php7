<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE);
//include_once '../Model/ItemVenda.Class.php';
include_once '../Model/ItemVenda.Class.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/Usuario.Class.php';
include_once '../Model/DAO.Class.php';

$ObjDao = new DAO();

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
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


        <title>Ranking de Avaliação de Fornecedores</title>


        <!-- bootstrap -->
        <link rel="stylesheet" href="../Public/css/bootstrap.min.css">
        <!--     -->

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

    <?PHP include_once './Menu.php';?>
        <section id="main-content">
            <section class="wrapper">
                <div class="row">
                <?PHP if($Acao == ""){?>
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <form action="AvaliacaoPedido.php" method="post">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-5"></div>
                                        <div class="col-sm-2">
                                            <a class="btn btn-primary" href="#avaliacao">Teste</a>
                                        </div>
                                        <div class="col-sm-5"></div>
                                    </div>
                                    <div class="form-group row"></div>
                                    <div class="row">
                                        <div class="col-lg-12"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-10"></div>
                                        <div class="col-lg-2"></div>
                                    </div>
                                </div>
                            </form>

                        <!-- Aqui vai os filtros em PHP para o GRID -->

                        <!-- INÍCIO REGISTROS FICTICIOS -->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2"><h4>Pedido</h4></div>
                                <div class="col-lg-2"><h4>Item</h4></div>
                                <div class="col-lg-2"><h4>Quantidade</h4></div>
                                <div class="col-lg-2"><h4>Fornecedor</h4></div>
                                <div class="col-lg-2"><h4>Avaliação</h4></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">7582</div>
                                <div class="col-lg-2">FITA CERA</div>
                                <div class="col-lg-2">350</div>
                                <div class="col-lg-2">OZACA</div>
                                <div class="col-lg-2">
                                    <a href="#avaliacao">Avaliar</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">01478</div>
                                <div class="col-lg-2">FUSIVEL OELO</div>
                                <div class="col-lg-2">15</div>
                                <div class="col-lg-2">VALGRI</div>
                                <div class="col-lg-2">
                                    <a href="#avaliacao">Avaliar</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">2487</div>
                                <div class="col-lg-2">COMPONENTE RAIO</div>
                                <div class="col-lg-2">100</div>
                                <div class="col-lg-2">JAVI</div>
                                <div class="col-lg-2">
                                    <a href="#avaliacao">Avaliar</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2">3578</div>
                                <div class="col-lg-2">FITA CERA</div>
                                <div class="col-lg-2">350</div>
                                <div class="col-lg-2">OZACA</div>
                                <div class="col-lg-2">
                                    <a href="#avaliacao">Avaliar</a>
                                </div>
                            </div>
                        </div>
                        <!-- FIM REGISTROS FICTICIOS -->

                        <div class="modal fade" id="avaliacao" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content-wrap">
                                    <div class="modal-content">
                                        <form id="carregar" name="carregar" action="AvaliacaoPedido.php?Acao=" method="post" enctype='multipart/form-data'>
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"&times;></button>
                                                <h4 class="modal-title">Avaliação</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3">

                                                    <!-- TODO: AQUI VAI O CONTEUDO DE AVALIAÇÃO DO PEDIDO -->

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" class="form-control m-bot15" id=id require="" name="id" value=""/>
                                                <input type="submit" class="form-control m-bot15" id=id require="" name="id" value="Votar"/>
                                                <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        </div>
                    </div>
                    }?>
                </div>
            </section>
        </section>

        <!-- main content end -->
        <!-- Right Slidebar start -->
        <?PHP //include_once './JanelaDireita.php'; ?>
        <!-- Right Slidebar end -->
        <!--footer start-->
        <?PHP //include_once './Rodape.php'; ?>
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

        <script src="../Public/js/respond.min.js" ></script>
        <script type="text/javascript" src="../Public/assets/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="../Public/js/jquery.pulsate.min.js"></script>
        <script src="../Public/js/pulstate.js" type="text/javascript"></script>
</body>
</html>
