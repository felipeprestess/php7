<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
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
$objCondicaoPagamento = new CondicaoPagamento();
$objTipoFrete = new TipoFrete();
$objMoeda = new Moeda();

include_once '../Model/DAO.Class.php';

$ObjDao = new DAO();


$Indice = "";
//Define a tabela que trabalharemos
$Tabela = "ordem_sup o, ordem_sup_cot f, cotacao_preco c ";
//Criamos a condição Filtro para pesquisa paginação, mostrará apenas as contas relacionadas a este login
$Filtro = "";
//Informamos os campos que iremos buscar no banco
$Campos = "DISTINCT o.*, f.cod_fornecedor";
//Montamos um array pra fazer a exibição dos resultados em tabela


$Grid = [
    'Empresa' => "COD_EMPRESA",
    'Número da ordem' => "NUM_OC",
    'Item' => "COD_ITEM",
    'Quantidade' => "QTD_SOLIC",
    'Unidade medida' => "COD_UNID_MED",
    'Fabricante' => "",
    'Entrega prevista Até' => "DAT_ENTREGA_PREV",
    'Data limite para cotação' => "Vencimento",
    'Preço unitário' => "Preço unitário",
    'IPI(%)' => "IPI(%)",
    'Orçamento válido até' => "Orçamento válido até",
    'Prazo entrega (em dias)' => "Prazo entrega (em dias)",
    'Moeda' => "Moeda",
    'Condições de pagamento' => "Condições de pagamento",
    'Modo de envio' => "Modo de envio",
    'Chat' => "Chat"
];

//Criamos uma condição where padrão para as pesquisas de tabela
$Where = "ORDER BY {$Indice} DESC";

$Consultar = $ObjDao->ConsultarComFiltro($Tabela, $Campos, str_replace('\\', "'", $_REQUEST['FiltrarExportar']), 0, 100000000000, $Parametros, $Where);

$html = "";

$msgFabricante = "";
if (isset($Consultar) && !empty($Consultar) && ($Consultar)) {
    $html .= "<table style='word-wrap:break-word;' border=1 cellspacing=0 cellpadding=2 id=\"{$Tabela}\" class=\"table table-bordered table-striped table-condensed\">";
    $html .= "<thead><tr>";
    //montamos o grid - nome titulo do resultado
    foreach ($Grid as $key => $value) {
        $html .= "<th class=\"text-center\">" . $key . "</th>";
    }

    $html .= "</tr>\n</thead><tbody>";
    $i = ($Paginacao->Pagina < 1) ? 0 : ($Paginacao->Pagina) * $Paginacao->Limite;
    foreach ($Consultar as $value) {
        $descricao = buscaDescricaoItemPorCod($value['COD_EMPRESA'], $value['COD_ITEM']);
        $unidade = buscaDescricaoUnidadeMedidaByCod($value['COD_UNID_MED']);
        $conversao = buscaFatorConversao($value['COD_EMPRESA'], $value['COD_ITEM'], $value['COD_FORNECEDOR']);

        if (($_REQUEST['AcaoExportar'] == "Selecionados" && $_REQUEST[str_replace(".", "_", trim($value['COD_EMPRESA']) . trim($value['NUM_OC']) . trim($value['COD_ITEM']) . trim($value['COD_FORNECEDOR']))] == "on") || $_REQUEST['AcaoExportar'] == "Tudo") {

            ++$i;
            $html .= "<tr id=\"tr{$value["{$Indice}"]}\" class=\"excluir text-center\">\n";

//montamos o formulario de exclusão
            if ($Permissoes['PTC0019']['LIXEIRA'] == 1) {
                $str_deletar = <<<EOT
<a class="btn btn-danger btn-xs excluiritem"  onclick="javascript: if (!confirm('Você realmente deseja marcar como não cotar?')){return false;}"  href="Cotacoes.php?Acao=Deletar&id={$value["{$Indice}"]}" id="{$value["{$Indice}"]}"><i class="fa fa-trash-o"></i> Excluir</a>
EOT;
            }
            //montandos o grid - resultado

            foreach ($Grid as $rs) {
                $objCotar = BuscaCotacao($value['NUM_OC'], $value['COD_FORNECEDOR'], $value['COD_ITEM']);

                if ($rs == 'Vencimento') {
                    $html .= "<td class=\"wordbreak\">" . $objFuncionalidades->FormataData(BuscaVencimentoOrdem($value['NUM_OC'], $value['COD_EMPRESA']), "-", "/") . "</td>";
                } elseif ($rs == 'IES_SITUA_OC') {
                    $status = BuscaSituacaoPedido($value[$rs]);

                    $html .= "<td class=\"wordbreak\">{$status}</td>";
                } elseif ($rs == "DAT_ENTREGA_PREV") {
                    $html .= "<td class=\"wordbreak\">{$value['QTD_ORIGEM']} {$value['COD_UNID_MED']} em {$objFuncionalidades->FormataData($value[$rs], "-", "/")} </td>";
                } elseif ($rs == "Preço unitário") {
                    $html .= "<td class=\"wordbreak\">{$objCotar->getPreco_unit()}</td>";
                } elseif ($rs == "IPI(%)") {
                    $html .= "<td class=\"wordbreak\">{$objCotar->getIpi()}</td>";
                } elseif ($rs == "Orçamento válido até") {
                    $html .= "<td class=\"wordbreak\">{$objFuncionalidades->FormataData($objCotar->getOrcamento_valido(), "-", "/")} </td>";
                } elseif ($rs == "Prazo entrega (em dias)") {
                    $html .= "<td class=\"wordbreak\">{$objCotar->getPrazo_entrega()}</td>";
                } elseif ($rs == "Moeda") {
                    if ($objCotar->getMoeda() != "") {
                        $objMoeda = buscaMoedaPorId($objCotar->getMoeda());
                    }
                    $html .= "<td class=\"wordbreak\">{$objMoeda->getCod()}</td>";
                } elseif ($rs == "Condições de pagamento") {
                    if ($objCotar->getCondicoes_pagamento() != "") {
                        $objCondicaoPagamento = buscaCondicaoPagamentoPorId($objCotar->getCondicoes_pagamento());
                    }
                    $html .= "<td class=\"wordbreak\">{$objCondicaoPagamento->getCod_erp()}</td>";
                } elseif ($rs == "Modo de envio") {
                    if ($objCotar->getModo_envio() != "") {
                        $objTipoFrete = buscaTipoFretePorId($objCotar->getModo_envio());
                    }
                    $html .= "<td class=\"wordbreak\">{$objTipoFrete->getCod()}</td>";
                } elseif ($rs == "Chat") {
                    $html .= "<td class=\"wordbreak\">{$objCotar->getChat()}</td>";
                } elseif ($rs == 'COD_ITEM') {

                    $msgFabricante .= $value[$rs] . " - " . $descricao . "<br/>";
                    $progamacao = BuscaProgramacaoEntrega($value['NUM_OC'], $value['COD_EMPRESA'], $value['NUM_VERSAO'], $unidade);
                    $html .= "<td class=\"wordbreak\">" . $value[$rs] . " - " . $descricao . " " . $progamacao . "</td>";
                } else {
                    $html .= "<td class=\"wordbreak\">" . $objFuncionalidades->LimpaString($value[$rs]) . "</td>";
                }
            }

            $html .= "</tr>\n";
        }
    }
    $html .= "<tr><td colspan='16' class=\"wordbreak\">";
    $html .= "<strong>Fabricante(s) por item <br/><br/>" . $msgFabricante . "</strong>";
    $html .= "</td></tr>";
    $html .= "</tbody></table>";
} else {
    $html .= "<p class=\"text-center\">Nenhum registro encontrado!</p>";
}

$arquivo = 'ordens.xls';

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename=\"{$arquivo}\"");
header("Content-Description: PHP Generated Data");
//Envia o conteúdo do arquivo
echo $html;
