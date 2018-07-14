<?php

/**
 * 
 * @param string $cod
 * @return string
 */
function buscaNomeFornecedor(string $cod): string {
    include_once '../Model/DAO.Class.php';

    $objDAO = new DAO();

    $nome = $objDAO->Consultar("fornecedor", "raz_social", WHERE . "cod_fornecedor = '{$cod}'");

    return $nome[0]['RAZ_SOCIAL'];
}

/**
 * 
 * @param string $ordem
 * @param string $fornecedorCod
 * @param string $empresa
 * @return float
 */
function buscaQtdeOrdensNaoCotadas(string $ordem, string $fornecedorCod, string $empresa): float {
    include_once '../Model/DAO.Class.php';

    $objDAO = new DAO();

    $count = $objDAO->ConsultarCustom("select count(*) from PTC_NAO_COTAR_NCT  where nct_tipo = 'O' "
                    . " and nct_codigo  = '{$ordem}' AND nct_empresa = '{$empresa}' and nct_fornecedor = '{$fornecedorCod}'")->fetch(PDO::FETCH_BOTH);
    $count = $count[0];

    return $count;
}

function buscaQtdeItensNaoCotados(string $ordem, string $fornecedorCod, string $empresa): float {
    include_once '../Model/DAO.Class.php';

    $objDAO = new DAO();

    $count = $objDAO->ConsultarCustom("select count(*) from PTC_NAO_COTAR_NCT where nct_tipo = 'I' "
                    . " and nct_codigo  = '{$ordem}' AND nct_empresa = '{$empresa}' and nct_fornecedor = '{$fornecedorCod}'")->fetch(PDO::FETCH_BOTH);
    $count = $count[0];

    return $count;
}

function ordemOuItemNaoCotado($ordem, $fornecedorCod, $empresa) {
    if (buscaQtdeOrdensNaoCotadas($ordem, $fornecedorCod, $empresa) + buscaQtdeItensNaoCotados($ordem, $fornecedorCod, $empresa) > 0)
        return !isCotadaBy($ordem, $fornecedorCod, $empresa);

    return false;
}

function listaEmpresas() {
    include_once '../Model/DAO.Class.php';

    $objDAO = new DAO();

    $listaEmpresa = $objDAO->ConsultarCustom("select cod_empresa, den_empresa from empresa");

    return $listaEmpresa;
}

function protege($valor) {
    return "'" . str_replace("'", "''", $valor) . "'";
}

/**
 * 
 * @param string $situacao
 * @return string
 */
function BuscaSituacaoPedido(string $situacao): string {
    switch ($situacao) {
        case "A": $situacao = "Cotação Aberta";
            break;
        case "R": $situacao = "Cotação Realizada";
            break;
        case "L": $situacao = "Cotação Liquidada";
            break;
        case "C": $situacao = "Cotação Cancelada";
            break;
        case "S": $situacao = "Cotação Suspensa";
            break;
        default: $situacao = "";
            break;
    }

    return $situacao;
}

/* Retorna os fornecedores encontrados de acordo com os filtros */

function getFornecedores($parametros = array()) {
    include_once '../Model/DAO.Class.php';

    $objDao = new DAO();
    $onde = "";
    if (!empty($parametros)) {
        $onde = array();
        if (isset($parametros["cod"]))
            $onde[] = "cod_fornecedor = '{$parametros["cod"]}'";

        if (isset($parametros["cnpj"]))
            $onde[] = "num_cgc_cpf = '{$parametros["cnpj"]}'";

        $onde = implode(" AND ", $onde);
    }

    return $objDao->ConsultarCustom("SELECT * FROM fornecedor" . WHERE . $onde);
}

/* Retorna o fornecedor do código informado */

function getFornecedorByCod($cod) {
    if ($fornecedores = getFornecedores(array("cod" => $cod)))
        return $fornecedores->fetch(PDO::FETCH_OBJ);

    return NULL;
}

/**
 * 
 * @param type $item
 * @param type $empresa
 * @return type
 */
function getFabricantesByItem($item, $empresa) {
    include_once '../Model/DAO.Class.php';

    $objDao = new DAO();

    $lista = $objDao->ConsultarCustom(" select * from item_fabricante where  cod_item = '" . $item . "'
        and (sit_fabricante = 'H' OR sit_fabricante IS NULL) and cod_empresa = '" . $empresa . "' order by cod_ref_item ASC");

    return $lista;
}

function getFabricanteNomeByPartNumber($partNumber) {
    include_once '../Model/DAO.Class.php';

    $objDao = new DAO();
    $partNumber = protege($partNumber);
    if ($resultados = $objDao->ConsultarCustom("SELECT NOM_FABRICANTE from item_fabricante" . WHERE . "cod_ref_item = {$partNumber}"))
        if ($resultado = $resultados->fetch(PDO::FETCH_OBJ))
            return $resultado->NOM_FABRICANTE;

    return "";
}

/**
 * 
 * @param int $idCotacao
 * @return bool
 */
function atualizaCotacaoErp(int $idCotacao): bool {
    include_once '../Model/Cotacao.Class.php';
    include_once '../Model/Funcionalidades.Class.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';
    include_once '../Model/TipoFrete.Class.php';
    include_once '../Model/Moeda.Class.php';
    include_once '../Controller/DAOCondicaoPagamento.php';
    include_once '../Controller/DAOTipoFrete.php';
    include_once '../Controller/DAOMoeda.php';

    $objCotacao = new Cotacao();
    $objFuncionalidades = new Funcionalidades();
    $objDao = new DAO();
    $objCondicaoPagamento = new CondicaoPagamento();
    $objTipoFrete = new TipoFrete();
    $objMoeda = new Moeda();

    $objCotacao = BuscaCotacaoPorId($idCotacao);
    $objCondicaoPagamento = buscaCondicaoPagamentoPorId($objCotacao->getCondicoes_pagamento());
    $objTipoFrete = buscaTipoFretePorId($objCotacao->getModo_envio());
    $objMoeda = buscaMoedaPorId($objCotacao->getMoeda());

    $dados = array();

    $dados["pre_unit_base"] = $objFuncionalidades->formatarNumeroParaBanco($objCotacao->getPreco_unit(), "pt");
    $dados["val_icms"] = 0;

    if ($objCotacao->getIpi() != 0 && $objCotacao->getIpi() != "") {
        $valorIpi = ($objCotacao->getPreco_unit() * $objCotacao->getIpi()) / 100;
        $dados["val_ipi"] = $objFuncionalidades->formatarNumeroParaBanco($valorIpi, "pt");
        $dados["pct_ipi"] = $objFuncionalidades->formatarNumeroParaBanco($objCotacao->getIpi(), "pt");
    }
    $dat_fim_validade = explode("-", $objCotacao->getData_limite_cotacao());
    $dados["dat_fim_validade"] = "MDY('{$dat_fim_validade[1]}','{$dat_fim_validade[2]}','{$dat_fim_validade[0]}')";

    $cotacaoErp = buscaCotacaoErp($objCotacao->getCod_empresa(), $objCotacao->getOc(), $objCotacao->getFornecedor());
    if ($objCotacao->getChat() != "") {
        if (trim($objCotacao->getChat()) != '') {
            $where = "cod_empresa = '" . $objCotacao->getCod_empresa() . "' AND " .
                    "cod_fornecedor = '" . $objCotacao->getFornecedor() . "' AND " .
                    "cod_vendedor = " . $cotacaoErp->COD_COMPRADOR . " AND " .
                    "num_cotacao = " . $cotacaoErp->NUM_COTACAO . " AND " .
                    "num_oc = " . $objCotacao->getOc() . " AND " .
                    "num_interno = 1";

            $sql = "SELECT MAX(num_chat) as max FROM lec_chat WHERE " . $where;

            $resultado = $objDao->ConsultarCustom($sql)->fetch(PDO::FETCH_OBJ);

            $fornecedorObj = getFornecedorByCod($objCotacao->getFornecedor());

            $num_chat = $resultado->MAX + 1;

            $chat = array("num_cotacao" => $cotacaoErp->NUM_COTACAO,
                "num_oc" => $objCotacao->getOc(),
                "cod_empresa" => $objCotacao->getCod_empresa(),
                "cod_fornecedor" => $objCotacao->getFornecedor(),
                "cod_vendedor" => $cotacaoErp->COD_COMPRADOR,
                "num_chat" => $num_chat,
                "num_interno" => 1,
                "dat_observacao" => date("Y-m-d H:i:s"),
                "des_observacao" => iconv('UTF-8', 'ISO-8859-1', '(' . $fornecedorObj->NUM_CGC_CPF . ')' . $fornecedorObj->RAZ_SOCIAL . ': ' . $objCotacao->getChat()));

            $objDao->Inserir("lec_chat", $chat);
        }
    }
    if ($objCotacao->getPrazo_entrega() != "" || $objCotacao->getFabricante() != "") {
        if ($objCotacao->getFabricante() != "") {
            $fornecedor["nom_fabricante"] = getFabricanteNomeByPartNumber($objCotacao->getFabricante());
        }

        if ($objCotacao->getPrazo_entrega() != "") {
            $fornecedor["num_dias_entrega"] = $objCotacao->getPrazo_entrega();
        }

        $where = " WHERE cod_empresa = " . protege($cotacaoErp->COD_EMPRESA) .
                " AND cod_fornecedor = " . protege($objCotacao->getFornecedor()) .
                " AND num_cotacao = " . protege($cotacaoErp->NUM_COTACAO) .
                " AND num_oc = " . protege($cotacaoErp->NUM_OC) .
                " AND num_versao_cot = " . protege($cotacaoErp->NUM_VERSAO_COT) .
                " AND num_versao_oc = " . protege($cotacaoErp->NUM_VERSAO);
        $objDao->Atualizar("ordem_sup_cot", $fornecedor, $where);
    }

// dados padrões
    $dados["cod_mod_embar"] = $objTipoFrete->getCod();
    $dados["cnd_pgto"] = $objCondicaoPagamento->getCod_erp();
    $dados["cod_moeda"] = $objMoeda->getCod();
    $dados["fat_conver_unid"] = 1;
    $dados["dat_cotacao"] = $dados["dat_inic_validade"] = $dados["data_cadastro"] = "MDY('" . date('m') . "','" . date('d') . "','" . date('Y') . "')";
    $dados["hora_cadastro"] = date("h:i:s");
    $dados["login"] = "e-procurement";
    $dados["pre_unit_liquido"] = $objFuncionalidades->formatarNumeroParaBanco($objCotacao->getPreco_unit(), "pt");

    $onde = " WHERE cod_empresa = " . protege($cotacaoErp->COD_EMPRESA) .
            " AND cod_fornecedor = " . protege($cotacaoErp->COD_FORNECEDOR) .
            " AND cod_item = " . protege($cotacaoErp->COD_ITEM) .
            " AND num_cotacao = " . protege($cotacaoErp->NUM_COTACAO) .
            " AND num_versao = " . protege($cotacaoErp->NUM_VERSAO);


    return $objDao->Atualizar("cotacao_preco", $dados, $onde) or die();
}

/**
 * 
 * @param array $ValoresPost
 * @return int
 */
function CadastraCotacao(array $ValoresPost): int {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Cotacao.Class.php';
    include_once '../Controller/Base.php';

    $ObjCotacao = new Cotacao();
    $ObjDao = new DAO();

    $cotar = array();

    $cotar[Cotacao::_ID] = $ValoresPost[Cotacao::_ID];
    $cotar[Cotacao::_COD_EMPRESA] = $ValoresPost[Cotacao::_COD_EMPRESA];
    $cotar[Cotacao::_CONDICOES_PAGAMENTO] = $ValoresPost[Cotacao::_CONDICOES_PAGAMENTO];
    $cotar[Cotacao::_DATA_LIMITE_COTACAO] = $ValoresPost[Cotacao::_DATA_LIMITE_COTACAO];
    $cotar[Cotacao::_FABRICANTE] = $ValoresPost[Cotacao::_FABRICANTE];
    $cotar[Cotacao::_IPI] = $ValoresPost[Cotacao::_IPI];
    $cotar[Cotacao::_ITEM] = $ValoresPost[Cotacao::_ITEM];
    $cotar[Cotacao::_MODO_ENVIO] = $ValoresPost[Cotacao::_MODO_ENVIO];
    $cotar[Cotacao::_MOEDA] = $ValoresPost[Cotacao::_MOEDA];
    $cotar[Cotacao::_NUMERO] = $ValoresPost[Cotacao::_NUMERO];
    $cotar[Cotacao::_ORCAMENTO_VALIDO] = $ValoresPost[Cotacao::_ORCAMENTO_VALIDO];
    $cotar[Cotacao::_PRAZO_ENTREGA] = $ValoresPost[Cotacao::_PRAZO_ENTREGA];
    $cotar[Cotacao::_PRECO_UNITARIO] = $ValoresPost[Cotacao::_PRECO_UNITARIO];
    $cotar[Cotacao::_UNIDADE_MEDIDA] = $ValoresPost[Cotacao::_UNIDADE_MEDIDA];
    $cotar[Cotacao::_OC] = $ValoresPost[Cotacao::_OC];
    $cotar[Cotacao::_CHAT] = $ValoresPost[Cotacao::_CHAT];
    $cotar[Cotacao::_FORNECEDOR] = $ValoresPost[Cotacao::_FORNECEDOR];

    if ($ValoresPost['Acao'] == "Inserir") {
        $BaseId = CadastraEntidade("Cadastro de cotação: " . $cotar[Cotacao::_NUMERO]);
        $cotar[Cotacao::_ID] = $BaseId;

        $id = $ObjDao->Inserir(Cotacao::_TABLENAME, $cotar);
        atualizaCotacaoErp($BaseId);
    } else {
        $id = $ObjDao->Atualizar(Cotacao::_TABLENAME, $cotar, WHERE . Cotacao::_ID . IGUAL . $ValoresPost[Cotacao::_ID]);
        atualizaCotacaoErp($ValoresPost[Cotacao::_ID]);
    }

    return $id;
}

/**
 * 
 * @param string $cotacao
 * @param string $fornecedor
 * @param string $item
 * @return Cotacao
 */
function BuscaCotacao(string $cotacao, string $fornecedor, string $item): Cotacao {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Cotacao.Class.php';

    $ObjCotacao = new Cotacao();
    $ObjDAO = new DAO();

    $cotacoes = $ObjDAO->Consultar(Cotacao::_TABLENAME, TUDO, WHERE . Cotacao::_OC . IGUAL . ASPA . $cotacao . ASPA . E
            . Cotacao::_FORNECEDOR . IGUAL . ASPA . $fornecedor . ASPA . E . Cotacao::_ITEM . IGUAL . ASPA . $item . ASPA);
    $ObjCotacao->alimentaObj($cotacoes[0]);

    return $ObjCotacao;
}

/**
 * 
 * @param int $id
 * @return Cotacao
 */
function BuscaCotacaoPorId(int $id): Cotacao {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Cotacao.Class.php';

    $ObjCotacao = new Cotacao();
    $ObjDAO = new DAO();

    $cotacoes = $ObjDAO->Consultar(Cotacao::_TABLENAME, TUDO, WHERE . Cotacao::_ID . IGUAL . $id);
    $ObjCotacao->alimentaObj($cotacoes[0]);

    return $ObjCotacao;
}

/**
 * 
 * @param string $oc
 * @param string $empresa
 * @param int $versao
 * @param string $unidade
 * @return string
 */
function BuscaProgramacaoEntrega(string $oc, string $empresa, int $versao, string $unidade, bool $pesquisas = false): string {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Funcionalidades.Class.php';

    $objFuncionalidade = new Funcionalidades();

    $ObjDAO = new DAO();
    $onde = " cod_empresa IN ('" . $empresa . "') and
                    TO_NUMBER(REPLACE(num_oc, '.', '')) = '{$oc}' and num_versao ='{$versao}' and ies_situa_prog = 'F' ";

    $programacoes = $ObjDAO->ConsultarCustom(" SELECT * from prog_ordem_sup WHERE {$onde} ORDER BY num_prog_entrega ASC");

    $retorno = "";

    if ($pesquisas == false) {
        $retorno .= "<br /><em>Entrega prevista: </em>";
    }
    while ($entrega = $programacoes->fetch(PDO::FETCH_OBJ)) {
        if ($pesquisas == false) {
            $retorno .= "<br />&nbsp;&nbsp;&nbsp;&nbsp; - " . $objFuncionalidade->FormatarMoeda(str_replace(".", ",", $entrega->QTD_SOLIC), 2) . " " . trim($unidade) . " em " . " " . trim($objFuncionalidade->FormataData($entrega->DAT_ENTREGA_PREV, "-", "/"));
        } else {
            $retorno .= "- " . $objFuncionalidade->FormatarMoeda(str_replace(".", ",", $entrega->QTD_SOLIC), 2) . " " . trim($unidade) . " em " . " " . trim($objFuncionalidade->FormataData($entrega->DAT_ENTREGA_PREV, "-", "/")) . "\n";
        }
    }

    return $retorno;
}

function isCotadaBy($ordem, $empresa, $fornecedor) {
    if ($cotacao = buscaCotacaoByOrdemAndFornecedor($ordem, $empresa, $fornecedor)) {
        return $cotacao->PRE_UNIT_BASE > 0;
    }
    return false;
}

function buscaCotacaoByOrdemAndFornecedor($oc, $empresa, $fornecedor = 0) {
    include_once '../Model/DAO.Class.php';

    $ObjDAO = new DAO();

    $onde = " o.ies_versao_atual = 'S' and
                    o.cod_empresa IN (1, 2) and
                    f.cod_empresa = o.cod_empresa and
                    f.num_oc = o.num_oc and
                    f.num_versao_oc = o.num_versao and
                    c.cod_empresa = f.cod_empresa and
                    c.cod_fornecedor = f.cod_fornecedor and
                    c.num_cotacao = f.num_cotacao and
                    c.num_versao = f.num_versao_cot and
                    c.ies_versao_atual = 'S' and
                    o.num_pedido = '0'  and
                    o.cod_item = c.cod_item and
                    c.cod_item NOT LIKE '998.%' and o.cod_empresa IN ('" . $empresa . "') and
                    TO_NUMBER(REPLACE(o.num_oc, '.', '')) = '{$oc}' and f.cod_fornecedor = '{$fornecedor}'";

    if ($cotacoes = $ObjDAO->ConsultarCustom(" select * from ordem_sup o, ordem_sup_cot f, cotacao_preco c where " . $onde . " order by c.data_cadastro DESC, c.hora_cadastro DESC", "c.*"))
        return $cotacoes->fetch(PDO::FETCH_OBJ);
}

/**
 * 
 * @param string $oc
 * @param string $empresa
 * @return string
 */
function BuscaVencimentoOrdem(string $oc, string $empresa): string {
    include_once '../Model/DAO.Class.php';

    $ObjDAO = new DAO();
    $onde = " o.ies_versao_atual = 'S' and
                    o.cod_empresa IN (1, 2) and
                    f.cod_empresa = o.cod_empresa and
                    f.num_oc = o.num_oc and
                    f.num_versao_oc = o.num_versao and
                    c.cod_empresa = f.cod_empresa and
                    c.cod_fornecedor = f.cod_fornecedor and
                    c.num_cotacao = f.num_cotacao and
                    c.num_versao = f.num_versao_cot and
                    c.ies_versao_atual = 'S' and
                    o.num_pedido = '0'  and
                    o.cod_item = c.cod_item and
                    c.cod_item NOT LIKE '998.%' and o.cod_empresa IN ('" . $empresa . "') and
                    TO_NUMBER(REPLACE(o.num_oc, '.', '')) = '{$oc}'";




    if ($cotacoes = $ObjDAO->ConsultarCustom(" SELECT c.dat_limite from ordem_sup o, ordem_sup_cot f, cotacao_preco c WHERE {$onde} ORDER BY c.data_cadastro DESC, c.hora_cadastro DESC"))
        if ($cotacao = $cotacoes->fetch(PDO::FETCH_OBJ))
            if ($cotacao->DAT_LIMITE != "") {
                return $cotacao->DAT_LIMITE;
            } else {
                return "";
            }

    return "";
}

/**
 * 
 * @param string $oc
 * @param string $empresa
 * @return string
 */
function BuscaDateFimCotacaoOrdem(string $oc, string $empresa): string {
    include_once '../Model/DAO.Class.php';

    $ObjDAO = new DAO();
    $onde = " o.ies_versao_atual = 'S' and
                    o.cod_empresa IN (1, 2) and
                    f.cod_empresa = o.cod_empresa and
                    f.num_oc = o.num_oc and
                    f.num_versao_oc = o.num_versao and
                    c.cod_empresa = f.cod_empresa and
                    c.cod_fornecedor = f.cod_fornecedor and
                    c.num_cotacao = f.num_cotacao and
                    c.num_versao = f.num_versao_cot and
                    c.ies_versao_atual = 'S' and
                    o.num_pedido = '0'  and
                    o.cod_item = c.cod_item and
                    c.cod_item NOT LIKE '998.%' and o.cod_empresa IN ('" . $empresa . "') and
                    TO_NUMBER(REPLACE(o.num_oc, '.', '')) = '{$oc}'";

    if ($cotacoes = $ObjDAO->ConsultarCustom(" SELECT c.dat_limite from ordem_sup o, ordem_sup_cot f, cotacao_preco c WHERE {$onde} ORDER BY c.data_cadastro DESC, c.hora_cadastro DESC"))
        if ($cotacao = $cotacoes->fetch(PDO::FETCH_OBJ))
            return $cotacao->DAT_LIMITE;

    return "";
}

/**
 * 
 * @param string $empresa
 * @param string $codItem
 * @return string
 */
function buscaDescricaoItemPorCod(string $empresa, string $codItem): string {
    include_once '../Model/DAO.Class.php';

    $ObjDao = new DAO();

    $retorno = $ObjDao->ConsultarCustom("select den_item from item where cod_empresa ='{$empresa}' and cod_item = '{$codItem}'")->fetch(PDO::FETCH_BOTH);

    return $retorno[0];
}

/**
 * 
 * @param type $ValoresPost
 */
function ExibeCotacao($ValoresPost) {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Cotacao.Class.php';
    include_once '../Controller/Base.php';

    $ObjCotacao = new Cotacao();
    $ObjDao = new DAO();
    $cotar = array();

    $cotar[Cotacao::_ID] = $ValoresPost["COT_ID"];
    $cotar[Cotacao::_COD_EMPRESA] = $ValoresPost["COT_EMPRESA"];
}

function buscaFatorConversao(string $empresa, string $item, string $fornecedor): float {
    include_once '../Model/DAO.Class.php';

    $ObjDao = new DAO();

    $resultados = $ObjDao->ConsultarCustom("SELECT FAT_CONVER_UNID FROM item_fornec where cod_empresa = " . protege($empresa) . " and"
            . " cod_item = " . protege($item) . " and cod_fornecedor = " . protege($fornecedor) . " ORDER BY fat_conver_unid");

    if ($resultado = $resultados->fetch(PDO::FETCH_OBJ))
        if ($resultado->FAT_CONVER_UNID > 0)
            return $resultado->FAT_CONVER_UNID;
    return 1;
}

/**
 * 
 * @param string $cod
 * @return string
 */
function buscaDescricaoUnidadeMedidaByCod(string $cod): string {
    include_once '../Model/DAO.Class.php';

    $ObjDao = new DAO();

    if ($unidades = $ObjDao->ConsultarCustom("SELECT DEN_UNID_MED_30 FROM unid_med WHERE cod_unid_med = " . protege($cod)))
        if ($unidade = $unidades->fetch(PDO::FETCH_OBJ))
            return $unidade->DEN_UNID_MED_30;

    return "";
}

/**
 * 
 * @return array
 */
function listaUnidadeMedida(): array {
    include_once '../Model/DAO.Class.php';

    $ObjDAO = new DAO();

    return $ObjDAO->ConsultarCustom("select cod_unid_med, den_unid_med_30  from unid_med")->fetchAll(PDO::FETCH_ASSOC);
}

function buscaCotacaoErp(string $empresa, string $num_oc, string $fabricante) {
    include_once '../Model/DAO.Class.php';

    $ObjDAO = new DAO();

    return $ObjDAO->ConsultarCustom("select o.*, f.cod_fornecedor, F.NUM_COTACAO, f.NUM_VERSAO_COT from ordem_sup o, ordem_sup_cot f, cotacao_preco c where "
                    . " o.ies_versao_atual = 'S' AND
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
                                    AND (f.cod_fornecedor = '" . $fabricante . "') 
                                    AND (o.num_oc = '" . $num_oc . "') 
                                    AND (f.cod_empresa = '" . $empresa . "')")->fetch(PDO::FETCH_OBJ);
}

function CadastraCotacaoImportar($ValoresPost, $ValoresFiles) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Cotacao.Class.php';
    include_once '../Model/Upload.Class.php';
    include_once '../Model/Funcionalidades.Class.php';
    include_once '../Controller/Base.php';

    $objCotacao = new Cotacao();
    $objFuncionalidades = new Funcionalidades();
    $ObjDao = new DAO();

    if (isset($ValoresFiles['Arquivo']['name']) && $ValoresFiles['Arquivo']['name'] != "") {
        $objImagemUpload = new Upload($ValoresFiles['Arquivo'], 800, 600, "../Public/img/Cliente/Documento/", 0);
        $retorno = $objImagemUpload->salvar();
        if ($retorno != "Erro 4") {
            $file = $retorno;
        }
    }

    $row = 0;
    $meuArray = array();
    $file = fopen('/var/www/html/ptv/Public/img/Cliente/Documento/' . $file, 'r');


    while ($line = fgetcsv($file, 1000000, ",")) {
        if ($row++ == 0) {
            continue;
        }
        $meuArray[] = $line;
    }

    fclose($file);

    foreach ($meuArray as $key => $value) {
        $BaseId = CadastraEntidade("");
        $cotacao[Cotacao::_ID] = $BaseId;

        $valores = explode(";", $value[0]);

        $cotacao[Cotacao::_COD_EMPRESA] = $valores[0];
        $cotacao[Cotacao::_OC] = $valores[1];
        $cotacao[Cotacao::_ITEM] = $valores[2];
        $cotacao[Cotacao::_QUANTIDADE] = $valores[3];
        $cotacao[Cotacao::_UNIDADE_MEDIDA] = $valores[4];
        $cotacao[Cotacao::_FABRICANTE] = $valores[5];
        $cotacao[Cotacao::_ENTREGA_PREVISTA] = $valores[6];
        $cotacao[Cotacao::_DATA_LIMITE_COTACAO] = $valores[7];
        $cotacao[Cotacao::_PRECO_UNITARIO] = $valores[8];
        $cotacao[Cotacao::_IPI] = $valores[9];
        $cotacao[Cotacao::_COD_EMPRESA] = $valores[10];
        $cotacao[Cotacao::_ORCAMENTO_VALIDO] = $valores[11];
        $cotacao[Cotacao::_PRAZO_ENTREGA] = $valores[12];
        $cotacao[Cotacao::_MOEDA] = $valores[13];
        $cotacao[Cotacao::_CONDICOES_PAGAMENTO] = $valores[14];
        $cotacao[Cotacao::_MODO_ENVIO] = $valores[15];
        $cotacao[Cotacao::_CHAT] = $valores[16];

        $id = $ObjDao->Inserir(Cotacao::_TABLENAME, $cotacao);
        atualizaCotacaoErp($BaseId);
    }

    return true;
}
