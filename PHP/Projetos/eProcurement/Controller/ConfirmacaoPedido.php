<?php

include_once '../Model/Base.Class.php';
include_once '../Model/DAO.Class.php';
include_once '../Model/Usuario.Class.php';
include_once '../Model/Funcionalidades.Class.php';
include_once '../Controller/DAOUsuario.php';
include_once '../Controller/Base.php';
include_once '../Controller/DAOOrdemHistorico.php';

$objDao = new DAO();
$objUsuario = new Usuario();
$objFuncionalidades = new Funcionalidades();

$formatoData = "Y-m-d";
$ontem = date($formatoData, strtotime("yesterday"));
$ontem = explode("-", $ontem);

$hoje = date($formatoData);
$hoje = explode("-", $hoje);

$href_cotacao = "Ao acessar o link(http://200.182.168.181/eProcurement/View/Login.php) e fazer o login: Menu Perto => Cotacoes";


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
                                                and p.dat_emis > MDY('04','08','2018')
						AND NOT EXISTS(SELECT 1 FROM ptc_pedido_historico_pdh
										  WHERE p.num_pedido = pdh_num_pedido
											  AND p.cod_empresa = pdh_cod_empresa
                                                                                          AND pdh_cod_fornecedor = '{$fornecedorCod}'
											  AND pdh_id_acao IN (3)
											  OR (pdh_id_acao = 3 AND pdh_data ='{$formatoData}'))";

    if ($resultados = $objDao->ConsultarCustom($sql)) {

        while ($pedido = $resultados->fetch(PDO::FETCH_OBJ)) {
            if ($pedido) {
                $mensagem = "
                                                                        Prezado fornecedor {$fornecedorNome},<br /><br />
	
									Foi realizado um novo pedido para voce.<br />
									O pedido %1% deve ser confirmado ou recusado.<br /><br />
									
									Voce pode fazer isto pelo endere&ccedil;o:<br />
									%2%<br /><br />
									
									<strong>Atenciosamente,</strong><br />
									Digicon/Perto
								";
                $fromName = "E-Procurement - Digicon/Perto";
                $assunto = "Pedido %1% disponivel";



                $link = " No sistema eprocuremente " . $href_cotacao;
                $assunto = str_replace("%1%", $pedido->NUM_PEDIDO, $assunto);

                $mensagem = str_replace("%1%", $pedido->NUM_PEDIDO, $mensagem);
                $mensagem = str_replace("%2%", $href_cotacao, $mensagem);
                $mensagem = "<html>
				<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>
                                <body>{$mensagem}</body>
			</html>";


                $destinatarios = array();
                $destinatarios[0]['nome'] = "rodrigo@forgesolucoes.com.br";
                $destinatarios[0]['email'] = "rodrigo@forgesolucoes.com.br";

                $destinatarios[1]['nome'] = $objUsuario->getNome();
                $destinatarios[1]['email'] = $objUsuario->getEmail();

                if ($objUsuario->getEmailSecundario() != "") {
                    $destinatarios[2]['nome'] = $objUsuario->getNome();
                    $destinatarios[2]['email'] = $objUsuario->getEmailSecundario();
                }

                $objFuncionalidades->enviaEmail($destinatarios, $assunto, $mensagem, "");


                $dados['PDH_COD_FORNECEDOR'] = $fornecedorCod;
                $dados['PDH_COD_EMPRESA'] = $pedido->COD_EMPRESA;
                $dados['PDH_NUM_PEDIDO'] = $pedido->NUM_PEDIDO;
                $dados['PDH_ID_ACAO'] = 3;
                $dados['PDH_DATA'] = date('d-m-Y');

                $BaseId = CadastraEntidade("Cadastro de envio de email confirmacao pedido " . $pedido->NUM_PEDIDO);
                $dados["PDH_ID"] = $BaseId;

                $id = $objDao->Inserir("PTC_PEDIDO_HISTORICO_PDH", $dados);
            }
        }
    }
}
