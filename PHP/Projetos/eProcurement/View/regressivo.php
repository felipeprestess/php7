<?PHP

date_default_timezone_set("America/Sao_Paulo");

/*
 *  Arquivo que gera os menus conforme a tabela 
 */
include_once '../Model/Usuario.Class.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/PerfilUsuario.Class.php';
include_once '../Model/Perfil.Class.php';
include_once '../Controller/Session.php';
include_once '../Controller/GeraMenus.php';
include_once '../Controller/DAOUsuario.php';
include_once '../Controller/DAOPerfilUsuario.php';
include_once '../Controller/DAOPerfil.php';

$objUsuario = new Usuario();
$ObjFuncionalidades = new Funcionalidades();
$objPerfilUsuario = new PerfilUsuario();
$objPerfil = new Perfil();

$IdUsuario = $_SESSION['id'];

$menus = GeraMenus($IdUsuario);


$objUsuario = BuscaUsuarioPorID($_SESSION['id']);
$objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($objUsuario->getID());
$objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

$perfilUsuario = buscaPerfilDoUsuarioPorId($IdUsuario);
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
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

        <title>General</title>

        <!-- Bootstrap core CSS -->
        <link href="../Public/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Public/css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="../Public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/gritter/css/jquery.gritter.css" />
        <!--right slidebar-->
        <link href="../Public/css/slidebars.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../Public/css/style.css" rel="stylesheet">
        <link href="../Public/css/style-responsive.css" rel="stylesheet" />

    </head>
    <body>
        <header class="header white-bg">
            <div class="navbar-header">
                <ul class="nav navbar-nav">

                    <?PHP
                    //Busca o parametro que identifica o dia e hora para derrubar o sistema, caso esteja vazio nao faz nada
                    $Derruba = buscaValorPadraoPorNome("Logoff Sistema");
                    $Volta = buscaValorPadraoPorNome("Fim Logoff Sistema");

                    //COMEÇO CÓDIGO

                    if (!is_null($Derruba) && $Derruba != '') {

                        $datetime = explode('T', $Derruba);
                        $Data = $datetime[0];
                        $Time = $datetime[1];

                        $Data = explode('-', $Data);
                        $Dia = $Data[2];
                        $Mes = $Data[1];
                        $Ano = $Data[0];

                        $Time = explode(':', $Time);
                        $Hora = $Time[0];
                        $Minuto = $Time[1];

                        switch ($Mes) {
                            case ('01'): {
                                    $Mes = 'january';
                                    break;
                                }
                            case ('02'): {
                                    $Mes = 'february';
                                    break;
                                }
                            case ('03'): {
                                    $Mes = 'march';
                                    break;
                                }
                            case ('04'): {
                                    $Mes = 'april';
                                    break;
                                }
                            case ('05'): {
                                    $Mes = 'may';
                                    break;
                                }
                            case ('06'): {
                                    $Mes = 'june';
                                    break;
                                }
                            case ('07'): {
                                    $Mes = 'july';
                                    break;
                                }
                            case ('08'): {
                                    $Mes = 'august';
                                    break;
                                }
                            case ('09'): {
                                    $Mes = 'september';
                                    break;
                                }
                            case ('10'): {
                                    $Mes = 'october';
                                    break;
                                }
                            case ('11'): {
                                    $Mes = 'november';
                                    break;
                                }
                            case ('12'): {
                                    $Mes = 'december';
                                    break;
                                }
                        }

                        $date = "{$Mes} {$Dia}, {$Ano} {$Hora}:{$Minuto}:00";


                        $separaDataHora = explode("T", $Derruba);
                        $dt = $separaDataHora[0];
                        $hr = $separaDataHora[1];

                        $DateTimederruba = ($dt . ' ' . $hr);
                        
                        $separaDataHoraVolta = explode("T", Volta);
                        $dtVolta = $separaDataHoraVolta[0];
                        $hrVolta = $separaDataHoraVolta[1];

                        $DateTimeVolta = ($dtVolta . ' ' . $hrVolta);

                        $Agora = date("Y-m-d H:i");

                        if (date($DateTimederruba) >= date($Agora) && date($DateTimeVolta) > date($Agora)) {

                            echo "<label style='margin-left: 10px;'>
                             <a href='javascript:;' class='btn btn-danger' id='pulsate-regular'>
                             Manutenção em
                             <font class='countdown styled'> </font>
                             </a>
                            </label>";
                        } else {
                            echo "
                             <a href='javascript:;' class='btn btn-danger' id='pulsate-regular'><strong>Atenção!</strong> Portal fora do ar.</a>
                             
                             ";
                            if (strtoupper(trim($objPerfil->getNome())) != "ADMINISTRADOR") {
                                $ObjFuncionalidades->ExibeMensagem("ALERTA SERVIDOR PHP.");
                                session_destroy();
                                $ObjFuncionalidades->Redirecionar("../index.php");
                            }
                        }
                    }
                    ?>
                </ul>


            </div>
        </header>

        <script src="../Public/js/jquery.js"></script>
        <script type="text/javascript" src="http://web.crea.acsta.net/rep_dif/Smart/Warner/BatmanVsSuperman/Arrobas-250/Contagem/dest/jquery.countdown.js"></script>
        <script type="text/javascript">
            $(function () {

                var endDate = '<?PHP echo $date; ?>';

                $('.countdown.simple').countdown({date: endDate});

                $('.countdown.styled').countdown({
                    date: endDate,
                    render: function (data) {
                        $(this.el).html(" <strong> " + this.leadingZeros(data.days, 2) + "</strong> dias <strong>" + this.leadingZeros(data.hours, 2) + ":" + this.leadingZeros(data.min, 2) + ":" + this.leadingZeros(data.sec, 2) + "</strong>");

                        if (this.leadingZeros(data.days, 2) == "00" && this.leadingZeros(data.hours, 2) == "00" && this.leadingZeros(data.min, 2) == "00" && this.leadingZeros(data.sec, 2) == "00") {

                           
                           location.reload();
                             
                        }
                    }
                });

                $('.countdown.callback').countdown({
                    date: +(new Date) + 10000,
                    render: function (data) {
                        $(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
                    },
                    onEnd: function () {
                        $(this.el).addClass('ended');
                    }
                }).on("click", function () {
                    $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
                });

                // End time for diff purposes
                var endTimeDiff = new Date().getTime() + 15000;
                // This is server's time
                var timeThere = new Date();
                // This is client's time (delayed)
                var timeHere = new Date(timeThere.getTime());
                // Get the difference between client time and server time
                var diff_ms = timeHere.getTime() - timeThere.getTime();
                // Get the rounded difference in seconds
                var diff_s = diff_ms / 1000 | 0;

                var notice = [];
                notice.push('Server time: ' + timeThere.toDateString() + ' ' + timeThere.toTimeString());
                notice.push('Your time: ' + timeHere.toDateString() + ' ' + timeHere.toTimeString());
                notice.push('Time difference: ' + diff_s + ' seconds (' + diff_ms + ' milliseconds to be precise). Your time is a bit behind.');

                $('.offset-notice').html(notice.join('<br />'));

                $('.offset-server .countdown').countdown({
                    date: endTimeDiff,
                    offset: diff_s * 1000,
                    onEnd: function () {
                        $(this.el).addClass('ended');
                    }
                });

                $('.offset-client .countdown').countdown({
                    date: endTimeDiff,
                    onEnd: function () {
                        $(this.el).addClass('ended');
                    }
                });

            });
        </script>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../Public/js/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="../Public/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="../Public/js/jquery.scrollTo.min.js"></script>
        <script src="../Public/js/jquery.nicescroll.js" type="text/javascript"></script>
        <script type="text/javascript" src="../Public/assets/gritter/js/jquery.gritter.js"></script>
        <script src="../Public/js/respond.min.js" ></script>
        <script type="text/javascript" src="../Public/js/jquery.pulsate.min.js"></script>

        <!--right slidebar-->
        <script src="../Public/js/slidebars.min.js"></script>

        <!--common script for all pages-->
        <script src="../Public/js/common-scripts.js"></script>

        <!--script for this page only-->
        <script src="../Public/js/gritter.js" type="text/javascript"></script>
        <script src="../Public/js/pulstate.js" type="text/javascript"></script>


    </body>
</html>
