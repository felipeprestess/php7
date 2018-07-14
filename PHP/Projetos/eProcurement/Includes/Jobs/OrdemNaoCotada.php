<?php

include_once '../../Model/Base.Class.php';
include_once '../../Model/DAO.Class.php';
include_once '../../Model/Usuario.Class.php';
include_once '../../Controller/DAOUsuario.php';
include_once '../../Controller/DAOOrdemHistorico.php';
include_once "../../Includes/PHPMailer/PHPMailerAutoload.php";

$objDao = new DAO();
$objUsuario = new Usuario();


$formatoData = "Y-m-d";

$hoje = date($formatoData);
$hoje = explode("-", $hoje);

$venceEmAte7Dias = date($formatoData, strtotime("+7 days"));
$venceEmAte7Dias = explode("-", $venceEmAte7Dias);

$venceEmAte1Mes = date($formatoData, strtotime("+1 month"));
$venceEmAte1Mes = explode("-", $venceEmAte1Mes);

$venceEmAte2Meses = date($formatoData, strtotime("+2 months"));
$venceEmAte2Meses = explode("-", $venceEmAte2Meses);

$enviadoHa15Dias = date($formatoData, strtotime("-15 days"));
$enviadoHa15Dias = explode("-", $enviadoHa15Dias);

$enviadoHa10Dias = date($formatoData, strtotime("-10 days"));
$enviadoHa10Dias = explode("-", $enviadoHa10Dias);

$enviadoHa7Dias = date($formatoData, strtotime("-7 days"));
$enviadoHa7Dias = explode("-", $enviadoHa7Dias);

$lista = ListaUsuarioFornecedor();


foreach ($lista as $key => $value) {
    $fornecedorCod = $value[USUARIO_CODIGO_FORNECEDOR];
    $fornecedorNome = $value[USUARIO_NOME];

    $sql = "SELECT o.cod_empresa, o.num_oc, c.dat_limite FROM ordem_sup o, ordem_sup_cot f, cotacao_preco c 
					WHERE o.ies_versao_atual = 'S' AND o.cod_empresa IN (1, 2) AND o.num_pedido = 0
						AND f.cod_empresa = o.cod_empresa AND f.num_oc = o.num_oc AND f.num_versao_oc = o.num_versao
						AND c.cod_empresa = f.cod_empresa AND c.cod_fornecedor = f.cod_fornecedor AND c.num_cotacao = f.num_cotacao
                                                AND c.num_versao = f.num_versao_cot AND c.ies_versao_atual = 'S' AND f.cod_fornecedor = '{$fornecedorCod}'
						AND o.ies_situa_oc = 'R'";

    $sqls = array();

    // Vence em até 7 dias
    $sqls[] = $sql . " AND c.dat_limite BETWEEN MDY('{$hoje[1]}','{$hoje[2]}','{$hoje[0]}') AND MDY('{$venceEmAte7Dias[1]}','{$venceEmAte7Dias[2]}','{$venceEmAte7Dias[0]}')
                                AND NOT EXISTS (SELECT 1 FROM ptc_ordem_historico_odh WHERE odh_acao IN (1, 5) AND odh_id_fornecedor = '{$fornecedorCod}'
								AND odh_num_ordem = o.num_oc AND odh_id_empresa = o.cod_empresa AND odh_data = MDY('{$hoje[1]}','{$hoje[2]}','{$hoje[0]}'))";

    // Vence em até 1 mês
    $sqls[] = $sql . " AND c.dat_limite BETWEEN MDY('{$venceEmAte7Dias[1]}','{$venceEmAte7Dias[2]}','{$venceEmAte7Dias[0]}') AND MDY('{$venceEmAte1Mes[1]}','{$venceEmAte1Mes[2]}','{$venceEmAte1Mes[0]}')
                                AND NOT EXISTS (SELECT 1 FROM ptc_ordem_historico_odh WHERE odh_acao IN (1, 5) AND odh_id_fornecedor = '{$fornecedorCod}'
								AND odh_num_ordem = o.num_oc AND odh_id_empresa = o.cod_empresa AND odh_data >= MDY('{$enviadoHa7Dias[1]}','{$enviadoHa7Dias[2]}','{$enviadoHa7Dias[0]}'))";


    // Vence em até 2 meses
    $sqls[] = $sql . " AND c.dat_limite BETWEEN MDY('{$venceEmAte1Mes[1]}','{$venceEmAte1Mes[2]}','{$venceEmAte1Mes[0]}') AND MDY('{$venceEmAte2Meses[1]}','{$venceEmAte2Meses[2]}','{$venceEmAte2Meses[0]}')
                                AND NOT EXISTS (SELECT 1 FROM ptc_ordem_historico_odh WHERE odh_acao IN (1, 5) AND odh_id_fornecedor = '{$fornecedorCod}'
								AND odh_num_ordem = o.num_oc AND odh_id_empresa = o.cod_empresa AND odh_data >= MDY('{$enviadoHa10Dias[1]}','{$enviadoHa10Dias[2]}','{$enviadoHa10Dias[0]}'))";


    // Vence após 2 meses	
    $sqls[] = $sql . " AND c.dat_limite > MDY('{$venceEmAte2Meses[1]}','{$venceEmAte2Meses[2]}','{$venceEmAte2Meses[0]}')
                                AND NOT EXISTS (SELECT 1 FROM ptc_ordem_historico_odh WHERE odh_acao IN (1, 5) AND odh_id_fornecedor = '{$fornecedorCod}'
								AND odh_num_ordem = o.num_oc AND odh_id_empresa = o.cod_empresa AND odh_data >= MDY('{$enviadoHa15Dias[1]}','{$enviadoHa15Dias[2]}','{$enviadoHa15Dias[0]}'))";


    foreach ($sqls as $key => $sql) {
        echo $sql;
        if ($resultados = $objDao->ConsultarCustom($sql)) {
            while ($ordem = $resultados->fetch(PDO::FETCH_OBJ)) {
                if ($ordem) {

                    $mensagem = "
                                                                                Prezado fornecedor {$fornecedorNome},<br /><br />
										
										A cotação número %1% está disponível até dia %2%.<br /><br />
										
										Você pode cotá-la no seguinte endereço:<br />
										%3%<br /><br />
		
										<strong>Atenciosamente,</strong><br />
										Digicon/Perto
									";
                    $fromName = "E-Procurement - Digicon/Perto";
                    $assunto = "Cotação número %1% disponível";




                    $sql = "SELECT c.dat_limite from cotacao_preco c, ordem_sup o, ordem_sup_cot f WHERE
									c.cod_empresa = f.cod_empresa AND 
									c.cod_fornecedor = f.cod_fornecedor AND 
									c.num_cotacao = f.num_cotacao AND 
									c.cod_item = o.cod_item AND 
									c.num_versao = f.num_versao_cot AND 
									f.cod_empresa = o.cod_empresa AND 
									f.num_oc = o.num_oc AND 
									o.cod_empresa = {$ordem->COD_EMPRESA} AND 
									o.num_oc = {$ordem->NUM_OC} AND 
									o.num_versao = {$ordem->NUM_VERSAO} AND 
									o.ies_situa_oc = {$ordem->IES_SITUA_OC}";

                    if ($cotacao = executar($conexao, $sql))
                        if ($cotacao = $cotacao->fetchObject()) {
                            $linkCotacao = "";
                            $vencimento = $cotacao->DAT_LIMITE;
                            $assunto = str_replace("%1%", $ordem->NUM_OC, $assunto);

                            $mensagem = str_replace("%1%", $ordem->NUM_OC, $mensagem);
                            $mensagem = str_replace("%2%", $vencimento, $mensagem);
                            $mensagem = str_replace("%3%", $linkCotacao, $mensagem);
                            $mensagem = "<html>
				<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>
                                <body>{$mensagem}</body>
			</html>";


                            //$email = $fornecedor->EMAIL;
                            $email = "pdeolinda@perto.com.br";
                            $mail = new PHPMailer();

                            $mail->IsSMTP();
                            $mail->Host = "10.1.1.25";
                            $mail->SMTPAuth = true;
                            $mail->Port = 25;
                            $mail->Username = "eprocurement@perto.com.br";
                            $mail->Password = "eprocurement.perto.2013";
                            $mail->CharSet = "ISO-8859-1";
                            $mail->SetFrom("eprocurement@perto.com.br", $fromName);
                            $mail->AddReplyTo("eprocurement@perto.com.br", $fromName);
                            $mail->AddAddress($email);
                            $mail->AddAddress('msceverton@gmail.com');
                            $mail->Subject = $assunto;
                            $mail->MsgHTML($mensagem);

                            //if ($mail->Send()) {
                            $dados['ODH_ID_FORNECEDOR'] = $fornecedorCod;
                            $dados['ODH_ID_EMPRESA'] = $ordem->COD_EMPRESA;
                            $dados['ODH_NUM_ORDEM'] = $ordem->NUM_OC;
                            $dados['ODH_ACAO'] = 1;
                            $dados['ODH_DATA'] = date('d-m-Y');
                            CadastraOrdemHistorico($dados);
                            //}
                        }
                }
            }
        }
    }
}


/*
  $mail = new PHPMailer();

  $mail->IsSMTP();
  $mail->Host = "10.1.1.25";
  $mail->SMTPAuth = true;
  $mail->Port = 25;
  $mail->Username = "eprocurement@perto.com.br";
  $mail->Password = "eprocurement.perto.2013";
  $mail->CharSet = "UTF-8";
  $mail->SetFrom("eprocurement@perto.com.br", "PERTO");
  $mail->AddReplyTo("eprocurement@perto.com.br", "PERTO");
  $mail->AddAddress('msceverton@gmail.com');
  $mail->AddAddress('pdeolinda@perto.com.br');
  $mail->Subject = 'EMAIL DE AVISO DE ORDEM NÃO COTADA A 7 DIAS, 1 MÊS E 2 MESES - DATA E HORA: ' . date('d/m/Y H:i:s');
  $mail->MsgHTML('ENVIO - DATA E HORA: ' . date('d/m/Y H:i:s'));
  $mail->Send(); */
?>