<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE);
//include_once '../Model/ItemVenda.Class.php';
include_once '../Controller/Session.php';
include_once '../Controller/DAONaoCotar.php';
include_once '../Controller/DAOTipoFrete.php';
include_once '../Controller/DAOMoeda.php';
include_once '../Controller/DAOCondicaoPagamento.php';
include_once '../Controller/DAOCotacao.php';
include_once '../Model/Moeda.Class.php';
include_once '../Model/CondicaoPagamento.Class.php';
include_once '../Model/TipoFrete.Class.php';
include_once '../Controller/DAOPedidoCompra.php';

$objItemVenda = new ItemVenda();
$objFuncionalidades = new Funcionalidades();

include_once '../Model/DAO.Class.php';

$ObjDao = new DAO();

if (isset($_REQUEST['Acao'])) {
    $dados = array();

    $dados['PDH_COD_FORNECEDOR'] = $objUsuarioLogado->getCodFornecedor();
    $dados['PDH_COD_EMPRESA'] = $_REQUEST['Empresa'];
    $dados['PDH_NUM_PEDIDO'] = $_REQUEST['Pedido'];
    $dados['PDH_DATA'] = date('Y-m-d');
    $dados['PDH_QTDE_ENTREGUE'] = 0;

    if ($_REQUEST['Acao'] == "AceitePedido") {

        $dados['PDH_ID_ACAO'] = 1;
        $dados['PDH_OBSERVACAO'] = "";

        $id = CadastraPedidoCompra($dados);
        $mensagem = "Pedido {$_REQUEST['Pedido']} aceito.";
    } elseif ($_REQUEST['Acao'] == "RecusaPedido") {
        $dados['PDH_ID_ACAO'] = 2;
        $dados['PDH_OBSERVACAO'] = $_REQUEST['Observacao'];
        $dados['PDH_NOVA_DATA'] = $_REQUEST['NovaData'];

        $id = CadastraPedidoCompra($dados);
        $mensagem = "Pedido {$_REQUEST['Pedido']} recusado.<br/> Nova data proposta: {$_REQUEST['NovaData']}<br/> Obs: " . $_REQUEST['Observacao'];
    }

    $objUsuarioComprador = new Usuario();

    $objUsuarioComprador = BuscaUsuarioPorCodComprador($_REQUEST['Comprador']);

    if ($objUsuarioComprador->getEmail() != "") {
        $destinatarios[0]['nome'] = $objUsuarioComprador->getNome();
        $destinatarios[0]['email'] = $objUsuarioComprador->getEmail();
    }

    //$objFuncionalidades->enviaEmail($destinatarios, "Aceite/ nao aceite do pedido", $mensagem, "");
    $objFuncionalidades->Redirecionar("PedidoCompra.php");
}

if (isset($_REQUEST['Acao'])) {
    $Acao = $_REQUEST['Acao'];
} else {
    $Acao = "";
}

$situacoes = array();
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

        <title>Pedido compra</title>

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

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="full-width">

        <section id="container" class="">
            <!--header start-->
            <!--header end-->
            <!--sidebar start-->
            <?php include_once './Menu.php'; ?>
            <!--sidebar end-->
            <!--main content start-->
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <?PHP if ($Acao == "") { ?>
                            <div class="col-lg-12">

                                <div class="panel panel-default">

                                    <form id="carregar" action="PedidoCompra.php" name="carregar" method="post">
                                        <div class="panel-heading">
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label class="col-2 col-form-label">Fornecedor</label>
                                                    <input type="text" <?PHP echo $objUsuarioLogado->getCodFornecedor() != "" ? " readonly " : ""; ?> class="form-control" id="filtroPorFornecedor" name="filtroPorFornecedor" placeholder="Fornecedor" value="<?PHP echo $objUsuarioLogado->getCodFornecedor() != "" ? $objUsuarioLogado->getCodFornecedor() : $_REQUEST['filtroPorFornecedor']; ?>"/>
                                                </div>
                                                <?PHP if ($objUsuarioLogado->getCodComprador() != "" || ($objUsuarioLogado->getCodComprador() == "" && $objUsuarioLogado->getCodFornecedor() == "")) { ?>
                                                    <div class="form-group row">
                                                        <div class="col-sm-3">
                                                            <label class="col-2 col-form-label">Comprador</label>
                                                            <input type="text" class="form-control" id="filtroPorComprador" name="filtroPorComprador" placeholder="Comprador" value="<?PHP echo ($_REQUEST['filtroPorComprador'] == "" && $_REQUEST['Filtrar'] == "") ? $objUsuarioLogado->getCodComprador() : $_REQUEST['filtroPorComprador']; ?>"/>
                                                        </div>
                                                    </div>     
                                                <?PHP } ?>
                                                <div class="col-sm-2">
                                                    <label for="filtroPorNumero" class="col-2 col-form-label">Pedido</label>
                                                    <input type="text" class="form-control" maxlength="15" id="filtroPorNumero" name="filtroPorNumero" placeholder="Número" value="<?PHP echo $_REQUEST['filtroPorNumero'] ?>" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="filtroPorCodigo" class="col-2 col-form-label">Código do item</label>
                                                    <input type="text" class="form-control" maxlength="15" id="filtroPorCodigo" name="filtroPorCodigo" placeholder="Código" value="<?PHP echo $_REQUEST['filtroPorCodigo'] ?>" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-2 col-form-label">Empresa</label>
                                                    <select name='filtroPorEmpresa' id="filtroPorEmpresa" class="form-control">
                                                        <?PHP
                                                        $ListaEmpresas = listaEmpresas();
                                                        while ($row = $ListaEmpresas->fetch(PDO::FETCH_BOTH)) {
                                                            if (in_array($row[0], explode(",", $objUsuario->getEmpresa()))) {
                                                                if ($_REQUEST['filtroPorEmpresa'] == $row[0]) {
                                                                    echo "<option id='filtroPorEmpresa' selected value='" . $row[0] . "'>" . $row[0] . " - " . $row[1] . "</option>";
                                                                } else {
                                                                    echo "<option id='filtroPorEmpresa' value='" . $row[0] . "'>" . $row[0] . " - " . $row[1] . "</option>";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="filtroPorDataVencimento" class="col-2 col-form-label">Entrega prevista até</label>
                                                    <input type="date" class="form-control" id="filtroPorDataVencimento" name="filtroPorDataVencimento" value="<?PHP echo $_REQUEST['filtroPorDataVencimento']; ?>"/>
                                                </div>
                                            </div>       

                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <label for="filtroPorSituacao" class="col-2 col-form-label">Situação</label>
                                                    <div  id='situacao' style="margin-top:3px;">
                                                        <input type='checkbox' <?PHP echo ($_REQUEST['filtroPorSituacaoAberto'] == "A") ? " checked " : ""; ?> class='form-group' id='filtroPorSituacaoAberto' name='filtroPorSituacaoAberto' value='A'/>
                                                        <label for="filtroPorSituacao" style="font-weight: 300; margin-right: 5px;">Aberto</label>
                                                        <input type='checkbox' class='form-group'  <?PHP echo ($_REQUEST['filtroPorSituacaoRealizado'] == "R") ? " checked " : ""; ?>  id='filtroPorSituacaoRealizado' name='filtroPorSituacaoRealizado' value='R'/>
                                                        <label for='filtroPorSituacao' style='font-weight: 300; margin-right: 5px;'>Realizado</label>
                                                        <input type='checkbox' <?PHP echo ($_REQUEST['filtroPorSituacaoLiquidado'] == "L") ? " checked " : ""; ?>  class='form-group' maxlength='255' id='filtroPorSituacaoLiquidado' name='filtroPorSituacaoLiquidado' value='L'/>
                                                        <label for='filtroPorSituacao' style='font-weight: 300; margin-right: 5px;'>Liquidado</label>
                                                        <input type='checkbox' <?PHP echo ($_REQUEST['filtroPorSituacaoCancelado'] == "C") ? " checked " : ""; ?>  class='form-group' maxlength='255' id='filtroPorSituacaoCancelado' name='filtroPorSituacaoCancelado' value='C'/>
                                                        <label for='filtroPorSituacao' style='font-weight: 300; margin-right: 5px;'>Cancelado</label>
                                                        <input type='checkbox' <?PHP echo ($_REQUEST['filtroPorSituacaoSuspenso'] == "S") ? " checked " : ""; ?>  class='form-group' maxlength='255' id='filtroPorSituacaoSuspenso' name='filtroPorSituacaoSuspenso' value='S'/>
                                                        <label for='filtroPorSituacao' style='font-weight: 300; margin-right: 5px;'>Suspenso</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 pull-right" align="right">
                                                    <input type="submit" name="Filtrar" id="Filtrar" onclick="return ValidaFiltros();" class="btn btn-primary" value="Buscar" />
                                                    <input type="reset" name="Limpar" class="btn btn-primary" value="Limpar"/>
                                                </div>
                                            </div>
                                        </div>

                                    </form>


                                    <div class="panel-body">
                                        <?php
                                        if (isset($_REQUEST['Filtrar'])) {
                                            $FiltroPaginacao .= "&Filtrar=" . $_REQUEST['Filtrar'];
                                            include_once '../Controller/Paginacao.Class.php';
                                            include_once '../Model/Funcionalidades.Class.php';

                                            $ObjFuncionalidades = new Funcionalidades();
                                            //Define indice principal da tabela
                                            $Indice = "";
                                            //Define a tabela que trabalharemos
                                            $Tabela = "pedido_sup p ";
                                            //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                            $Filtro = "";
                                            //Informamos os campos que iremos buscar no banco
                                            $Campos = "*";
                                            //Montamos um array pra fazer a exibição dos resultados em tabela
                                            if ($objUsuarioLogado->getCodFornecedor() == "") {

                                                $Grid = [
                                                    'Número' => "NUM_PEDIDO",
                                                    'Quantidade Item' => "Quantidade Item",
                                                    'Total' => "Total",
                                                    'Fornecedor' => 'COD_FORNECEDOR',
                                                    'Empresa' => "COD_EMPRESA",
                                                    'Situacao' => "IES_SITUA_PED",
                                                ];
                                            } else {
                                                $Grid = [
                                                    'Número' => "NUM_PEDIDO",
                                                    'Quantidade Item' => "Quantidade Item",
                                                    'Total' => "Total",
                                                    'Empresa' => "COD_EMPRESA",
                                                    'Situacao' => "IES_SITUA_PED",
                                                ];
                                            }

                                            $SeqFiltro = 0;
                                            //Criamos uma condição where padrão para as pesquisas de tabela
                                            $Where = " order by p.ies_situa_ped DESC ";

                                            if ($objUsuarioLogado->getInterno() == 1) {
                                                $target = "target='_BLANK'";
                                            } else {
                                                $target = " ";
                                            }

                                            $Filtro .= "p.ies_versao_atual = 'S' and
                                                        p.cod_empresa IN (1, 2) and 
                                                                 p.dat_emis > MDY('04','08','2018') and
                                                                 p.IES_SITUA_PED <> 'A' and 
                                                        EXISTS (SELECT 1 FROM ordem_sup o WHERE o.num_pedido = p.num_pedido 
                                                        AND o.ies_versao_atual = 'S' AND o.cod_empresa = p.cod_empresa  AND o.num_versao_pedido = p.num_versao	) ";

                                            /* if ($objUsuarioLogado->getCodFornecedor() != "") {
                                              $Filtro .= " and ies_situa_ped IN ('R', 'L')";
                                              } */

                                            $SeqFiltro++;


                                            //Filtra as cotações por empresa
                                            if ($_REQUEST['filtroPorEmpresa'] != "") {
                                                $FiltroPaginacao .= "&filtroPorEmpresa=" . $_REQUEST['filtroPorEmpresa'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (p.cod_empresa = '" . strtoupper($_REQUEST['filtroPorEmpresa']) . "')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (p.cod_empresa = '" . strtoupper($_REQUEST['filtroPorEmpresa']) . "')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            //Filtra as cotações por Fornecedor
                                            if ($_REQUEST['filtroPorFornecedor'] != "") {
                                                $FiltroPaginacao .= "&filtroPorFornecedor=" . $_REQUEST['filtroPorFornecedor'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (p.cod_fornecedor = '" . strtoupper($_REQUEST['filtroPorFornecedor']) . "')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (p.cod_fornecedor = '" . strtoupper($_REQUEST['filtroPorFornecedor']) . "')";
                                                    $SeqFiltro++;
                                                }
                                            }


                                            if ($SeqFiltro > 0 && ($_REQUEST['filtroPorSituacaoAberto'] != "" ||
                                                    $_REQUEST['filtroPorSituacaoRealizado'] != "" || $_REQUEST['filtroPorSituacaoLiquidado'] != "" || $_REQUEST['filtroPorSituacaoCancelado'] != "" ||
                                                    $_REQUEST['filtroPorSituacaoSuspenso'] != "")) {
                                                $Filtro .= " AND (";
                                            }
                                            $seqFiltroStatus = 0;

                                            if ($_REQUEST['filtroPorSituacaoAberto'] != "") {
                                                $FiltroPaginacao .= "&filtroPorSituacaoAberto=" . $_REQUEST['filtroPorSituacaoAberto'];
                                                $Filtro .= "  (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoAberto']) . "')";
                                                $SeqFiltro++;
                                                $seqFiltroStatus++;
                                            }
                                            if ($_REQUEST['filtroPorSituacaoRealizado'] != "") {
                                                $FiltroPaginacao .= "&filtroPorSituacaoRealizado=" . $_REQUEST['filtroPorSituacaoRealizado'];
                                                if ($seqFiltroStatus > 0) {
                                                    $Filtro .= " OR (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoRealizado']) . "')";
                                                    $SeqFiltro++;
                                                    $seqFiltroStatus++;
                                                } else {
                                                    $Filtro .= " (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoRealizado']) . "')";
                                                    $SeqFiltro++;
                                                    $seqFiltroStatus++;
                                                }
                                            }
                                            if ($_REQUEST['filtroPorSituacaoLiquidado'] != "") {
                                                $FiltroPaginacao .= "&filtroPorSituacaoLiquidado=" . $_REQUEST['filtroPorSituacaoLiquidado'];
                                                if ($seqFiltroStatus > 0) {
                                                    $Filtro .= " OR (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoLiquidado']) . "')";
                                                    $SeqFiltro++;
                                                    $seqFiltroStatus++;
                                                } else {
                                                    $Filtro .= " (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoLiquidado']) . "')";
                                                    $SeqFiltro++;
                                                    $seqFiltroStatus++;
                                                }
                                            }
                                            if ($_REQUEST['filtroPorSituacaoCancelado'] != "") {
                                                $FiltroPaginacao .= "&filtroPorSituacaoCancelado=" . $_REQUEST['filtroPorSituacaoCancelado'];
                                                if ($seqFiltroStatus > 0) {
                                                    $Filtro .= " OR (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoCancelado']) . "')";
                                                    $SeqFiltro++;
                                                    $seqFiltroStatus++;
                                                } else {
                                                    $Filtro .= " (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoCancelado']) . "')";
                                                    $SeqFiltro++;
                                                    $seqFiltroStatus++;
                                                }
                                            }
                                            if ($_REQUEST['filtroPorSituacaoSuspenso'] != "") {
                                                $FiltroPaginacao .= "&filtroPorSituacaoSuspenso=" . $_REQUEST['filtroPorSituacaoSuspenso'];
                                                if ($seqFiltroStatus > 0) {
                                                    $Filtro .= " OR (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoSuspenso']) . "')";
                                                    $SeqFiltro++;
                                                    $seqFiltroStatus++;
                                                } else {
                                                    $Filtro .= " (p.ies_situa_ped = '" . strtoupper($_REQUEST['filtroPorSituacaoSuspenso']) . "')";
                                                    $SeqFiltro++;
                                                    $seqFiltroStatus++;
                                                }
                                            }
                                            if (($_REQUEST['filtroPorSituacaoAberto'] != "" ||
                                                    $_REQUEST['filtroPorSituacaoRealizado'] != "" || $_REQUEST['filtroPorSituacaoLiquidado'] != "" || $_REQUEST['filtroPorSituacaoCancelado'] != "" ||
                                                    $_REQUEST['filtroPorSituacaoSuspenso'] != "")) {
                                                $Filtro .= " )";
                                            }

                                            //Filtra as cotações por número
                                            if ($_REQUEST['filtroPorNumero'] != "") {
                                                $FiltroPaginacao .= "&filtroPorNumero=" . $_REQUEST['filtroPorNumero'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (p.num_pedido = '" . strtoupper($_REQUEST['filtroPorNumero']) . "')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (p.num_pedido = '" . strtoupper($_REQUEST['filtroPorNumero']) . "')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            //Filtra as cotações por código de item
                                            if ($_REQUEST['filtroPorCodigo'] != "") {
                                                $FiltroPaginacao .= "&filtroPorCodigo=" . $_REQUEST['filtroPorCodigo'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (EXISTS(SELECT 1 FROM ordem_sup o
							   WHERE o.num_pedido = p.num_pedido AND o.cod_empresa = p.cod_empresa AND o.ies_situa_oc = 'R'
							   AND o.ies_versao_atual = 'S' AND o.cod_item = '" . strtoupper($_REQUEST['filtroPorCodigo']) . "')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (EXISTS(SELECT 1 FROM ordem_sup o
							   WHERE o.num_pedido = p.num_pedido AND o.cod_empresa = p.cod_empresa AND o.ies_situa_oc = 'R'
							   AND o.ies_versao_atual = 'S' AND o.cod_item = '" . strtoupper($_REQUEST['filtroPorCodigo']) . "')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            if ($_REQUEST['filtroPorComprador'] != "") {
                                                $FiltroPaginacao .= "&filtroPorComprador=" . $_REQUEST['filtroPorComprador'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (p.cod_comprador = '{$_REQUEST['filtroPorComprador']}')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (p.cod_comprador = '{$_REQUEST['filtroPorComprador']}')";
                                                    $SeqFiltro++;
                                                }
                                            }
                                            //Filtra as cotações por data de vencimento
                                            if ($_REQUEST['filtroPorDataVencimento'] != "") {
                                                $data = explode("-", $_REQUEST['filtroPorDataVencimento']);
                                                $FiltroPaginacao .= "&filtroPorDataVencimento=" . $_REQUEST['filtroPorDataVencimento'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND EXISTS(SELECT 1 FROM prog_ordem_sup d, ordem_sup o WHERE 
				p.cod_empresa = o.cod_empresa AND o.cod_empresa = d.cod_empresa AND
				p.num_pedido = o.num_pedido AND o.num_oc = d.num_oc AND
				p.ies_versao_atual = 'S' AND o.ies_versao_atual = 'S' AND
				d.dat_entrega_prev <= MDY('{$data[1]}','{$data[2]}','{$data[0]}'))";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " EXISTS(SELECT 1 FROM prog_ordem_sup d, ordem_sup o WHERE 
				p.cod_empresa = o.cod_empresa AND o.cod_empresa = d.cod_empresa AND
				p.num_pedido = o.num_pedido AND o.num_oc = d.num_oc AND
				p.ies_versao_atual = 'S' AND o.ies_versao_atual = 'S' AND
				d.dat_entrega_prev <= MDY('{$data[1]}','{$data[2]}','{$data[0]}'))";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            $Paginacao = new Paginacao($Tabela, $Filtro);

                                            $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, $Paginacao->Atual, $Paginacao->Limite, NULL, " ORDER BY {$Indice} ASC ");

                                            if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
                                                ?>
                                                <form action="../Controller/GeraRelatorioCotacao.php"  method="post" name="exportarCotacao" id="exportarCotacao">
                                                    <?PHP
                                                    echo "</div>";
                                                    echo "<table id=\"{$Tabela}\" class=\"table table-bordered table-striped table-condensed\">";
                                                    echo "<thead><tr>";
                                                    //montamos o grid - nome titulo do resultado
                                                    foreach ($Grid as $key => $value) {
                                                        echo "<th class=\"text-center\">{$key}</th>";
                                                    }
                                                    echo "<th> </th>";

                                                    echo "</tr>\n</thead><tbody>";
                                                    $i = ($Paginacao->Pagina < 1) ? 0 : ($Paginacao->Pagina) * $Paginacao->Limite;
                                                    foreach ($Consultar as $value) {


                                                        ++$i;
                                                        echo "<tr id=\"tr{$value["{$Indice}"]}\" class=\"excluir text-center\">\n";

//montamos o formulario de exclusão
                                                        //montandos o grid - resultado
                                                        $countItem = 0;

                                                        foreach ($Grid as $rs) {
                                                            if ($rs == "IES_SITUA_PED") {
                                                                if ($value[$rs] == "A") {
                                                                    $status = "Aberto";
                                                                } elseif ($value[$rs] == "R") {
                                                                    $status = "Realizado";
                                                                } elseif ($value[$rs] == "L") {
                                                                    $status = "Liquidado";
                                                                } elseif ($value[$rs] == "C") {
                                                                    $status = "Cancelado";
                                                                } elseif ($value[$rs] == "S") {
                                                                    $status = "Suspenso";
                                                                }
                                                                echo "<td class=\"wordbreak\">" . $status . "</td>";
                                                            } elseif ($rs == "Quantidade Item") {
                                                                $qtdItens = $ObjDao->ConsultarCustom("SELECT COUNT(*) FROM ORDEM_SUP WHERE num_pedido = {$value['NUM_PEDIDO']} and cod_empresa = '{$value['COD_EMPRESA']}' and ies_versao_atual = 'S'")->fetch(PDO::FETCH_BOTH);

                                                                echo "<td class=\"wordbreak\">" . $objFuncionalidades->FormatarMoeda($qtdItens[0], 2) . " item(ns)</td>";
                                                            } elseif ($rs == "Total") {
                                                                $qtdItens = $ObjDao->ConsultarCustom("SELECT sum(qtd_solic*pre_unit_oc) FROM ORDEM_SUP WHERE num_pedido = {$value['NUM_PEDIDO']} and cod_empresa = '{$value['COD_EMPRESA']}' and ies_versao_atual = 'S'")->fetch(PDO::FETCH_BOTH);

                                                                echo "<td class=\"wordbreak\">" . $objFuncionalidades->FormatarMoeda($qtdItens[0], 2) . "</td>";
                                                            } elseif ($rs == "COD_FORNECEDOR") {
                                                                echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString(buscaNomeFornecedor($value["{$rs}"])) . "</td>";
                                                            } else {
                                                                echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td>";
                                                            }
                                                            $countItem++;
                                                        }
                                                        echo "<td class=\"col-sm-2 text-center\">";
                                                        if ($value['IES_SITUA_PED'] != "L" && $value['IES_SITUA_PED'] != "C") {
                                                            ?>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                                            <a title='Aceite do pedido.' onclick="javascript: if (!confirm('Ao dar o aceite no pedido, você está concordando com as cláusulas existentes conforme contrato padrão da Perto/Digicon. Confirma o aceite do pedido?')) {
                                                                                        return false;
                                                                                    }" href="PedidoCompra.php?Acao=AceitePedido&Pedido=<?PHP echo $value['NUM_PEDIDO']; ?>&Empresa=<?PHP echo $value['COD_EMPRESA']; ?>&Comprador=<?PHP echo $value['COD_COMPRADOR']; ?>"><i class="fa fa-thumbs-o-up"></i></a>

                                                            <a title='Recusa do pedido.' onclick="abreRecusa('<?PHP echo $value['NUM_PEDIDO']; ?>', '<?PHP echo $value['COD_EMPRESA']; ?>', '<?PHP echo $value['COD_COMPRADOR']; ?>');" href="#"><i class="fa fa-thumbs-o-down"></i></a>

                                                            <?PHP
                                                        }
                                                        $status = buscaStatusPedido($value['NUM_PEDIDO'], $value['COD_EMPRESA'], ($objUsuarioLogado->getCodFornecedor() != "") ? $objUsuarioLogado->getCodFornecedor() : $value['COD_FORNECEDOR']);
                                                        if ($status == 1) {
                                                            echo "| Status atual: <strong>Pedido aceito</strong><br /><br />";
                                                        } elseif ($status == 2) {
                                                            $obs = buscaObservacaoPedido($value['NUM_PEDIDO'], $value['COD_EMPRESA'], ($objUsuarioLogado->getCodFornecedor() != "") ? $objUsuarioLogado->getCodFornecedor() : $value['COD_FORNECEDOR']);
                                                            echo "| Status atual: <strong>Pedido recusado</strong><br />";
                                                            echo "<strong>{$obs}</strong><br />";
                                                        }

                                                        echo "</td>\n";
                                                        echo "</tr>\n";
                                                    }
                                                    echo "</tbody></table>";
                                                    ?> </form><?PHP
                                                $Paginacao->MontaPaginas(addslashes($FiltroPaginacao));
                                            } else {
                                                echo "<p class=\"text-center\">Nenhum registro encontrado!</p>";
                                            }
                                            echo "</div>";
//Criar condicao se Acao == Incluir e|ou Alterar
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?PHP
                        }
                        ?>         
                    </div>   

                    <!-- importacao -->
                    <div class="modal fade " id="ModalRecusa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content-wrap">
                                <form id="carregar" action="PedidoCompra.php?Acao=RecusaPedido" name="carregar" method="post" enctype='multipart/form-data' >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Cadastro</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <label for="Nome">Observação</label>
                                                    <textarea tabindex="15" required="" class="form-control" maxlength="255" rows="4" id="Observacao" name="Observacao"></textarea>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="Nome">Nova Data</label>
                                                    <input type="date" class="form-control m-bot15" id="NovaData" name="NovaData" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" class="form-control m-bot15" id="Pedido" name="Pedido" value="" />
                                            <input type="hidden" class="form-control m-bot15" id="Empresa" name="Empresa" value="" />
                                            <input type="hidden" class="form-control m-bot15" id="Comprador" name="Comprador" value="" />
                                            <input type="submit" name="Cotar" id="Cotar" class="btn btn-info" value="Confirmar" />    
                                            <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- fim modal importacao -->
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

        <script src="../Public/js/respond.min.js" ></script>
        <script type="text/javascript" src="../Public/assets/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="../Public/js/jquery.pulsate.min.js"></script>
        <script src="../Public/js/pulstate.js" type="text/javascript"></script>

        <script>

                                                            function abreRecusa(pedido, empresa, comprador) {
                                                                document.getElementById('Pedido').value = pedido;
                                                                document.getElementById('Empresa').value = empresa;
                                                                document.getElementById('Comprador').value = comprador;
                                                                $("#ModalRecusa").modal('show');

                                                            }
        </script>


    </body>

    <!-- Mirrored from thevectorlab.net/flatlab/dynamic_table.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Mar 2015 13:32:07 GMT -->
</html>

