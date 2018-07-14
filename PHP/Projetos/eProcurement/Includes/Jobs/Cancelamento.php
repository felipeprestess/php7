<?PHP

$user = "logix";
        $pass = "logix";
        $name = "logixprd";
        $host = "192.168.0.240"; //servidor de produção local
        $user = "logix";
        $pass = "logix";
        $name = "logixprd";
        //$host = "192.168.0.240"; //servidor de produção remoto
        //$user = "logix"; $pass = "logix"; $name = "LOGIXPRD"; $host = "192.168.0.240";
        $tns = " (DESCRIPTION =(ADDRESS_LIST =(ADDRESS = (PROTOCOL = TCP) (HOST = " . $host . ")(PORT = 1521)))(CONNECT_DATA = (SID = " . $name . ")))";
        try {
            $db = new PDO("oci:dbname=" . $tns, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $i) {
            //die("Erro ao conectar com o Oracle!");
            die("Erro: <code> {$i->getMessage()} </code> <br>" . date('d/M/Y H:i:s'));
        }

		
	$Pedidos = $db->query("SELECT cod_empresa, num_pedido FROM ped_itens PI WHERE  num_pedido in ( select p.num_pedido from pedidos p where p.num_pedido=num_pedido and COD_TIP_CARTEIRA <> '02')AND PI.cod_empresa ='01' and PI.qtd_pecas_atend > 0 and (PI.qtd_pecas_solic - (PI.qtd_pecas_atend + PI.qtd_pecas_cancel + PI.qtd_pecas_romaneio)) > 0 AND PI.qtd_pecas_romaneio = 0 group by cod_empresa, num_pedido");
		while ($rows = $Pedidos->fetch(PDO::FETCH_BOTH)){
			$db->query("

DECLARE
	FGE_TLR NUMBER := 1;
	FGE_EMP VARCHAR2(25) := '01';
	FGE_PED NUMBER := ".$rows[1].";
	FGE_MOT NUMBER := 95;
BEGIN
	LOGIX.FGE_P_CANCELA_PEDIDO_TOTAL(FGE_TLR, FGE_EMP, FGE_PED, FGE_MOT);
	DBMS_OUTPUT.PUT('FGE_TLR: ');
	DBMS_OUTPUT.PUT_LINE(FGE_TLR);
	DBMS_OUTPUT.PUT('FGE_EMP: ');
	DBMS_OUTPUT.PUT_LINE(FGE_EMP);
	DBMS_OUTPUT.PUT('FGE_PED: ');
	DBMS_OUTPUT.PUT_LINE(FGE_PED);
	DBMS_OUTPUT.PUT('FGE_MOT: ');
	DBMS_OUTPUT.PUT_LINE(FGE_MOT);
END;


			");
			
		}