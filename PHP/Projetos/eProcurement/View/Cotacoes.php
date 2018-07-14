<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE);
//include_once '../Model/ItemVenda.Class.php';
include_once '../Model/NaoCotar.Class.php';
include_once '../Controller/Session.php';
include_once '../Controller/DAONaoCotar.php';
include_once '../Controller/DAOTipoFrete.php';
include_once '../Controller/DAOMoeda.php';
include_once '../Controller/DAOCondicaoPagamento.php';
include_once '../Controller/DAOCotacao.php';
include_once '../Model/Moeda.Class.php';
include_once '../Model/Cotacao.Class.php';
include_once '../Model/CondicaoPagamento.Class.php';
include_once '../Model/TipoFrete.Class.php';

$objItemVenda = new ItemVenda();
$objFuncionalidades = new Funcionalidades();
$objCotar = new Cotacao();

include_once '../Model/DAO.Class.php';

$ObjDao = new DAO();

if (isset($_POST['Cotar'])) {
    if ($_REQUEST['Acao'] == "Importar") {
        $id = CadastraCotacaoImportar($_REQUEST, $_FILES);
        $objFuncionalidades->Redirecionar("Cotacoes.php");
    } else {
        $id = CadastraCotacao($_REQUEST);
        $objFuncionalidades->Redirecionar("Cotacoes.php");
    }
}

if (isset($_REQUEST['Acao'])) {
    $Acao = $_REQUEST['Acao'];
} else {
    $Acao = "";
}

$situacoes = array();

if ($_REQUEST['sit-cota-realizada'] != "") {
    array_push($situacoes, $_REQUEST['sit-cota-realizada']);
}

if ($_REQUEST['sit-cota-n-respondida'] != "") {
    array_push($situacoes, $_REQUEST['sit-cota-n-respondida']);
}

if ($_REQUEST['sit-cota-n-cotadas'] != "") {
    array_push($situacoes, $_REQUEST['sit-cota-n-cotadas']);
}

if ($Acao == "NaoCotar") {
    CadastraNaoCotar($_REQUEST);
    $id = $objFuncionalidades->Redirecionar("Cotacoes.php");
}

if ($objUsuarioLogado->getCodFornecedor() == "") {
    $readOnly = " readonly = ''; ";
} else {
    $readOnly = " ";
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

        <title>Cotações</title>

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

                                    <form id="carregar" action="Cotacoes.php" name="carregar" method="post">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-sm-5"></div>
                                                <div class="col-sm-2">
                                                    <a class="btn btn-primary" href="#ModalCadastroImportar" data-toggle="modal"><i class="fa fa-file-o"> Importar Cotações</i></a>
                                                </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label class="col-2 col-form-label">Fornecedor</label>
                                                    <input type="text" <?PHP echo $objUsuarioLogado->getCodFornecedor() != "" ? " readonly " : ""; ?> class="form-control" id="filtroPorFornecedor" name="filtroPorFornecedor" placeholder="Fornecedor" value="<?PHP echo $objUsuarioLogado->getCodFornecedor() != "" ? $objUsuarioLogado->getCodFornecedor() : $_REQUEST['filtroPorFornecedor']; ?>"/>
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
                                                <div class="col-sm-2">
                                                    <label for="filtroPorNumero" class="col-2 col-form-label">Número</label>
                                                    <input type="text" class="form-control" maxlength="15" id="filtroPorNumero" name="filtroPorNumero" placeholder="Número" value="<?PHP echo $_REQUEST['filtroPorNumero'] ?>" />
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="filtroPorCodigo" class="col-2 col-form-label">Código do item</label>
                                                    <input type="text" class="form-control" maxlength="15" id="filtroPorCodigo" name="filtroPorCodigo" placeholder="Código" value="<?PHP echo $_REQUEST['filtroPorCodigo'] ?>" />
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="filtroPorDataVencimento" class="col-2 col-form-label">Vencimento de</label>
                                                    <input type="date" class="form-control" id="filtroPorDataVencimento" name="filtroPorDataVencimento" value="<?PHP echo ($_REQUEST['filtroPorDataVencimento'] == "") ? date('Y-m-d') : $_REQUEST['filtroPorDataVencimento']; ?>"/>
                                                </div>
                                            </div>       
                                            <?PHP if ($objUsuarioLogado->getCodComprador() != "" || ($objUsuarioLogado->getCodComprador() == "" && $objUsuarioLogado->getCodFornecedor() == "")) { ?>
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <label class="col-2 col-form-label">Comprador</label>
                                                        <input type="text" class="form-control" id="filtroPorComprador" name="filtroPorComprador" placeholder="Comprador" value="<?PHP echo ($_REQUEST['filtroPorComprador'] == "" && $_REQUEST['Filtrar'] == "") ? $objUsuarioLogado->getCodComprador() : $_REQUEST['filtroPorComprador']; ?>"/>
                                                    </div>
                                                </div>     
                                            <?PHP } ?>
                                            <div class="form-group row">
                                                <div class="col-sm-10">

                                                    <label for="filtroPorSituacao" class="col-2 col-form-label">Situação</label>
                                                    <div  id='situacao' style="margin-top:3px;">

                                                        <?PHP if ($_REQUEST['sit-cota-realizada'] != "") { ?>
                                                            <?PHP echo "<input type='checkbox' class='form-group' checked='true' id='filtroPorSituacao' name='sit-cota-realizada' value='1'/>"; ?>
                                                            <?PHP echo "<label for='filtroPorSituacao' style='font-weight: 300; margin-right: 5px;'>Cotação realizada</label>"; ?>
                                                        <?PHP } else { ?>
                                                            <input type="checkbox" class="form-group"  id="filtroPorSituacao" name="sit-cota-realizada" value="1"/>
                                                            <label for="filtroPorSituacao" style="font-weight: 300; margin-right: 5px;">Cotação realizada</label>
                                                        <?PHP } ?>

                                                        <?PHP if ($_REQUEST['sit-cota-n-respondida'] != "") { ?>
                                                            <?PHP echo "<input type='checkbox' class='form-group' checked='true' id='filtroPorSituacao' name='sit-cota-n-respondida' value='2'/>"; ?>
                                                            <?PHP echo "<label for='filtroPorSituacao' style='font-weight: 300; margin-right: 5px;'>Cotação não respondida</label>"; ?>
                                                        <?PHP } else { ?>
                                                            <input type="checkbox" class="form-group" id="filtroPorSituacao" name="sit-cota-n-respondida" value="2"/>
                                                            <label for="filtroPorSituacao" style="font-weight: 300; margin-right: 5px;">Cotação não respondida</label>  
                                                        <?PHP } ?>

                                                        <?PHP if ($_REQUEST['sit-cota-n-cotadas'] != "") { ?>
                                                            <?PHP echo "<input type='checkbox' class='form-group' checked='true' maxlength='255' id='filtroPorSituacao' name='sit-cota-n-cotadas' value='3'/>"; ?>
                                                            <?PHP echo "<label for='filtroPorSituacao' style='font-weight: 300; margin-right: 5px;'>Não cotadas</label>"; ?>
                                                        <?PHP } else { ?>
                                                            <input type="checkbox" class="form-group" maxlength="255" id="filtroPorSituacao" name="sit-cota-n-cotadas" value="3"/>
                                                            <label for="filtroPorSituacao" style="font-weight: 300; margin-right: 5px;">Não cotadas</label>
                                                        <?PHP } ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 pull-right" align="right">
                                                    <input type="submit" name="Filtrar" id="Filtrar" onclick="return ValidaFiltros();" class="btn btn-primary" value="Buscar" />
                                                    <input type="reset" name="Limpar" class="btn btn-primary" value="Limpar"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-10">

                                                </div>
                                                <div class="col-lg-2">
                                                <!--<input type="submit" name="Filtrar" id="Filtrar" onclick="return ValidaFiltros();" class="btn btn-primary" value="Buscar" />
                                                    <input type="reset" name="Limpar" class="btn btn-primary" value="Limpar"/>-->
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
                                            $Tabela = "ordem_sup o, ordem_sup_cot f, cotacao_preco c ";
                                            //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                            $Filtro = "";
                                            //Informamos os campos que iremos buscar no banco
                                            $Campos = " DISTINCT o.*, f.cod_fornecedor";
                                            //Montamos um array pra fazer a exibição dos resultados em tabela

                                            if ($objUsuarioLogado->getCodFornecedor() == "") {
                                                $Grid = [
                                                    'Número' => "NUM_OC",
                                                    'Item' => "COD_ITEM",
                                                    'Fornecedor' => 'COD_FORNECEDOR',
                                                    'Empresa' => "COD_EMPRESA",
                                                    'Quantidade' => "QTD_SOLIC",
                                                    'Vencimento' => "Vencimento",
                                                    'Situação' => "IES_SITUA_OC"
                                                ];
                                            } else {
                                                $Grid = [
                                                    'Número' => "NUM_OC",
                                                    'Item' => "COD_ITEM",
                                                    'Empresa' => "COD_EMPRESA",
                                                    'Quantidade' => "QTD_SOLIC",
                                                    'Vencimento' => "Vencimento",
                                                    //'Empresa' => "den_reduz",
                                                    'Situação' => "IES_SITUA_OC"
                                                ];
                                            }

                                            $SeqFiltro = 0;
                                            //Criamos uma condição where padrão para as pesquisas de tabela
                                            $Where = "ORDER BY {$Indice} DESC";

                                            if ($objUsuarioLogado->getInterno() == 1) {
                                                $target = "target='_BLANK'";
                                            } else {
                                                $target = " ";
                                            }

                                            $Filtro .= "o.ies_versao_atual = 'S' AND
                                    o.cod_empresa IN (1, 2) AND
                                    f.cod_empresa = o.cod_empresa AND
                                    f.num_oc = o.num_oc AND
                                    f.num_versao_oc = o.num_versao AND
                                    c.cod_empresa = f.cod_empresa AND
                                    c.cod_fornecedor = f.cod_fornecedor AND
                                    c.num_cotacao = f.num_cotacao AND
                                    c.num_versao = f.num_versao_cot AND
                                    c.ies_versao_atual = 'S' AND
                                    o.num_pedido = '0' AND
                                    o.cod_item = c.cod_item AND
                                    c.cod_item NOT LIKE '998.%'
                                    and o.ies_situa_oc <> 'P' and o.ies_situa_oc <> 'C' and o.ies_situa_oc <> 'L'
                                                    ";
                                            $SeqFiltro++;


                                            //Filtra as cotações por empresa
                                            if ($_REQUEST['filtroPorEmpresa'] != "") {
                                                $FiltroPaginacao .= "&filtroPorEmpresa=" . $_REQUEST['filtroPorEmpresa'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (f.cod_empresa = '" . strtoupper($_REQUEST['filtroPorEmpresa']) . "')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (f.cod_empresa = '" . strtoupper($_REQUEST['filtroPorEmpresa']) . "')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            //Filtra as cotações por Fornecedor
                                            if ($_REQUEST['filtroPorFornecedor'] != "") {
                                                $FiltroPaginacao .= "&filtroPorFornecedor=" . $_REQUEST['filtroPorFornecedor'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (f.cod_fornecedor = '" . strtoupper($_REQUEST['filtroPorFornecedor']) . "')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (f.cod_fornecedor = '" . strtoupper($_REQUEST['filtroPorFornecedor']) . "')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            //Filtra as cotações por número
                                            if ($_REQUEST['filtroPorNumero'] != "") {
                                                $FiltroPaginacao .= "&filtroPorNumero=" . $_REQUEST['filtroPorNumero'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (o.num_oc = '" . strtoupper($_REQUEST['filtroPorNumero']) . "')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (o.num_oc = '" . strtoupper($_REQUEST['filtroPorNumero']) . "')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            //Filtra as cotações por código de item
                                            if ($_REQUEST['filtroPorCodigo'] != "") {
                                                $FiltroPaginacao .= "&filtroPorCodigo=" . $_REQUEST['filtroPorCodigo'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (o.cod_item LIKE '%" . strtoupper($_REQUEST['filtroPorCodigo']) . "%')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (o.cod_item LIKE '%" . strtoupper($_REQUEST['filtroPorCodigo']) . "%')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            if ($_REQUEST['filtroPorComprador'] != "") {
                                                $FiltroPaginacao .= "&filtroPorComprador=" . $_REQUEST['filtroPorComprador'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (o.cod_comprador = '{$_REQUEST['filtroPorComprador']}')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (o.cod_comprador = '{$_REQUEST['filtroPorComprador']}')";
                                                    $SeqFiltro++;
                                                }
                                            }
                                            //Filtra as cotações por data de vencimento
                                            if ($_REQUEST['filtroPorDataVencimento'] != "") {
                                                $data = explode("-", $_REQUEST['filtroPorDataVencimento']);
                                                $FiltroPaginacao .= "&filtroPorDataVencimento=" . $_REQUEST['filtroPorDataVencimento'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (c.dat_limite <= MDY('{$data[1]}','{$data[2]}','{$data[0]}') OR c.dat_limite IS NULL)";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (c.dat_limite <= MDY('{$data[1]}','{$data[2]}','{$data[0]}') OR c.dat_limite IS NULL)";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            //Filtra as cotações por situações
                                            if (array(1, 2, 3) != $situacoes) {
                                                if (!in_array(3, $situacoes)) {
                                                    if (array(1, 2) != $situacoes) {
                                                        if (in_array(1, $situacoes)) {

                                                            if ($SeqFiltro > 0) {
                                                                $Filtro .= " AND ";
                                                            }

                                                            $Filtro .= "c.pre_unit_base <> 0";

                                                            if ($SeqFiltro > 0) {
                                                                $Filtro .= " AND ";
                                                            }

                                                            $Filtro .= "(NOT EXISTS (SELECT 1 FROM " . NaoCotar::_TABLENAME . " onc WHERE TO_NUMBER(REPLACE(o.num_oc, '.', '')) = TO_NUMBER(REPLACE(onc." . NaoCotar::_CODIGO . ", '.', '')) AND o.cod_empresa = onc." . NaoCotar::_COD_EMPRESA . " AND onc." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'O')
                                              OR (c.pre_unit_base = 0 AND NOT EXISTS(SELECT 1 FROM " . NaoCotar::_TABLENAME . " ni WHERE ni." . NaoCotar::_CODIGO . " = o.cod_item AND ni." . NaoCotar::_COD_EMPRESA . " = o.cod_empresa AND ni." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'I')))";

                                                            $SeqFiltro++;
                                                        }

                                                        if (in_array(2, $situacoes)) {

                                                            if ($SeqFiltro > 0) {
                                                                $Filtro .= " AND ";
                                                            }

                                                            $Filtro .= "c.pre_unit_base = 0";

                                                            $Filtro .= " AND NOT EXISTS (SELECT 1 FROM " . NaoCotar::_TABLENAME . " onc WHERE TO_NUMBER(REPLACE(o.num_oc, '.', '')) = TO_NUMBER(REPLACE(onc." . NaoCotar::_CODIGO . ", '.', '')) AND o.cod_empresa = onc." . NaoCotar::_COD_EMPRESA . " AND onc." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'O')";

                                                            $Filtro .= " AND NOT EXISTS(SELECT 1 FROM " . NaoCotar::_TABLENAME . " ni WHERE ni." . NaoCotar::_CODIGO . " = o.cod_item AND ni." . NaoCotar::_CODIGO . " = o.cod_empresa AND ni." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'I')";
                                                            $SeqFiltro++;
                                                        }
                                                    } else {

                                                        if ($SeqFiltro > 0) {
                                                            $Filtro .= " AND ";
                                                        }

                                                        $Filtro .= "NOT EXISTS (SELECT 1 FROM " . NaoCotar::_TABLENAME . " onc WHERE TO_NUMBER(REPLACE(o.num_oc, '.', '')) = TO_NUMBER(REPLACE(onc." . NaoCotar::_CODIGO . ", '.', '')) AND o.cod_empresa = onc." . NaoCotar::_COD_EMPRESA . " AND onc." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'O')";

                                                        $Filtro .= " AND NOT EXISTS(SELECT 1 FROM " . NaoCotar::_TABLENAME . " ni WHERE ni." . NaoCotar::_CODIGO . " = o.cod_item AND ni." . NaoCotar::_COD_EMPRESA . " = o.cod_empresa AND ni." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'I')";
                                                        $SeqFiltro++;
                                                    }
                                                } else {
                                                    if (array(2, 3) == $situacoes) {

                                                        if ($SeqFiltro > 0) {
                                                            $Filtro .= " AND ";
                                                        }

                                                        $Filtro .= "c.pre_unit_base = 0";
                                                        $SeqFiltro++;
                                                    } else if (array(1, 3) == $situacoes) {

                                                        if ($SeqFiltro > 0) {
                                                            $Filtro .= " AND ";
                                                        }

                                                        $Filtro .= "(c.pre_unit_base <> 0
                                              OR EXISTS (SELECT 1 FROM " . NaoCotar::_TABLENAME . " onc WHERE TO_NUMBER(REPLACE(o.num_oc, '.', '')) = TO_NUMBER(REPLACE(onc." . NaoCotar::_CODIGO . ", '.', '')) AND o.cod_empresa = onc." . NaoCotar::_COD_EMPRESA . " AND onc." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . "='O')
                                              OR (c.pre_unit_base = 0 AND EXISTS(SELECT 1 FROM " . NaoCotar::_TABLENAME . " ni WHERE ni." . NaoCotar::_CODIGO . " = o.cod_item AND ni." . NaoCotar::_COD_EMPRESA . " = o.cod_empresa AND ni." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'I')))";
                                                        $SeqFiltro++;
                                                    } else {

                                                        if ($SeqFiltro > 0) {
                                                            $Filtro .= " AND ";
                                                        }

                                                        $Filtro .= "(EXISTS (SELECT 1 FROM " . NaoCotar::_TABLENAME . " onc WHERE TO_NUMBER(REPLACE(o.num_oc, '.', '')) = TO_NUMBER(REPLACE(onc." . NaoCotar::_CODIGO . ", '.', '')) AND o.cod_empresa = onc." . NaoCotar::_COD_EMPRESA . " AND onc." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . "='O')
                                              OR (c.pre_unit_base = 0 AND EXISTS(SELECT 1 FROM " . NaoCotar::_TABLENAME . " ni WHERE ni." . NaoCotar::_CODIGO . " = o.cod_item AND ni." . NaoCotar::_COD_EMPRESA . " = o.cod_empresa AND ni." . NaoCotar::_ID_FORNECEDOR . " = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'I')))";
                                                        $SeqFiltro++;
                                                    }
                                                }

                                                $SeqFiltro++;
                                            }

                                            //var_dump($Filtro);

                                            $Paginacao = new Paginacao($Tabela, $Filtro);

                                            $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, $Paginacao->Atual, $Paginacao->Limite, NULL, " ORDER BY {$Indice} ASC ");
                                            echo "<div class=\"adv-table\" style='overflow: visible;overflow-x: scroll;'>";
                                            if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
                                                ?>
                                                <form action="../Controller/GeraRelatorioCotacao.php"  method="post" name="exportarCotacao" id="exportarCotacao">
                                                    <?PHP
                                                    echo "<table id=\"{$Tabela}\" class=\"table table-bordered table-striped table-condensed\">";
                                                    echo "<thead><tr>";
                                                    //montamos o grid - nome titulo do resultado
                                                    echo "<th><center><input type='checkbox' name='Todos' id='Todos'/> </center> </th>";
                                                    foreach ($Grid as $key => $value) {
                                                        echo "<th class=\"text-center\">{$key}</th>";
                                                    }
                                                    echo "<th> </th>";

                                                    echo "</tr>\n</thead><tbody>";
                                                    $i = ($Paginacao->Pagina < 1) ? 0 : ($Paginacao->Pagina) * $Paginacao->Limite;
                                                    foreach ($Consultar as $value) {
                                                        $descricao = buscaDescricaoItemPorCod($value['COD_EMPRESA'], $value['COD_ITEM']);
                                                        $unidade = buscaDescricaoUnidadeMedidaByCod($value['COD_UNID_MED']);
                                                        $conversao = buscaFatorConversao($value['COD_EMPRESA'], $value['COD_ITEM'], $value['COD_FORNECEDOR']);
                                                        $vencimento = BuscaVencimentoOrdem($value['NUM_OC'], $value['COD_EMPRESA']);


                                                        ++$i;
                                                        echo "<tr id=\"tr{$value["{$Indice}"]}\" class=\"excluir text-center\">\n";

//montamos o formulario de exclusão
                                                        if ($Permissoes['PTC0019']['LIXEIRA'] == 1) {
                                                            $str_deletar = <<<EOT
<a class="btn btn-danger btn-xs excluiritem"  onclick="javascript: if (!confirm('Você realmente deseja marcar como não cotar?')){return false;}"  href="Cotacoes.php?Acao=Deletar&id={$value["{$Indice}"]}" id="{$value["{$Indice}"]}"><i class="fa fa-trash-o"></i> Excluir</a>
EOT;
                                                        }
                                                        //montandos o grid - resultado
                                                        $countItem = 0;

                                                        echo "<td class=\"wordbreak\"><input class='marcar' data-id='selecExp'  name='" . trim($value['COD_EMPRESA']) . trim($value['NUM_OC']) . trim($value['COD_ITEM']) . trim($value['COD_FORNECEDOR']) . "' id='" . trim($value['COD_EMPRESA']) . trim($value['NUM_OC']) . trim($value['COD_ITEM']) . trim($value['COD_FORNECEDOR']) . "' type=\"checkbox\" /></td>";

                                                        foreach ($Grid as $rs) {
                                                            if ($rs == "QTD_SOLIC") {

                                                                echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->FormatarMoeda(((str_replace(".", ",", $value[$rs])) / $conversao), 2) . " " . $unidade . "</td>";
                                                            } elseif ($rs == 'Vencimento') {
                                                                echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->FormataData($vencimento, "-", "/") . "</td>";
                                                            } elseif ($rs == 'IES_SITUA_OC') {
                                                                $isNaoCotar = ordemOuItemNaoCotado($value['NUM_OC'], $value['COD_FORNECEDOR'], $value['COD_EMPRESA']);

                                                                $isCotada = $podeCotar = false;
                                                                $isCotada = isCotadaBy($value['NUM_OC'], $value['COD_EMPRESA'], $value['COD_FORNECEDOR']);
                                                                if ($isNaoCotar) {
                                                                    echo "<td class=\"wordbreak\">Não cotada</td>";
                                                                } else if ($isCotada) {
                                                                    echo "<td class=\"wordbreak\">Cotação realizada</td>";
                                                                } else {
                                                                    echo "<td class=\"wordbreak\">Cotação não respondida</td>";
                                                                }
                                                            } elseif ($rs == 'COD_ITEM') {
                                                                $progamacao = BuscaProgramacaoEntrega($value['NUM_OC'], $value['COD_EMPRESA'], $value['NUM_VERSAO'], $unidade);
                                                                echo "<td class=\"wordbreak\">" . $value[$rs] . " - " . $descricao . " " . $progamacao . "</td>";
                                                            } elseif ($rs == "COD_FORNECEDOR") {
                                                                echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString(buscaNomeFornecedor($value["{$rs}"])) . "</td>";
                                                            } else {
                                                                echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td>";
                                                            }
                                                            $countItem++;
                                                        }
                                                        echo "<td class=\"col-sm-2 text-center\">";
                                                        ?>
                                                        <a title="Cotar" data-toggle="modal" data-target="#cotacao" onclick="exibeDados('<?PHP echo $value["COD_EMPRESA"]; ?>', '<?PHP echo $value["NUM_OC"]; ?>', '<?PHP echo $value["COD_ITEM"]; ?>', '', '<?PHP echo ""; ?>', '<?PHP echo BuscaDateFimCotacaoOrdem($value['NUM_OC'], $value['COD_EMPRESA']); ?>', '<?PHP echo $value["O.PRE_UNIT_OC"]; ?>', '<?PHP echo $value["COD_UNID_MED"]; ?>', '<?PHP echo intval($value["PCT_IPI"]); ?>', '', '<?PHP echo $vencimento; ?>', '<?PHP echo $value["COD_MOEDA"]; ?>', '<?PHP echo $value["CND_PGTO"]; ?>', '<?PHP echo $value["IES_TIP_ENTREGA"] ?>', '<?PHP echo $value['COD_ITEM'] . " - " . str_replace('"', "", $descricao); ?>', '<?PHP echo $value["NUM_COTACAO"]; ?>', '<?PHP echo $value["COD_FORNECEDOR"]; ?>');" href="#cotacao"><i class="fa fa-tag"></i></a>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <?PHP if ($objUsuarioLogado->getCodFornecedor() != "") { ?>
                                                            <a title='Não Cotar' onclick="javascript: if (!confirm('Você realmente deseja marcar como não cotar?')) {
                                                                                            return false;
                                                                                        }" href="Cotacoes.php<?PHP echo"?Acao=NaoCotar&" . NaoCotar::_COD_EMPRESA; ?><?PHP echo "={$value['COD_EMPRESA']}&" . NaoCotar::_CODIGO; ?><?PHP echo "={$value['NUM_OC']}&" . NaoCotar::_TIPO; ?><?PHP echo "=O&" . NaoCotar::_ID_FORNECEDOR; ?><?PHP echo "={$value['COD_FORNECEDOR']}>"; ?>"><i class="fa fa-ban"></i></a>
                                                               <?PHP
                                                           }
                                                           echo "</td>\n";
                                                           echo "</tr>\n";
                                                       }
                                                       echo "</tbody></table>";
                                                       ?><div align='center'>
                                                        <input type="hidden" name="FiltrarExportar" class="form-control" id="FiltrarExportar" value="<?PHP echo addslashes($Filtro); ?>"/>
                                                        <input type="hidden" name="AcaoExportar" class="form-control" id="AcaoExportar" value=""/>
                                                        <a id="btnExportarSel" class="btn btn-primary" onclick="Exportar('Selecionados');" href="#"><i class='fa fa-table'> Exportar sel.</i></a>
                                                        <a  class="btn btn-primary"  onclick="Exportar('Tudo');" href="#"><i class='fa fa-table'> Exportar tudo</i></a></div><?PHP
                                                    //Se a quantia de itens for maior que apenas um, adiciona a opção de marcar e desmarcar todas.
                                                    //Incluimos a montagem das páginas
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
                    <div class="modal fade " id="ModalCadastroImportar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content-wrap">
                                <form id="carregar" action="Cotacoes.php?Acao=Importar" name="carregar" method="post" enctype='multipart/form-data' >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Cadastro</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label for="Nome">Excel</label>
                                                    <input type="file" class="form-control" name="Arquivo" maxlength="18" value="" id="Arquivo">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5"></div>
                                                <div class="col-lg-2">
                                                    <a target="_BLANK" href="../Docs/manual-importacao-pt.pdf"><strong>?</strong>Manual de importação</a>
                                                </div>
                                                <div class="col-lg-5"></div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <input  type="hidden" class="form-control m-bot15" id="id" required="" name="id" value=" " />
                                            <input type="submit" name="Cotar" id="Cotar" class="btn btn-info"  value="Confirmar" />    
                                            <button data-dismiss="modal" class="btn btn-default" type="button">Fechar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- fim modal importacao -->
                    <!--Modal de Cotação--> 
                    <div class="modal fade modal-dialog-center" id="cotacao" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content-wrap">
                                <div class="modal-content">
                                    <form action="Cotacoes.php"  method="post" name="cotacao" id="cot">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Cotação</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label for="empresa">Empresa</label>
                                                    <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>"/>
                                                    <input type="hidden" name="<?PHP echo Cotacao::_ID; ?>" class="form-control" id="<?PHP echo Cotacao::_ID; ?>" value="<?PHP echo $objCotar->getId(); ?>"/>
                                                    <input type="text" required="" <?PHP echo $readOnly; ?> tabindex="1" maxlength="2" class="form-control disabled" readonly="true" id="<?PHP echo Cotacao::_COD_EMPRESA; ?>" name="<?PHP echo Cotacao::_COD_EMPRESA; ?>" placeholder="Empresa" value="<?PHP echo $objCotar->getCod_empresa(); ?>"/>                                                        
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="codigo">Número</label>
                                                    <input type="hidden" tabindex="3" maxlength="10" class="form-control disabled" maxlength="15" id="<?PHP echo Cotacao::_NUMERO; ?>" name="<?PHP echo Cotacao::_NUMERO; ?>" placeholder="Item" value="<?PHP echo $objCotar->getNumero(); ?>" />
                                                    <input type="text" required="" <?PHP echo $readOnly; ?>  tabindex="2" class="form-control" maxlength="15" name="<?PHP echo Cotacao::_OC; ?>" id="<?PHP echo Cotacao::_OC; ?>" readonly="true" value="<?PHP echo $objCotar->getOc(); ?>"/>
                                                </div>
                                                <div class="col-sm-8">
                                                    <label for="descricao">Item</label>
                                                    <input type="hidden" tabindex="3" maxlength="10" class="form-control disabled" maxlength="15" id="<?PHP echo Cotacao::_FORNECEDOR; ?>" name="<?PHP echo Cotacao::_FORNECEDOR; ?>" placeholder="Item" value="<?PHP echo $objCotar->getFornecedor(); ?>" />
                                                    <input type="hidden" tabindex="3" maxlength="10" class="form-control disabled" maxlength="15" id="<?PHP echo Cotacao::_ITEM; ?>" name="<?PHP echo Cotacao::_ITEM; ?>" placeholder="Item" value="<?PHP echo $objCotar->getItem(); ?>" />
                                                    <input type="text" required="" readonly="" tabindex="3" class="form-control disabled" maxlength="15" id="DescricaoItem" name="DescricaoItem" placeholder="Item" value="<?PHP echo $objCotar->getItem(); ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="filtroPorCodigo" class="col-2 col-form-label">Fabricante</label>
                                                    <select tabindex="12" <?PHP echo $readOnly; ?>  class="form-control" id="<?PHP echo Cotacao::_FABRICANTE; ?>" name="<?PHP echo Cotacao::_FABRICANTE; ?>"></select>
                                                </div>
                                                <div class="col-sm-9">
                                                    <label for="entregaprevista" class="col-2 col-form-label">Entrega prevista até</label>
                                                    <textarea tabindex="15" required="" readonly="" class="form-control" maxlength="255" rows="4" id="<?PHP echo Cotacao::_ENTREGA_PREVISTA; ?>" name="<?PHP echo Cotacao::_ENTREGA_PREVISTA; ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="datalimitecotacao" class="col-2 col-form-label">Data limite para cotação:</label>
                                                    <input type="date" required="" tabindex="6" class="form-control" readonly="true"  id="<?PHP echo Cotacao::_DATA_LIMITE_COTACAO; ?>" name="<?PHP echo Cotacao::_DATA_LIMITE_COTACAO; ?>" value="<?PHP echo $objFuncionalidades->FormataData($objCotar->getData_limite_cotacao(), "-", "/"); ?>"/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="precounitario" class="col-2 col-form-label">Preço unitário:</label>
                                                    <input type="number" required="" <?PHP echo $readOnly; ?> min="0" step="0.0001"   tabindex="7"  class="form-control" id="<?PHP echo Cotacao::_PRECO_UNITARIO; ?>" name="<?PHP echo Cotacao::_PRECO_UNITARIO; ?>" value="<?PHP echo $objCotar->getPreco_unit(); ?>"/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="unidademedida" class="col-2 col-form-label">Unidade medida</label>
                                                    <select tabindex="12" required="" <?PHP echo $readOnly; ?>  class="form-control" id="<?PHP echo Cotacao::_UNIDADE_MEDIDA; ?>" name="<?PHP echo Cotacao::_UNIDADE_MEDIDA; ?>">
                                                        <?PHP
                                                        foreach (listaUnidadeMedida() as $key => $coluna) {
                                                            echo "<option value='" . trim($coluna['COD_UNID_MED']) . "'>" . $coluna['DEN_UNID_MED_30'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-1">
                                                    <label for="ipi" class="col-2 col-form-label">IPI (%)</label>
                                                    <input type="text" required="" <?PHP echo $readOnly; ?>  tabindex="9" class="form-control" id="<?PHP echo Cotacao::_IPI; ?>" name="<?PHP echo Cotacao::_IPI; ?>" value="<?PHP echo $objCotar->getIpi(); ?>"/>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="orcamentovalido" class="col-2 col-form-label">Orçamento válido até</label>
                                                    <input type="date" required="" <?PHP echo $readOnly; ?>  tabindex="10" class="form-control" id="<?PHP echo Cotacao::_ORCAMENTO_VALIDO; ?>" name="<?PHP echo Cotacao::_ORCAMENTO_VALIDO; ?>" value="<?PHP echo $objFuncionalidades->FormataData($objCotar->getOrcamento_valido(), "-", "/"); ?>"/>
                                                </div>
                                                <div class="col-sm-2"></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-3">
                                                    <label for="prazoentrega" class="col-2 col-form-label">Prazo de entrega (em dias)</label>
                                                    <input type="number" required="" <?PHP echo $readOnly; ?> min="0" step="0.0001"  tabindex="11" class="form-control" id="<?PHP echo Cotacao::_PRAZO_ENTREGA; ?>" name="<?PHP echo Cotacao::_PRAZO_ENTREGA; ?>" value="<?PHP echo $objCotar->getPrazo_entrega(); ?>"/>
                                                </div>  
                                                <div class="col-sm-2">
                                                    <label for="moeda" class="col-2 col-form-label">Moeda</label>                                           
                                                    <select tabindex="12" required="" <?PHP echo $readOnly; ?>  class="form-control" id="<?PHP echo Cotacao::_MOEDA; ?>" name="<?PHP echo Cotacao::_MOEDA; ?>">
                                                        <?PHP
                                                        foreach (listarMoedas() as $moeda => $coluna) {
                                                            echo "<option value='" . $coluna[Moeda::_ID] . "'>" . $coluna[Moeda::_DESCRICAO] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div> 
                                                <div class="col-sm-3">
                                                    <label for="condicaopagto" class="col-2 col-form-label">Condições de pagamento</label>
                                                    <select class="form-control" required="" <?PHP echo $readOnly; ?>  id="<?PHP echo Cotacao::_CONDICOES_PAGAMENTO; ?>" name="<?PHP echo Cotacao::_CONDICOES_PAGAMENTO; ?>" tabindex="13">
                                                        <?PHP
                                                        foreach (ListarCondicaoPagamento() as $condicaoPagamento => $coluna) {
                                                            echo '<option value="' . $coluna[CondicaoPagamento::_ID] . '">' . $coluna[CondicaoPagamento::_DESCRICAO] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="modoenvio" class="col-2 col-form-label">Modo de envio</label>
                                                    <select tabindex="14" required="" <?PHP echo $readOnly; ?>  class="form-control" id="<?PHP echo Cotacao::_MODO_ENVIO; ?>" name="<?PHP echo Cotacao::_MODO_ENVIO; ?>">
                                                        <?PHP
                                                        foreach (ListaTipoFrete() as $tipoFrete => $coluna) {
                                                            echo '<option value="' . $coluna[TipoFrete::_ID] . '">' . $coluna[TipoFrete::_DESCRICAO] . '</option>';
                                                        }
                                                        ?>  
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <label for="chat" class="col-2 col-form-label">Chat</label>
                                                    <textarea tabindex="15" <?PHP echo $readOnly; ?>  class="form-control" maxlength="255" rows="4" id="<?PHP echo Cotacao::_CHAT; ?>" name="<?PHP echo Cotacao::_CHAT; ?>"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <?PHP if ($objUsuarioLogado->getCodFornecedor() != "") { ?>
                                                <div id="divCotar" style="position: relative; float: right;">
                                                    <input tabindex="17" type="submit"  id="Cotar" name="Cotar"  class="btn btn-primary" value="Cotar" />
                                                </div>
                                            <?PHP } ?>
                                            <button data-dismiss="modal" tabindex="16" class="btn btn-default" type="button">Fechar</button>&nbsp;

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- page end-->
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
                                                            function Exportar(tipo) {
                                                                if (tipo == 'Selecionados') {
                                                                    //verifica a quantidade de checkboxes marcados
                                                                    var qtdCheckbox = $('input:checkbox:checked').length;
                                                                    //se for maior que zero, o portal exporta as cotações 
                                                                    if (qtdCheckbox > 0) {
                                                                        document.getElementById('AcaoExportar').value = tipo;
                                                                        document.getElementById("exportarCotacao").submit();
                                                                    } else {
                                                                        alert('Nenhuma cotação foi selecionada.');
                                                                    }
                                                                } else {
                                                                    document.getElementById('AcaoExportar').value = tipo;
                                                                    document.getElementById("exportarCotacao").submit();
                                                                }

                                                            }

                                                            $(function () {
                                                                $('#Todos').click(function () {
                                                                    $('.marcar').each(
                                                                            function () {
                                                                                if ($('#Todos').prop("checked"))
                                                                                    $(this).prop("checked", true);
                                                                                else
                                                                                    $(this).prop("checked", false);
                                                                            }
                                                                    );
                                                                });
                                                            });
                                                            function exibeDados(fieldEmpresa, fieldNumero, fieldItem, fieldFabricante, fieldEntregaPrevista, fieldDataLimiteCotacao,
                                                                    fieldPrecoUnitario, fieldUnidadeMedida, fieldIpi, fieldOrcamentoValido, fieldPrazoEntrega, fieldMoeda, fieldCondicaoPagto, fieldModoEnvio, fieldDescricaoItem, fieldNumCotacao, fieldFornecedor) {

                                                                $.ajax({
                                                                    url: '../Controller/Pesquisas.php?Pesquisa=PesquisaCotacao',
                                                                    type: 'GET',
                                                                    data: 'Filtro=&<?PHP echo Cotacao::_DATA_LIMITE_COTACAO; ?>=' + fieldDataLimiteCotacao + '&<?PHP echo Cotacao::_NUMERO ?>=' + fieldNumero + '&<?PHP echo Cotacao::_UNIDADE_MEDIDA ?>=' + fieldUnidadeMedida + '&<?PHP echo Cotacao::_COD_EMPRESA ?>=' + fieldEmpresa + '&<?PHP echo Cotacao::_FORNECEDOR ?>=' + fieldFornecedor + '&<?PHP echo Cotacao::_ITEM ?>=' + fieldItem,
                                                                    dataType: 'json',
                                                                    success: function (data) {
                                                                        $.ajax({
                                                                            url: '../Controller/Pesquisas.php?Pesquisa=PesquisaFabricanteItem',
                                                                            type: 'GET',
                                                                            data: 'Filtro=&<?PHP echo Cotacao::_COD_EMPRESA; ?>=' + fieldEmpresa + '&<?PHP echo Cotacao::_ITEM; ?>=' + fieldItem,
                                                                            dataType: 'json',
                                                                            success: function (data) {
                                                                                var options = '';
                                                                                options += "<option id='<?PHP echo Cotacao::_FABRICANTE; ?>' value=''></option>";
                                                                                $.each(data, function (key, value) {
                                                                                    options += "<option id='<?PHP echo Cotacao::_FABRICANTE; ?>' value='" + value.cod + "'>" + value.cod + " - " + value.descricao + "</option>";
                                                                                });
                                                                                $("#<?PHP echo Cotacao::_FABRICANTE; ?>").html(options);
                                                                            }
                                                                        });



                                                                        if (data.<?PHP echo Cotacao::_ID; ?> != "" && data.<?PHP echo Cotacao::_ID; ?> != null) {
                                                                            document.getElementById('<?PHP echo Cotacao::_ID; ?>').value = data.<?PHP echo Cotacao::_ID; ?>;
                                                                            document.getElementById('<?PHP echo Cotacao::_PRECO_UNITARIO; ?>').value = data.<?PHP echo Cotacao::_PRECO_UNITARIO; ?>;
                                                                            $('#<?PHP echo Cotacao::_UNIDADE_MEDIDA; ?>').find('option[value="' + data.<?PHP echo Cotacao::_UNIDADE_MEDIDA; ?> + '"]').attr('selected', true);
                                                                            document.getElementById('<?PHP echo Cotacao::_IPI; ?>').value = data.<?PHP echo Cotacao::_IPI; ?>;
                                                                            document.getElementById('<?PHP echo Cotacao::_PRAZO_ENTREGA; ?>').value = data.<?PHP echo Cotacao::_PRAZO_ENTREGA; ?>;
                                                                            $('#<?PHP echo Cotacao::_FABRICANTE; ?>').find('option[value="' + data.<?PHP echo Cotacao::_FABRICANTE; ?> + '"]').attr('selected', true);
                                                                            $('#<?PHP echo Cotacao::_MOEDA; ?>').find('option[value="' + data.<?PHP echo Cotacao::_MOEDA; ?> + '"]').attr('selected', true);
                                                                            $('#<?PHP echo Cotacao::_CONDICOES_PAGAMENTO; ?>').find('option[value="' + data.<?PHP echo Cotacao::_CONDICOES_PAGAMENTO; ?> + '"]').attr('selected', true);
                                                                            $('#<?PHP echo Cotacao::_MODO_ENVIO; ?>').find('option[value="' + data.<?PHP echo Cotacao::_MODO_ENVIO; ?> + '"]').attr('selected', true);
                                                                            document.getElementById('<?PHP echo Cotacao::_ORCAMENTO_VALIDO; ?>').value = data.<?PHP echo Cotacao::_ORCAMENTO_VALIDO; ?>;
                                                                            document.getElementById('<?PHP echo Cotacao::_CHAT; ?>').value = data.<?PHP echo Cotacao::_CHAT; ?>;
                                                                            document.getElementById('<?PHP echo Cotacao::_ENTREGA_PREVISTA; ?>').value = data.<?PHP echo Cotacao::_ENTREGA_PREVISTA; ?>;
                                                                            document.getElementById('Acao').value = 'Atualizar';

                                                                            $('#ENT_REPRESENTANTE').find('option[value="' + data.COD + '"]').attr('selected', true);

                                                                        } else {
                                                                            document.getElementById('<?PHP echo Cotacao::_ENTREGA_PREVISTA; ?>').value = data.<?PHP echo Cotacao::_ENTREGA_PREVISTA; ?>;
                                                                            document.getElementById('Acao').value = 'Inserir';
                                                                        }

                                                                        document.getElementById('<?PHP echo Cotacao::_COD_EMPRESA; ?>').value = fieldEmpresa;
                                                                        document.getElementById('<?PHP echo Cotacao::_NUMERO; ?>').value = fieldNumCotacao;
                                                                        document.getElementById('<?PHP echo Cotacao::_ITEM; ?>').value = fieldItem;
                                                                        document.getElementById('<?PHP echo Cotacao::_FABRICANTE; ?>').value = fieldFabricante;
                                                                        document.getElementById('<?PHP echo Cotacao::_FORNECEDOR; ?>').value = fieldFornecedor;
                                                                        document.getElementById('<?PHP echo Cotacao::_DATA_LIMITE_COTACAO; ?>').value = fieldDataLimiteCotacao;
                                                                        document.getElementById('<?PHP echo Cotacao::_OC; ?>').value = fieldNumero;

                                                                        if (data.cotacaoexpirada == '1') {
                                                                            $("#divCotar").css('display', 'none');
                                                                        } else {
                                                                            $("#divCotar").css('display', '');
                                                                        }

                                                                        document.getElementById('DescricaoItem').value = fieldDescricaoItem;

                                                                    }
                                                                });


                                                            }
        </script>


    </body>

    <!-- Mirrored from thevectorlab.net/flatlab/dynamic_table.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Mar 2015 13:32:07 GMT -->
</html>

