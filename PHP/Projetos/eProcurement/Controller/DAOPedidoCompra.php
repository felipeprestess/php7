<?php

/**
 * 
 * @param array $ValoresPost
 * @return int
 */
function CadastraPedidoCompra(array $ValoresPost): int {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();

    $pedidoCompra = array();

    $pedidoCompra["PDH_ID"] = $ValoresPost["PDH_ID"];
    $pedidoCompra["PDH_ID_ACAO"] = $ValoresPost["PDH_ID_ACAO"];
    $pedidoCompra["PDH_COD_FORNECEDOR"] = $ValoresPost["PDH_COD_FORNECEDOR"];
    $pedidoCompra["PDH_COD_EMPRESA"] = $ValoresPost["PDH_COD_EMPRESA"];
    $pedidoCompra["PDH_NUM_PEDIDO"] = $ValoresPost["PDH_NUM_PEDIDO"];
    $pedidoCompra["PDH_DATA"] = $ValoresPost["PDH_DATA"];
    $pedidoCompra["PDH_OBSERVACAO"] = $ValoresPost["PDH_OBSERVACAO"];
    $pedidoCompra["PDH_QTDE_ENTREGUE"] = $ValoresPost["PDH_QTDE_ENTREGUE"];
    $pedidoCompra["PDH_NOVA_DATA"] = $ValoresPost["PDH_NOVA_DATA"];

    $BaseId = CadastraEntidade("Cadastro de Pedido Compra: " . $pedidoCompra["PDH_NUM_PEDIDO"]);
    $pedidoCompra["PDH_ID"] = $BaseId;

    $id = $ObjDao->Inserir("PTC_PEDIDO_HISTORICO_PDH", $pedidoCompra);

    return $id;
}

/**
 * 
 * @param string $pedido
 * @param string $empresa
 * @param string $fornecedor
 * @return bool
 */
function isAvaliado(string $pedido, string $empresa, string $fornecedor): bool {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();

    if ($resultados = $ObjDao->ConsultarCustom("select count(*) from PTC_PEDIDO_HISTORICO_PDH where PDH_ID_ACAO IN (1, 2) and"
            . " PDH_COD_FORNECEDOR ='{$fornecedor}' and PDH_COD_EMPRESA = '{$empresa}' and PDH_NUM_PEDIDO = {$pedido}"))
        $resultado = $resultados->fetch(PDO::FETCH_BOTH);

    if ($resultado[0] > 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * 
 * @param string $pedido
 * @param string $empresa
 * @param string $fornecedor
 * @return int
 */
function buscaStatusPedido(string $pedido, string $empresa, string $fornecedor): int {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();

    $resultado = $ObjDao->ConsultarCustom("select PDH_ID_ACAO from PTC_PEDIDO_HISTORICO_PDH where PDH_ID_ACAO IN (1, 2) and"
                    . " PDH_COD_FORNECEDOR ='{$fornecedor}' and PDH_COD_EMPRESA = '{$empresa}' and PDH_NUM_PEDIDO = {$pedido}")->fetch(PDO::FETCH_BOTH);


    return (int) $resultado[0];
}

/**
 * 
 * @param string $pedido
 * @param string $empresa
 * @param string $fornecedor
 * @return string
 */
function buscaObservacaoPedido(string $pedido, string $empresa, string $fornecedor): string {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Controller/Base.php';

    $ObjDao = new DAO();

    $resultado = $ObjDao->ConsultarCustom("select PDH_OBSERVACAO from PTC_PEDIDO_HISTORICO_PDH where PDH_ID_ACAO IN (1, 2) and"
                    . " PDH_COD_FORNECEDOR ='{$fornecedor}' and PDH_COD_EMPRESA = '{$empresa}' and PDH_NUM_PEDIDO = {$pedido}")->fetch(PDO::FETCH_BOTH);

    return !is_null($resultado[0]) ? $resultado[0] : "";
}
