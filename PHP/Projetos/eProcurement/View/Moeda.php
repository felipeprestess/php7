<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

include_once '../Model/DAO.Class.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/Moeda.Class.php';

include_once '../Controller/DAOMoeda.php';
include_once '../Controller/Session.php';

$ObjDao = new DAO();
$ObjMoeda = new Moeda();
$ObjFuncionalidades = new Funcionalidades();

if (isset($_POST['Cadastrar'])) {
    if ($_REQUEST['Acao'] == "Inserir") {
        $ObjMoeda = buscaMoedaPorCodErp($_REQUEST[Moeda::_COD_ERP]);

        if ($ObjMoeda->getId() != "" && !is_null($ObjMoeda->getId())) {
            $ObjFuncionalidades->ExibeMensagem("Cod erp já cadastrado para outra moeda, portanto não é possivel recadastra-la.");
            $ObjFuncionalidades->VoltarPaginaAnterior();
        } else {
            $id = cadastraMoeda($_REQUEST);
        }
        $ObjFuncionalidades->Redirecionar("Moeda.php");
    } elseif ($_POST['Acao'] == "Atualizar") {
        $id = cadastrarMoeda($_REQUEST);
        $ObjFuncionalidades->Redirecionar("Moeda.php");
    }
}

if (isset($_REQUEST['Acao'])) {
    $Acao = $_REQUEST['Acao'];
} else {
    $Acao = "";
}

if ($Acao == "Deletar") {
    include_once '../Controller/DAOPedido.php';
    $Cadastrados = ContarPedidoPorMoeda($_REQUEST['id']);
    if ($Cadastrados == 0) {
        $id = deletarMoeda($_REQUEST);
        $ObjFuncionalidades->Redirecionar("Moeda.php");
    } else {
        $ObjFuncionalidades->ExibeMensagem("Existem registros vinculados a esta moeda, portanto não é possivel exclui-la.");
        $ObjFuncionalidades->Redirecionar("Moeda.php");
    }
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
        <title>Moeda</title>
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

        <!--toastr-->
        <link href="../Public/assets/toast/jquery.toast.css" rel="stylesheet" type="text/css" />

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
                        <?PHP if ($Acao == "") { ?>
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <form id="carregar" action="Moeda.php" name="carregar" method="post">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-lg-1">
                                                    <?PHP if ($Permissoes['PTC0017']['INCLUIR'] == 1) { ?>
                                                        <a class="btn btn-primary" data-toggle="modal" href="Moeda.php?Acao=Inserir"><i class="fa fa-file-o"></i> Cadastrar</a>
                                                    <?PHP } ?>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control m-bot15"  id="filtroPorCod" name="filtroPorCod" value="<?PHP echo $_REQUEST['filtroPorCod'];
                                                    ?>" placeholder="Cód ERP"/>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control m-bot15"  id="filtroPorDesc" name="filtroPorDesc" value="<?PHP echo $_REQUEST['filtroPorDesc'];
                                                    ?>" placeholder="Descrição"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-11">
                                                </div>                                              
                                                <div class="col-lg-1">
                                                    <input type="submit" name="Filtrar" id="Filtrar" onclick="return ValidaFiltros();" class="btn btn-primary" value="Filtrar" />
                                                </div>                                               
                                            </div>
                                        </div>
                                    </form>
                                    <div class="panel-body">
                                        <?php
                                        if (isset($_REQUEST['Filtrar'])) {
                                            $FiltroPaginacao .= "&Filtrar=" . $_REQUEST['Filtrar'];
                                            include_once '../Controller/Paginacao.Class.php';

                                            //Define indice principal da tabela
                                            $Indice = Moeda::_ID;
                                            //Define a tabela que trabalharemos
                                            $Tabela = Moeda::_TABLENAME;
                                            //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                            $Filtro = "";
                                            //Informamos os campos que iremos buscar no banco
                                            $Campos = Moeda::_ID . SEPARADOR . Moeda::_DESCRICAO . SEPARADOR . Moeda::_COD_ERP . SEPARADOR . Moeda::_ABREVIACAO;
                                            //Montamos um array pra fazer a exibição dos resultados em tabela
                                            $Grid = ['Código ERP' => Moeda::_COD_ERP, 'Descrição' => Moeda::_DESCRICAO, 'Abreviação' => Moeda::_ABREVIACAO];
                                            //Criamos uma condição where padrão para as pesquisas de tabela
                                            $Where = " ORDER BY " . Moeda::_COD_ERP . " ASC ";

                                            if ($objUsuarioLogado->getInterno() == 1) {
                                                $target = "target='_BLANK'";
                                            } else {
                                                $target = " ";
                                            }

                                            if ($_REQUEST['filtroPorCod'] != "") {
                                                $FiltroPaginacao .= "&filtroPorCod=" . $_REQUEST['filtroPorCod'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (" . Moeda::_COD_ERP . " = '" . strtoupper($_REQUEST['filtroPorCod']) . "')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (" . Moeda::_COD_ERP . " = '" . strtoupper($_REQUEST['filtroPorCod']) . "')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            if ($_REQUEST['filtroPorDesc'] != "") {
                                                $FiltroPaginacao .= "&filtroPorDesc=" . $_REQUEST['filtroPorDesc'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (" . Moeda::_DESCRICAO . " LIKE '%" . strtoupper($_REQUEST['filtroPorDesc']) . "%')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (" . Moeda::_DESCRICAO . " LIKE '%" . strtoupper($_REQUEST['filtroPorDesc']) . "%')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            $Paginacao = new Paginacao($Tabela, $Filtro);
                                            $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, $Paginacao->Atual, $Paginacao->Limite, '', $Where);
                                            echo "<div class=\"adv-table\" style='overflow: visible;overflow-x: scroll;'>";
                                            if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
                                                echo "<table id=\"{$Tabela}\" class=\"table table-bordered table-striped table-condensed\">";
                                                echo "<thead><tr>";
                                                //montamos o grid - nome titulo do resultado
                                                foreach ($Grid as $key => $value) {
                                                    echo "<th><center>{$key}</center></th>";
                                                }
                                                echo "<th id={$Indice} class=\"text-center nomeindice\">Editar | Excluir</th>";

                                                echo "</tr>\n</thead><tbody>";
                                                $i = ($Paginacao->Pagina < 1) ? 0 : ($Paginacao->Pagina) * $Paginacao->Limite;
                                                foreach ($Consultar as $value) {
                                                    ++$i;
                                                    echo "<tr id=\"tr{$value["{$Indice}"]}\" class=\"excluir text-center\">\n";


                                                    //montamos o formulario de exclusão
                                                    if ($Permissoes['PTC0017']['LIXEIRA'] == 1) {
                                                        $str_deletar = <<<EOT
<a class="btn btn-danger btn-xs excluiritem" onclick="javascript: if (!confirm('Você realmente deseja excluir este registro?')){return false;}"  href="Moeda.php?Acao=Deletar&id={$value[$Indice]}" id="{$value[$Indice]}"><i class="fa fa-trash-o"></i> Excluir</a>
EOT;
                                                    }
                                                    //montandos o grid - resultado
                                                    foreach ($Grid as $rs) {
                                                        echo "<center><td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td></center>";
                                                    }
                                                    echo "<td class=\"col-lg-2 text-center\">";
                                                    echo "<a class=\"btn btn-warning btn-xs\" {$target} href=\"?Acao=Atualizar&id={$value["{$Indice}"]}\"><i class=\"fa fa-pencil\"></i> Editar</a>";
                                                    echo " {$str_deletar}";
                                                    echo "</td>\n";
                                                    echo "</tr>\n";
                                                }
                                                echo "</tbody></table>";
                                                //Incluimos a montagem das páginas
                                                $Paginacao->MontaPaginas($FiltroPaginacao);
                                            } else {
                                                echo "<p class=\"text-center\">Nenhum registro encontrado!</p>";
                                            }
                                            echo "</div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?PHP
                            //Criar condicao se Acao == Incluir e|ou Alterar
                        } elseif ($Acao == 'Inserir' || $Acao == "Atualizar") {

                            if ($Acao == "Atualizar") {
                                $ObjMoeda = buscaMoedaPorId($_REQUEST['id']);
                            }
                            ?>
                            <form id="carregar" action="Moeda.php" name="carregar" method="post">
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <section class="panel">
                                                <header class="panel-heading">
                                                    Moeda
                                                </header>
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                                    <label> Código </label>
                                                                    <input type="hidden" name="Acao" class="form-control m-bot15" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                                    <input type="hidden" name="<?PHP echo Moeda::_ID; ?>" class="form-control m-bot15" id="<?PHP echo Moeda::_ID; ?>" value="<?PHP echo $ObjMoeda->getId(); ?>" />
                                                                    <input required class="form-control m-bot15" type="text" name="<?PHP echo Moeda::_COD_ERP; ?>" id="<?PHP echo Moeda::_COD_ERP; ?>" value="<?PHP echo $ObjMoeda->getCod(); ?>" />
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                                    <label> Descrição </label>
                                                                    <input required class="form-control m-bot15" type="text" name="<?PHP echo Moeda::_DESCRICAO; ?>" id="<?PHP echo Moeda::_DESCRICAO; ?>" value="<?PHP echo $ObjMoeda->getDescricao(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                                    <label> Abreviação </label>
                                                                    <input required class="form-control m-bot15" type="text" name="<?PHP echo Moeda::_ABREVIACAO; ?>" id="<?PHP echo Moeda::_ABREVIACAO; ?>" value="<?PHP echo $ObjMoeda->getAbreviacao(); ?>"  />
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
                                                                    <?PHP //if ($PermissoesGeral['PTV0060'][PERFILPROGRAMA_INCLUIR] == 1) { 
                                                                    if ($Permissoes['PTC0017']['INCLUIR'] == 1) {
                                                                        ?>
                                                                        <input type="submit" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    
    <?PHP } ?>
                                                                    <a class="btn btn-info" href="Moeda.php">Voltar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
<?PHP } ?>
                </section>
            </section>

            <?PHP include_once './JanelaDireita.php'; ?>
<?PHP include_once './Rodape.php'; ?>

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