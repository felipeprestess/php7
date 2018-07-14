<?PHP
    ini_set('display_errors', 1);
    ini_set('display_startup_erros', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    
    include_once '../Model/Moeda.Class.php';
    include_once '../Model/Cotacao.Class.php';
    include_once '../Controller/Session.php';
    include_once '../Controller/DAOCotacao.php';
    include_once '../Controller/DAOMoeda.php';
    include_once '../Controller/DAOCondicaoPagamento.php';    
    include_once '../Controller/DAOTipoFrete.php';
    
    $ObjMoeda = new Moeda();
    $objCotar = new Cotacao();
    $objFuncionalidades = new Funcionalidades();
   
    
    include_once '../Model/DAO.Class.php';

    $ObjDao = new DAO();  
    
    if (isset($_POST['Cadastrar'])) {
    if ($_REQUEST['Acao'] == 'Inserir') {

        $objCotacao = BuscaCotacao((int)$_REQUEST[Cotacao::_ID]);
            if($objCotacao->getId() != "" && !is_null($objCotacao->getId())){
                $objFuncionalidades->ExibeMensagem("Cotação já cadastrada!");
                $objFuncionalidades->VoltarPaginaAnterior();
            }else{
                $id = CadastraCotacao($_POST);
                $id = strtoupper($id);
                $id = $objFuncionalidades->Redirecionar("Cotacoes.php"); 
            }
    } else if ($_POST['Acao'] == "Atualizar") {
            $id = CadastraCotacao($_POST);
            $objFuncionalidades->Redirecionar("Cotacoes.php");
    }
} else {
    if (isset($_REQUEST['Acao'])) {
        $Acao = $_REQUEST['Acao'];
    } else {
        $Acao = "";
    }
}

//if ($Acao == "Cotar") {
//    $_REQUEST['Acao'] = 'Inserir';
//    CadastraCotar($_REQUEST);
//    $objFuncionalidades->Redirecionar("Cotacao.php");
//}
?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
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
        
        <title>Cotar</title>
        
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
                                    
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <label class="col-2 col-form-label">Empresa</label>
                                                <input type="hidden" name="<?PHP echo Cotacao::_ID;?>" class="form-control" id="<?PHP echo Cotacao::ID; ?>" value="<?PHP echo $objCotar->getId(); ?>"/>
                                                <input type="hidden" name="Acao" class="form-control" id="Acao" value="<?PHP echo $Acao; ?>"/>
                                                <input type="text" tabindex="1" maxlength="2" class="form-control disabled" disabled="true" id="empresa" name="empresa" placeholder="Empresa" value="<?PHP echo $objCotar->getCod_empresa();?>"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="col-2 col-form-label">Número</label>
                                            <input type="text" tabindex="2" maxlength="10" class="form-control disabled" disabled="true" id="numero" name="numero" placeholder="Número" value="<?PHP echo $objCotar->getNumero();?>"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="item" class="col-2 col-form-label">Item</label>
                                            <input type="text" tabindex="3" maxlength="10" class="form-control disabled" disabled="true" maxlength="15" id="item" name="item" placeholder="Item" value="<?PHP echo $objCotar->getItem();?>" />
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="filtroPorCodigo" class="col-2 col-form-label">Fabricante</label>                        
                                            <select tabindex="4" class="form-control dropdown disabled" disabled="true" id="fabricante" name="fabricante" placeholder="Fabricante">
                                                <?PHP
                                                    echo '<option>'.$objCotar->getFabricante().'</option>';
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="filtroPorDataVencimento" class="col-2 col-form-label">Entrega prevista até</label>
                                            <input type="date" tabindex="5" class="form-control disabled" disabled="true" id="filtroPorDataVencimento" name="filtroPorDataVencimento" value="<?PHP echo $objFuncionalidades->FormataData($objCotar->getEntrega_prevista(), "-", "/"); ?>"/>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>                                         
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="datalimitecotacao" class="col-2 col-form-label">Data limite para cotação:</label>
                                            <input type="date" tabindex="6" class="form-control disabled" disabled="true"  id="datalimitecotacao" name="datalimitecotacao" value="<?PHP echo $objFuncionalidades->FormataData($objCotar->getData_limite_cotacao(),"-","/"); ?>"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="precounitario" class="col-2 col-form-label">Preço unitário:</label>
                                            <input type="number" tabindex="7" min="0" class="form-control" id="precounitario" name="precounitario" value="<?PHP echo $objCotar->getPreco_unit();?>"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="unidademedida" class="col-2 col-form-label">Unidade medida</label>
                                            <input type="text" tabindex="8" class="form-control" id="unidademedida" name="unidademedida" value="<?PHP echo $objCotar->getUnidade_medida();?>"/>
                                        </div>
                                        <div class="col-sm-1">
                                            <label for="ipi" class="col-2 col-form-label">IPI (%)</label>
                                            <input type="text" tabindex="9" class="form-control" id="ipi" name="ipi" value="<?PHP echo $objCotar->getIpi();?>"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="orcamentovalido" class="col-2 col-form-label">Orçamento válido até</label>
                                            <input type="date" tabindex="10" class="form-control" disabled="true" id="orcamentovalido" name="orcamentovalido" value="<?PHP echo $objFuncionalidades->FormataData($objCotar->getOrcamento_valido(),"-","/"); ?>"/>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>                                  
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label for="prazoentrega" class="col-2 col-form-label">Prazo de entrega (em dias)</label>
                                            <input type="number" min="0" tabindex="11" class="form-control" id="prazoentrega" name="prazoentrega" value="<?PHP echo $objCotar->getPrazo_entrega();?>"/>
                                        </div>  
                                          <div class="col-sm-2">
                                            <label for="moeda" class="col-2 col-form-label">Moeda</label>                                           
                                            <select tabindex="12" class="form-control" id="moeda">
                                                <?PHP
                                                    foreach (listarMoedas() as $moeda => $coluna)
                                                    {
                                                        echo "<option id='".$coluna["MOD_ID"]."'>".$coluna["MOD_DESCRICAO"]."</option>";
                                                    }      
                                                ?>
                                            </select>
                                        </div> 
                                        <div class="col-sm-3">
                                            <label for="condicaopagto" class="col-2 col-form-label">Condições de pagamento</label>
                                            <select class="form-control dropdown" id="condicaopagto" name="condicaopagto" tabindex="13">
                                                <?PHP
                                                  foreach (ListarCondicaoPagamento() as $condicaoPagamento => $coluna)
                                                  {
                                                    echo '<option id="'.$coluna["CPGTO_ID"].'">'.$coluna["CPGTO_DESCRICAO"].'</option>';
                                                  }                                                
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="modoenvio" class="col-2 col-form-label">Modo de envio</label>
                                            <select tabindex="14" class="form-control dropdown" id="modoenvio" name="modoenvio">
                                              <?PHP 
                                                foreach (ListaTipoFrete() as $tipoFrete => $coluna){
                                                    echo '<option id="'.$coluna["TFR_ID"].'">'.$coluna["TFR_DESCRICAO"].'</option>';
                                                }
                                              ?>  
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label for="chat" class="col-2 col-form-label">Chat</label>
                                            <textarea tabindex="15" class="form-control" rows="4" id="chat" name="Chat"><?PHP  ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lm-12 pull-right">
                                            <button tabindex="16" class="btn btn-primary">Salvar</button> 
                                            <button tabindex="17" class="btn btn-primary" type="reset">Limpar</button> 
                                            <button tabindex="18" class="btn btn-primary" onclick="window.open('Home.php','_self')" >Cancelar</button> 
                                        </div>
                                    </div>  
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12"></div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">

                                    </div>
                                    <div class="col-lg-2">
<!--                                    <input type="submit" name="Filtrar" id="Filtrar" onclick="return ValidaFiltros();" class="btn btn-primary" value="Buscar" />
                                        <input type="reset" name="Limpar" class="btn btn-primary" value="Limpar"/>-->
                                    </div>
                                </div>
                     <?PHP }?>
                            </form>                           
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </body>
</html>
