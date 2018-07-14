<?php
include_once '../../Model/IClass.php';
include_once '../../Model/Base.Class.php';
include_once '../../Model/DAO.Class.php';
include_once '../../Model/Usuario.Class.php';
include_once '../../Model/ItemVenda.Class.php';
include_once '../../Model/Funcionalidades.Class.php';
include_once '../../Controller/DAOUsuario.php';
include_once '../../Controller/DAOItemVenda.php';
include_once "../../Includes/PHPMailer/PHPMailerAutoload.php";

$objDao = new DAO();
$objUsuario = new Usuario();
$objItemVenda = new ItemVenda();
$objFuncionalidades = new Funcionalidades();

//ASSUNTO E MENSAGEM EM PORTUGUÊS
$assuntoPT = "Itens de Venda (Obsoletos)";

$mensagemPT = "Prezado Fornecedor,
				 <br><br>
				 Segue abaixo uma lista de Itens Obsoletos disponíveis para a venda:
				 <br><br><br>";



$itemVenda = listaItemVenda('A');
foreach ($itemVenda as $key => $value) {

    $mensagemPT .= "<strong>Item</strong>: " . $value[ItemVenda::_CODIGO] . " | <strong>Quantidade</strong>: " . $value[ItemVenda::_QUANTIDADE] . " | <strong>Preço</strong>: U$ " . converteValorEmDolar($value[ItemVenda::_PRECO_UNIT]) . " (R$ " . number_format((float) $value[ItemVenda::_PRECO_UNIT], 2, ",", ".") . ")";
    $mensagemPT .= "<br>";
    $mensagemPT .= "<strong>Especificação</strong>:  " . $itemVenda->ITEM_ESPEC;
    $mensagemPT .= "<br>";
    $mensagemPT .= "<strong>Fabricante(s)</strong>:  ";

    $sqlForns = "SELECT * FROM item_fabricante WHERE cod_item = '" . $itemVenda->ITEM_COD . "' AND cod_empresa='" . $itemVenda->COD_EMPRESA . "'";
    if ($parts = $objDao->ConsultarCustom($sqlForns)) {
        while ($partNumber = $parts->fetch(PDO::FETCH_OBJ)) {
            if (trim($partNumber->COD_REF_ITEM) != '') {
                $mensagemPT .= " Part Number " . ($partNumber->COD_REF_ITEM) . " - " . ($partNumber->NOM_FABRICANTE) . " | ";
            }
        }
    }

    $mensagemPT .= "<br><br>";
}


$mensagemPT .= "<br>";
$mensagemPT .= "<strong>Havendo interesse, acesse o portal e entre em contato.</strong>";
$mensagemPT .= "<br><br>";
$mensagemPT .= "Atenciosamente,";
$mensagemPT .= "<br><br>";
$mensagemPT .= "<strong>Perto/Digicon</strong>";


$listaUsuario = ListaUsuarioFornecedor();



$destinatarios = array();
foreach ($listaUsuario as $keyUsuario => $valueUsuario) {
    $assunto = $assuntoPT;
    $mensagem = $mensagemPT;
    $fornecedorNome = $valueUsuario[USUARIO_NOME];
    $fornecedorEmail = $valueUsuario[USUARIO_EMAIL];

    $destinatarios[0]['nome'] = $fornecedorEmail;
    $destinatarios[0]['email'] = $fornecedorEmail;

    //$objFuncionalidades->enviaEmail($destinatarios, $assunto, $mensagem, "");
}
?>
<script> window.close();</script>
