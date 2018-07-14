<?php

include_once '../../Model/Base.Class.php';
include_once '../../Model/DAO.Class.php';
include_once '../../Model/Auditoria.Class.php';
include_once '../../Model/AuditoriaCampo.Class.php';
include_once '../../Model/DaoErp.Class.php';
include_once '../../Model/Cidade.Class.php';
include_once '../../Model/EnderecoPessoa.Class.php';
include_once '../../Model/Pedido.Class.php';
include_once '../../Model/Pessoa.Class.php';
include_once '../../Model/Funcionalidades.Class.php';
include_once '../../Model/Usuario.Class.php';
include_once '../../Controller/DAOPessoa.php';
include_once '../../Controller/DAOPedido.php';
include_once '../../Controller/DAOUsuario.php';
include_once '../../Controller/Base.php';
include_once '../PHPMailer/class.phpmailer.php';

$objDaoErp = new DaoErp();
$objPessoa = new Pessoa();
$objPedido = new Pessoa();
$objUsuario = new Usuario();
$objUsuarioAnalista = new Usuario();
$objBase = new Base();
$objDao = new DAO();
$objFuncionalidades = new Funcionalidades();

$data = $objFuncionalidades->CalculaData(date("Y-m-d"), 15, "d", "-");
$data = explode("-", $data);
$Sql = "select FNM.NOTA_FISCAL, FNM.DAT_HOR_EMISSAO, FNM.TRANS_NOTA_FISCAL, FNM.EMPRESA, FNM.CLIENTE from fat_nf_mestre FNM 
where TIP_CARTEIRA = '03' and DAT_HOR_EMISSAO < MDY('{$data[1]}','{$data[2]}','{$data[0]}') AND FNM.TRANS_NOTA_FISCAL NOT IN 
(SELECT EFA_TRANS_NOTA_FISCAL FROM {$objDaoErp->getSchema()}PTV_EMAIL_FAT_AMOSTRA_EFA WHERE EFA_TRANS_NOTA_FISCAL =FNM.TRANS_NOTA_FISCAL AND EFA_EMPRESA = FNM.EMPRESA) ORDER BY FNM.NOTA_FISCAL";
$nfe = $objDaoErp->ConsultaGenerica($Sql);


include("../PHPMailer/PHPMailerAutoload.php");
if ($objDaoErp->getEmpresaPortal() == "MP") {
    while ($rowMestre = $nfe->fetch(PDO::FETCH_BOTH)) {
        $objPessoa = BuscaPessoaPorCod($rowMestre[4]);
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.malhariaprincesa.com.br';
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = "logix@malhariaprincesa.com.br";
        $mail->Password = "#IJ5ht2_";
        $mail->setFrom('logix@malhariaprincesa.com.br', 'Portal de vendas');
        $mail->AddAddress(strtolower($objPessoa->getEmail()), strtolower(utf8_decode($objPessoa->getRazaoSocial())));
        $mail->Subject = "Amostras Malharia Princesa";

        $email = "";
        $email .= "Olá, tudo bem???\r\n";
        $email .= "Verificamos que foi encaminhado uma amostra para vocês a Alguns dias atrás, NF {$rowMestre[0]} com os itens:\r\n";

        $itensNfe = $objDaoErp->ConsultaGenerica("SELECT FNI.ITEM,FNI.DES_ITEM,FNI.PEDIDO FROM FAT_NF_ITEM FNI WHERE FNI.EMPRESA='{$rowMestre[3]}' and FNI.TRANS_NOTA_FISCAL = {$rowMestre[2]}");
        while ($rowItem = $itensNfe->fetch(PDO::FETCH_BOTH)) {
            $Pedido = $rowItem[2];
            $email .= "         * {$rowItem[0]} -  {$rowItem[1]}  \r\n";
        }

        //Busca usuario pelo pedido
        $objPedido = BuscaPedidoPorCodErp($Pedido);
        $objUsuario = BuscaUsuarioPorID($objPedido->getUsuarioGravou());
        $mail->AddAddress(strtolower($objUsuario->getEmail()), strtolower(utf8_decode($objUsuario->getNome())));

        // Busca analista pela codigo representante
        $cod_analista = $objDaoErp->BuscaAnalistaDoRepresentate($objUsuario->getRepresentanteERP());
        $objUsuarioAnalista = BuscaUsuarioPorCodRepresentante($cod_analista);
        $mail->AddAddress(strtolower($objUsuarioAnalista->getEmail()), strtolower(utf8_decode($objUsuarioAnalista->getNome())));

        $email .= "Gostaríamos de saber se Já foi Testado???\r\n";
        $email .= "O que Acharam do Artigo??\r\n";
        $email .= "Podemos agendar uma visita o quanto antes??\r\n";
        $email .= "Agradecemos a Atenção,\r\n";
        $email .= "Malharia Princesa\r\n";

        $mail->msgHTML($email);
        $mail->AltBody = $email;

        $faturamentoAmostra = array();
        $faturamentoAmostra['EFA_TRANS_NOTA_FISCAL'] = $rowMestre[2];
        $faturamentoAmostra['EFA_EMPRESA'] = $rowMestre[3];

        $BaseId = CadastraEntidade("Cadastro de faturamento amostra");
        $faturamentoAmostra['EFA_ID'] = $BaseId;

        $id = $objDao->InserirTeste($objDaoErp->getSchema() . "PTV_EMAIL_FAT_AMOSTRA_EFA", $faturamentoAmostra);

        //$mail->send();
    }
}