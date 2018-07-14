<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include_once '../Controller/Session.php';
if (isset($_POST['Cadastrar'])) {
    include_once '../Model/PadraoModulo.Class.php';
    include_once '../Controller/DAOPadroesModulo.php';
    include_once '../Model/Funcionalidades.Class.php';

    $ObjPadroesModulo = new PadraoModulo();
    $ObjFuncionalidades = new Funcionalidades();
    $id = CadastraPadroesModulo($_POST);
    $ObjFuncionalidades->Redirecionar("Parametros.php?idPrograma={$_POST[PADRAOMODULO_PAI_ID]}&Acao=" . $_POST['Acao']);
}
include_once '../Model/PadraoModulo.Class.php';
include_once '../Model/DAO.Class.php';

$ObjDao = new DAO();
$objPadraoModulo = new PadraoModulo();

if (isset($_REQUEST['Acao'])) {
    $Acao = $_REQUEST['Acao'];
} else {
    $Acao = "";
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

        <title>Parametrizacao</title>

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
                                    <div class="panel-heading">
                                        Escolha o modulo:
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        include_once '../Controller/Paginacao.Class.php';
                                        include_once '../Model/Funcionalidades.Class.php';
                                        $ObjFuncionalidades = new Funcionalidades();
                                        //Define indice principal da tabela
                                        $Indice = "MOD_ID";
                                        //Define a tabela que trabalharemos
                                        $Tabela = $objPadraoModulo->getSchema() . "PTC_MODULO_MOD";
                                        //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                        $Filtro = "";
                                        //Informamos os campos que iremos buscar no banco
                                        $Campos = "MOD_ID, MOD_DESCRICAO_CURTA, MOD_DESCRICAO";
                                        //Montamos um array pra fazer a exibição dos resultados em tabela
                                        $Grid = ['ID' => 'MOD_ID', 'Nome' => 'MOD_DESCRICAO_CURTA', 'Descricao' => 'MOD_DESCRICAO',];
                                        //Criamos uma condição where padrão para as pesquisas de tabela
                                        $Where = "ORDER BY {$Indice} DESC";
                                        $Paginacao = new Paginacao($Tabela, $Filtro);
                                        $Parametros = " ";
                                        $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, $Paginacao->Atual, $Paginacao->Limite, '', $Where);
                                        if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
                                            echo "<table id=\"{$Tabela}\" class=\"table table-bordered table-striped table-condensed\">";
                                            echo "<thead><tr>";
                                            //montamos o grid - nome titulo do resultado
                                            foreach ($Grid as $key => $value) {
                                                echo "<th>{$key}</th>";
                                            }
                                            echo "<th id={$Indice} class=\"text-center nomeindice\">Selecionar</th>";

                                            echo "</tr>\n</thead><tbody>";
                                            $i = ($Paginacao->Pagina < 1) ? 0 : ($Paginacao->Pagina) * $Paginacao->Limite;
                                            foreach ($Consultar as $value) {
                                                ++$i;
                                                echo "<tr id=\"tr{$value["{$Indice}"]}\" class=\"excluir\">\n";



                                                //montandos o grid - resultado
                                                foreach ($Grid as $rs) {
                                                    echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td>";
                                                }
                                                echo "<td class=\"col-lg-2 text-center\">";
                                                echo "<a class=\"btn btn-warning btn-xs\" href=\"?Acao=ModuloSelecionado&idModulo={$value["{$Indice}"]}\"><i class=\"fa fa-pencil\"></i> Selecionar</a> ";
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
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?PHP
                        } elseif ($Acao == "ModuloSelecionado") {
                            ?>
                            <div class="col-lg-12">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Escolha o programa    <br/><a class="btn btn-primary" href="Parametros.php">Voltar</a>

                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        include_once '../Controller/Paginacao.Class.php';
                                        include_once '../Model/Funcionalidades.Class.php';
                                        $ObjFuncionalidades = new Funcionalidades();
                                        //Define indice principal da tabela


                                        $Indice = "PGM_PRO_ID";
                                        //Define a tabela que trabalharemos
                                        $Tabela = $objPadraoModulo->getSchema() . "PTC_PROGRAMA_MODULO_PGM PGM";
                                        //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                        $Filtro = "PGM.PGM_MOD_ID =" . $_REQUEST['idModulo'];
                                        //Informamos os campos que iremos buscar no banco
                                        $Campos = "PGM.PGM_PRO_ID, PRO.PRO_DESCRICAO_CURTA";
                                        //Montamos um array pra fazer a exibição dos resultados em tabela
                                        $Grid = ['ID' => 'PGM_PRO_ID', 'Nome' => 'PRO_DESCRICAO_CURTA',];
                                        //Criamos uma condição where padrão para as pesquisas de tabela
                                        $Where = "ORDER BY {$Indice} DESC";
                                        $Paginacao = new Paginacao($Tabela, $Filtro);
                                        $Parametros = "INNER JOIN " . $objPadraoModulo->getSchema() . "PTC_PROGRAMA_PRO PRO ON (PRO.PRO_ID = PGM.PGM_PRO_ID) ";
                                        $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, 0, 1000000000, $Parametros, $Where);
                                        if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
                                            echo "<table id=\"{$Tabela}\" class=\"table table-bordered table-striped table-condensed\">";
                                            echo "<thead><tr>";
                                            echo "<th> # </th>";
                                            //montamos o grid - nome titulo do resultado
                                            foreach ($Grid as $key => $value) {
                                                echo "<th>{$key}</th>";
                                            }
                                            echo "<th id={$Indice} class=\"text-center nomeindice\">Selecionar</th>";

                                            echo "</tr>\n</thead><tbody>";
                                            $i = ($Paginacao->Pagina < 1) ? 0 : ($Paginacao->Pagina) * $Paginacao->Limite;
                                            foreach ($Consultar as $value) {
                                                ++$i;
                                                echo "<tr id=\"tr{$value["{$Indice}"]}\" class=\"excluir\">\n";
                                                echo "<td>{$i}</td>";


                                                //montandos o grid - resultado
                                                foreach ($Grid as $rs) {
                                                    echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td>";
                                                }
                                                echo "<td class=\"col-lg-3 text-center\">";
                                                echo "<a class=\"btn btn-warning btn-xs\" href=\"?Acao=Atualizar&idPrograma={$value["{$Indice}"]}\"><i class=\"fa fa-pencil\"></i> Selecionar</a> ";
                                                echo " {$str_deletar}";
                                                echo "</td>\n";
                                                echo "</tr>\n";
                                            }
                                            echo "</tbody></table>";
                                            //Incluimos a montagem das páginas
                                        } else {
                                            echo "<p class=\"text-center\">Nenhum registro encontrado!</p>";
                                        }
//Criar condicao se Acao == Incluir e|ou Alterar
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?PHP
                        } elseif ($Acao == 'Inserir' || $Acao == "Atualizar") {
                            include_once '../Model/Padroes.Class.php';
                            include_once '../Model/PadraoModulo.Class.php';

                            include_once '../Controller/DAOPadroesModulo.php';

                            $ObjPadroes = new PadraoModulo();



                            if ($Acao == "Atualizar") {
                                $ListaPadroesModulo = BuscaPadroesPorModulo($_REQUEST['idPrograma'], 'P');
                            }
                            ?>
                            <form id="carregar" action="Parametros.php" name="carregar" method="post">
                                <div>

                                    <div class="row">
                                        <div class="col-lg-12">

                                            <section class="panel">
                                                <header class="panel-heading">

                                                    Parametros por perfil
                                                </header>
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                            <input type="hidden" name="<?PHP echo PADRAOMODULO_PAI_ID; ?>" class="form-control" id="<?PHP echo PADRAOMODULO_PAI_ID; ?>" value="<?PHP echo $_REQUEST['idPrograma']; ?>" />



                                                            <table class="table table-bordered table-striped table-condensed">
                                                                <?PHP
                                                                $Contador = 0;
                                                                foreach ($ListaPadroesModulo as $chave_do_indice => $valor_do_indice) {
                                                                    ?> <tr>
                                                                        <td style="text-align: center;">
                                                                            <?PHP
                                                                            $Contador = $Contador + 1;
                                                                            if ($valor_do_indice[PADRAOMODULO_TIPO_CAMPO] == "text") {
                                                                                ?>

                                                                                <?PHP echo $valor_do_indice[PADRAOMODULO_PARAMETRO]; ?>
                                                                                <input type="text" name="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" class="form-control" id="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" value="<?PHP echo $valor_do_indice[PADRAOMODULO_VALOR]; ?>" />

                                                                                <?PHP
                                                                            } elseif ($valor_do_indice[PADRAOMODULO_TIPO_CAMPO] == "number") {
                                                                                ?>
                                                                                <label for="TipoFrete"><?PHP echo $valor_do_indice[PADRAOMODULO_PARAMETRO]; ?></label>
                                                                                <input type="number" name="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" class="form-control" id="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" value="<?PHP echo $valor_do_indice[PADRAOMODULO_VALOR]; ?>" />

                                                                                <?PHP
                                                                            } elseif ($valor_do_indice[PADRAOMODULO_TIPO_CAMPO] == "datetime-local") {
                                                                                ?>
                                                                                <label for="TipoFrete"><?PHP echo $valor_do_indice[PADRAOMODULO_PARAMETRO]; ?></label>
                                                                                <input type="datetime-local" name="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" class="form-control" size="20" id="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" value="<?PHP echo $valor_do_indice[PADRAOMODULO_VALOR]; ?>" />

                                                                                <?PHP
                                                                            } elseif ($valor_do_indice[PADRAOMODULO_TIPO_CAMPO] == "checkbox") {
                                                                                ?> 
                                                                                <label for="TipoFrete"><?PHP echo $valor_do_indice[PADRAOMODULO_PARAMETRO]; ?></label>
                                                                                <?PHP
                                                                                if ($valor_do_indice[PADRAOMODULO_VALOR] == 1) {
                                                                                    ?>
                                                                                    <input type="checkbox" checked="true" class="form-control"  name="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" id="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" />
                                                                                <?PHP } else { ?>
                                                                                    <input type="checkbox" class="form-control"  name="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" id="<?PHP echo $valor_do_indice[PADRAOMODULO_ID]; ?>" />
                                                                                    <?PHP
                                                                                }
                                                                                ?>
                                                                                <?PHP
                                                                            }
                                                                            ?> 
                                                                        </td>
                                                                        <td>
                                                                            <label for="TipoFrete"><?PHP echo " "; ?></label>
                                                                            <p><?PHP echo $valor_do_indice[PADRAOMODULO_DESCRICAO]; ?></p>
                                                                        </td>
                                                                    </tr><?PHP
                                                                }
                                                                ?>

                                                            </table>

                                                            <div class="row"><div class="col-lg-12"></div></div>

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

                                                                    <?PHP if ($Contador > 0) { ?><?PHP if ($Permissoes['PTC0016']['ALTERAR'] == 1) { ?>
                                                                            <input type="submit" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    
                                                                    <?PHP } ?>
                                                                <?PHP } ?><a class="btn btn-info" href="Parametros.php">Voltar</a>
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

        <!--custom switch-->
        <script src="../Public/js/bootstrap-switch.js"></script>

        <script src="../Public/js/respond.min.js" ></script>
        <script type="text/javascript" src="../Public/assets/gritter/js/jquery.gritter.js"></script>
        <script type="text/javascript" src="../Public/js/jquery.pulsate.min.js"></script>
        <script src="../Public/js/pulstate.js" type="text/javascript"></script>

        <script type="text/javascript">


            function Esvazia() {
                $('#406582').attr('value', '');
            }
            /*function habilitaIncluir() {
             alert('gtes');
             $('#3pep_acessar').attr("CHECKED", "true");
             
             }*/
        </script>
    </body>

</html>


