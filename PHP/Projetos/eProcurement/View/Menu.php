<?PHP
date_default_timezone_set("America/Sao_Paulo");

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

/*
 *  Arquivo que gera os menus conforme a tabela 
 */
include_once '../Controller/Session.php';
include_once '../Model/Usuario.Class.php';
include_once '../Controller/GeraMenus.php';
include_once '../Controller/DAOUsuario.php';
include_once '../Model/Perfil.Class.php';
include_once '../Controller/DAOPerfil.php';
include_once '../Controller/DAODashboard.php';
include_once '../Model/PerfilPrograma.Class.php';
include_once '../Controller/DAOPerfilPrograma.php';
include_once '../Controller/DAOUsuarioPrograma.php';
include_once '../Model/Programa.Class.php';
include_once '../Controller/DAOPrograma.php';

$IdUsuario = $_SESSION['id'];
$objUsuario = new Usuario();
$menus = GeraMenus($IdUsuario);
$objPerfil = new Perfil();
$objPerfilPrograma = new PerfilPrograma();

$objUsuario = BuscaUsuarioPorID($_SESSION['id']);
$perfilUsuario = buscaPerfilDoUsuarioPorId($IdUsuario);
$objPerfil = buscaPerfilPorId($perfilUsuario[0][PERFILUSUARIO_PERFIL_ID]);
$objPerfilPrograma = buscaPerfilProgramaPorIdPrograma(21, $objPerfil->getID());
$objPrograma = new Programa();
?>

<header class="header white-bg" style="background-color: <?php echo $objUsuario->getCorMenu(); ?>;">
    <div class="navbar-header" id='primaryHeader'>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="fa fa-bars"></span>
        </button>

        <!--logo start-->
        <a href="Home.php" class="logo" style="width: 100px;"><img src="../Public/img/logo-<?PHP echo $objUsuario->getEmpresaPortal(); ?>.png" style="width: 115px; height: 34px;"/></a>
        <!--logo end-->
        <div id="navbar-collapse-1" class="navbar-collapse collapse yamm mega-menu">
            <ul class="nav navbar-nav">
                <!-- Classic list -->
                <!-- Classic dropdown -->

                <?PHP
                $existe = existePermissoesUsuario($_SESSION['id']);
                foreach ($menus as $chave_do_indice => $valor_do_indice) {
                    if ($existe == 0) {
                        $ProgramasAcessarPerfil = BuscaProgramasPorPerfilAcessar($perfilUsuario[0][PERFILUSUARIO_PERFIL_ID], $valor_do_indice[MENU_PROGRAMA]);
                    } else {
                        $ProgramasAcessarPerfil = 0;
                    }
                    $ProgramasAcessarEspecificoUsuario = BuscaPermissoesProgramasPorUsuario($IdUsuario, $valor_do_indice[MENU_PROGRAMA]);
                    if ((in_array($valor_do_indice[MENU_PROGRAMA], $ProgramasAcessarPerfil[0]) &&
                            (!in_array($valor_do_indice[MENU_PROGRAMA], $ProgramasAcessarEspecificoUsuario[0]) || $ProgramasAcessarEspecificoUsuario[0][USUARIOPROGRAMA_ACESSAR] == 1)) ||
                            (!in_array($valor_do_indice[MENU_PROGRAMA], $ProgramasAcessarPerfil[0]) &&
                            $ProgramasAcessarEspecificoUsuario[0][USUARIOPROGRAMA_ACESSAR] == 1)) {

                        if ($valor_do_indice[MENU_DESTINO] == "") {
                            ?>
                            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color:<?php echo $objUsuario->getCorTextoMenu(); ?>; background-color:<?php echo $objUsuario->getCorMenu(); ?>;"><?PHP echo preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $valor_do_indice[MENU_DESCRICAO_CURTA])); ?> <b class=" fa fa-angle-down"></b></a>
                            <?PHP } else { ?>
                            <li class=""><a href="<?PHP echo $valor_do_indice[MENU_DESTINO]; ?>"  style="color:<?php echo $objUsuario->getCorTextoMenu(); ?>; background-color:<?php echo $objUsuario->getCorMenu(); ?>; "><?PHP echo preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $valor_do_indice[MENU_DESCRICAO_CURTA])); ?> <b class=" fa fa-angle-down"></b></a>

                                <?PHP
                            }
                            $SubMenus = BuscaSubMenusProgramasAcessar($valor_do_indice[MENU_ID]);
                            ?>
                            <ul role="menu" class="dropdown-menu" style="background-color:<?php echo $objUsuario->getCorMenu(); ?>;">
                                <?PHP
                                foreach ($SubMenus as $chave_do_ind_sub_men => $valor_do_ind_sub_men) {

                                    if ($existe == 0) {
                                        $ProgramasAcessarPerfilSubMenu = BuscaProgramasPorPerfilAcessar($perfilUsuario[0][PERFILUSUARIO_PERFIL_ID], $valor_do_ind_sub_men[MENU_PROGRAMA]);
                                    } else {
                                        $ProgramasAcessarPerfilSubMenu = 0;
                                    }

                                    $ProgramasAcessarEspecificoUsuarioSubMenu = BuscaPermissoesProgramasPorUsuario($IdUsuario, $valor_do_ind_sub_men[MENU_PROGRAMA]);


                                    if ((in_array($valor_do_ind_sub_men[MENU_PROGRAMA], $ProgramasAcessarPerfilSubMenu[0]) && (!in_array($valor_do_ind_sub_men[MENU_PROGRAMA], $ProgramasAcessarEspecificoUsuarioSubMenu[0]) || $ProgramasAcessarEspecificoUsuarioSubMenu[0][USUARIOPROGRAMA_ACESSAR] == 1)) || (!in_array($valor_do_ind_sub_men[MENU_PROGRAMA], $ProgramasAcessarPerfilSubMenu[0]) && $ProgramasAcessarEspecificoUsuarioSubMenu[0][USUARIOPROGRAMA_ACESSAR] == 1)) {
                                        ?>
                                        <li><a tabindex="-1" href="<?PHP echo $valor_do_ind_sub_men[MENU_DESTINO]; ?>" style="color:<?php echo $objUsuario->getCorTextoMenu(); ?>;"> <?PHP echo preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $valor_do_ind_sub_men[MENU_DESCRICAO_CURTA])); ?> </a></li>
                                        <?PHP
                                    }
                                }
                                $SubMenus = null;
                                ?>
                            </ul>
                        </li>
                        <?PHP
                    }
                }
                ?>


                <?PHP
//Busca o parametro que identifica o dia e hora para derrubar o sistema, caso esteja vazio nao faz nada
                $Derruba = buscaValorPadraoPorNome("Logoff Sistema");

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

                    if (!is_null($Volta) && $Volta != '') {
                        $Volta = buscaValorPadraoPorNome("Fim Logoff Sistema");
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
                    }

                    $Agora = date("Y-m-d H:i");

                    if (strtotime($DateTimederruba) >= strtotime($Agora)) {

                        echo "
                            <li>
                    
                            <iframe src='regressivo.php' scrolling='no' style='
                                border: none;
                                width: 30.4em;
                                height: 4em;
                                '>
                            </iframe>
                    
                            </li>
                            ";
                    } elseif (strtotime($DateTimederruba) <= strtotime($Agora) && strtotime($DateTimeVolta) >= strtotime($Agora)) {
                        echo "
                            <li>
                             <div class='panel-body'>
                             <a href='javascript:;' class='btn btn-danger' id='pulsate-regular'><strong>Atenção!</strong> Portal fora do ar.</a>
                             </div>
                             </li>
                             
                            ";
                        if (strtoupper(trim($objPerfil->getNome())) != "ADMINISTRADOR") {
                            $ObjFuncionalidades->ExibeMensagem("O sistema esta temporariamente em manutencao, tente novamente mais tarde.");
                            session_destroy();
                            $ObjFuncionalidades->Redirecionar("../index.php");
                        }
                    }
                }
                ?>

            </ul>
        </div>
        <div class="top-nav ">
            <ul class="nav pull-right top-menu"  >

                <!-- notification dropdown start-->
                <?PHP if ($Permissoes['PTV0026']['ACESSAR'] == 1 || $Permissoes['PTV0024']['ACESSAR'] == 1) { ?>
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false"  style="color:<?php echo $objUsuario->getCorTextoMenu(); ?>;">
                            <i class="fa fa-bell-o"></i>

                            <button class="badge bg-warning" id='SinetaGeral'></button>
                        </a>
                        <ul class="dropdown-menu extended notification" style="right: 0;">

                            <li class="text-center">
                                <p class="yellow">
                                    Pedidos
                                </p>
                            </li>
                            <?PHP if ($Permissoes['PTV0024']['ACESSAR'] == 1) { ?>
                                <li>
                                    <p style="padding: 0px;">
                                        <a href="Aprovacao.php?First=true">Aprovação Comercial
                                            <button class="small italic btn btn-xs btn-danger" style="margin-left: 60px;" id='SinetaPedidosValue'></button>
                                        </a>
                                    </p>
                                </li>

                                <?PHP
                            }
                            if ($objPerfil->getAprovaFinanceiro() == 1) {
                                ?>
                                <li>
                                    <p style="padding: 0px;">
                                        <a href="MarcacaoPedido.php">Aprovação Financeira
                                            <button class="small italic btn btn-xs btn-danger" style="margin-left: 60px;" id='SinetaPedidosFinanceiroValue'></button>
                                        </a>
                                    </p>
                                </li>
                                <?PHP
                            }
                            if ($Permissoes['PTV0026']['ACESSAR'] == 1) {
                                ?>
                                <li class="text-center">
                                    <p class="yellow">
                                        Clientes
                                    </p>
                                </li>
                                <li>
                                    <p style="padding: 0px;">
                                        <a href="AprovacaoCliente.php">Clientes para aprovar
                                            <button class="small italic btn btn-xs btn-danger" style="margin-left: 60px;" id='SinetaClientesValue'></button>
                                        </a>
                                    </p>
                                </li>
                            <?PHP } ?>
                        </ul>
                    </li>
                <?php } ?>

                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <?PHP if ($objUsuario->getImagem() != "") { ?>
                            <img width="30px" height="30px" alt="" src="../Public/img/Usuarios/<?PHP echo $objUsuario->getImagem(); ?>">
                        <?PHP } ?>
                        <span class="username"  style="color:<?php echo $objUsuario->getCorTextoMenu(); ?>;"><?PHP echo $objUsuario->getNome(); ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li style="width:100%"><a href="#GLOBALModalCoresMenu" data-toggle="modal"><i class="fa fa-tint"></i> Cores</a></li>
                        <li><a href="../Controller/Deslogar.php"><i class="fa fa-key"></i> Sair</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
                <li class="sb-toggle-right" title="Opções do Representate">
                    <i class="fa  fa-align-right" style="color:<?php echo $objUsuario->getCorTextoMenu(); ?>;"></i>
                </li>
            </ul>
        </div>
    </div>

    <!-- INÍCIO MODAL CORES DO MENU -->
    <div class="modal fade in  " id="GLOBALModalCoresMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content-wrap">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Paleta de Cores</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <label for="Pesquisa">Cor Fundo Menu</label>
                                        <input type="color" class="form-control" id="GLOBALCorFundoMenu" name="GLOBALCorFundoMenu" style="width: 100%;height: 60px;" value="<?php echo $objUsuario->getCorMenu(); ?>" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="Pesquisa">Cor Texto Menu</label>
                                        <input type="color" class="form-control" id="GLOBALCorTextoMenu" name="GLOBALCorTextoMenu" style="width: 100%;height: 60px;" value="<?php echo $objUsuario->getCorTextoMenu(); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="button" onclick="GLOBALSalvarCoresMenu()">Salvar</button> 
                            <button class="btn btn-warning" type="button" onclick="GLOBALLimparModalCoresMenu()">Limpar</button>
                            <button data-dismiss="modal" class="btn btn-danger" type="button">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIM MODAL CORES DO MENU -->

    <script type='text/javascript'>


        var GLOBALCorTextoMenu = '';
        var GLOBALCorFundoMenu = '';
        var xhr = new XMLHttpRequest();

        function GLOBALLimparModalCoresMenu()
        {
            document.getElementById('GLOBALCorFundoMenu').value = "#ffffff";
            document.getElementById('GLOBALCorTextoMenu').value = "#000000";
        }

        function GLOBALSalvarCoresMenu()
        {
            GLOBALCorFundoMenu = document.getElementById('GLOBALCorFundoMenu').value;
            GLOBALCorTextoMenu = document.getElementById('GLOBALCorTextoMenu').value;

            GLOBALCorFundoMenu = GLOBALCorFundoMenu.replace("#", "");
            GLOBALCorTextoMenu = GLOBALCorTextoMenu.replace("#", "");

            xhr = new XMLHttpRequest();
            xhr.open("GET", "../Controller/API.php?function=AlterarCoresMenu&CorFundoMenu=" + GLOBALCorFundoMenu + "&CorTextoMenu=" + GLOBALCorTextoMenu, true);
            xhr.onload = function (e) {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        response = JSON.parse(xhr.responseText);
                        if (response.status === 'true') {
                            alert('Cores alteradas com sucesso!');
                        } else if (response.status === 'false') {
                            alert('Erro ao alterar as cores!');
                        }
                        location.reload();
                    } else {
                        response = JSON.parse(xhr.responseText);
                        alert(response);
                        alert('Erro ao alterar as cores!');
                    }
                }
            };
            xhr.onerror = function (e) {
                console.error(xhr.statusText);
            };
            xhr.send();

        }

    </script>

</header>
