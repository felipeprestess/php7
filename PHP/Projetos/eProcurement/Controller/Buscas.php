<?php

/*
  ini_set('display_errors', 1);
  ini_set('display_startup_erros', 1);
  error_reporting(E_ALL); */

if (!function_exists("formataStringSemCaracteres")) {

    function formataStringSemCaracteres($string) {
        $FORMATAR = STR_REPLACE("Ã", "A", $string);
        $FORMATAR = STR_REPLACE("Â", "A", $FORMATAR);
        $FORMATAR = STR_REPLACE("Ô", "O", $FORMATAR);
        $FORMATAR = STR_REPLACE("Ê", "E", $FORMATAR);
        $FORMATAR = STR_REPLACE("Á", "A", $FORMATAR);
        $FORMATAR = STR_REPLACE("À", "A", $FORMATAR);
        $FORMATAR = STR_REPLACE("É", "E", $FORMATAR);
        $FORMATAR = STR_REPLACE("Ê", "E", $FORMATAR);
        $FORMATAR = STR_REPLACE("È", "E", $FORMATAR);
        $FORMATAR = STR_REPLACE("Í", "I", $FORMATAR);
        $FORMATAR = STR_REPLACE("Ì", "I", $FORMATAR);
        $FORMATAR = STR_REPLACE("Ó", "O", $FORMATAR);
        $FORMATAR = STR_REPLACE("Õ", "O", $FORMATAR);
        $FORMATAR = STR_REPLACE("Ú", "U", $FORMATAR);
        $FORMATAR = STR_REPLACE("Ç", "C", $FORMATAR);
        $FORMATAR = STR_REPLACE(",", "", $FORMATAR);
        $FORMATAR = STR_REPLACE("-", "", $FORMATAR);
        $FORMATAR = STR_REPLACE("'", "", $FORMATAR);

        return $FORMATAR;
    }

}

function BuscaClientePedido($db) {
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Controller/Session.php';
    include_once '../Model/Funcionalidades.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Model/Pessoa.Class.php';
    include_once '../Model/Cidade.Class.php';
    include_once '../Model/Estado.Class.php';
    include_once '../Model/EnderecoPessoa.Class.php';
    include_once '../Controller/DAOPessoa.php';

    $objFuncionalidades = new Funcionalidades();
    $objDao = new DAO();
    $objPessoa = new Pessoa();
    $objCidade = new Cidade();
    $objEstado = new Estado();
    $ObjUsuario = new Usuario();
    $objEnderecoPessoa = new EnderecoPessoa();

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : null;

    $ID = $_SESSION['id'];
    $ResultadoBusca = $objDao->Consultar(USUARIO_TABLENAME, USUARIO_VISUALIZA_CLIENTE_SEM_CANAL . SEPARADOR . USUARIO_REPRESENTANTE_ERP . SEPARADOR . USUARIO_CADASTRA_PEDIDO_OUTRO, WHERE . USUARIO_ID . IGUAL . $ID);
//var_dump($ResultadoBusca);
    $RepresentanteERP = $ResultadoBusca[0][USUARIO_REPRESENTANTE_ERP];
    $Usuario = $ResultadoBusca[0][USUARIO_CADASTRA_PEDIDO_OUTRO];

    if ($objDao->getEmpresaPortal() == "SA" || $objDao->getEmpresaPortal() == "TH") {
        $funcaoTamanho = "LEN";
    } else {
        $funcaoTamanho = "LENGTH";
    }

    if ($RepresentanteERP != "") {
        if ($Usuario == 1) {
            $Resultado = $db->query("SELECT PES." . PESSOA_ID . ", PES." . PESSOA_COD . ", PES." . PESSOA_RAZAO_SOCIAL . ", PES." . PESSOA_CNPJ . ", PES." . PESSOA_CPF . ", CID." . CIDADE_NOME . ", EST." . ESTADO_SIGLA . ", {$funcaoTamanho}(replace(PES." . PESSOA_RAZAO_SOCIAL . ", ' ','')) as CONT FROM " . PESSOA_TABLENAME . " PES INNER JOIN " . BASE_TABLENAME . " ON (" . BASE_ID . IGUAL . PESSOA_ID . ") LEFT JOIN " . ENDERECO_TABLENAME . " EDP ON (EDP." . ENDERECO_PESSOA_ID . " = PES." . PESSOA_ID . ") LEFT JOIN " . CIDADE_TABLENAME . " CID ON(CID." . CIDADE_ID . " = EDP." . ENDERECO_CIDADE_ID . ") LEFT JOIN " . ESTADO_TABLENAME . " EST ON(EST." . ESTADO_ID . " = CID." . CIDADE_ID_ESTADO . ") WHERE (PES." . PESSOA_COD . " LIKE '%{$item}%' OR PES." . PESSOA_RAZAO_SOCIAL . " LIKE '%" . strtoupper($item) . "%' OR PES." . PESSOA_CPF . " LIKE '%{$item}%' OR PES." . PESSOA_CNPJ . " LIKE '%{$item}%')  ORDER BY CONT ASC");
        } else {
            $Nivel = BuscaNivelCanalVenda($RepresentanteERP);

            $filtroCanalVenda = " PES." . PESSOA_COD . " IN ( SELECT CCV.COD_CLIENTE FROM CLI_CANAL_VENDA CCV WHERE CCV.COD_CLIENTE = PES." . PESSOA_COD . " AND CCV.COD_NIVEL_{$Nivel} = {$RepresentanteERP})";

            $OrTransicao = buscaCanalVendaTransicaoSa($RepresentanteERP);

            if ($nivel_4 != "" && !is_null($nivel_4)) {
                $Resultado = $db->query("SELECT DISTINCT PES." . PESSOA_ID . ", PES." . PESSOA_COD . ", PES." . PESSOA_RAZAO_SOCIAL . ", PES." . PESSOA_CNPJ . ", PES." . PESSOA_CPF . ", CID." . CIDADE_NOME . ", EST." . ESTADO_SIGLA . ", {$funcaoTamanho}(replace(PES." . PESSOA_RAZAO_SOCIAL . ", ' ','')) as CONT FROM " . PESSOA_TABLENAME . " PES INNER JOIN " . BASE_TABLENAME . " ON (" . BASE_ID . IGUAL . PESSOA_ID . ") LEFT JOIN " . ENDERECO_TABLENAME . " EDP ON (EDP." . ENDERECO_PESSOA_ID . " = PES." . PESSOA_ID . E . ENDERECO_TIPO . IGUAL . "'P') LEFT JOIN " . CIDADE_TABLENAME . " CID ON(CID." . CIDADE_ID . " = EDP." . ENDERECO_CIDADE_ID . ") LEFT JOIN " . ESTADO_TABLENAME . " EST ON(EST." . ESTADO_ID . " = CID." . CIDADE_ID_ESTADO . ") WHERE (PES." . PESSOA_COD . " LIKE '%{$item}%' OR PES." . PESSOA_RAZAO_SOCIAL . " LIKE '%" . strtoupper($item) . "%' OR PES." . PESSOA_CPF . " LIKE '%{$item}%' OR PES." . PESSOA_CNPJ . " LIKE '%{$item}%') AND ( {$filtroCanalVenda} {$OrTransicao} OR " . BASE_PROPRIETARIO_ID . IGUAL . $ID . " OR " . BASE_CRIADOR_ID . IGUAL . $ID . " )   ORDER BY CONT ASC");
            } else {
                $Resultado = $db->query("SELECT PES." . PESSOA_ID . ", PES." . PESSOA_COD . ", PES." . PESSOA_RAZAO_SOCIAL . ", PES." . PESSOA_CNPJ . ", PES." . PESSOA_CPF . ", CID." . CIDADE_NOME . ", EST." . ESTADO_SIGLA . ", {$funcaoTamanho}(replace(PES." . PESSOA_RAZAO_SOCIAL . ", ' ','')) as CONT FROM " . PESSOA_TABLENAME . " PES INNER JOIN " . BASE_TABLENAME . " ON (" . BASE_ID . IGUAL . PESSOA_ID . ") LEFT JOIN " . ENDERECO_TABLENAME . " EDP ON (EDP." . ENDERECO_PESSOA_ID . " = PES." . PESSOA_ID . E . ENDERECO_TIPO . IGUAL . "'P') LEFT JOIN " . CIDADE_TABLENAME . " CID ON(CID." . CIDADE_ID . " = EDP." . ENDERECO_CIDADE_ID . ") LEFT JOIN " . ESTADO_TABLENAME . " EST ON(EST." . ESTADO_ID . " = CID." . CIDADE_ID_ESTADO . ") WHERE (PES." . PESSOA_COD . " LIKE '%{$item}%' OR PES." . PESSOA_RAZAO_SOCIAL . " LIKE '%" . strtoupper($item) . "%' OR PES." . PESSOA_CPF . " LIKE '%{$item}%' OR PES." . PESSOA_CNPJ . " LIKE '%{$item}%') AND ( {$filtroCanalVenda} OR " . BASE_PROPRIETARIO_ID . IGUAL . $ID . " OR " . BASE_CRIADOR_ID . IGUAL . $ID . " )   ORDER BY CONT ASC");
            }
        }
    } else {
        $Resultado = $db->query("SELECT CLI.COD_CLIENTE, CLI.NOM_CLIENTE, CLI.NUM_CGC_CPF, CID.DEN_CIDADE, CID.COD_UNI_FEDER, {$funcaoTamanho}(replace(CLI.NOM_CLIENTE, ' ','')) as CONT FROM clientes CLI INNER JOIN CIDADES CID ON (CID.COD_CIDADE = CLI.COD_CIDADE) WHERE CLI.IES_SITUACAO = 'A' AND (CLI.NOM_CLIENTE LIKE '%" . strtoupper($item) . "%'  OR CLI.NUM_CGC_CPF LIKE '%{$item}%' OR CLI.COD_CLIENTE LIKE '%{$item}%' OR REPLACE(REPLACE(REPLACE(CLI.NUM_CGC_CPF, '.', ''),'-',''),'/','') LIKE '%{$item}%') ORDER BY CONT ASC");
    }

    if ($_GET['dev'] == 'true') {
        //$e = $Resultado->fetchAll(PDO::FETCH_ASSOC);
        //echo json_encode($e);
        var_dump($Resultado->fetchAll(PDO::FETCH_ASSOC));
    }


    $dados = array();
    $i = 0;
    while ($Resultado2 = $Resultado->fetch(PDO::FETCH_ASSOC)) {
        $dados[$i]['COD_CLIENTE'] = $Resultado2[PESSOA_COD];
        $dados[$i]['ID'] = $Resultado2[PESSOA_ID];
        $dados[$i]['NOM_CLIENTE'] = strtoupper(preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2[PESSOA_RAZAO_SOCIAL]))));
        $dados[$i]['NUM_CGC_CPF'] = $Resultado2[PESSOA_CNPJ];
        $dados[$i][PESSOA_CPF] = $Resultado2[PESSOA_CPF];
        $dados[$i]['DEN_CIDADE'] = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2[CIDADE_NOME])));
        $dados[$i]['COD_UNI_FEDER'] = $Resultado2[ESTADO_SIGLA];
        $dados[$i]['CONT'] = $Resultado2['CONT'];

        $dados[$i]['completo'] = trim($Resultado2[PESSOA_ID]) . " - " . trim(strtoupper(formataStringSemCaracteres(strtoupper($Resultado2[PESSOA_RAZAO_SOCIAL])))) . " - " . trim($Resultado2[PESSOA_CNPJ]) . "   " . trim(strtoupper(formataStringSemCaracteres(strtoupper($Resultado2[CIDADE_NOME])))) . "/" . trim($Resultado2[ESTADO_SIGLA]);
        $i++;
    }




    return json_encode($dados);
}

function CaracteristicasFiltroEstoqueDimensional($db) {
    include_once '../Model/DAO.Class.php';
    include_once '../Controller/DAOEstoqueDimensional.php';

    $objDao = new DAO();
    $lista = listaCaracteristicaPorRand($_REQUEST['rand'], $_REQUEST['Filtro']);

    return json_encode($lista);
}

function ListaFamiliaEmpresa($db) {
    include_once '../Controller/DAOEstoqueDimensional.php';

    $lista = listaFamiliaPorEmpresa($_REQUEST['empresa']);
    return json_encode($lista);
}

function BuscaRepresentante($db) {
    include_once '../Model/DaoErp.Class.php';
    include_once '../Controller/Session.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Model/Usuario.Class.php';

    $objDao = new DaoErp();
    $objUsuario = new Usuario();

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;

    $objUsuario = BuscaUsuarioPorID($_SESSION['id']);

    if ($objUsuario->getLiberaModificacaoRepresentante() == 1) {
        $lista = $objDao->ConsultaGenerica("select DISTINCT cod_repres, raz_social from representante  INNER JOIN " . USUARIO_TABLENAME . " ON (" . USUARIO_REPRESENTANTE_ERP . " = cast(cod_repres as varchar))  WHERE " . USUARIO_REPRESENTANTE_ERP . " ='{$item}' OR raz_social LIKE '%" . $item . "%'  ORDER BY raz_social ASC");
    } else {
        $lista = $objDao->ConsultaGenerica("select DISTINCT cod_repres, raz_social from representante  INNER JOIN " . USUARIO_TABLENAME . " ON (" . USUARIO_REPRESENTANTE_ERP . " = cast(cod_repres as varchar))  WHERE (" . USUARIO_REPRESENTANTE_ERP . " ='{$item}' OR raz_social LIKE '%" . $item . "%') and " . USUARIO_REPRESENTANTE_ERP . " = '{$objUsuario->getRepresentanteERP()}'  ORDER BY raz_social ASC");
    }
    return json_encode($lista->fetchAll(PDO::FETCH_ASSOC));
}

function BuscaCondicaoPagamento($db) {
    include_once '../Model/CondicaoPagamento.Class.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Controller/Session.php';
    include_once '../Controller/DAOCondicaoPagamento.php';
    include_once '../Model/CondicaoPagamentoCliente.Class.php';
    include_once '../Controller/DAOCondicaoPagamentoCliente.php';
    include_once '../Controller/DAOPessoa.php';
    include_once '../Model/Pessoa.Class.php';

    $objDao = new DAO();
    $objPessoa = new Pessoa();
    $ObjCondicaoPagamento = new CondicaoPagamento();
    $objCondicaoPagamentoCliente = new CondicaoPagamentoCliente();


    if (isset($_GET['Usuario'])) {
        $_SESSION['ultimoClientePedido'] = NULL;
    }

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;

    if (isset($_SESSION['ultimoClientePedido']) && $_SESSION['ultimoClientePedido'] != "") {

        $Cliente = $_SESSION['ultimoClientePedido'];

        $objPessoa = BuscaPessoaPorCod($Cliente);

        if ($objPessoa->getID() != "" && !is_null($objPessoa->getID())) {
            $ExisteCondicoes = ConfirmaCondicaoPagamentoClientePorIdCliente($objPessoa->getID());
            if ($ExisteCondicoes == true) {
                if (isset($_GET['Usuario'])) {
                    $Resultado = ListaCondicoesPagamentoBuscasEspecificoCliente($item, $objPessoa->getID(), 'ver todas');
                } else {
                    $Resultado = ListaCondicoesPagamentoBuscasEspecificoCliente($item, $objPessoa->getID());
                }
            } else {
                if (isset($_GET['Usuario'])) {
                    $Resultado = ListaCondicoesPagamentoBuscas($item, '', 'ver todas');
                } else {
                    $Resultado = ListaCondicoesPagamentoBuscas($item, '');
                }
            }
        } else {
            if (isset($_GET['Usuario'])) {
                $Resultado = ListaCondicoesPagamentoBuscas($item, '', 'ver todas');
            } else {
                $Resultado = ListaCondicoesPagamentoBuscas($item, '');
            }
        }

        if ($Resultado != false) {
            $i = 0;

            while ($Resultado2 = $Resultado->fetch(PDO::FETCH_BOTH)) {
                $mediaDias = BuscaMediaDiasCondicaoPagamentoDiretoERP($Resultado2[1]);
                if (!is_null($objPessoa->getQuantidadeMaximaDiasCondicaoPagmento()) && $objPessoa->getQuantidadeMaximaDiasCondicaoPagmento() != 0) {
                    if ($objPessoa->getQuantidadeMaximaDiasCondicaoPagmento() >= $mediaDias) {
                        $dados[$i][CONDICAO_PAGAMENTO_ID] = $Resultado2[0];
                        $dados[$i][CONDICAO_PAGAMENTO_COD_ERP] = $Resultado2[1];
                        $dados[$i][CONDICAO_PAGAMENTO_NOME] = $Resultado2[2];
                        $dados[$i]['cont'] = $Resultado2[3];
                        $i++;
                    }
                } else {
                    $dados[$i][CONDICAO_PAGAMENTO_ID] = $Resultado2[0];
                    $dados[$i][CONDICAO_PAGAMENTO_COD_ERP] = $Resultado2[1];
                    $dados[$i][CONDICAO_PAGAMENTO_NOME] = $Resultado2[2];
                    $dados[$i]['cont'] = $Resultado2[3];
                    $i++;
                }
            }

            return json_encode($dados);
        } else {
            return false;
        }
    } else {
        if (isset($_GET['Usuario'])) {
            $Resultado = ListaCondicoesPagamentoBuscas($item, '', 'ver todas');
        } else {
            $Resultado = ListaCondicoesPagamentoBuscas($item, '');
        }
        return json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
    }
}

function BuscaClientePedidoIndicacao($db) {
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Controller/Session.php';

    $objDao = new DAO();
    $ObjUsuario = new Usuario();

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : null;

    $ID = $_SESSION['id'];
    $ResultadoBusca = $objDao->Consultar(USUARIO_TABLENAME, USUARIO_REPRESENTANTE_ERP . SEPARADOR . USUARIO_CADASTRA_PEDIDO_OUTRO, WHERE . USUARIO_ID . IGUAL . $ID);
//var_dump($ResultadoBusca);
    $RepresentanteERP = $ResultadoBusca[0][USUARIO_REPRESENTANTE_ERP];
    $Usuario = $ResultadoBusca[0][USUARIO_CADASTRA_PEDIDO_OUTRO];
    if ($RepresentanteERP != "") {
        if ($Usuario == 1) {
            if ($objDao->getEmpresaPortal() == "SA" || $objDao->getEmpresaPortal() == "TH") {
                $Resultado = $db->query("SELECT CLI.COD_CLIENTE, CLI.NOM_CLIENTE, CLI.NUM_CGC_CPF, CID.DEN_CIDADE, CID.COD_UNI_FEDER, LEN(replace(CLI.NOM_CLIENTE, ' ', '')) as CONT FROM clientes CLI INNER JOIN CIDADES CID ON (CID.COD_CIDADE = CLI.COD_CIDADE)  where CLI.IES_SITUACAO = 'A' AND (CLI.COD_CLIENTE LIKE '%{$item}%' OR CLI.NOM_CLIENTE LIKE '%" . strtoupper($item) . "%'  OR CLI.NUM_CGC_CPF LIKE '%{$item}%') ORDER BY CONT ASC");
            } else {
                $Resultado = $db->query("SELECT CLI.COD_CLIENTE, CLI.NOM_CLIENTE, CLI.NUM_CGC_CPF, CID.DEN_CIDADE, CID.COD_UNI_FEDER, LENGTH(replace(CLI.NOM_CLIENTE, ' ')) as CONT FROM clientes CLI INNER JOIN CIDADES CID ON (CID.COD_CIDADE = CLI.COD_CIDADE)  where CLI.IES_SITUACAO = 'A' AND (CLI.COD_CLIENTE LIKE '%{$item}%' OR CLI.NOM_CLIENTE LIKE '%" . strtoupper($item) . "%'  OR CLI.NUM_CGC_CPF LIKE '%{$item}%') ORDER BY CONT ASC");
            }
        } else {
            if ($objDao->getEmpresaPortal() == "SA" || $objDao->getEmpresaPortal() == "TH") {
                $Resultado = $db->query("SELECT CLI.COD_CLIENTE, CLI.NOM_CLIENTE, CLI.NUM_CGC_CPF, CID.DEN_CIDADE, CID.COD_UNI_FEDER, LEN(replace(CLI.NOM_CLIENTE, ' ', '')) as CONT FROM clientes CLI INNER JOIN CIDADES CID ON (CID.COD_CIDADE = CLI.COD_CIDADE) where CLI.IES_SITUACAO = 'A' AND (CLI.COD_CLIENTE LIKE '%{$item}%' OR CLI.NOM_CLIENTE LIKE '%{$item}%'  OR CLI.NUM_CGC_CPF LIKE '%{$item}%') ORDER BY CONT ASC");
            } else {
                $Resultado = $db->query("SELECT CLI.COD_CLIENTE, CLI.NOM_CLIENTE, CLI.NUM_CGC_CPF, CID.DEN_CIDADE, CID.COD_UNI_FEDER, LENGTH(replace(CLI.NOM_CLIENTE, ' ')) as CONT FROM clientes CLI INNER JOIN CIDADES CID ON (CID.COD_CIDADE = CLI.COD_CIDADE) where CLI.IES_SITUACAO = 'A' AND (CLI.COD_CLIENTE LIKE '%{$item}%' OR CLI.NOM_CLIENTE LIKE '%{$item}%'  OR CLI.NUM_CGC_CPF LIKE '%{$item}%') ORDER BY CONT ASC");
            }
        }
    } else {
        if ($objDao->getEmpresaPortal() == "SA" || $objDao->getEmpresaPortal() == "TH") {
            $Resultado = $db->query("SELECT CLI.COD_CLIENTE, CLI.NOM_CLIENTE, CLI.NUM_CGC_CPF, CID.DEN_CIDADE, CID.COD_UNI_FEDER, LEN(replace(CLI.NOM_CLIENTE, ' ', '')) as CONT FROM clientes CLI INNER JOIN CIDADES CID ON (CID.COD_CIDADE = CLI.COD_CIDADE) WHERE CLI.IES_SITUACAO <> 'C' AND (CLI.NOM_CLIENTE LIKE '%{$item}%'  OR CLI.NUM_CGC_CPF LIKE '%{$item}%' OR CLI.COD_CLIENTE LIKE '%{$item}%') ORDER BY CONT ASC");
        } else {
            $Resultado = $db->query("SELECT CLI.COD_CLIENTE, CLI.NOM_CLIENTE, CLI.NUM_CGC_CPF, CID.DEN_CIDADE, CID.COD_UNI_FEDER, LENGTH(replace(CLI.NOM_CLIENTE, ' ')) as CONT FROM clientes CLI INNER JOIN CIDADES CID ON (CID.COD_CIDADE = CLI.COD_CIDADE) WHERE CLI.IES_SITUACAO <> 'C' AND (CLI.NOM_CLIENTE LIKE '%{$item}%'  OR CLI.NUM_CGC_CPF LIKE '%{$item}%' OR CLI.COD_CLIENTE LIKE '%{$item}%') ORDER BY CONT ASC");
        }
    }
    $dados = array();
    $i = 0;
    while ($Resultado2 = $Resultado->fetch(PDO::FETCH_ASSOC)) {

        $dados[$i]['COD_CLIENTE'] = $Resultado2['COD_CLIENTE'];
        $dados[$i]['NOM_CLIENTE'] = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2['NOM_CLIENTE'])));
        $dados[$i]['NUM_CGC_CPF'] = $Resultado2['NUM_CGC_CPF'];
        $dados[$i]['DEN_CIDADE'] = $Resultado2['DEN_CIDADE'];
        $dados[$i]['COD_UNI_FEDER'] = $Resultado2['COD_UNI_FEDER'];
        $dados[$i]['CONT'] = $Resultado2['CONT'];
        $i++;
    }
    return json_encode($dados);
}

function BuscaTransportadora($db) {

    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Pessoa.Class.php';
    include_once '../Model/TipoPessoa.Class.php';
    include_once '../Controller/DAOPadroesModulo.php';
    include_once '../Model/TransportadoraUsuario.Class.php';
    include_once '../Controller/DAOTransportadoraUsuario.php';

    $objDao = new DAO();
    $objPessoa = new Pessoa();
    $objTipoPessoa = new TipoPessoa();
    $objTransportadoraUsuario = new TransportadoraUsuario();

    $tipoTransportadora = buscaValorPadraoPorNome("Tipo Transportador");
    $quantidadeTransportadorasUsuario = quantidadeTransportadorasUsuario();

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;

    if ($objDao->getEmpresaPortal() == "SA" || $objDao->getEmpresaPortal() == "TH") {
        $funcaoTamanho = "LEN";
    } else {
        $funcaoTamanho = "LENGTH";
    }


    $query = " SELECT PES_ID, FN.COD_CLIENTE, FN.NOM_CLIENTE, FN.NUM_CGC_CPF, CD.DEN_CIDADE, CD.COD_UNI_FEDER, {$funcaoTamanho}(replace(FN.NOM_CLIENTE, ' ','')) as CONT FROM {$objDao->getSchemaErp()}CLIENTES FN 
              INNER JOIN CIDADES CD ON (CD.cod_cidade = FN.cod_cidade)
              INNER JOIN " . PESSOA_TABLENAME . " ON (" . PESSOA_COD . "=FN.COD_CLIENTE) ";

    if (!isset($_GET['Usuario'])) {
        if ((int) buscaValorPadraoPorNome("RESPEITA USUARIO X TRANSPORTADORA") == 1 && $quantidadeTransportadorasUsuario > 0) {
            $query .= " INNER JOIN " . TRANSPUSUARIO_TABLENAME . " TRU ON (TRU." . TRANSPUSUARIO_PESSOA_ID . " = " . PESSOA_ID . " AND TRU." . TRANSPUSUARIO_USUARIO_ID . " = " . $_SESSION['id'] . ") ";
        }
    }
    $query .= " INNER JOIN " . TIPO_PESSOA_TABLENAME . " ON (" . TIPO_PESSOA_ID . " = " . PESSOA_TIPO . " AND " . TIPO_PESSOA_CODIGO_ERP . " = '" . $tipoTransportadora . "')
              WHERE FN.ies_situacao = 'A' 
              AND (FN.COD_CLIENTE LIKE '%{$item}%' OR FN.NOM_CLIENTE LIKE '%{$item}%' OR FN.NUM_CGC_CPF LIKE '%{$item}%')";

    // Se estiver cadastrando 'usuario X transportadora' não tráz as que ja estao cadastradas          
    if (isset($_GET['Usuario'])) {
        $query .= " AND " . PESSOA_ID . " NOT IN (SELECT " . TRANSPUSUARIO_PESSOA_ID . " FROM " . TRANSPUSUARIO_TABLENAME . WHERE . TRANSPUSUARIO_USUARIO_ID . " = " . $_SESSION['id'] . ") ";
    }

    $query .= " ORDER BY CONT ASC ";

    //echo $query;
    $Resultado = $db->query($query);


    $dados = array();
    $i = 0;
    while ($Resultado2 = $Resultado->fetch(PDO::FETCH_ASSOC)) {

        $dados[$i]['COD_CLIENTE'] = $Resultado2['COD_CLIENTE'];
        $dados[$i]['NOM_CLIENTE'] = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2['NOM_CLIENTE'])));
        $dados[$i]['NUM_CGC_CPF'] = $Resultado2['NUM_CGC_CPF'];
        $dados[$i]['DEN_CIDADE'] = $Resultado2['DEN_CIDADE'];
        $dados[$i]['COD_UNI_FEDER'] = $Resultado2['COD_UNI_FEDER'];
        $dados[$i]['CONT'] = $Resultado2['CONT'];
        $dados[$i]['PES_ID'] = $Resultado2['PES_ID'];
        $i++;
    }
    return json_encode($dados);
}

function BuscaConcorrente($db) {

    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Pessoa.Class.php';
    include_once '../Controller/DAOPadroesModulo.php';


    $objDao = new DAO();
    $objPessoa = new Pessoa();

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;

    if ($objDao->getEmpresaPortal() == "SA" || $objDao->getEmpresaPortal() == "TH") {
        $funcaoTamanho = "LEN";
    } else {
        $funcaoTamanho = "LENGTH";
    }


    $query = " SELECT PES_ID, FN.COD_CLIENTE, FN.NOM_CLIENTE, FN.NUM_CGC_CPF, CD.DEN_CIDADE, CD.COD_UNI_FEDER, {$funcaoTamanho}(replace(FN.NOM_CLIENTE, ' ','')) as CONT FROM {$objDao->getSchemaErp()}CLIENTES FN 
              INNER JOIN CIDADES CD ON (CD.cod_cidade = FN.cod_cidade)
              INNER JOIN " . PESSOA_TABLENAME . " ON (" . PESSOA_COD . "=FN.COD_CLIENTE AND " . PESSOA_CONCORRENTE . " = 1) ";

    $query .= " WHERE FN.ies_situacao = 'A' 
              AND (FN.COD_CLIENTE LIKE '%{$item}%' OR FN.NOM_CLIENTE LIKE '%{$item}%' OR FN.NUM_CGC_CPF LIKE '%{$item}%')";

    $query .= " ORDER BY CONT ASC ";
    $Resultado = $db->query($query);


    $dados = array();
    $i = 0;
    while ($Resultado2 = $Resultado->fetch(PDO::FETCH_ASSOC)) {

        $dados[$i]['COD_CLIENTE'] = $Resultado2['COD_CLIENTE'];
        $dados[$i]['NOM_CLIENTE'] = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2['NOM_CLIENTE'])));
        $dados[$i]['NUM_CGC_CPF'] = $Resultado2['NUM_CGC_CPF'];
        $dados[$i]['DEN_CIDADE'] = $Resultado2['DEN_CIDADE'];
        $dados[$i]['COD_UNI_FEDER'] = $Resultado2['COD_UNI_FEDER'];
        $dados[$i]['CONT'] = $Resultado2['CONT'];
        $dados[$i]['PES_ID'] = $Resultado2['PES_ID'];
        $i++;
    }
    return json_encode($dados);
}

function BuscaPortadorPorTipoPortador($db) {

    $item = (isset($_GET['Filtro']) && !empty($_GET['Filtro'])) ? strtoupper($_GET['Filtro']) : false;



    $Resultado = $db->query("SELECT cod_portador, nom_portador FROM portador where ies_tip_portador = '{$item}'");
    $dados = array();
    $i = 0;
    while ($Resultado2 = $Resultado->fetch(PDO::FETCH_BOTH)) {

        $dados[$i]['cod_portador'] = $Resultado2[0];
        $dados[$i]['nom_portador'] = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2[1])));

        $i++;
    }
    return json_encode($dados);
}

function BuscaCanalVendaRepresentante($db) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DaoErp.Class.php';

    $objDaoErp = new DaoErp();
    $objDao = new DAO();

    function BuscaNomeRepresentante($cod) {
        include_once '../Model/DaoErp.Class.php';

        $objDaoErp = new DaoErp();
        $representante = $objDaoErp->BuscaRepresentantePorCod($cod);
        $representante = $representante->fetchAll(PDO::FETCH_ASSOC);
        if ($representante[0]['raz_social'] != "" && !is_null($representante[0]['raz_social'])) {
            $nome = $representante[0]['raz_social'];
        } else {
            $nome = '';
        }
        return $nome;
    }

    $RepresentanteERP = (isset($_GET['Filtro']) && !empty($_GET['Filtro'])) ? strtoupper($_GET['Filtro']) : false;

    $Select = $objDaoErp->ConsultaGenerica("SELECT cod_nivel_1, cod_nivel_2, cod_nivel_3, cod_nivel_4, cod_nivel_5, cod_nivel_6, cod_nivel_7 FROM canal_venda WHERE (cod_nivel_1 = " . $RepresentanteERP . " OR cod_nivel_2 = " . $RepresentanteERP . " OR cod_nivel_3 = " . $RepresentanteERP . " OR cod_nivel_4 = " . $RepresentanteERP . " OR cod_nivel_5 = " . $RepresentanteERP . " OR cod_nivel_6 = " . $RepresentanteERP . " OR cod_nivel_7 = " . $RepresentanteERP . ")");
    while ($row = $Select->fetch(PDO::FETCH_BOTH)) {
        if ($row[6] == $RepresentanteERP) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "07";
        } elseif ($row[5] == $RepresentanteERP && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "06";
        } elseif ($row[4] == $RepresentanteERP && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "05";
        } elseif ($row[3] == $RepresentanteERP && $row[4] == 0 && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "04";
        } elseif ($row[2] == $RepresentanteERP && $row[3] == 0 && $row[4] == 0 && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "03";
        } elseif ($row[1] == $RepresentanteERP && $row[2] == 0 && $row[3] == 0 && $row[4] == 0 && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "02";
        } elseif ($row[0] == $RepresentanteERP && $row[1] == 0 && $row[2] == 0 && $row[3] == 0 && $row[4] == 0 && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "01";
        }
    }

    $dados['Nivel_1'] = $NivelUm;
    $dados['Nivel_1_desc'] = BuscaNomeRepresentante($NivelUm);
    $dados['Nivel_2'] = $NivelDois;
    $dados['Nivel_2_desc'] = BuscaNomeRepresentante($NivelDois);
    $dados['Nivel_3'] = $NivelTres;
    $dados['Nivel_3_desc'] = BuscaNomeRepresentante($NivelTres);
    $dados['Nivel_4'] = $NivelQuatro;
    $dados['Nivel_4_desc'] = BuscaNomeRepresentante($NivelQuatro);
    $dados['Nivel_5'] = $NivelCinco;
    $dados['Nivel_5_desc'] = BuscaNomeRepresentante($NivelCinco);
    $dados['Nivel_6'] = $NivelSeis;
    $dados['Nivel_6_desc'] = BuscaNomeRepresentante($NivelSeis);
    $dados['Nivel_7'] = $NivelSete;
    $dados['Nivel_7_desc'] = BuscaNomeRepresentante($NivelSete);
    $dados['Nivel'] = $Nivel;

    return json_encode($dados);
}

function BuscaTipoEndereco($db) {
    include_once '../Model/TipoEndereco.Class.php';
    include_once '../Controller/DAOTipoEndereco.php';
    include_once '../Controller/DAOEnderecoPessoa.php';

    $objTipoEndereco = new TipoEndereco();

    $ListaTipoEndereco = listaTipoEnderecoPessoa();
    $i = 0;
    $retorno = false;

    $endereco = strtoupper($_REQUEST['Filtro']);

    foreach ($ListaTipoEndereco as $chave_do_indice => $valor_do_indice) {

        $retorno = explode(trim(strtoupper($valor_do_indice[TIPOENDERECO_NOME])) . " ", $endereco);

        if (isset($retorno[1]) && $retorno[1] != "" && !is_null($retorno[1])) {
            $dados['END'] = preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $retorno[1]);
            return json_encode($dados);
            exit();
        }
    }
    $dados['END'] = $endereco;
    return json_encode($dados);
}

function BuscaItemPedido($db) {
    include_once '../Model/Pedido.Class.php';
    include_once '../Controller/DAOPedido.php';

    $objPedido = new Pedido();

    $objPedido = BuscaPedidoPorId($_REQUEST['ID']);

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;
    $dados = array();

    if ($objPedido->getEmpresaPortal() == "SA" || $objPedido->getEmpresaPortal() == "TH") {
        $funcaoTamanho = "LEN";
    } else {
        $funcaoTamanho = "LENGTH";
    }

    // Pesquisa Item customizada com *
    if ($objPedido->getEmpresaPortal() == "SA") {
        if (substr_count($item, "*") > 0) {
            $item = str_replace("*", "%", $item);
        } else {
            $item = "%{$item}%";
        }
    }

    //echo "select distinct ITV.COD_ITEM, IT.DEN_ITEM, LENGTH(replace(IT.DEN_ITEM, ' ')) as CONT from ITEM_VDP ITV INNER JOIN ITEM IT ON (IT.ies_situacao='A' AND IT.COD_ITEM = ITV.COD_ITEM AND IT.COD_EMPRESA= '{$objPedido->getEmpresa()}')  WHERE ITV.cod_empresa='{$objPedido->getEmpresa()}' AND ITV.COD_ITEM LIKE '%{$item}%' OR IT.DEN_ITEM LIKE '%{$item}%' ORDER BY CONT ASC";
    $Resultado = $db->query("select distinct ITV.COD_ITEM, IT.DEN_ITEM, {$funcaoTamanho}(replace(IT.DEN_ITEM, ' ','')) as CONT from ITEM_VDP ITV 
                             INNER JOIN ITEM IT ON (IT.ies_situacao='A' AND IT.COD_ITEM = ITV.COD_ITEM AND IT.COD_EMPRESA= '{$objPedido->getEmpresa()}')  
                             WHERE ITV.cod_empresa='{$objPedido->getEmpresa()}' 
                             AND (ITV.COD_ITEM LIKE '{$item}' OR IT.DEN_ITEM LIKE '{$item}') 
                             ORDER BY CONT ASC");


    $i = 0;
    while ($Resultado2 = $Resultado->fetch(PDO::FETCH_ASSOC)) {

        $dados[$i]['COD_ITEM'] = $Resultado2['COD_ITEM'];
        $dados[$i]['completo'] = trim($Resultado2['COD_ITEM']) . " - " . trim(preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2['DEN_ITEM']))));
        $dados[$i]['DEN_ITEM'] = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2['DEN_ITEM'])));
        $dados[$i]['CONT'] = $Resultado2['CONT'];
        $i++;
    }

    return json_encode($dados);
}

function BuscaMotoristaTransportadora($db) {
    $Resultado = $db->query("SELECT distinct  cod_motorista, nom_motorista, num_placa FROM GUA_MANIF_CARGA GMC
INNER JOIN mc_mestre MM on (MM.num_solicit=GMC.num_solicit) where cod_transpor = '{$_REQUEST['Filtro']}'");
    $i = 0;
    while ($Resultado2 = $Resultado->fetch(PDO::FETCH_BOTH)) {

        $dados[$i]['cod_motorista'] = $Resultado2[0];
        $dados[$i]['nom_motorista'] = $Resultado2[1];
        $dados[$i]['num_placa'] = $Resultado2[2];
        $i++;
    }

    return json_encode($dados);
}

function BuscaItemPedidoEstoque($db) {
    include_once '../Model/Pedido.Class.php';
    include_once '../Controller/DAOPedido.php';

    $objPedido = new Pedido();

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;
    if ($objPedido->getEmpresaPortal() == "SA" || $objPedido->getEmpresaPortal() == "TH") {
        $funcaoTamanho = "LEN";
    } else {
        $funcaoTamanho = "LENGTH";
    }
    $Resultado = $db->query("select distinct ITV.COD_ITEM, IT.DEN_ITEM, {$funcaoTamanho}(replace(IT.DEN_ITEM, ' ','')) as CONT from ITEM_VDP ITV INNER JOIN ITEM IT ON (IT.COD_ITEM = ITV.COD_ITEM)  WHERE AND ITV.COD_ITEM LIKE '%{$item}%' OR IT.DEN_ITEM LIKE '%{$item}%' ORDER BY CONT ASC");

    $i = 0;
    while ($Resultado2 = $Resultado->fetch(PDO::FETCH_ASSOC)) {

        $dados[$i]['COD_ITEM'] = $Resultado2['COD_ITEM'];
        $dados[$i]['DEN_ITEM'] = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', utf8_encode($Resultado2['DEN_ITEM'])));
        $dados[$i]['CONT'] = $Resultado2['CONT'];
        $i++;
    }

    return json_encode($dados);
}

function BuscaEnderecoCliente($db) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Cidade.Class.php';
    include_once '../Model/Estado.Class.php';

    $objDao = new DAO();
    $objCidade = new Cidade();
    $objEstado = new Estado();

    $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;
    $Resultado = $objDao->ConsultarCustom("SELECT CID." . CIDADE_ID . SEPARADOR . "CID." . CIDADE_NOME . SEPARADOR . "CID." . CIDADE_CODIGO . SEPARADOR . "EST." . ESTADO_SIGLA . " FROM " . CIDADE_TABLENAME . " CID INNER JOIN " . ESTADO_TABLENAME . " EST ON (EST." . ESTADO_ID . " = CID." . CIDADE_ID_ESTADO . ") WHERE CID." . CIDADE_NOME . " LIKE '%{$item}%' OR CID." . CIDADE_CODIGO . " LIKE '%{$item}%'");

    return json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
}

function BuscaUsuarioPorNome($db) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objDao = new DAO();
    $objUsuario = new Usuario();

    if (!isset($_GET['query']) || empty($_GET['query'])) {
        return null;
    }
    $_GET['query'] = strtoupper($_GET['query']);
    $sql = "SELECT " . USUARIO_ID . "," . USUARIO_NOME . " FROM " . USUARIO_TABLENAME . " WHERE " . USUARIO_NOME . " LIKE '%" . $_GET['query'] . "%' OR " . USUARIO_USUARIO . " LIKE '%" . $_GET['query'] . "%'";
    $Resultado = $objDao->ConsultarCustom($sql);

    return json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
}

/*
  function BuscaClienteSubstituto($db) {
  $ID = $_SESSION['id'];
  $Resultado = $db->query("SELECT COD_CLIENTE, NOM_CLIENTE, NUM_CGC_CPF FROM clientes order by NOM_CLIENTE asc");
  return json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
  }



  function BuscaItemPedido($db) {
  $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;

  $ResultadoPadroes = $db->query("SELECT pdp_cod_empresa FROM joi_pad_por_pdp");
  $Padroes = $ResultadoPadroes->fetch(PDO::FETCH_BOTH);
  $Resultado = $db->query("SELECT COD_ITEM, DEN_ITEM, LENGTH(replace(DEN_ITEM, ' ')) as CONT FROM item WHERE COD_LIN_PROD= 1 AND cod_empresa = '{$Padroes[0]}' AND COD_ITEM in (SELECT COD_ITEM FROM item_vdp WHERE cod_empresa = '{$Padroes[0]}' AND COD_ITEM=COD_ITEM AND cod_tip_carteira = '01')  AND (ies_tip_item ='C' OR ies_tip_item='F') AND (COD_ITEM LIKE '%{$item}%' OR DEN_ITEM LIKE '%{$item}%') ORDER BY CONT ASC");
  echo json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
  }

  function BuscaItemPedidoPromocao($db) {
  $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;

  $ResultadoPadroes = $db->query("SELECT pdp_cod_empresa FROM joi_pad_por_pdp");
  $Padroes = $ResultadoPadroes->fetch(PDO::FETCH_BOTH);
  $Resultado = $db->query("SELECT I.COD_ITEM, I.DEN_ITEM, LENGTH(replace(I.DEN_ITEM, ' ')) as CONT FROM item I"
  . "INNER JOIN desc_preco_item DC ON (DC.COD_ITEM = I.COD_ITEM AND DC.NUM_LIST_PRECO =)"
  . " WHERE I.COD_LIN_PROD= 1 AND I.cod_empresa = '{$Padroes[0]}' AND I.COD_ITEM in "
  . "(SELECT COD_ITEM FROM item_vdp WHERE cod_empresa = '{$Padroes[0]}' AND COD_ITEM=I.COD_ITEM AND "
  . "cod_tip_carteira = '01')  AND (I.ies_tip_item ='C' OR I.ies_tip_item='F') AND (I.COD_ITEM "
  . "LIKE '%{$item}%' OR I.DEN_ITEM LIKE '%{$item}%') ORDER BY CONT ASC");
  echo json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
  }

  function BuscaItemPedidoCheckListCopia($db) {
  $ResultadoPadroes = $db->query("SELECT pdp_cod_empresa, pdp_num_lista_preco_componente FROM joi_pad_por_pdp");
  $Padroes = $ResultadoPadroes->fetch(PDO::FETCH_BOTH);
  $Resultado = $db->query("SELECT * FROM (SELECT r.*, ROWNUM RNUM, COUNT(*) OVER () RESULT_COUNT FROM (SELECT COD_ITEM, DEN_ITEM FROM item WHERE COD_ITEM in (SELECT ckl_item FROM joi_check_list_ckl where ckl_item=COD_ITEM) AND cod_empresa = '{$Padroes[0]}' AND COD_ITEM in(SELECT COD_ITEM FROM desc_preco_item WHERE COD_ITEM=COD_ITEM and num_list_preco = {$Padroes[1]}) order by DEN_ITEM asc) R) WHERE  RNUM between 1 and 1000000");
  return json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
  }

  function BuscaItemPedidoExportacao($db) {
  $ResultadoPadroes = $db->query("SELECT pdp_cod_empresa, pdp_lista_exportacao FROM joi_pad_por_pdp");
  $Padroes = $ResultadoPadroes->fetch(PDO::FETCH_BOTH);
  $Resultado = $db->query("SELECT * FROM (SELECT r.*, ROWNUM RNUM, COUNT(*) OVER () RESULT_COUNT FROM (SELECT COD_ITEM, DEN_ITEM FROM item WHERE cod_empresa = '{$Padroes[0]}' AND COD_ITEM in(SELECT COD_ITEM FROM desc_preco_item WHERE COD_ITEM=COD_ITEM and num_list_preco = {$Padroes[1]}) order by DEN_ITEM asc) R) WHERE  RNUM between 1 and 1000000");
  return json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
  }



  function BuscaUsuario($db) {
  $item = (isset($_GET['query']) && !empty($_GET['query'])) ? strtoupper($_GET['query']) : false;
  $Resultado = $db->query("SELECT usp_id, usp_usuario,usp_usuario_erp, usp_nome FROM joi_usuario_portal_usp WHERE  usp_usuario_erp like '%{$item}%' OR usp_nome like '%{$item}%' OR usp_usuario like '%{$item}%'");
  return json_encode($Resultado->fetchAll(PDO::FETCH_ASSOC));
  }
 */


include_once '../Model/DAO.Class.php';

$objDao = new DAO();

$db = $objDao->Conectar();


$PaginaBusca = $_GET['PaginaBusca'];

$Retorno = $PaginaBusca($db);

echo $Retorno;
?>
