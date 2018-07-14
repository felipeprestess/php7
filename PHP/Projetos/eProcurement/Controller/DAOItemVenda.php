<?php

/**
 * 
 * @param int $id
 * @return ItemVenda
 */
//Retorna um objeto do tipo Item de Venda com busca por ID
function BuscaItemVendaPorId(int $id): ItemVenda {
    include_once '../Model/ItemVenda.Class.php';
    include_once '../Model/DAO.Class.php';

    $objDAO = new DAO();
    $objItemVenda = new ItemVenda();

    $itemVenda = $objDAO->Consultar(ItemVenda::_TABLENAME, "*", WHERE . ItemVenda::_ID . IGUAL . $id);
    $objItemVenda->alimentaObj($itemVenda[0]);

    return $objItemVenda;
}

/**
 * 
 * @param string $empresa
 * @param string $codigo
 * @return ItemVenda
 */
//Retorna um objeto do tipo Item de vendo com busca por EMPRESA e CODIGO
function BuscaItemVendaPorEmpresaECodigo(string $empresa, string $codigo): ItemVenda {
    include_once '../Model/ItemVenda.Class.php';
    include_once '../Model/DAO.Class.php';


    $objDAO = new DAO();
    $objItemVenda = new ItemVenda();

    $itemVenda = $objDAO->Consultar(ItemVenda::_TABLENAME, "*", WHERE . ItemVenda::_EMPRESA . IGUAL . ASPA . $empresa . ASPA . E . ItemVenda::_CODIGO . IGUAL . ASPA . $codigo . ASPA);
    $objItemVenda->alimentaObj($itemVenda[0]);
    return $objItemVenda;
}

/**
 * 
 * @param type $valores
 * @return type
 */
function deletarItemVenda($valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/ItemVenda.Class.php';
    include_once '../Controller/Base.php';

    $objDAOItemVenda = new DAO();

    $codItemVenda = $objDAOItemVenda->Deletar(ItemVenda::_TABLENAME, WHERE . ItemVenda::_ID . IGUAL . $valores['id']);
    return $codItemVenda;
}

/**
 * 
 * @param type $valores
 * @return bool
 */
function inativarItem($valores): bool {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/ItemVenda.Class.php';
    include_once '../Controller/Base.php';

    $objDAOItemVenda = new DAO();

    $itemVenda = array();

    $itemVenda[ItemVenda::_SITUACAO] = "I";

    $objDAOItemVenda->Atualizar(ItemVenda::_TABLENAME, $itemVenda, WHERE . ItemVenda::_ID . IGUAL . $valores['id']);

    return true;
}

/**
 * 
 * @param type $valoresPost
 * @return int
 */
function cadastraItemVenda($valoresPost): int {

    include_once '../Model/DAO.Class.php';
    include_once '../Model/ItemVenda.Class.php';
    include_once '../Controller/Base.php';

    $objDaoItemVenda = new DAO();
    $itemVenda = array();
    $objFuncionalidades = new Funcionalidades();

    $itemVenda[ItemVenda::_ID] = $valoresPost[ItemVenda::_ID];
    $itemVenda[ItemVenda::_CODIGO] = $valoresPost[ItemVenda::_CODIGO];
    $itemVenda[ItemVenda::_EMPRESA] = $valoresPost[ItemVenda::_EMPRESA];
    $itemVenda[ItemVenda::_DESCRICAO] = $valoresPost[ItemVenda::_DESCRICAO];
    $itemVenda[ItemVenda::_ESPECIFICACAO] = $valoresPost[ItemVenda::_ESPECIFICACAO];
    $itemVenda[ItemVenda::_QUANTIDADE] = $valoresPost[ItemVenda::_QUANTIDADE];
    $itemVenda[ItemVenda::_PRECO_UNIT] = $objFuncionalidades->FormatarMoeda($valoresPost[ItemVenda::_PRECO_UNIT], 2);

    if ($valoresPost['Acao'] == 'Inserir') {
        $baseId = CadastraEntidade("Cadastro item venda: " . $itemVenda[ItemVenda::_DESCRICAO]);
        $itemVenda[ItemVenda::_SITUACAO] = "A";
        $itemVenda[ItemVenda::_ID] = $baseId;

        $idItemVenda = $objDaoItemVenda->Inserir(ItemVenda::_TABLENAME, $itemVenda);
    } else {
        $idItemVenda = $objDaoItemVenda->Atualizar(ItemVenda::_TABLENAME, $itemVenda, WHERE . ItemVenda::_ID . IGUAL . $valoresPost[ItemVenda::_ID]);
    }

    return $idItemVenda;
}

/**
 * 
 * @param int $status
 * @return array
 */
function listaItemVenda(string $status): array {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/ItemVenda.Class.php';
    include_once '../Controller/Base.php';

    $objDaoItemVenda = new DAO();

    return $objDaoItemVenda->Consultar(ItemVenda::_TABLENAME, TUDO, WHERE . ItemVenda::_SITUACAO . IGUAL . "'A'");
}

function converteValorEmDolar(float $valor): float {
    include_once '../Model/DAO.Class.php';
    include_once '../Controller/Base.php';

    $objDaoItemVenda = new DAO();
    $onde = "cod_moeda = '2' AND dat_ref = today";

    $cotacao = $objDaoItemVenda->Consultar("COTACAO", "VAL_COTACAO", WHERE . $onde);
    $cotacao = $cotacao[0];

    if ($cotacao != "") {
        return number_format($valor / $cotacao, 2, '.', ',');
    } else {
        return 1;
    }
}
