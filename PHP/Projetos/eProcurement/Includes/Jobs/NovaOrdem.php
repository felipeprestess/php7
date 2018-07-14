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
$ontem = date($formatoData, strtotime("yesterday"));
$ontem = explode("-", $ontem);

$hoje = date($formatoData);
$hoje = explode("-", $hoje);

$href_cotacao = "Menu Perto => Cotacoes";


$lista = ListaUsuarioFornecedor();
foreach ($lista as $key => $value) {
    $fornecedorCod = $value[USUARIO_CODIGO_FORNECEDOR];
    $fornecedorNome = $value[USUARIO_NOME];


    $sql = "SELECT %1%
					FROM ordem_sup o, ordem_sup_cot f, cotacao_preco c
					WHERE o.ies_versao_atual = 'S'
						AND o.ies_situa_oc = 'A'
						AND o.cod_empresa IN (1, 2)
						AND o.cod_empresa = f.cod_empresa
						AND o.num_oc = f.num_oc
						AND o.num_versao = f.num_versao_oc
                                                AND f.cod_fornecedor = '{$fornecedorCod}'
						AND f.cod_empresa = c.cod_empresa
						AND f.cod_fornecedor = c.cod_fornecedor
						AND f.num_cotacao = c.num_cotacao
						AND f.num_versao_cot = c.num_versao
						AND c.ies_versao_atual = 'S'
                                                AND c.data_cadastro BETWEEN MDY('{$ontem[1]}','{$ontem[2]}','{$ontem[0]}') AND MDY('{$hoje[1]}','{$hoje[2]}','{$hoje[0]}')
						AND NOT EXISTS(SELECT 1 
									   FROM ptc_ordem_historico_odh h
									   WHERE h.odh_acao = 1
                                                                                        AND h.odh_id_fornecedor = '{$fornecedorCod}'
											AND h.odh_num_ordem = o.num_oc
											AND h.odh_id_empresa = o.cod_empresa)
						";


    $param_what = "COUNT(UNIQUE o.num_oc) as qtde";

    $numero_cotacoes = $objDao->ConsultarCustom(str_replace("%1%", $param_what, $sql))->fetch(PDO::FETCH_BOTH);
    $numero_cotacoes = $numero_cotacoes[0];

    if ($numero_cotacoes > 0) {

        $mensagem = "
								Prezado fornecedor " . $fornecedorNome . ",
								<br /><br />
                                                                Existe(m) {$numero_cotacoes} cotação(ões) disponível(is).
								<br /><br />
								Para realizar a(s) cotação(ões), acesse o seguinte endereço:
								<br />
                                                                 {$href_cotacao}
								<br /><br />
								<strong>Atenciosamente,</strong><br />
								Digicon/Perto
							";
        $fromName = "E-Procurement - Digicon/Perto";
        $assunto = "{$numero_cotacoes} nova(s) cotação(ões) disponível(is)";
        /* switch ($fornecedor->IDIOMA) {
          case "BR":
          $mensagem = "
          Prezado fornecedor " . $fornecedorNome . ",
          <br /><br />
          Existe(m) $numero_cotacoes cotação(ões) disponível(is).
          <br /><br />
          Para realizar a(s) cotação(ões), acesse o seguinte endereço:
          <br />
          $href_cotacao
          <br /><br />
          <strong>Atenciosamente,</strong><br />
          Digicon/Perto
          ";
          $fromName = "E-Procurement - Digicon/Perto";
          $assunto = "$numero_cotacoes nova(s) cotação(ões) disponível(is)";
          break;
          case "ES":
          $mensagem = "
          Prezado fornecedor " . $fornecedorNome . ",
          <br /><br />
          Existe(m) $numero_cotacoes cotação(ões) disponível(is).
          <br /><br />
          Para realizar a(s) cotação(ões), acesse o seguinte endereço:
          <br />
          $href_cotacao
          <br /><br />
          <strong>Atenciosamente,</strong><br />
          Digicon/Perto
          ";
          $fromName = "E-Procurement - Digicon/Perto";
          $assunto = "$numero_cotacoes nova(s) cotação(ões) disponível(is)";
          break;
          default:
          $mensagem = "
          Prezado fornecedor " . $fornecedorNome . ",
          <br /><br />
          Existe(m) $numero_cotacoes cotação(ões) disponível(is).
          <br /><br />
          Para realizar a(s) cotação(ões), acesse o seguinte endereço:
          <br />
          $href_cotacao
          <br /><br />
          <strong>Atenciosamente,</strong><br />
          Digicon/Perto
          ";
          $fromName = "E-Procurement - Digicon/Perto";
          $assunto = "$numero_cotacoes nova(s) cotação(ões) disponível(is)";
          break;
          } */

        $mensagem = "<html>
				<head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\"></head>
                                <body>{$mensagem}</body>
			</html>";
        $email = $value[USUARIO_EMAIL];
        //$email = "pdeolinda@perto.com.br";
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
        //$mail->Send();

        $param_what = "o.num_oc, o.cod_empresa";
        if ($resultados = $objDao->ConsultarCustom(str_replace("%1%", $param_what, $sql))) {
            while ($ordem = $resultados->fetch(PDO::FETCH_OBJ)) {
                $dados['ODH_ID_FORNECEDOR'] = $fornecedorCod;
                $dados['ODH_ID_EMPRESA'] = $ordem->COD_EMPRESA;
                $dados['ODH_NUM_ORDEM'] = $ordem->NUM_OC;
                $dados['ODH_ACAO'] = 1;
                $dados['ODH_DATA'] = date('d-m-Y');
                CadastraOrdemHistorico($dados);
            }
        }
    }
}
?>