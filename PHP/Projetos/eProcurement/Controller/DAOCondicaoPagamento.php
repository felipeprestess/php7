<?php

function CadastraCondicaoPagamento($ValoresPost) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';
    include_once '../Controller/Base.php';

    $ObjCondicaoPagamento = new CondicaoPagamento();
    $ObjDao = new DAO();


    $condicaoPagamento = array();

    $condicaoPagamento[CondicaoPagamento::_ID] = $ValoresPost[CondicaoPagamento::_ID];
    $condicaoPagamento[CondicaoPagamento::_COD_ERP] = $ValoresPost[CondicaoPagamento::_COD_ERP];
    $condicaoPagamento[CondicaoPagamento::_DESCRICAO] = strtoupper($ValoresPost[CondicaoPagamento::_DESCRICAO]);
    $condicaoPagamento[CondicaoPagamento::_CARTEIRAS] = $ValoresPost[CondicaoPagamento::_CARTEIRAS];
    if (isset($ValoresPost[CondicaoPagamento::_PARCELADO])) {
        $condicaoPagamento[CondicaoPagamento::_PARCELADO] = 1;
    } else {
        $condicaoPagamento[CondicaoPagamento::_PARCELADO] = 0;
    }
    if (isset($ValoresPost[CondicaoPagamento::_BNDS])) {
        $condicaoPagamento[CondicaoPagamento::_BNDS] = 1;
    } else {
        $condicaoPagamento[CondicaoPagamento::_BNDS] = 0;
    }

    if (isset($ValoresPost[CondicaoPagamento::_ANTECIPADO])) {
        $condicaoPagamento[CondicaoPagamento::_ANTECIPADO] = 1;
    } else {
        $condicaoPagamento[CondicaoPagamento::_ANTECIPADO] = 0;
    }

    $condicaoPagamento[CondicaoPagamento::_VALOR_MINIMO] = $ValoresPost[CondicaoPagamento::_VALOR_MINIMO];

    if ($ValoresPost['Acao'] == "Inserir") {
        $BaseId = CadastraEntidade("Cadastro da condicao pagamento: " . $condicaoPagamento[CondicaoPagamento::_DESCRICAO]);
        $condicaoPagamento[CondicaoPagamento::_ID] = $BaseId;

        $idCondicaoPagamento = $ObjDao->Inserir(CondicaoPagamento::_TABLENAME, $condicaoPagamento);
    } else {
        $idCondicaoPagamento = $ObjDao->Atualizar(CondicaoPagamento::_TABLENAME, $condicaoPagamento, WHERE . CondicaoPagamento::_ID . IGUAL . $ValoresPost[CondicaoPagamento::_ID]);
    }
    return $idCondicaoPagamento;
}

function ListaCondicoesPagamentoDiretoERP() {
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';

    $objCondicaoPagamento = new CondicaoPagamento();
    $objDao = new DaoErp();

    $ListaCondicaoPagamento = $objDao->ConsultaGenerica("select COD_CND_PGTO, DEN_CND_PGTO from COND_PGTO");

    return $ListaCondicaoPagamento;
}

function BuscaCondicoesPagamentoDiretoERP($cod) {
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';

    $objCondicaoPagamento = new CondicaoPagamento();
    $objDao = new DaoErp();

    $ListaCondicaoPagamento = $objDao->ConsultaGenerica("select COD_CND_PGTO, DEN_CND_PGTO from COND_PGTO WHERE COD_CND_PGTO = '" . $cod . "'");

    $ListaCondicaoPagamento = $ListaCondicaoPagamento->fetch(PDO::FETCH_BOTH);

    $objCondicaoPagamento->setCodERP($ListaCondicaoPagamento[0]);
    $objCondicaoPagamento->setCondicaoPagamento($ListaCondicaoPagamento[1]);


    return $objCondicaoPagamento;
}

function BuscaMediaDiasCondicaoPagamentoDiretoERP($cod) {
    include_once '../Model/DaoErp.Class.php';

    $objDao = new DaoErp();

    $MediaDias = $objDao->ConsultaGenerica("select ((sum(qtd_dias_sd)) / (max(sequencia))) from cond_pgto_item where cod_cnd_pgto = {$cod}");

    $MediaDias = $MediaDias->fetch(PDO::FETCH_BOTH);

    return $MediaDias[0];
}

function ListaCondicoesPagamento($usuario = NULL) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';
    include_once '../Model/CondicaoPagamentoUsuario.Class.php';
    include_once '../Controller/DAOCondicaoPagamentoUsuario.php';

    $objDao = new DAO();
    $objCondicaoPagamento = new CondicaoPagamento();
    $objCondicaoPagamentoUsuario = new CondicaoPagamentoUsuario();
    $quantidadeCondicoesPagamentoUsuario = quantidadeCondicoesPagamentoUsuario();

    if ((int) buscaValorPadraoPorNome("RESPEITA USUARIO X COND PAGAMENTO") == 1 && $usuario == NULL && $quantidadeCondicoesPagamentoUsuario > 0) {
        $table = CondicaoPagamento::_TABLENAME . " INNER JOIN " . CONDPGTOUSUARIO_TABLENAME . " LPU ON (LPU." . CONDPGTOUSUARIO_CONDPGTO_ID . IGUAL . CondicaoPagamento::_ID . E . " LPU." . CONDPGTOUSUARIO_USUARIO_ID . IGUAL . $_SESSION['id'] . ") ";
    } else {
        $table = CondicaoPagamento::_TABLENAME;
    }


    $ListaCondicaoPagamento = $objDao->Consultar($table, "*");

    return $ListaCondicaoPagamento;
}

function ListaCondicoesPagamentoBuscas($item, $cliente = '', $usuario = NULL) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';
    include_once '../Model/CondicaoPagamentoUsuario.Class.php';
    include_once '../Controller/DAOCondicaoPagamentoUsuario.php';

    $objDao = new DAO();
    $objCondicaoPagamento = new CondicaoPagamento();
    $objCondicaoPagamentoUsuario = new CondicaoPagamentoUsuario();

    $quantidadeCondicoesPagamentoUsuario = quantidadeCondicoesPagamentoUsuario();

    if ($objDao->getEmpresaPortal() == "SA" || $objDao->getEmpresaPortal() == "TH") {
        $funcaoTamanho = "LEN";
    } else {
        $funcaoTamanho = "LENGTH";
    }

    if ((int) buscaValorPadraoPorNome("RESPEITA USUARIO X COND PAGAMENTO") == 1 && $usuario == NULL && $quantidadeCondicoesPagamentoUsuario > 0) {
        $table = CondicaoPagamento::_TABLENAME . " INNER JOIN " . CONDPGTOUSUARIO_TABLENAME . " LPU ON (LPU." . CONDPGTOUSUARIO_CONDPGTO_ID . IGUAL . CondicaoPagamento::_ID . E . " LPU." . CONDPGTOUSUARIO_USUARIO_ID . IGUAL . $_SESSION['id'] . ") ";
    } else {
        $table = CondicaoPagamento::_TABLENAME;
    }

    $ListaCondicaoPagamento = $objDao->ConsultarCustom("SELECT " . CondicaoPagamento::_ID . SEPARADOR . CondicaoPagamento::_COD_ERP . SEPARADOR . CondicaoPagamento::_DESCRICAO . SEPARADOR . CondicaoPagamento::_CARTEIRAS . SEPARADOR . $funcaoTamanho . "(replace(" . CondicaoPagamento::_DESCRICAO . ", ' ',''))  cont " . FROM . $table . WHERE . CondicaoPagamento::_DESCRICAO . " LIKE " . "'%" . $item . "%' OR " . CondicaoPagamento::_COD_ERP . " LIKE " . "'%" . $item . "%' ORDER BY CAST(" . CondicaoPagamento::_COD_ERP . " AS INTEGER) ASC");

    return $ListaCondicaoPagamento;
}

function ListaCondicoesPagamentoBuscasEspecificoCliente($item, $cliente = '', $usuario = NULL) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';
    include_once '../Model/CondicaoPagamentoUsuario.Class.php';
    include_once '../Controller/DAOCondicaoPagamentoUsuario.php';

    $objDao = new DAO();
    $objCondicaoPagamento = new CondicaoPagamento();
    $objCondicaoPagamentoUsuario = new CondicaoPagamentoUsuario();

    $quantidadeCondicoesPagamentoUsuario = quantidadeCondicoesPagamentoUsuario(); //0

    if ($objDao->getEmpresaPortal() == "SA" || $objDao->getEmpresaPortal() == "TH") {
        $funcaoTamanho = "LEN";
    } else {
        $funcaoTamanho = "LENGTH";
    }

    $query = "SELECT " . CondicaoPagamento::_ID . SEPARADOR . CondicaoPagamento::_COD_ERP . SEPARADOR . CondicaoPagamento::_DESCRICAO . SEPARADOR . CondicaoPagamento::_CARTEIRAS . SEPARADOR . $funcaoTamanho . "(replace(" . CondicaoPagamento::_DESCRICAO . ", ' ',''))  cont " . FROM . CondicaoPagamento::_TABLENAME . " CP
             INNER JOIN " . CONDICAO_PAGAMENTO_CLIENTE_TABLENAME . " CPC ON (CPC." . CONDICAO_PAGAMENTO_CLIENTE_VER . IGUAL . "1 AND CPC." . CONDICAO_PAGAMENTO_CLIENTE_PESSOA_ID . IGUAL . "'" . $cliente . "'" . E . " CPC." . CONDICAO_PAGAMENTO_CLIENTE_CondicaoPagamento::_ID . IGUAL . " CP." . CondicaoPagamento::_ID . ") ";
    if ((int) buscaValorPadraoPorNome("RESPEITA USUARIO X COND PAGAMENTO") == 1 && $usuario == NULL && $quantidadeCondicoesPagamentoUsuario > 0) {
        $query .= " INNER JOIN " . CONDPGTOUSUARIO_TABLENAME . " LPU ON (LPU." . CONDPGTOUSUARIO_CONDPGTO_ID . IGUAL . CondicaoPagamento::_ID . E . " LPU." . CONDPGTOUSUARIO_USUARIO_ID . IGUAL . $_SESSION['id'] . ") ";
    }
    $query .= WHERE . CondicaoPagamento::_DESCRICAO . " LIKE " . "'%" . $item . "%' OR " . CondicaoPagamento::_COD_ERP . " LIKE '%" . $item . "%'  ORDER BY cont ASC";
    //echo $query;
    $ListaCondicaoPagamento = $objDao->ConsultarCustom($query);

    return $ListaCondicaoPagamento;
}

function buscaCondicaoPagamentoPorId($idCondicaoPagamento) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';

    $objCondicaoPagamento = new CondicaoPagamento();
    $objDao = new DAO();

    $condicaoPagamento = $objDao->ConsultarInnerEntidadePadrao(CondicaoPagamento::_TABLENAME, "*", WHERE . CondicaoPagamento::_ID . IGUAL . $idCondicaoPagamento, CondicaoPagamento::_ID);


    $objCondicaoPagamento->alimentaObj($condicaoPagamento[0]);

    return $objCondicaoPagamento;
}

function buscaIndiceDespesaFinanceiraCondicaoPagamentoPorCod($codCondicaoPagamento) {
    include_once '../Model/DaoErp.Class.php';

    $objDaoErp = new DaoErp();

    $indice = $objDaoErp->ConsultaGenerica("select PCT_DESP_FINAN from cond_pgto where COD_CND_PGTO = {$codCondicaoPagamento}");
    $indice = $indice->fetch(PDO::FETCH_BOTH);
    $indice = $indice[0];
    if ($indice != "" && !is_null($indice)) {
        return $indice;
    } else {
        return 0;
    }
}

function buscaCondicaoPagamentoPorCod($codCondicaoPagamento) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';

    $objCondicaoPagamento = new CondicaoPagamento();
    $objDao = new DAO();

    $condicaoPagamento = $objDao->ConsultarInnerEntidadePadrao(CondicaoPagamento::_TABLENAME, "*", WHERE . CondicaoPagamento::_COD_ERP . IGUAL . "'" . $codCondicaoPagamento . "'", CondicaoPagamento::_ID);

    $objCondicaoPagamento->alimentaObj($condicaoPagamento[0]);

    return $objCondicaoPagamento;
}

##Busca condição de pagamento por código erp e retorna objeto##

function buscaCondicaoPagamentoPorCodErp($codErp) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';

    $objCondicaoPagamento = new CondicaoPagamento();
    $objDao = new DAO();

    $condicaoPagamento = $objDao->ConsultarInnerEntidadePadrao(CondicaoPagamento::_TABLENAME, "*", WHERE . CondicaoPagamento::_COD_ERP . IGUAL . "'" . $codErp . "'", CondicaoPagamento::_ID);

    $objCondicaoPagamento->alimentaObj($condicaoPagamento[0]);

    return $objCondicaoPagamento;
}

function deletarCondicaoPagamento($Valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();
    $ObjCondicaoPagamento = new CondicaoPagamento();

    $id = $ObjDao->Deletar(CondicaoPagamento::_TABLENAME, WHERE . CondicaoPagamento::_ID . IGUAL . $Valores['id']);

    return $id;
}

function ListarCondicaoPagamento(){
    include_once '../Model/DAO.Class.php';
    include_once '../Model/CondicaoPagamento.Class.php';
    
    $objDao= new DAO();
    $ObjCondPagmento = new CondicaoPagamento();
    
    $condicoes = $objDao->Consultar(CondicaoPagamento::_TABLENAME,"*");
   
    return $condicoes;
    
}