<?PHP
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE);
include_once '../Model/ItemVenda.Class.php';
include_once '../Model/NaoCotar.Class.php';
include_once '../Controller/Session.php';
include_once '../Controller/DAOItemVenda.php';


$objItemVenda = new ItemVenda();
$objFuncionalidades = new Funcionalidades();

include_once '../Model/DAO.Class.php';

$ObjDao = new DAO();

if (isset($_POST['Cadastrar'])) {
    if ($_REQUEST['Acao'] == 'Inserir') {

        //$objItemVenda = BuscaItemVendaPorEmpresaECodigo((string)$_REQUEST[ITEMVENDA_EMPRESA], (string)$_REQUEST[ITEMVENDA_CODIGO]);
//            if($objItemVenda->getId() != "" && !is_null($objItemVenda->getId())){
//                $objFuncionalidades->ExibeMensagem("Item de venda já cadastrado!");
//                $objFuncionalidades->VoltarPaginaAnterior();
//            }else{
//                $id = cadastraItemVenda($_POST);
//                $id = strtoupper($id);
//                $id = $objFuncionalidades->Redirecionar("Cotacoes_.php"); 
//            }
    } else if ($_POST['Acao'] == "Atualizar") {
//            $id = cadastraItemVenda($_POST);
//            $objFuncionalidades->Redirecionar("Cotacoes_.php");
    }
} else {
//        if(isset($_REQUEST['Acao'])){
//            $Acao = $_REQUEST['Acao'];
//        }else{
//            $Acao = "";
//        }
}

if ($Acao == "Deletar") {
    $id = deletarItemVenda($_REQUEST);
    $objFuncionalidades->Redirecionar("Cotacoes_.php");
}


$situacoes = array();

if ($_REQUEST['sit-cota-realizada'] != "") {
    $situacoes[] = $_REQUEST['sit-cota-realizada'];
}

if ($REQUEST['sit-cota-n-respondida'] != "") {
    $situacoes[] = $_REQUEST['sit-cota-realizada'];
}

if ($REQUEST['sit-n-cotadas'] != "") {
    $situacoes[] = $REQUEST['sit-n-cotadas'];
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

                                    <form id="carregar" action="Cotacoes_.php" name="carregar" method="post">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-sm-5"></div>
                                                <div class="col-sm-2">
                                                    <a class="btn btn-primary" href="#" data-toggle="modal"><i class="fa fa-file-o"> Importar Cotações</i></a>
                                                </div>
                                                <div class="col-sm-5"></div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label class="col-2 col-form-label">Fornecedor</label>
                                                    <input type="text" class="form-control" id="filtroPorFornecedor" name="filtroPorFornecedor" placeholder="Fornecedor" value=""/>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="col-2 col-form-label">Empresa</label>
                                                    <select name='empresas' class="form-control">
                                                        <option>Selecione</option>
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
                                                    <input type="date" class="form-control" id="filtroPorDataVencimento" name="filtroPorDataVencimento" value="<?PHP echo date('Y-m-d'); ?>"/>
                                                </div>
                                            </div>                                        
                                            <div class="form-group row">
                                                <div class="col-sm-10">

                                                    <label for="filtroPorSituacao" class="col-2 col-form-label">Situação</label>
                                                    <div id='situacao' style="margin-top:3px;">
                                                        <input type="checkbox" class="form-group" checked="true" id="filtroPorSituacao" name="sit-cota-realizada" value="1"/>
                                                        <label for="filtroPorSituacao" style="font-weight: 300; margin-right: 5px;">Cotação realizada</label>

                                                        <input type="checkbox" class="form-group" checked="true" id="filtroPorSituacao" name="sit-cota-n-respondida" value="2"/>
                                                        <label for="filtroPorSituacao" style="font-weight: 300; margin-right: 5px;">Cotação não respondida</label>

                                                        <input type="checkbox" class="form-group" maxlength="255" id="filtroPorSituacao" name="sit-cota-n-cotadas" value="3"/>
                                                        <label for="filtroPorSituacao" style="font-weight: 300; margin-right: 5px;">Não cotadas</label>
                                                    </div>

                                                </div>
                                                <div class="col-lg-2" style="float:right;">
                                                    <input type="submit" name="Filtrar" id="Filtrar" onclick="return ValidaFiltros();" class="btn btn-primary" value="Buscar" />
                                                    <input type="reset" name="Limpar" class="btn btn-primary" value="Limpar"/>
                                                </div>
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
    <!--                                            <input type="submit" name="Filtrar" id="Filtrar" onclick="return ValidaFiltros();" class="btn btn-primary" value="Buscar" />
                                                <input type="reset" name="Limpar" class="btn btn-primary" value="Limpar"/>-->
                                            </div>
                                        </div>

                                    </form>


                                    <div class="panel-body">
                                        <?php
                                        if (isset($_REQUEST['Filtrar'])) {
                                            $FiltroPaginacao .= "&Filtrar=" . $_REQUEST['Filtrar'];
                                            include_once '../Controller/Paginacao.Class.php';
                                            include_once '../Model/Funcionalidades.Class.php';

                                            $htmlInteresse = '<div class="fa-hover col-md-3 col-sm-4"><a href="#"><i class="fa fa-stack-exchange"></i></a></div>';

                                            $ObjFuncionalidades = new Funcionalidades();
                                            //Define indice principal da tabela
                                            $Indice = "";
                                            //Define a tabela que trabalharemos
                                            $Tabela = "ordem_sup o, ordem_sup_cot f, cotacao_preco c";
                                            //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                            $Filtro = "";
                                            //Informamos os campos que iremos buscar no banco
                                            $Campos = "o.*, f.cod_fornecedor, c.dat_fim_validade";
                                            //Montamos um array pra fazer a exibição dos resultados em tabela
                                            $Grid = [' ' => "Checkbox",
                                                'Número' => "NUM_OC",
                                                'Item' => "COD_EMPRESA",
                                                'Quantidade' => "QTD_ORIGEM",
                                                'Vencimento' => "DAT_FIM_VALIDADE",
                                                //'Empresa' => "den_reduz",
                                                'Situação' => "IES_SITUA_OC"
                                            ];

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
                                                    ";
                                            $SeqFiltro++;


                                            //Filtra as cotações por empresa
                                            /* if ($_REQUEST['filtroPorEmpresa'] != "") {
                                              $FiltroPaginacao .= "&filtroPorEmpresa=" . $_REQUEST['filtroPorEmpresa'];
                                              if ($SeqFiltro > 0) {
                                              $Filtro .= " AND (" . ITEMVENDA_EMPRESA . " LIKE '%" . strtoupper($_REQUEST['filtroPorEmpresa']) . "%')";
                                              $SeqFiltro++;
                                              } else {
                                              $Filtro .= " (" . ITEMVENDA_EMPRESA . " LIKE '%" . strtoupper($_REQUEST['filtroPorEmpresa']) . "%')";
                                              $SeqFiltro++;
                                              }
                                              } */

                                            //Filtra as cotações por Fornecedor
                                            if ($_REQUEST['filtroPorFornecedor'] != "") {
                                                $FiltroPaginacao .= "&filtroPorFornecedor=" . $_REQUEST['filtroPorFornecedor'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (f.cod_fornecedor LIKE '%" . strtoupper($_REQUEST['filtroPorFornecedor']) . "%')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (f.cod_fornecedor LIKE '%" . strtoupper($_REQUEST['filtroPorFornecedor']) . "%')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            //Filtra as cotações por número
                                            if ($_REQUEST['filtroPorNumero'] != "") {
                                                $FiltroPaginacao .= "&filtroPorNumero=" . $_REQUEST['filtroPorNumero'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (p.num_oc LIKE '%" . strtoupper($_REQUEST['filtroPorNumero']) . "%')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (p.num_oc LIKE '%" . strtoupper($_REQUEST['filtroPorNumero']) . "%')";
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


                                            //Filtra as cotações por data de vencimento
                                            if ($_REQUEST['filtroPorDataVencimento'] != "") {
                                                $data = explode("-", $_REQUEST['filtroPorDataVencimento']);
                                                $FiltroPaginacao .= "&filtroPorDataVencimento=" . $_REQUEST['filtroPorDataVencimento'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (c.dat_fim_validade = MDY('{$data[1]}','{$data[2]}','{$data[0]}'))";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (c.dat_fim_validade = MDY('{$data[1]}','{$data[2]}','{$data[0]}'))";
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

                                                        $Filtro .= "NOT EXISTS (SELECT 1 FROM " . NaoCotar::_TABLENAME . " onc WHERE TO_NUMBER(REPLACE(o.num_oc, '.', '')) = TO_NUMBER(REPLACE(onc." . NaoCotar::_CODIGO . ", '.', '')) AND o.cod_empresa = onc." . NaoCotar::_COD_EMPRESA . " AND onc.id_fornecedor = f.cod_fornecedor AND " . NaoCotar::_TIPO . " = 'O')";


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


                                            $Paginacao = new Paginacao($Tabela, $Filtro);


                                            $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, $Paginacao->Atual, $Paginacao->Limite, NULL, " ORDER BY {$Indice} ASC ");


                                            if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
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
                                                    /* if ($Permissoes['PTV0018']['LIXEIRA'] == 1) { */
                                                    $str_deletar = <<<EOT
<a class="btn btn-danger btn-xs excluiritem"  onclick="javascript: if (!confirm('Você realmente deseja excluir este registro?')){return false;}"  href="Cotacoes_.php?Acao=Deletar&id={$value["{$Indice}"]}" id="{$value["{$Indice}"]}"><i class="fa fa-trash-o"></i> Excluir</a>
EOT;
                                                    //}
                                                    //montandos o grid - resultado
                                                    $countItem = 0;
                                                    foreach ($Grid as $rs) {
                                                        if ($rs == 'Checkbox') {
                                                            echo "<td class=\"wordbreak\"><input type=\"checkbox\" /></td>";
                                                        } else if ($rs == 'DAT_FIM_VALIDADE') {
                                                            echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->FormataData($value[$rs], "-", "/") . "</td>";
                                                        } elseif ($rs == 'IES_SITUA_OC') {

                                                            if (($value["{$rs}"]) == 'A') {
                                                                echo "<td class=\"wordbreak\">Cotação não realizada</td>";
                                                            } else if (($value["{$rs}"]) == 'R') {
                                                                echo "<td class=\"wordbreak\">Cotação realizada</td>";
                                                            } else if (($value["{$rs}"]) == 'C') {
                                                                echo "<td class=\"wordbreak\">Não cotadas</td>";
                                                            }
                                                        } else {
                                                            echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td>";
                                                        }
                                                        $countItem++;
                                                    }
                                                    echo "<td class=\"col-sm-2 text-center\">";

                                                    //echo "<a class=\"btn btn-warning btn-xs\" {$target} href=\"?Acao=Atualizar&id={$value["{$Indice}"]}\"><i class=\"fa fa-pencil\"></i> Editar</a> ";
                                                    //echo " {$str_deletar}";
                                                    echo "<a href=\"#\"><i class=\"fa fa-tag\"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\"><i class=\"fa fa-ban\"></i></a>";


                                                    echo "</td>\n";
                                                    echo "</tr>\n";
                                                }
                                                echo "</tbody></table>";
                                                //Se a quantia de itens for maior que apenas um, adiciona a opção de marcar e desmarcar todas.
                                                if ($countItem < 1) {
                                                    echo "<input type=\"checkbox\" />Marcar/Desmarcar todos";
                                                }
                                                //Incluimos a montagem das páginas
                                                $Paginacao->MontaPaginas();
                                            } else {
                                                echo "<p class=\"text-center\">Nenhum registro encontrado!</p>";
                                            }
//Criar condicao se Acao == Incluir e|ou Alterar
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?PHP
                        } elseif ($Acao == 'Inserir' || $Acao == "Atualizar") {
                            include_once '../Model/Perfil.Class.php';
                            include_once '../Controller/DAOPerfil.php';


                            //Objetos para operacoes

                            $objPerfil = new Perfil();

                            if ($Acao == "Atualizar") {
                                $objPerfil = buscaPerfilPorId($_REQUEST['id']);
                            }
                            ?>
                            <form id="carregar" action="Perfil.php" name="carregar" method="post">
                                <div>

                                    <div class="row">
                                        <div class="col-lg-12">

                                            <section class="panel">
                                                <header class="panel-heading">

                                                    Perfil
                                                </header>

                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label> Nome </label>
                                                                    <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                                    <input type="hidden" name="<?PHP echo PERFIL_ID; ?>" class="form-control" id="<?PHP echo PERFIL_ID; ?>" value="<?PHP echo $objPerfil->getId(); ?>" />


                                                                    <input required="" class="form-control" type="text" name="<?PHP echo PERFIL_NOME; ?>" id="<?PHP echo PERFIL_NOME; ?>" value="<?PHP echo $objPerfil->getNome(); ?>" />
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label for="UF"> Aprova Financeiro </label>
                                                                    <?PHP if ($objPerfil->getAprovaFinanceiro() == 1) { ?>
                                                                        <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo PERFIL_APROVA_FINANCEIRO; ?>" id="<?PHP echo PERFIL_APROVA_FINANCEIRO; ?>" />
                                                                    <?PHP } else { ?>
                                                                        <input type="checkbox" class="form-control"  name="<?PHP echo PERFIL_APROVA_FINANCEIRO; ?>" id="<?PHP echo PERFIL_APROVA_FINANCEIRO; ?>" />
                                                                    <?PHP } ?>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label for="UF"> Aprova Comercial </label>
                                                                    <?PHP if ($objPerfil->getAprovaComercial() == 1) { ?>
                                                                        <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo PERFIL_APROVA_COMERCIAL; ?>" id="<?PHP echo PERFIL_APROVA_COMERCIAL; ?>" />
                                                                    <?PHP } else { ?>
                                                                        <input type="checkbox" class="form-control"  name="<?PHP echo PERFIL_APROVA_COMERCIAL; ?>" id="<?PHP echo PERFIL_APROVA_COMERCIAL; ?>" />
                                                                    <?PHP } ?>
                                                                </div>
                                                            </div>
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
                                                                    <?PHP if (($Acao == "Atualizar" && $Permissoes['PTV0018']['ALTERAR'] == 1) || ($Acao == "Inserir" && $Permissoes['PTV0018']['INCLUIR'] == 1)) { ?>
                                                                        <input type="submit" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    <?PHP } ?><a class="btn btn-info" href="Perfil.php">Voltar</a>
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


                        <?PHP } ?>
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


    </body>

    <!-- Mirrored from thevectorlab.net/flatlab/dynamic_table.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 16 Mar 2015 13:32:07 GMT -->
</html>

