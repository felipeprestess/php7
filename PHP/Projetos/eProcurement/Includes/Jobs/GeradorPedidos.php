<?php
// partir da do pcp MPR0011
//criar parametro que habilita a tela com data a partir de, criar parametro que regra qual codigo do representante de entrada
include_once '../../Controller/Session.php';
include_once '../../Model/DAO.Class.php';
include_once '../../Model/Pedido.Class.php';
include_once '../../Model/Usuario.Class.php';
include_once '../../Model/EnderecoEntregaPedido.Class.php';
include_once '../../Model/TextoNota.Class.php';
include_once '../../Model/Operacoes.Class.php';
include_once '../../Model/ObservacaoPedido.Class.php';
include_once '../../Model/Funcionalidades.Class.php';
include_once '../../Model/InformacoesPedidoBNDS.Class.php';
include_once '../../Model/TipoPedido.Class.php';
include_once '../../Controller/DAOTipoPedido.php';
include_once '../../Controller/DAOEnderecoEntrega.php';
include_once '../../Controller/DAOTextoNota.php';
include_once '../../Controller/DAOUsuario.php';
include_once '../../Controller/DAOObservacaoPedido.php';
include_once '../../Controller/DAOOperacoes.php';
include_once '../../Model/CapaPedido.Class.php';
include_once '../../Controller/DAOCapaPedido.php';
include_once '../../Model/DaoErp.Class.php';
include_once '../../Model/Pessoa.Class.php';
include_once '../../Controller/DAOPessoa.php';
include_once '../../Model/Item.Class.php';
include_once '../../Model/EnderecoPessoa.Class.php';
include_once '../../Model/Cidade.Class.php';
include_once '../../Model/Estado.Class.php';
include_once '../../Controller/DAOEnderecoPessoa.php';
include_once '../../Controller/DAOCidade.php';
include_once '../../Controller/DAOEstado.php';


$objPessoa = new Pessoa();
$objDaoErp = new DaoErp();
$objItem = new Item();
$objPedido = new Pedido();
$objPedidoSessao = new Pedido();
$ObjDao = new DAO();
$objUsuario = new Usuario();
$objEnderecoEntrega = new EnderecoEntregaPedido();
$objTextoNota = new TextoNota();
$objObspedido = new ObservacaoPedido();
$objOperacao = new Operacoes();
$objFuncionalidades = new Funcionalidades();
$objInformacoesPedidoBNDS = new InformacoesPedidoBNDS();
$objTipoPedido = new TipoPedido();
$objCapaPedido = new CapaPedido();
$objListaPreco = new ListaPreco();
$objCondicaoPagamento = new CondicaoPagamento();
$objEnderecoPessoa = new EnderecoPessoa();
$objCidade = new Cidade();
$objEstado = new Estado();

$EnderecoEntrega = array();
$Pedido = Array();
$TextoNota = array();
$item = array();
$ObsPedido = array();
$InformacoesPedidoBNDS = array();

$AR = $objDaoErp->ConsultaGenerica("select EMPRESA, AR, NUM_SEQ, DATA_CONTAGEM, COD_FORNEC, 
        RAZ_SOCIAL, COD_FORNEC_TRIANGULACAO, RAZ_SOCIAL_TRIANGULACAO, COD_ITEM, 
        DESC_ITEM, QTD_SISTEMA, QTD_BALANCA from V_MPR_ENTRADA_TERCEIROS 
        V_MPR_ENTRADA_TERCEIROS where NUM_SEQ not in 
        (select CPG_SEQ_AR from PTV.PTV_CONTRL_PED_GER_CPG where CPG_AR =AR and CPG_SEQ_AR=NUM_SEQ ) 
        and data_contagem > '20/02/2017' order by AR");

while ($row = $AR->fetch(PDO::FETCH_BOTH)) {
    $codCliente = '';
    if ($row[6] != "" && !is_null($row[6])) {
        $codCliente = $row[6];
    } else {
        $codCliente = $row[4];
    }

    $cliente = $objDaoErp->ConsultaGenerica("select  NUM_CGC_CPF  from FORNECEDOR where COD_FORNECEDOR = '{$codCliente}'");
    $cliente = $cliente->fetch(PDO::FETCH_BOTH);
    $cliente = $cliente[0];

    $cliente = $objDaoErp->ConsultaGenerica("select  cod_cliente  from clientes where NUM_CGC_CPF = '{$cliente}'");
    $cliente = $cliente->fetch(PDO::FETCH_BOTH);
    $cliente = $cliente[0];

    $objEnderecoPessoa = BuscaEnderecoPessoaNoErpPorCodCliente($cliente);
    $objCidade = BuscaCidadePorCod($objEnderecoPessoa->getCidadeId());
    $objEstado = BuscaEstadoPorCodCidade($objCidade->getCodigo());

    $TextoNota[TEXTO_NOTA_TEXTO_UM] = '';
    $TextoNota[TEXTO_NOTA_TEXTO_DOIS] = '';
    $TextoNota[TEXTO_NOTA_TEXTO_TRES] = '';
    $TextoNota[TEXTO_NOTA_TEXTO_QUATRO] = '';
    $TextoNota[TEXTO_NOTA_TEXTO_CINCO] = '';

    $ObsPedido[OBSERVACAO_PEDIDO_TEXTO_UM] = '';
    $ObsPedido[OBSERVACAO_PEDIDO_TEXTO_DOIS] = '';


    $Pedido[PEDIDO_EMPRESA] = '01';
    $Pedido[PEDIDO_ID_REPRESENTANTE] = "7337";
    $Pedido[PEDIDO_ID_CLIENTE] = $cliente;

    $objPessoa = BuscaPessoaPorCod($cliente);
    $Pedido[PEDIDO_ID_TRANSPORTADORA] = '';
    $Pedido[PEDIDO_ID_REDESPACHO] = '';
    $Pedido[PEDIDO_TIPO_FRETE] = "114";
    $Pedido[PEDIDO_TIPO_VENDA] = "7174";
    $Pedido[PEDIDO_TIPO_ENTREGA] = 3;
// regra do email respondido pelo Jaison
    if ($row[6] != "" && !is_null($row[6])) {
        $Pedido[PEDIDO_OPERACAO_FISCAL] = 7164;
    } else {
        $Pedido[PEDIDO_OPERACAO_FISCAL] = 7161;
    }

    if ($objPessoa->getInscricaoEstadual() == '' || $objPessoa->getInscricaoEstadual() == 'ISENTO' || $objPessoa->getInscricaoEstadual() == ' ' || is_null($objPessoa->getInscricaoEstadual())) {
        $Pedido[PEDIDO_FINALIDADE] = '2';
    } else {
        $Pedido[PEDIDO_FINALIDADE] = '1';
    }

    $Pedido[PEDIDO_OBSERVACAO] = '';
    $Pedido[PEDIDO_CALCULA_COMISSAO] = 0;

// Lista Preco pega da regra do cliente senao pega da capa geral
    if (isset($ValoresPost[PEDIDO_LISTA_PRECO]) && $ValoresPost[PEDIDO_LISTA_PRECO] != "" && $ValoresPost[PEDIDO_LISTA_PRECO] != 0) {
        $Sugestao = $objDaoErp->BuscaSugestaoListaPreco($cliente);
        if ($Sugestao != "" && !is_null($Sugestao)) {
            $objListaPreco = buscaListaPrecoPorCodErp($Sugestao);
            $Pedido[PEDIDO_LISTA_PRECO] = $objListaPreco->getId();
        } else {
            $objCapaPedido = buscaCapaPedidoGeral();
            $objListaPreco = buscaListaPrecoPorCodErp($objCapaPedido->getListaPreco());
            $Pedido[PEDIDO_LISTA_PRECO] = $objListaPreco->getId();
        }
    } else {
        $Pedido[PEDIDO_LISTA_PRECO] = '0';
    }
//pega da regra do cliente senao pega da capa geral
    $Sugestao = $objDaoErp->BuscaSugestaoCondicaoPagamento($cliente);
    if ($Sugestao != "" && !is_null($Sugestao)) {
        $objCondicaoPagamento = buscaCondicaoPagamentoPorCod($Sugestao);
        $Pedido[PEDIDO_CONDICAO_PAGAMENTO] = $objCondicaoPagamento->getId();
    } else {
        $objCapaPedido = buscaCapaPedidoGeral();
        $objCondicaoPagamento = buscaCondicaoPagamentoPorCod($objCapaPedido->getListaPreco());
        $Pedido[PEDIDO_CONDICAO_PAGAMENTO] = $objCondicaoPagamento->getId();
    }

    $Pedido[PEDIDO_DESCONTO_ADICIONAL] = 0;

    $przEntrega = $objDaoErp->ConsultaGenerica("select t1.NUM_AVISO_REC, t1.COD_ITEM, t3.NUM_ORDEM, t3.DAT_ENTREGA 
from aviso_rec t1, MAN_BAIXA_MST_1103 t2, ORDENS t3
where t1.COD_EMPRESA = t2.EMPRESA
and t1.NUM_AVISO_REC = '{$row[1]}'
and t1.NUM_AVISO_REC = t2.NUM_AVISO_REC
and t3.NUM_ORDEM = t2.NUM_ORDEM");
    $przEntrega = $przEntrega->fetch(PDO::FETCH_BOTH);
    $przEntrega = $przEntrega[3];

    $przEntrega = explode(" ", $przEntrega);
    $przEntrega = $przEntrega[0];
    $przEntrega = explode("/", $przEntrega);
    $przEntrega = $przEntrega[2] . "-" . $przEntrega[1] . "-" . $przEntrega[0];

    $Pedido[PEDIDO_PRAZO_ENTREGA] = $przEntrega;
    $Pedido[PEDIDO_DATA_EMISSAO] = date('Y-m-d');
    $Pedido[PEDIDO_HORA_EMISSAO] = date('H:i:s');
    $Pedido[PEDIDO_COD_PEDIDO_CLIENTE] = $row[1];
    $Pedido[PEDIDO_COD_PEDIDO_REPRESENTANTE] = '';
    $Pedido[PEDIDO_NOME_CONTATO] = '';
    $Pedido[PEDIDO_TELEFONE_CONTATO] = '';
    $Pedido[PEDIDO_EMAIL_CONTATO] = '';
    $Pedido[PEDIDO_TIPO_ORCAMENTO] = '59342';
    $Pedido[PEDIDO_ID_CLIENTE_TRIANGULACAO] = '';
    $Pedido[PEDIDO_ID_CLIENTE_INDICACAO] = '';
    $Pedido[PEDIDO_REPRESENTANTE_SECUNDARIO] = '';
    $Pedido[PEDIDO_REPRESENTANTE_TERCIARIO] = '';
    $Pedido[PEDIDO_REPRESENTANTE_SECUNDARIO_COMISSAO] = '';
    $Pedido[PEDIDO_REPRESENTANTE_TERCIARIO_COMISSAO] = '';
    $Pedido[PEDIDO_USA_ENDERECO_ENTREGA] = 0;
    $Pedido[PEDIDO_DATA_EFETIVACAO] = date('Y-m-d');
    $Pedido[PEDIDO_USUARIO_GRAVOU] = 7337;
    $Pedido[PEDIDO_STATUS] = "I"; // inserido
    $Pedido[PEDIDO_COD_ORCAMENTO] = '(select max(PED_COD_ORCAMENTO)+1 from ' . $objPedido->getSchema() . 'PTV_PEDIDO_PED)';
    $Pedido[PEDIDO_VERSAO] = 1;
    $Pedido[PEDIDO_VERSAO_ATUAL] = 'S';
    $BaseId = CadastraEntidade("Cadastro capa  Orcamento/Pedido", $Pedido, '', '', "503");
    $Pedido[PEDIDO_ID] = $BaseId;
    try {
        $idPedido = $ObjDao->Inserir(PEDIDO_TABLENAME, $Pedido);
    } catch (PDOException $e) {
        sleep(2);
        $idPedido = $ObjDao->Inserir(PEDIDO_TABLENAME, $Pedido);
    }
    $objPedidoSessao = BuscaPedidoPorId($BaseId);
    $_SESSION['idRegistroPai'] = $objPedidoSessao->getCodOrcamento();


    $BaseBNDS = CadastraEntidade("Cadastro info BNDS pedido" . $Pedido[PEDIDO_ID], $InformacoesPedidoBNDS);
    $InformacoesPedidoBNDS[PEDIDO_INFO_BNDS_ID] = $BaseBNDS;
    $InformacoesPedidoBNDS[PEDIDO_INFO_BNDS_PEDIDO_ID] = $Pedido[PEDIDO_ID];
    $idBNDS = $ObjDao->Inserir(PEDIDO_INFO_BNDS_TABLENAME, $InformacoesPedidoBNDS);

    $TextoNota[TEXTO_NOTA_ID_PEDIDO] = $Pedido[PEDIDO_ID];
    $BaseTextoNota = CadastraEntidade("Cadastro texto nota para o pedido" . $Pedido[PEDIDO_ID], $TextoNota);
    $TextoNota[TEXTO_NOTA_ID] = $BaseTextoNota;

    $idTextoNota = $ObjDao->Inserir(TEXTO_NOTA_TABLENAME, $TextoNota);

    $ObsPedido[OBSERVACAO_PEDIDO_ID_PEDIDO] = $Pedido[PEDIDO_ID];
    $BaseObsPedido = CadastraEntidade("Cadastro observacao para o pedido" . $Pedido[PEDIDO_ID], $ObsPedido);
    $ObsPedido[OBSERVACAO_PEDIDO_ID] = $BaseObsPedido;

    $idObsPedido = $ObjDao->Inserir(OBSERVACAO_PEDIDO_TABLENAME, $ObsPedido);


// Itens
//select EMPRESA, AR, NUM_SEQ, DATA_CONTAGEM, COD_FORNEC, "
    //. "RAZ_SOCIAL, COD_FORNEC_TRIANGULACAO, RAZ_SOCIAL_TRIANGULACAO, COD_ITEM, "
    // . "DESC_ITEM, QTD_SISTEMA, QTD_BALANCA from V_MPR_ENTRADA_TERCEIROS "
    //. "V_MPR_ENTRADA_TERCEIROS where data_contagem > '20/02/2017' order by AR
    $item[ITEM_CODIGO_ITEM] = $row[8];
    $item[ITEM_PEDIDO_ID] = $BaseId;
    $item[ITEM_COMISSAO] = "0";


    $item[ITEM_DESCRICAO_ITEM] = $row[9];

    $Sequencia = (BuscaMaiorSequencia($BaseId) + 1);
    $item[ITEM_SEQUENCIA] = $Sequencia;
    $item[ITEM_TEXTO_ITEM] = '';
    $item[ITEM_ITEM_DESENVOLVIDO] = '';
    $item[ITEM_DESENV_ESPECIAL_OBS] = '';
    $item[ITEM_BASE] = '';
    $item[ITEM_COR_FUNDO] = '';
    $item[ITEM_ESTAMPA] = '';
    $item[ITEM_COR_ESPAMPA] = '';

    $item[ITEM_QUANTIDADE] = str_replace(",", ".", $row[10]);

//
    $objItem = $objDaoErp->BuscaItemPorCodComEstoque($row[8]);
    $valor = $objDaoErp->MontaPrecoItemCorreto($row[8], $objListaPreco->getCodErp(), $Pedido[PEDIDO_ID_CLIENTE], $objCondicaoPagamento->getCondicaoPagamento(), 0, $objEstado->getSigla(), $objItem->getCodLinhaProducao(), $objItem->getCodLinRecei(), $objItem->getCodSegMerg(), $objItem->getCodClaUso(), 0);


    if ($valor != "" && isset($valor)) {
        if ($objItem->getEmpresaPortal() == "MP") {
            $IndiceDespesaFinanceira = $objDaoErp->BuscaIndiceDespFinanCondicaoPagamento($objCondicaoPagamento->getCodERP());
        } else {
            $IndiceDespesaFinanceira = "";
        }
        if ($IndiceDespesaFinanceira != "") {
            $valor = $valor * $IndiceDespesaFinanceira;
        }
    } else {
        $valor = (string) "0";
    }
    //

    if (substr_count($valor, ",") > 0) {
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", ".", $valor);
        $item[ITEM_PRECO_BRUTO] = $valor;
    } else {
        $item[ITEM_PRECO_BRUTO] = $valor;
    }


    $item[ITEM_PRAZO_ENTREGA] = $przEntrega;



    $BaseIdItens = CadastraEntidadeItem("Cadastro capa  Item", $item, 1, '', 7337);
    $item[ITEM_ID] = $BaseIdItens;
    $ResultadoInsert = $ObjDao->Inserir(ITEM_TABLENAME, $item);

//Fazer efetivar


    $objPedido = BuscaPedidoPorId($BaseId);

    $pedido = array();
    $controlePedidoGerado = array();

    $retorno = $objDaoErp->EfetivaPedidoDigMestLogix12($objPedido);

    $pedido[PEDIDO_STATUS] = "A";
    $pedido[PEDIDO_DATA_EFETIVACAO] = date("Y-m-d H:m:s");
    $pedido[PEDIDO_EFETIVADO] = $retorno;
    $objDao->Atualizar(PEDIDO_TABLENAME, $pedido, WHERE . PEDIDO_ID . IGUAL . $idPedido);

    $BaseControlePedidoGerado = CadastraEntidade("Cadastro");
    $controlePedidoGerado['CPG_ID'] = $BaseControlePedidoGerado;
    $controlePedidoGerado['CPG_NUM_PEDIDO'] = $retorno;
    $controlePedidoGerado['CPG_AR'] = $row[1];
    $controlePedidoGerado['CPG_SEQ_AR'] = $row[2];

    $ResultadoInsert = $ObjDao->Inserir("PTV.PTV_CONTRL_PED_GER_CPG", $controlePedidoGerado);
}