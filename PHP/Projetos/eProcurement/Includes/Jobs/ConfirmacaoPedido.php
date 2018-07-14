<?php

include_once '../../Model/Base.Class.php';
include_once '../../Model/DAO.Class.php';
include_once '../../Model/Usuario.Class.php';
include_once '../../Model/Funcionalidades.Class.php';
include_once '../../Controller/DAOUsuario.php';
include_once '../../Controller/DAOOrdemHistorico.php';

$objDao = new DAO();
$objUsuario = new Usuario();
$objFuncionalidades = new Funcionalidades();
 ini_set('display_errors', 1);
    ini_set('display_startup_erros', 1);
    error_reporting(E_ALL ^ E_NOTICE);
    
$formatoData = "Y-m-d";
$ontem = date($formatoData, strtotime("yesterday"));
$ontem = explode("-", $ontem);

/*$hoje = date($formatoData);
$hoje = explode("-", $hoje);*/

$href_cotacao = "Menu Perto => Cotacoes";


$lista = ListaUsuarioFornecedor();
foreach ($lista as $key => $value) {
    $fornecedorCod = $value[USUARIO_CODIGO_FORNECEDOR];
    $fornecedorNome = $value[USUARIO_NOME];

    $objUsuario = BuscaUsuarioPorCodFornecedor($fornecedorCod);
 $sql = " SELECT distinct p.num_pedido, p.cod_empresa FROM pedido_sup p 
inner join ordem_sup os on(os.cod_empresa = p.cod_empresa and os.num_pedido = p.num_pedido and os.cod_item NOT LIKE '998.%')
                                        WHERE p.cod_fornecedor = '{$fornecedorCod}' AND p.cod_empresa IN (1, 2) 
						AND p.ies_situa_ped = 'R'
                                                AND p.ies_versao_atual = 'S' 
						AND NOT EXISTS(SELECT 1 FROM ptc_pedido_historico_pdh
										  WHERE p.num_pedido = pdh_num_pedido
											  AND p.cod_empresa = pdh_cod_empresa
                                                                                          AND pdh_cod_fornecedor = '{$fornecedorCod}'
											  AND pdh_id_acao IN (1, 2)
											  OR (pdh_id_acao = 3 AND pdh_data = MDY('04','09','2018')))";

    if ($resultados = $objDao->ConsultarCustom($sql)) {

        while ($pedido = $resultados->fetch(PDO::FETCH_OBJ)) {
            if ($pedido) {
                $mensagem = "
                                                                        Prezado fornecedor {$fornecedorNome},<br /><br />
	
									Foi realizado um novo pedido para você.<br />
									O pedido %1% deve ser confirmado ou recusado.<br /><br />
									
									Você pode fazer isto pelo endere&ccedil;o:<br />
									%2%<br /><br />
									
									<strong>Atenciosamente,</strong><br />
									Digicon/Perto
								";
                $fromName = "E-Procurement - Digicon/Perto";
                $assunto = "Pedido %1% disponível";



                $link = "http://10.1.1.33/eProcurement/pedidos/avaliar/" . $pedido->COD_EMPRESA . "/" . $pedido->NUM_PEDIDO;
                $assunto = str_replace("%1%", $pedido->NUM_PEDIDO, $assunto);

                $mensagem = str_replace("%1%", $pedido->NUM_PEDIDO, $mensagem);
                $mensagem = str_replace("%2%", $link, $mensagem);
                $mensagem = "<html>
				<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>
                                <body>{$mensagem}</body>
			</html>";


                $destinatarios = array();

                $destinatarios[0]['nome'] = $objUsuario->getNome();
                $destinatarios[0]['email'] = $objUsuario->getEmail();

                if ($objUsuario->getEmailSecundario() != "") {
                    $destinatarios[1]['nome'] = $objUsuario->getNome();
                    $destinatarios[1]['email'] = $objUsuario->getEmailSecundario();
                }

                $objFuncionalidades->enviaEmail($destinatarios, $assunto, $mensagem, "");

                if ($mail->Send()) {
                    $dados['ODH_ID_FORNECEDOR'] = $fornecedorCod;
                    $dados['ODH_ID_EMPRESA'] = $pedido->COD_EMPRESA;
                    $dados['ODH_NUM_ORDEM'] = $pedido->NUM_OC;
                    $dados['ODH_ACAO'] = 3;
                    $dados['ODH_DATA'] = date('d-m-Y');
                    //CadastraOrdemHistorico($dados);
                }
            }
        }
    }
}
