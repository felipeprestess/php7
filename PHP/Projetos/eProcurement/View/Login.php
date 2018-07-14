<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

date_default_timezone_set("America/Sao_Paulo");

include_once '../Model/Usuario.Class.php';
include_once '../Controller/DAOPadroesModulo.php';
$ObjUsuario = new Usuario();

/*$Derruba = buscaValorPadraoPorNome("Logoff Sistema");

$Volta = buscaValorPadraoPorNome("Fim Logoff Sistema");

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
}



if (!is_null($Volta) && $Volta != '') {

    $datetimeVolta = explode('T', $Volta);
    $DataVolta = $datetimeVolta[0];
    $TimeVolta = $datetimeVolta[1];

    $DataVolta = explode('-', $DataVolta);
    $DiaVolta = $DataVolta[2];
    $MesVolta = $DataVolta[1];
    $AnoVolta = $DataVolta[0];

    $TimeVolta = explode(':', $TimeVolta);
    $HoraVolta = $TimeVolta[0];
    $MinutoVolta = $TimeVolta[1];

    switch ($MesVolta) {
        case ('01'): {
                $MesVolta = 'january';
                break;
            }
        case ('02'): {
                $MesVolta = 'february';
                break;
            }
        case ('03'): {
                $MesVolta = 'march';
                break;
            }
        case ('04'): {
                $MesVolta = 'april';
                break;
            }
        case ('05'): {
                $MesVolta = 'may';
                break;
            }
        case ('06'): {
                $MesVolta = 'june';
                break;
            }
        case ('07'): {
                $MesVolta = 'july';
                break;
            }
        case ('08'): {
                $MesVolta = 'august';
                break;
            }
        case ('09'): {
                $MesVolta = 'september';
                break;
            }
        case ('10'): {
                $MesVolta = 'october';
                break;
            }
        case ('11'): {
                $MesVolta = 'november';
                break;
            }
        case ('12'): {
                $MesVolta = 'december';
                break;
            }
    }

    $dateVolta = "{$MesVolta} {$DiaVolta}, {$AnoVolta} {$HoraVolta}:{$MinutoVolta}:00";


    $separaDataHoraVolta = explode("T", $Volta);
    $dtVolta = $separaDataHoraVolta[0];
    $hrVolta = $separaDataHoraVolta[1];

    $DateTimeVolta = ($dtVolta . ' ' . $hrVolta);
}*/



$Agora = date("Y-m-d H:i");
?>
<!DOCTYPE html>
<html lang="pt-br">

    <!-- Mirrored from thevectorlab.net/flatlab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Mar 2015 13:29:37 GMT -->
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

        <title>Portal de Vendas</title>

        <!-- Bootstrap core CSS -->
        <link href="../Public/css/bootstrap.min.css" rel="stylesheet">
        <link href="../Public/css/bootstrap-reset.css" rel="stylesheet">
        
        <!--toastr-->
        <link href="../Public/assets/toast/jquery.toast.css" rel="stylesheet" type="text/css" />
        
        <!--external css-->
        <link href="../Public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="../Public/css/style.css" rel="stylesheet">
        <link href="../Public/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div class="container">

            <form id="form" method="post" class="form-signin" action="../Controller/Login.php">
                <h2 class="form-signin-heading" style='coler:green'>Login</h2>
                <div class="login-wrap">
                    <input required="" type="text" id="<?PHP echo USUARIO_NOME; ?>" name="<?PHP echo USUARIO_USUARIO; ?>" class="form-control" placeholder="Usuario" autofocus>
                    <input id="<?PHP echo USUARIO_SENHA; ?>" name="<?PHP echo USUARIO_SENHA; ?>" type="password" class="form-control" placeholder="Senha">
                    <label class="checkbox">
                        <input type="checkbox" id="PrimeiroAcesso" name="PrimeiroAcesso" onclick="PrimeiroAcesso();" /> Primeiro Acesso?

                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="remember-me"> Lembrar de mim?
                        <span class="pull-right">
                            <a data-toggle="modal" href="#myModal"> Esqueceu sua senha?</a>
                        </span>
                    </label>
                    <button class="btn btn-lg btn-default btn-block" type="submit">Entrar</button>
                    <p>Bem vindo ao Portal de Vendas</p>
                    <?PHP
                   
                    if (date($DateTimederruba) <= date($Agora) && date($Agora) < date($DateTimeVolta)) {
                        echo " <p style='color:red;'> O portal de vendas esta em manutenção e retornará em  <font class='countdown styled'> </font> </p>";
                    }
                    
                    ?>
                    <p style="margin-top: 10px; color: white; font-weight: 500; opacity: 0.75;" onmouseover="this.style.opacity = 1;" onmouseout="this.style.opacity = 0.75;">
                        <a href="https://www.google.com/chrome/browser/desktop/index.html" target="_blank">
                            <img src="../Public/img/chrome.png" style="width: 30px;">
                            <span style="font-size: 13px; font-weight: 600; margin-left: 10px; color: #000000;">
                                Utilize somente com Google Chrome
                            </span>
                        </a>
                    </p>
                </div>

                <!-- Modal -->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Esqueceu Sua senha ?</h4>
                            </div>
                            <div class="modal-body">
                                <p>Entre com seu email para recuperar sua senha.</p>
                                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                                <button class="btn btn-success" type="button">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal -->

            </form>

        </div>

        <script src="../Public/js/FuncaoGlobal.js"></script>

        <!-- js placed at the end of the document so the pages load faster -->
        <script type="text/javascript">
                            /**
                             * 
                             * @param {type} Valor
                             * @returns {undefined}
                             * 
                             * Faz a logica do primeiro acesso retirando a obrigatoriedade do campo de senha do usuario.
                             */
                            function PrimeiroAcesso() {
                                if (document.getElementById('PrimeiroAcesso').checked == true) {

                                    RemoveAtributo("Senha", "required");
                                } else {

                                    AdicionaAtributo('PrimeiroAcesso', 'required', '');
                                }
                            }
        </script>
        <script src="../Public/js/jquery.js"></script>
        <script src="../Public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://web.crea.acsta.net/rep_dif/Smart/Warner/BatmanVsSuperman/Arrobas-250/Contagem/dest/jquery.countdown.js"></script>
        <script type="text/javascript">
                            $(function () {

                                var endDate = '<?PHP echo $dateVolta; ?>';

                                $('.countdown.simple').countdown({date: endDate});

                                $('.countdown.styled').countdown({
                                    date: endDate,
                                    render: function (data) {
                                        $(this.el).html(" <strong> " + this.leadingZeros(data.days, 2) + "</strong> dias <strong>" + this.leadingZeros(data.hours, 2) + ":" + this.leadingZeros(data.min, 2) + ":" + this.leadingZeros(data.sec, 2) + "</strong>");

                                        if (this.leadingZeros(data.days, 2) == "00" && this.leadingZeros(data.hours, 2) == "00" && this.leadingZeros(data.min, 2) == "00" && this.leadingZeros(data.sec, 2) == "00") {


                                            //location.reload();

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
    </body>

    <!-- Mirrored from thevectorlab.net/flatlab/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Mar 2015 13:29:38 GMT -->
</html>
