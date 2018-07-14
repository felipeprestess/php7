
<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE);
include_once '../Model/ItemVenda.Class.php';
include_once '../Controller/Session.php';
include_once '../Controller/DAOItemVenda.php';
include_once '../Controller/DAOCotacao.php';

$objItemVenda = new ItemVenda();
$objFuncionalidades = new Funcionalidades();

include_once '../Model/DAO.Class.php';

$ObjDao = new DAO();

if (isset($_POST['Cadastrar'])) {
    if ($_REQUEST['Acao'] == 'Inserir') {

        $objItemVenda = BuscaItemVendaPorEmpresaECodigo((string) $_REQUEST[ItemVenda::_EMPRESA], (string) $_REQUEST[ItemVenda::_CODIGO]);

        if ($objItemVenda->getId() != "" && !is_null($objItemVenda->getId())) {
            $objFuncionalidades->ExibeMensagem("Item de venda já cadastrado!");
            $objFuncionalidades->VoltarPaginaAnterior();
        } else {
            $id = cadastraItemVenda($_POST);
            $id = strtoupper($id);
            $id = $objFuncionalidades->Redirecionar("ItemVenda.php");
        }
    } else if ($_POST['Acao'] == "Atualizar") {
        $id = cadastraItemVenda($_POST);
        $objFuncionalidades->Redirecionar("ItemVenda.php");
    }
} else {
    if (isset($_REQUEST['Acao'])) {
        $Acao = $_REQUEST['Acao'];
    } else {
        $Acao = "";
    }
}

if ($Acao == "Deletar") {
    $id = deletarItemVenda($_REQUEST);
    $objFuncionalidades->Redirecionar("ItemVenda.php");
} elseif ($Acao == "Indisponivel") {
    $id = inativarItem($_REQUEST);
    $objFuncionalidades->Redirecionar("ItemVenda.php");
}

if (isset($_POST['EmailMensagem'])) {

    if (isset($_REQUEST['msgInteresse'])) {
        $destinatarios[0]['nome'] = "Rodrigo";
        $destinatarios[0]['email'] = "rodrigo@forgesolucoes.com.br";

        $objFuncionalidades->enviaEmail($destinatarios, "Interesse do Item: " . $_REQUEST['descricao'], $_REQUEST['msgInteresse'], null);
    }
}
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="keyword" content="">
        <title>Item de venda</title>

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
                        <?php if ($Acao == "") { ?>
                            <div class="col-lg-12">

                                <div class="panel panel-default">
                                    <form id="carregar" action="ItemVenda.php" name="carregar" method="post">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-lg-1">
                                                    <?PHP if ($Permissoes['PTC0020']['INCLUIR'] == 1) { ?>
                                                        <a class="btn btn-primary" data-toggle="modal" href="ItemVenda.php?Acao=Inserir"><i class="fa fa-file-o"></i> Novo</a>
                                                    <?PHP } ?>
                                                </div>
                                                <?PHP if ($objPerfil->getAdministrador() == "1") { ?>
                                                    <div class="col-lg-2">
                                                        <a class='btn btn-success' title="Enviar e-mail para todos os fornecedores." target="_BLANK" href='../Controller/EnviaEmailTodosFornecedores.php'><i class='fa fa-envelope-o'></i> Enviar e-mail fornec.</a>
                                                    </div>
                                                <?PHP } ?>
                                                <div class="col-lg-3">
                                                    <select name="filtroPorEmpresa" id="filtroPorEmpresa" class="form-control m-bot15" required >
                                                        <?PHP
                                                        $ListaEmpresas = listaEmpresas();
                                                        while ($row = $ListaEmpresas->fetch(PDO::FETCH_BOTH)) {
                                                            if (in_array($row[0], explode(",", $objUsuarioLogado->getEmpresa()))) {
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
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" maxlength="15" id="filtroPorCodigo" name="filtroPorCodigo" placeholder="CÓDIGO" value="<?PHP echo $_REQUEST['filtroPorCodigo'] ?>" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" maxlength="255" id="filtroPorDesc" name="filtroPorDesc" value="<?PHP echo $_REQUEST['filtroPorDesc']; ?>" placeholder="DESCRIÇÃO"/>
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
                                            include_once '../Model/Funcionalidades.Class.php';

                                            $htmlInteresse = '<div class="fa-hover col-md-3 col-sm-4"><a href="#"><i class="fa fa-stack-exchange"></i></a></div>';

                                            $ObjFuncionalidades = new Funcionalidades();
                                            //Define indice principal da tabela
                                            $Indice = ItemVenda::_ID;
                                            //Define a tabela que trabalharemos
                                            $Tabela = ItemVenda::_TABLENAME;
                                            //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                            $Filtro = "";
                                            //Informamos os campos que iremos buscar no banco
                                            $Campos = ItemVenda::_ID . SEPARADOR . ItemVenda::_SITUACAO . SEPARADOR . ItemVenda::_EMPRESA . SEPARADOR . ItemVenda::_CODIGO . SEPARADOR . ItemVenda::_DESCRICAO . SEPARADOR . ItemVenda::_ESPECIFICACAO . SEPARADOR . ItemVenda::_QUANTIDADE . SEPARADOR . ItemVenda::_PRECO_UNIT;
                                            //Montamos um array pra fazer a exibição dos resultados em tabela
                                            $Grid = [
                                                'Empresa' => ItemVenda::_EMPRESA,
                                                'Código' => ItemVenda::_CODIGO,
                                                'Descrição' => ItemVenda::_DESCRICAO,
                                                'Especificação' => ItemVenda::_ESPECIFICACAO,
                                                'Quantidade' => ItemVenda::_QUANTIDADE,
                                                'Preço unitário' => ItemVenda::_PRECO_UNIT,
                                                'Status' => ItemVenda::_SITUACAO,
                                                'Interesse' => 'Interesse'
                                            ];
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
                                                    $Filtro .= " AND (" . ItemVenda::_DESCRICAO . " LIKE '%" . strtoupper($_REQUEST['filtroPorDesc']) . "%')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (" . ItemVenda::_DESCRICAO . " LIKE '%" . strtoupper($_REQUEST['filtroPorDesc']) . "%')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            if ($_REQUEST['filtroPorEmpresa'] != "") {
                                                $FiltroPaginacao .= "&filtroPorEmpresa=" . $_REQUEST['filtroPorEmpresa'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (" . ItemVenda::_EMPRESA . " LIKE '%" . strtoupper($_REQUEST['filtroPorEmpresa']) . "%')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (" . ItemVenda::_EMPRESA . " LIKE '%" . strtoupper($_REQUEST['filtroPorEmpresa']) . "%')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            if ($_REQUEST['filtroPorCodigo'] != "") {
                                                $FiltroPaginacao .= "&filtroPorCodigo=" . $_REQUEST['filtroPorCodigo'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (" . ItemVenda::_CODIGO . " LIKE '%" . strtoupper($_REQUEST['filtroPorCodigo']) . "%')";
                                                    $SeqFiltro++;
                                                } else {
                                                    $Filtro .= " (" . ItemVenda::_CODIGO . " LIKE '%" . strtoupper($_REQUEST['filtroPorCodigo']) . "%')";
                                                    $SeqFiltro++;
                                                }
                                            }

                                            $Paginacao = new Paginacao($Tabela, $Filtro);
                                            $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, $Paginacao->Atual, $Paginacao->Limite, NULL, " ORDER BY {$Indice} ASC ");
                                            echo "<div class=\"adv-table\" style='overflow: visible;overflow-x: scroll;'>";
                                            if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
                                                echo "<table style='word-wrap:break-word;' id=\"{$Tabela}\" class=\"table table-bordered table-striped table-condensed\">";
                                                echo "<thead><tr>";
                                                //montamos o grid - nome titulo do resultado
                                                foreach ($Grid as $key => $value) {
                                                    echo "<th class=\"text-center\">{$key}</th>";
                                                }
                                                echo "<th id={$Indice} class=\"text-center nomeindice\">Editar | Excluir | Indisponível</th>";

                                                echo "</tr>\n</thead><tbody>";
                                                $i = ($Paginacao->Pagina < 1) ? 0 : ($Paginacao->Pagina) * $Paginacao->Limite;
                                                foreach ($Consultar as $value) {
                                                    ++$i;
                                                    echo "<tr id=\"tr{$value["{$Indice}"]}\" class=\"excluir text-center\">\n";

//montamos o formulario de exclusão
                                                    if ($Permissoes['PTC0020']['LIXEIRA'] == 1) {
                                                        $str_deletar = <<<EOT
<a class="btn btn-danger btn-xs excluiritem"  onclick="javascript: if (!confirm('Você realmente deseja excluir este registro?')){return false;}"  href="ItemVenda.php?Acao=Deletar&id={$value["{$Indice}"]}" id="{$value["{$Indice}"]}"><i class="fa fa-trash-o"></i> Excluir</a>
<a class="btn btn-danger btn-xs excluiritem"  onclick="javascript: if (!confirm('Você realmente deseja tornar indisponível este registro?')){return false;}"  href="ItemVenda.php?Acao=Indisponivel&id={$value["{$Indice}"]}" id="{$value["{$Indice}"]}"><i class="fa fa-lock"></i> Indisponivel</a>
EOT;
                                                    }
                                                    //montamos o grid - resultado
                                                    foreach ($Grid as $rs) {
                                                        if ($rs == ItemVenda::_SITUACAO) {
                                                            if ($value[ItemVenda::_SITUACAO] == "I") {
                                                                echo "<td class=\"wordbreak\" placeholder=\"Item está indisponivel.\">Indisponivel</td>";
                                                            } else if ($value[ItemVenda::_SITUACAO] == "A") {
                                                                echo "<td class=\"wordbreak\" placeholder=\"Item está ativo.\">Ativo</td>";
                                                            }
                                                        } elseif ($rs == 'Interesse') {
                                                            ?><td class='text-xs-center'>
                                                            <?PHP if ($objUsuarioLogado->getCodFornecedor() != "") { ?>
                                                                    <div class='fa-hover col-md-3 col-sm-4'>
                                                                        <a class='btn btn-success' data-toggle='modal' href='#interesse' onclick="carregaDadosItemVenda('<?PHP echo $value[ItemVenda::_EMPRESA]; ?> ', '<?PHP echo $value[ItemVenda::_CODIGO]; ?> ', '<?PHP echo $value[ItemVenda::_DESCRICAO]; ?>', '<?PHP echo $value[ItemVenda::_ESPECIFICACAO]; ?> ', '<?PHP echo $value[ItemVenda::_QUANTIDADE]; ?>', '<?PHP echo $ObjFuncionalidades->FormatarMoeda($value[ItemVenda::_PRECO_UNIT], -2); ?>');">
                                                                            <i class='fa fa-stack-exchange'></i>
                                                                        </a>
                                                                    </div>
                                                                <?PHP } ?>
                                                            </td>
                                                            <?PHP
                                                        } else {
                                                            echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td>";
                                                        }
                                                    }
                                                    echo "<td class=\"col-lg-2 text-center\">";
                                                    if ($Permissoes['PTC0020']['ALTERAR']) {
                                                        echo "<a class=\"btn btn-warning btn-xs\" {$target} href=\"?Acao=Atualizar&id={$value["{$Indice}"]}\"><i class=\"fa fa-pencil\"></i> Editar</a> ";
                                                    }
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
                                            echo "</div>";
//Criar condicao se Acao == Incluir e|ou Alterar
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else if ($Acao == 'Inserir' || $Acao == "Atualizar") {

                            if ($Acao == "Atualizar") {

                                $objItemVenda = BuscaItemVendaPorId((int) $_REQUEST['id']);
                            }
                            ?>
                            <form id="carregar" action="ItemVenda.php" name="carregar" method="post">
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <section class="panel">
                                                <header class="panel-heading">Item de venda</header>
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label> Empresa </label>
                                                                    <input type="hidden" name="<?PHP echo ItemVenda::_ID; ?>" class="form-control" id="<?PHP echo ItemVenda::_ID; ?>" value="<?PHP echo $objItemVenda->getId(); ?>" />
                                                                    <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                                    <select name="<?PHP echo ItemVenda::_EMPRESA; ?>" id="<?PHP echo ItemVenda::_EMPRESA; ?>" class="form-control m-bot15" required >
                                                                        <?PHP
                                                                        $ListaEmpresas = listaEmpresas();
                                                                        while ($row = $ListaEmpresas->fetch(PDO::FETCH_BOTH)) {
                                                                            if (in_array($row[0], explode(",", $objUsuarioLogado->getEmpresa()))) {
                                                                                if ($objItemVenda->getEmpresa() == $row[0]) {
                                                                                    echo "<option id='" . ItemVenda::_EMPRESA . "' selected value='" . $row[0] . "'>" . $row[0] . " - " . $row[1] . "</option>";
                                                                                } else {
                                                                                    echo "<option id='" . ItemVenda::_EMPRESA . "' value='" . $row[0] . "'>" . $row[0] . " - " . $row[1] . "</option>";
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label> Código </label>
                                                                    <input type="text" tabindex="2" class="form-control" required="true" maxlength="15" name="<?PHP echo ItemVenda::_CODIGO; ?>" id="<?PHP echo ItemVenda::_CODIGO; ?>" value="<?PHP echo $objItemVenda->getCodigo(); ?>"/>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label> Descrição </label>
                                                                    <input type="text" tabindex="3" class="form-control"  maxlength="255" required="true" name="<?PHP echo ItemVenda::_DESCRICAO; ?>" id="<?PHP echo ItemVenda::_DESCRICAO; ?>" value="<?PHP echo $objItemVenda->getDesc_item(); ?>"/>                                                       
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <label> Especificação </label>
                                                                    <textarea rows="4" tabindex="4" style="resize: none;" maxlength="255" required="true" class="form-control" name="<?PHP echo ItemVenda::_ESPECIFICACAO; ?>" id="<?PHP echo ItemVenda::_ESPECIFICACAO; ?>"><?PHP echo $objItemVenda->getEspecificacao(); ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label> Quantidade </label>
                                                                    <input type="number" tabindex="5" min="0" step="0.0001"  maxlength="20" required="true" class="form-control" name="<?PHP echo ItemVenda::_QUANTIDADE; ?>" id="<?PHP echo ItemVenda::_QUANTIDADE; ?>" value="<?PHP echo $objItemVenda->getQuantidade(); ?>"/>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label> Preço Unitário </label>
                                                                    <input type="number" tabindex="6" min="0" step="0.0001"  maxlength="20" step="any" required="true" class="form-control"  name="<?PHP echo ItemVenda::_PRECO_UNIT; ?>" id="<?PHP echo ItemVenda::_PRECO_UNIT; ?>" value="<?PHP echo str_replace(",", ".", $objItemVenda->getPrecoUnit()); ?>"/>
                                                                </div>
                                                            </div>  
                                                        </div> 
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label> </label>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label>   </label>
                                                                    <?PHP if (($Acao == "Atualizar" && $Permissoes['PTC0020']['ALTERAR'] == 1) || ($Acao == "Inserir" && $Permissoes['PTC0020']['INCLUIR'] == 1)) { ?>
                                                                        <input type="submit" tabindex="7" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    <?PHP } ?><a tabindex="8"class="btn btn-info" href="ItemVenda.php">Voltar</a>
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
                        <?php } ?>

                        <!--Modal da Mensagem de interesse-->
                        <div class="modal fade modal-dialog-center" id="interesse" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content-wrap">
                                    <div class="modal-content">
                                        <form action="ItemVenda.php" method="post" name="mensagem" id="mensagem">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Mensagem de interesse</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="empresa">Empresa</label>
                                                        <input type="text" tabindex="1" class="form-control" maxlength="2" name="empresa" id="empresa" readonly="true"/>                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="codigo">Código</label>
                                                        <input type="text" tabindex="2" class="form-control" maxlength="15" name="codigo" id="codigo" readonly="true"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="descricao">Descrição</label>
                                                        <input type="text" tabindex="3" class="form-control" maxlength="255" name="descricao"  id="descricao" readonly="true"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="especificacao">Especificação</label>
                                                        <textarea rows="4" tabindex="4" class="form-control" style="resize:none;" name="especificacao" id="especificacao" readonly="true"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="qtd">Quantidade</label>
                                                        <input type="number" tabindex="5" min="0" step="0.0001"  class="form-control"  maxlength="20" name="quantidade" id="quantidade" readonly="true"/>                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="preco">Preço unitário</label>
                                                        <input type="number" min="0" step="0.0001"  tabindex="6" class="form-control"  maxlength="20" step="any" name="preco" id="preco" readonly="true"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="msgInteresse">Mensagem de interesse</label>
                                                        <textarea rows="4" tabindex="7" class="form-control" style="resize:none;" name="msgInteresse" placeholder="Escreva algo..." id="msgInteresse"></textarea>                                
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button data-dismiss="modal" tabindex="8" class="btn btn-default" type="button">Fechar</button>
                                                <button tabindex="9" class="btn btn-success" id="EmailMensagem" name="EmailMensagem" type="submit">Enviar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?PHP //} ?>

                    </div>

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


                                                                            function carregaDadosItemVenda(msgEmpresa, msgCodigo, msgDescricao, msgEspecificacao, msgQuantidade, msgPreco) {

                                                                                document.getElementById('empresa').value = msgEmpresa;
                                                                                document.getElementById('codigo').value = msgCodigo;
                                                                                document.getElementById('descricao').value = msgDescricao;
                                                                                document.getElementById('especificacao').value = msgEspecificacao;
                                                                                document.getElementById('quantidade').value = msgQuantidade;
                                                                                document.getElementById('preco').value = msgPreco;
                                                                            }


        </script>


    </body>
</html>