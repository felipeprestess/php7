<?php
ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include_once '../Controller/Session.php';
include_once '../Controller/DAOUsuario.php';
include_once '../Model/PerfilUsuario.Class.php';
include_once '../Model/Perfil.Class.php';
include_once '../Controller/DAOPerfilUsuario.php';
include_once '../Controller/DAOPerfil.php';
include_once '../Model/Funcionalidades.Class.php';
$ObjFuncionalidades = new Funcionalidades();

$objPerfilUsuario = new PerfilUsuario();
$objPerfil = new Perfil();

if (isset($_POST['Cadastrar'])) {
    if ($_POST['Acao'] == "Inserir") {
        $id = cadastraUsuario($_POST, $_FILES);
        $ObjFuncionalidades->ExibeMensagem("Usuário cadastrado com sucesso!");
        $ObjFuncionalidades->Redirecionar("Usuario.php");
    } elseif ($_POST['Acao'] == "Atualizar") {
        $id = cadastraUsuario($_POST, $_FILES);
        $ObjFuncionalidades->ExibeMensagem("Usuário atualizado com sucesso!");
        $ObjFuncionalidades->Redirecionar("Usuario.php?id={$_POST[USUARIO_ID]}&Acao=" . $_POST['Acao']);
    }
} else {
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/DAO.Class.php';

    $ObjDao = new DAO();
    $objUsuario = new Usuario();

    if (isset($_REQUEST['Acao'])) {
        $Acao = $_REQUEST['Acao'];
    } else {
        $Acao = "";
    }
}
if ($Acao == "Deletar") {
    $id = deletarUsuario($_REQUEST);
    $ObjFuncionalidades->Redirecionar("Usuario.php");
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

        <title>Usuario</title>

        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-timepicker/compiled/timepicker.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-colorpicker/css/colorpicker.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="../Public/assets/jquery-multi-select/css/multi-select.css" />


        <!-- Bootstrap core CSS -->
        <link href="../Public/css/bootstrap.min.css" rel="stylesheet">

        <link href="../Public/css/bootstrap-reset.css" rel="stylesheet">

        <!--toastr-->
        <link href="../Public/assets/toast/jquery.toast.css" rel="stylesheet" type="text/css" />

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
            <?php include_once './Menu.php'; ?>
            <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <?PHP if ($Acao == "") { ?>
                            <div class="col-lg-12">

                                <div class="panel panel-default">
                                    <form id="carregar" action="Usuario.php" name="carregar" method="post">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-lg-1">

                                                    <?PHP if ($Permissoes['PTC0014']['INCLUIR'] == 1) { ?>
                                                        <a class="btn btn-primary" href="Usuario.php?Acao=Inserir"><i class="fa fa-file-o"></i> Novo</a>
                                                    <?PHP } ?>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control"  id="filtroPorNome" name="filtroPorNome" value="<?PHP echo $_REQUEST['filtroPorNome'];
                                                    ?>" placeholder="Nome"/>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control"  id="filtroPorUsuraio" name="filtroPorUsuario" value="<?PHP echo $_REQUEST['filtroPorUsuario'];
                                                    ?>" placeholder="Usuario"/>
                                                </div>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control"  id="filtroPorRep" name="filtroPorRep" value="<?PHP echo $_REQUEST['filtroPorRep'];
                                                    ?>" placeholder="Representante"/>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-11"></div>
                                                <?PHP
                                                ?>
                                                <div class="col-lg-1">
                                                    <input type="submit" name="Filtrar" id="Filtrar" onclick="return ValidaFiltros();" class="btn btn-primary" value="Filtrar" />
                                                </div>
                                                <?PHP ?>
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

                                            $SeqFiltro = 0;

                                            if ($_REQUEST['filtroPorUsuario'] != "") {
                                                $FiltroPaginacao .= "&filtroPorUsuario=" . $_REQUEST['filtroPorUsuario'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (" . USUARIO_USUARIO . " = '" . strtoupper($_REQUEST['filtroPorUsuario']) . "' OR " . USUARIO_USUARIO . " LIKE '%" . $_REQUEST['filtroPorUsuario'] . "%')";
                                                    $SeqFiltro = $SeqFiltro + 1;
                                                } else {
                                                    $Filtro .= " (" . USUARIO_USUARIO . " = '" . strtoupper($_REQUEST['filtroPorUsuario']) . "' OR " . USUARIO_USUARIO . " LIKE '%" . strtoupper($_REQUEST['filtroPorUsuario']) . "%')";
                                                    $SeqFiltro = $SeqFiltro + 1;
                                                }
                                            }

                                            if ($_REQUEST['filtroPorNome'] != "") {
                                                $FiltroPaginacao .= "&filtroPorNome=" . $_REQUEST['filtroPorNome'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (" . USUARIO_NOME . " = '" . strtoupper($_REQUEST['filtroPorNome']) . "' OR " . USUARIO_NOME . " LIKE '%" . $_REQUEST['filtroPorNome'] . "%')";
                                                    $SeqFiltro = $SeqFiltro + 1;
                                                } else {
                                                    $Filtro .= " (" . USUARIO_NOME . " = '" . strtoupper($_REQUEST['filtroPorNome']) . "' OR " . USUARIO_NOME . " LIKE '%" . strtoupper($_REQUEST['filtroPorNome']) . "%')";
                                                    $SeqFiltro = $SeqFiltro + 1;
                                                }
                                            }

                                            if ($_REQUEST['filtroPorRep'] != "") {
                                                $FiltroPaginacao .= "&filtroPorRep=" . $_REQUEST['filtroPorRep'];
                                                if ($SeqFiltro > 0) {
                                                    $Filtro .= " AND (" . USUARIO_REPRESENTANTE_ERP . " = '" . strtoupper($_REQUEST['filtroPorRep']) . "' OR " . USUARIO_NOME . " LIKE '%" . $_REQUEST['filtroPorRep'] . "%')";
                                                    $SeqFiltro = $SeqFiltro + 1;
                                                } else {
                                                    $Filtro .= " (" . USUARIO_REPRESENTANTE_ERP . " = '" . strtoupper($_REQUEST['filtroPorRep']) . "' OR " . USUARIO_NOME . " LIKE '%" . strtoupper($_REQUEST['filtroPorRep']) . "%')";
                                                    $SeqFiltro = $SeqFiltro + 1;
                                                }
                                            }

                                            if ($SeqFiltro > 0) {
                                                $Filtro = " " . $Filtro;
                                            }
                                            //Define indice principal da tabela
                                            $Indice = USUARIO_ID;
                                            //Define a tabela que trabalharemos
                                            $Tabela = USUARIO_TABLENAME;
                                            //Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
                                            //Informamos os campos que iremos buscar no banco
                                            $Campos = USUARIO_ID . SEPARADOR . USUARIO_NOME . SEPARADOR . USUARIO_USUARIO . SEPARADOR . USUARIO_REPRESENTANTE_ERP;
                                            //Montamos um array pra fazer a exibiÃ§Ã£o dos resultados em tabela
                                            $Grid = ['Nome' => USUARIO_NOME, 'Usuario' => USUARIO_USUARIO, 'Representante ERP' => USUARIO_REPRESENTANTE_ERP,];
                                            //Criamos uma condiÃ§Ã£o where padrÃ£o para as pesquisas de tabela
                                            $Where = " ORDER BY " . USUARIO_NOME . " asc ";
                                            $Paginacao = new Paginacao($Tabela, $Filtro);

                                            $Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, $Filtro, $Paginacao->Atual, $Paginacao->Limite, '', $Where);
  echo "<div class=\"adv-table\" style='overflow: visible;overflow-x: scroll;'>";
                                            if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
                                                echo "<table id=\"{$Tabela}\"  class=\"table table-bordered table-striped table-condensed\">";
                                                echo "<thead><tr>";

                                                //montamos o grid - nome titulo do resultado
                                                foreach ($Grid as $key => $value) {
                                                    echo "<th>{$key}</th>";
                                                }
                                                echo "<th id={$Indice} class=\"text-center nomeindice\">Editar | Excluir</th>";

                                                echo "</tr>\n</thead><tbody>";
                                                $i = ($Paginacao->Pagina < 1) ? 0 : ($Paginacao->Pagina) * $Paginacao->Limite;
                                                foreach ($Consultar as $value) {
                                                    ++$i;
                                                    echo "<tr id=\"tr{$value["{$Indice}"]}\" class=\"excluir\">\n";


//montamos o formulario de exclusÃ£o
                                                    if ($Permissoes['PTC0014']['LIXEIRA'] == 1) {
                                                        $str_deletar = <<<EOT
<a class="btn btn-danger btn-xs excluiritem" onclick="javascript: if (!confirm('VocÃª realmente deseja excluir este registro?')){return false;}"  href="Usuario.php?Acao=Deletar&id={$value["{$Indice}"]}" id="{$value["{$Indice}"]}"><i class="fa fa-trash-o"></i> Excluir</a>
EOT;
                                                    }
                                                    //montandos o grid - resultado
                                                    foreach ($Grid as $rs) {
                                                        echo "<td class=\"wordbreak\">" . $ObjFuncionalidades->LimpaString($value["{$rs}"]) . "</td>";
                                                    }
                                                    echo "<td class=\"col-lg-2 text-center\">";
                                                    echo "<a class=\"btn btn-warning btn-xs\" {$_SESSION['target']} href=\"?Acao=Atualizar&id={$value[USUARIO_ID]}\"><i class=\"fa fa-pencil\"></i> Editar</a> ";
                                                    echo " {$str_deletar}";
                                                    echo "</td>\n";
                                                    echo "</tr>\n";
                                                }
                                                echo "</tbody></table>";
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
                        } elseif ($Acao == 'Inserir' || $Acao == "Atualizar") {
                            include_once '../Model/Usuario.Class.php';
                            include_once '../Controller/DAOUsuario.php';

                            $objUsuario = new Usuario();

                            if ($Acao == "Atualizar") {
                                include_once '../Model/PerfilUsuario.Class.php';
                                include_once '../Controller/DAOPerfilUsuario.php';

                                $objPerfilUsuarioLogado = new PerfilUsuario();

                                $objUsuario = BuscaUsuarioPorID($_REQUEST['id']);


                                $PerfilUsuarioLogado = buscaPerfilDoUsuarioPorId($objUsuarioLogado->getID());
                                $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($_SESSION['id']);
                                $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());
                                include './MenuUsuario.php';
                            }
                            ?>
                            <form id="carregar" action="Usuario.php" name="carregar" method="post" enctype="multipart/form-data">
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <section class="panel">
                                                <header class="panel-heading">
                                                    Usuario
                                                </header>
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label> Nome </label>
                                                                    <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>" />
                                                                    <input type="hidden" name="<?PHP echo USUARIO_ID; ?>" class="form-control" id="<?PHP echo USUARIO_ID; ?>" value="<?PHP echo $objUsuario->getId(); ?>" />
                                                                    <input required=""  class="form-control" type="text" name="<?PHP echo USUARIO_NOME; ?>" id="<?PHP echo USUARIO_NOME; ?>" value="<?PHP echo $objUsuario->getNome(); ?>" />
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label> Usuario </label>
                                                                    <input required="" class="form-control" type="text" name="<?PHP echo USUARIO_USUARIO; ?>" id="<?PHP echo USUARIO_USUARIO; ?>" value="<?PHP echo $objUsuario->getUsuario(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label> Ramal </label>
                                                                    <input  class="form-control" type="text" name="<?PHP echo USUARIO_RAMAL; ?>" id="<?PHP echo USUARIO_RAMAL; ?>" value="<?PHP echo $objUsuario->getRamal(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label> Usuario ERP </label>
                                                                    <input  class="form-control" maxlength="8" type="text" style="text-transform: capitalize;" name="<?PHP echo USUARIO_ERP; ?>" id="<?PHP echo USUARIO_ERP; ?>" value="<?PHP echo $objUsuario->getUsuarioERP(); ?>"  />
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <label> Representante ERP </label>
                                                                    <input class="form-control" maxlength="4" type="text" name="<?PHP echo USUARIO_REPRESENTANTE_ERP; ?>" id="<?PHP echo USUARIO_REPRESENTANTE_ERP; ?>" value="<?PHP echo $objUsuario->getRepresentanteERP(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <label> Email </label>
                                                                    <input required="" class="form-control" type="email" name="<?PHP echo USUARIO_EMAIL; ?>" id="<?PHP echo USUARIO_EMAIL; ?>" value="<?PHP echo $objUsuario->getEmail(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-5">
                                                                    <label> Email Secundario </label>
                                                                    <input class="form-control" type="email" name="<?PHP echo USUARIO_EMAIL_SECUNDARIO; ?>" id="<?PHP echo USUARIO_EMAIL_SECUNDARIO; ?>" value="<?PHP echo $objUsuario->getEmailSecundario(); ?>"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <label> Telefone </label>
                                                                    <input required="" class="form-control" type="text" name="<?PHP echo USUARIO_TELEFONE; ?>" id="<?PHP echo USUARIO_TELEFONE; ?>" value="<?PHP echo $objUsuario->getTelefone(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label> Carteira </label>
                                                                    <input required="" class="form-control" type="text" name="<?PHP echo USUARIO_CARTEIRA; ?>" id="<?PHP echo USUARIO_CARTEIRA; ?>" value="<?PHP echo $objUsuario->getCarteira(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label> Empresa </label>
                                                                    <input required="" class="form-control" type="text" name="<?PHP echo USUARIO_EMPRESA; ?>" id="<?PHP echo USUARIO_EMPRESA; ?>" value="<?PHP echo $objUsuario->getEmpresa(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label for="UF">Recebe e-mails aprov/reprov cli.</label>
                                                                    <select name="<?PHP echo USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE; ?>" id="<?PHP echo USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE; ?>" class="form-control m-bot15">
                                                                        <option id='<?PHP echo USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE; ?>' selected value=''></option>
                                                                        <?PHP
                                                                        if ($objUsuario->getRecebeEmailAprovacaoReprovacaoCliente() == "A") {
                                                                            echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE . "' selected value='A'>Aprovação</option>";
                                                                        } else {
                                                                            echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE . "' value='A'>Aprovação</option>";
                                                                        }
                                                                        if ($objUsuario->getRecebeEmailAprovacaoReprovacaoCliente() == "R") {
                                                                            echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE . "' selected value='R'>Reprovação</option>";
                                                                        } else {
                                                                            echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE . "' value='R'>Reprovação</option>";
                                                                        }
                                                                        if ($objUsuario->getRecebeEmailAprovacaoReprovacaoCliente() == "AB") {
                                                                            echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE . "' selected value='AB'>Ambos</option>";
                                                                        } else {
                                                                            echo "<option id='" . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE . "' value='AB'>Ambos</option>";
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label> Cor Menu </label>
                                                                    <?php if (!empty($objUsuario->getCorMenu())) { ?>
                                                                        <input type="color" class="form-control" style="height: 60px;" name="<?PHP echo USUARIO_COR_MENU; ?>" id="<?PHP echo USUARIO_COR_MENU; ?>" value="<?PHP echo $objUsuario->getCorMenu(); ?>"/>
                                                                    <?php } else { ?>
                                                                        <input type="color" class="form-control" style="height: 60px;" name="<?PHP echo USUARIO_COR_MENU; ?>" id="<?PHP echo USUARIO_COR_MENU; ?>" value="#ffffff"/>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label> Cor Texto Menu </label>
                                                                    <?php if (!empty($objUsuario->getCorTextoMenu())) { ?>
                                                                        <input type="color" class="form-control" style="height: 60px;" name="<?PHP echo USUARIO_COR_TEXTO_MENU; ?>" id="<?PHP echo USUARIO_COR_TEXTO_MENU; ?>" value="<?PHP echo $objUsuario->getCorTextoMenu(); ?>"/>
                                                                    <?php } else { ?>
                                                                        <input type="color" class="form-control" style="height: 60px;" name="<?PHP echo USUARIO_COR_TEXTO_MENU; ?>" id="<?PHP echo USUARIO_COR_TEXTO_MENU; ?>" value="#000000" />
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label> Imagem </label>
                                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                                            <?PHP if ($objUsuario->getImagem() != "") { ?>
                                                                                <img src="../Public/img/Usuarios/<?PHP echo $objUsuario->getImagem(); ?>" alt="" />
                                                                            <?PHP } else { ?>
                                                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Selecione+a Imagem" alt="" />
                                                                            <?PHP } ?>
                                                                        </div>
                                                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                        <div>
                                                                            <span class="btn btn-white btn-file">
                                                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Selecionar</span>
                                                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                                <input type="file" class="default" name="<?PHP echo USUARIO_IMAGEM; ?>" id="<?PHP echo USUARIO_IMAGEM; ?>" />
                                                                            </span>
                                                                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remover</a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <?PHP if ($Acao == "Atualizar") { ?>
                                                                    <div class="col-lg-2">
                                                                        <label for="UF"> Zera Senha? </label>
                                                                        <input type="checkbox" class="form-control"  name="ZeraSenha" id="ZeraSenha" />
                                                                    </div>
                                                                <?PHP } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-3">
                                                                    <label> Código Fornecedor </label>
                                                                    <input class="form-control" type="text" name="<?PHP echo USUARIO_CODIGO_FORNECEDOR; ?>" id="<?PHP echo assunto; ?>" value="<?PHP echo $objUsuario->getCodFornecedor(); ?>"  />
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <label> Código Comprador </label>
                                                                    <input class="form-control" type="text" name="<?PHP echo USUARIO_CODIGO_COMPRADOR; ?>" id="<?PHP echo USUARIO_CODIGO_COMPRADOR; ?>" value="<?PHP echo $objUsuario->getCodComprador(); ?>"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-9"></div>
                                                                <div class="col-lg-3">
                                                                    <?PHP if (($Acao == "Atualizar" && $Permissoes['PTC0014']['ALTERAR'] == 1) || ($Acao == "Inserir" && $Permissoes['PTC0014']['INCLUIR'] == 1)) { ?>
                                                                        <input type="submit" name="Cadastrar" id="Cadastrar" class="btn btn-info"  value="Confirmar" />    
                                                                    <?PHP } ?>
                                                                    <a class="btn btn-info" href="Usuario.php">Voltar</a>
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

                        <?PHP } ?>
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


        <script type="text/javascript" src="../Public/assets/fuelux/js/spinner.min.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-daterangepicker/moment.min.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script type="text/javascript" src="../Public/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        <script type="text/javascript" src="../Public/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="../Public/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>

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
