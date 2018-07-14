<?php
include_once '../Model/Funcionalidades.Class.php';
include_once '../Model/DAO.Class.php';
include_once '../Model/OrigemInteracao.Class.php';
include_once '../Controller/DAOOrigemInteracao.php';
include_once '../Controller/Session.php';

$ObjDao = new DAO();
$objOrigemInteracao = new OrigemInteracao();
$ObjFuncionalidades = new Funcionalidades();

if (isset($_POST['Cadastrar'])) {
    $id = CadastraOrigemInteracao($_REQUEST);
    $ObjFuncionalidades->Redirecionar("OrigemInteracao.php");
}

if (isset($_REQUEST['Acao'])) {
    $Acao = $_REQUEST['Acao'];
} else {
    $Acao = "";
}
if ($Acao == "Deletar") {
    include_once '../Controller/DAOPedido.php';
    $Cadastrados = ContarRegistrosPorOrigemInteracao($_REQUEST['id']);
    if ($Cadastrados == 0) {
        $id = deletarOrigemInteracao($_REQUEST);
        $ObjFuncionalidades->Redirecionar("OrigemInteracao.php");
    } else {
        $ObjFuncionalidades->ExibeMensagem("Existem registros vinculados a este registro, por tanto não é possivel exclui-lo");
        $ObjFuncionalidades->Redirecionar("OrigemInteracao.php");
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

        <title>Origem Interação</title>

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
                                    <form id="carregar" action="OrigemInteracao.php" name="carregar" method="post">
                                        <div class="panel-heading">
                                            <div class="row">

                                                <div class="col-lg-1">

                                                    <?PHP if ($Permissoes['PTV0061']['INCLUIR'] == 1) { ?>
                                                        <a class="btn btn-primary" href="OrigemInteracao.php?Acao=Inserir"><i class="fa fa-file-o"></i> Cadastrar</a>
                                                    <?PHP } ?>
                                                </div>
                                                <!--  alterado abaixo     -->
                                                <div class="col-lg-4">
                                                    <input type="text" class="form-control"  id="filtroPorDesc" name="filtroPorDesc" value="<?PHP echo $_REQUEST['filtroPorDesc'];
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
                                            $Indice = ORIGEM_INTERACAO_ID;
                                            //Define a tabela que trabalharemos
                                            $Tabela = ORIGEM_INTERACAO_TABLENAME;
                                            //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                            $Filtro = "";
                                            //Informamos os campos que iremos buscar no banco
                                            $Campos = ORIGEM_INTERACAO_ID . SEPARADOR . ORIGEM_INTERACAO_NOME;
                                            //Montamos um array pra fazer a exibição dos resultados em tabela
                                            $Grid = ['Descrição' => ORIGEM_INTERACAO_NOME,];
                                            //Criamos uma condição where padrão para as pesquisas de tabela
                                            $Where = "ORDER BY {$Indice} DESC";

                                            if ($objUsuarioLogado->getInterno() == 1) {
                                                $target = "target='_BLANK'";
                                            } else {
                                                $target = " ";
                                            }




                                            if ($_REQUEST['filtroPorDesc'] != "") {
                                                $FiltroPaginacao .= "&filtroPorDesc=" . $_REQUEST['filtroPorDesc'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (" . ORIGEM_INTERACAO_NOME . " LIKE '%" . strtoupper($_REQUEST['filtroPorDesc']) . "%')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (" . ORIGEM_INTERACAO_NOME . " LIKE '%" . strtoupper($_REQUEST['filtroPorDesc']) . "%')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            $Paginacao = new Paginacao($Tabela, $Filtro);
                                            $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, $Paginacao->Atual, $Paginacao->Limite, '', $Where);


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
                                                    if ($Permissoes['PTV0061']['LIXEIRA'] == 1) {
                                                        $str_deletar = <<<EOT
<a class="btn btn-danger btn-xs excluiritem"  onclick="javascript: if (!confirm('Você realmente deseja excluir este registro?')){return false;}" href="OrigemInteracao.php?Acao=Deletar&id={$value["{$Indice}"]}" id="{$value["{$Indice}"]}"><i class="fa fa-trash-o"></i> Excluir</a>
EOT;
                                                    }
                                                    //montandos o grid - resultado
                                                    foreach ($Grid as $rs) {
                                                        echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td>";
                                                    }
                                                    echo "<td class=\"col-lg-2 text-center\">";
                                                    echo "<a class=\"btn btn-warning btn-xs\" {$target} href=\"?Acao=Atualizar&id={$value["{$Indice}"]}\"><i class=\"fa fa-pencil\"></i> Editar</a> ";
                                                    echo " {$str_deletar}";
                                                    echo "</td>\n";
                                                    echo "</tr>\n";
                                                }
                                                echo "</tbody></table>";
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

                            if ($Acao == "Atualizar") {
                                $objOrigemInteracao = buscaOrigemInteracaoPorId($_REQUEST['id']);
                            }
                            ?>
                            <form id="carregar" action="OrigemInteracao.php" name="carregar" method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <section class="panel">
                                            <header class="panel-heading">
                                                Origem Interação
                                            </header>
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <label> Nome </label>
                                                                <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                                <input type="hidden" name="<?PHP echo ORIGEM_INTERACAO_ID; ?>" class="form-control" id="<?PHP echo ORIGEM_INTERACAO_ID; ?>" value="<?PHP echo $objOrigemInteracao->getId(); ?>" />
                                                                <input required="" maxlength="100" class="form-control" type="text" name="<?PHP echo ORIGEM_INTERACAO_NOME; ?>" id="<?PHP echo ORIGEM_INTERACAO_NOME; ?>" value="<?PHP echo $objOrigemInteracao->getNome(); ?>" />
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
                                                                <?PHP if (($Acao == "Atualizar" && $Permissoes['PTV0061']['ALTERAR'] == 1) || ($Acao == "Inserir" && $Permissoes['PTV0061']['INCLUIR'] == 1)) { ?>
                                                                    <input type="submit" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    <?PHP } ?><a class="btn btn-info" href="OrigemInteracao.php">Voltar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
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
</html>

