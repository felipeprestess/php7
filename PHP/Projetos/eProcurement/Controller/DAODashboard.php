<?php

include_once '../Model/Base.Class.php';

class DataPortal extends Base {

    private $date;

    function __construct($date) {
        parent::__construct();
        $this->date = $date;
        $this->Format();
    }

    function Format() {
        if ($this->getEmpresaPortal() == "GUABI" || $this->getEmpresaPortal() == "BR") {
            $this->setDate(" TO_DATE('{$this->getDate()}', '%Y-%m-%d') ");
        } elseif ($this->getEmpresaPortal() == "MP" || $this->getEmpresaPortal() == "HI") {
            $this->setDate(" TO_DATE('{$this->getDate()}','yyyy-mm-dd') ");
        } elseif ($this->getEmpresaPortal() == "SA" || $this->getEmpresaPortal() == "TH") {
            $this->setDate(" CONVERT(DATETIME, '{$this->getDate()}', 120) ");
        }
    }

    function getDate() {
        return $this->date;
    }

    function setDate($date) {
        $this->date = $date;
    }

}

function getPedidosPerdidos() {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Pedido.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOPedido.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/Session.php';

    $objDAO = new DAO();
    $objUsuario = new Usuario();
    $objPedido = new Pedido();


    $DataInicial = date('Y') . "-" . date('m') . "-01";
    $DataInicial = " CONVERT(DATETIME, " . $DataInicial . ", 120)";
    $DataFinal = "CONVERT(DATETIME, ." . date('Y-m-d') . ", 120)";

    $pedidos = $objDAO->ConsultarInnerEntidadePadrao(PEDIDO_TABLENAME, "*", WHERE . BASE_CRIADOR_ID . IGUAL . $_SESSION['id'] . E . BASE_CREATEDTIME . " >= " . $DataInicial . E . BASE_CREATEDTIME . " <= " . $DataFinal . E . PEDIDO_MOTIVO_PERCA_ID . " <> ''" . E . PEDIDO_MOTIVO_PERCA_ID . " IS NOT NULL" . E . PEDIDO_MOTIVO_PERCA_ID . " <> '0'", PEDIDO_ID);

    return count($pedidos);
}

function getPedidosAbertos() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $DataInicial = date('Y') . "-" . date('m') . "-01";
    $DataFinal = date('Y-m-d');
    $CodEmpresa = "01";

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "
SELECT COUNT(DISTINCT(P.num_pedido)) Qtd_Pedidos_Emitidos
FROM ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
AND P.DAT_PEDIDO >= {$DataInicial->getDate()}
and p.DAT_PEDIDO <= {$DataFinal->getDate()})
WHERE p1.COD_EMPRESA = '" . $CodEmpresa . "'
AND (p1.qtd_pecas_solic - p1.qtd_pecas_cancel)> 0";


    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }

    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetch(PDO::FETCH_BOTH);

    return $dados[0];
}

function getPedidosComSaldoFaturar() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $DataInicial = date('Y') . "-" . date('m') . "-01";
    $DataFinal = date('Y-m-d');
    $CodEmpresa = "01";

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "
select COUNT(DISTINCT(P.num_pedido)) Pedidos_Com_saldo_a_faturar_julho
from ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
AND P.DAT_PEDIDO >= {$DataInicial->getDate()}
and p.DAT_PEDIDO <= {$DataFinal->getDate()})
where p1.COD_EMPRESA = '" . $CodEmpresa . "'
and (p1.qtd_pecas_solic - p1.qtd_pecas_cancel) > 0
and (p1.qtd_pecas_solic - p1.qtd_pecas_cancel) - p1.qtd_pecas_atend > 0 ";

    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }

    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetch(PDO::FETCH_BOTH);

    return $dados[0];
}

function getPedidosTotalmenteAtendidos() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $DataInicial = date('Y') . "-" . date('m') . "-01";
    $DataFinal = date('Y-m-d');
    $CodEmpresa = "01";

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "select COUNT(DISTINCT(P.num_pedido)) Pedidos_Atendidos_Total
FROM ped_itens P1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
and P.DAT_PEDIDO >= {$DataInicial->getDate()}
and p.DAT_PEDIDO <= {$DataFinal->getDate()})
WHERE P1.COD_EMPRESA = '" . $CodEmpresa . "'
and (P1.qtd_pecas_solic - P1.qtd_pecas_cancel) > 0
and p1.qtd_pecas_atend >0
and P1.num_pedido not in
(select P2.num_pedido
from ped_itens P2
where p2.COD_EMPRESA = p1.COD_EMPRESA
and (P2.qtd_pecas_solic - P2.qtd_pecas_cancel)> 0
and (P2.qtd_pecas_solic - P2.qtd_pecas_cancel) -P2.QTD_PECAS_ATEND >0)
";

    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }

    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetch(PDO::FETCH_BOTH);

    return $dados[0];
}

function getPedidosSeparadosEntrega() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $DataInicial = date('Y') . "-" . date('m') . "-01";
    $DataFinal = date('Y-m-d');
    $CodEmpresa = "01";

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "select COUNT(DISTINCT(p1.num_pedido)) TOTAL
from ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
and P.DAT_PEDIDO >= {$DataInicial->getDate()}
and p.DAT_PEDIDO <= {$DataFinal->getDate()})
where p1.COD_EMPRESA = '" . $CodEmpresa . "'
and (p1.qtd_pecas_solic - p1.qtd_pecas_cancel) > 0
and p1.QTD_PECAS_ROMANEIO > 0
and p1.num_pedido in
(select p2.num_pedido
from ped_itens p2
where p2.COD_EMPRESA = p1.COD_EMPRESA
and (p2.qtd_pecas_solic - p2.qtd_pecas_cancel) > 0
and (p2.qtd_pecas_solic - p2.qtd_pecas_cancel) - p2.qtd_pecas_atend > 0) ";

    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }

    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetch(PDO::FETCH_BOTH);

    return $dados['TOTAL'];
}

function getPedidosAtrasados() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $DataInicial = date('Y') . "-" . date('m') . "-01";
    $DataFinal = date('Y-m-d');
    $CodEmpresa = "01";

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);
    $sysdate = new DataPortal(date('Y-m-d'));

    $Query = "
select COUNT(DISTINCT(P.num_pedido)) Pedidos_Prazo_entrega_Atraso
from ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
AND P.DAT_PEDIDO >= {$DataInicial->getDate()}
and p.DAT_PEDIDO <= {$DataFinal->getDate()})
where p1.COD_EMPRESA = '" . $CodEmpresa . "'
and (p1.qtd_pecas_solic - p1.qtd_pecas_cancel) > 0
and (p1.qtd_pecas_solic - p1.qtd_pecas_cancel) - p1.qtd_pecas_atend > 0
AND {$sysdate->getDate()} > p1.prz_entrega ";
    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }
    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetch(PDO::FETCH_BOTH);

    return $dados[0];
}

function GetValoresResumoFaturamento() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $CodEmpresa = "01";

    $now = array(
        'day' => date('d'),
        'month' => date('m'),
        'year' => date('Y')
    );
    $DataInicial = $now['year'] . "-01-01";

    $end['month'] = date('m');
    if ((int) $end['month'] == 1) {
        $end['month'] = '12';
    } else {
        $end['month'] = '0' . ((int) $end['month'] - 1);
    }
    $end['year'] = date('Y');
    $QtdDiasNoMes = cal_days_in_month(CAL_GREGORIAN, $end['month'], $end['year']);
    if ($QtdDiasNoMes <= 9) {
        $end['day'] = '0' . $QtdDiasNoMes;
    } else {
        $end['day'] = $QtdDiasNoMes;
    }
    $DataFinal = $end['year'] . "-" . $end['month'] . "-" . $end['day'];

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "SELECT MONTH(P.dat_pedido) as MES, YEAR(P.dat_pedido),
 sum(((p1.qtd_pecas_solic - p1.qtd_pecas_cancel) * p1.PRE_UNIT)* ((100-p1.PCT_DESC_ADIC)/100) ) AS VALOR_PEDIDO
FROM ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
AND P.DAT_PEDIDO >= {$DataInicial->getDate()}
AND P.DAT_PEDIDO <= {$DataFinal->getDate()})
WHERE p1.COD_EMPRESA = '" . $CodEmpresa . "' ";
    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }
    $Query .= "AND (p1.qtd_pecas_solic - p1.qtd_pecas_cancel)> 0
GROUP BY P.dat_pedido
ORDER BY YEAR(P.DAT_PEDIDO) ASC
, MONTH(P.DAT_PEDIDO) ASC";


    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetchAll(PDO::FETCH_ASSOC);

    foreach ($dados as $linha) {
        $indicador[$linha['MES']] += $linha['VALOR_PEDIDO'];
    }


    $indicadores = "";
    foreach ($indicador as $numero) {
        if ($indicadores == null || $indicadores == "") {
            $indicadores = $numero;
        } else {
            $indicadores .= ", " . $numero;
        }
    }

    return $indicadores;
}

function GetValoresResumoFaturamentoMesAtual() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $CodEmpresa = "01";

    $now = array(
        'day' => date('d'),
        'month' => date('m'),
        'year' => date('Y')
    );

    $DataInicial = $now['year'] . "-" . $now['month'] . "-01";

    //Monta o formato de data com máximo de days daquele month
    $QuantidadeDiasNoMes = cal_days_in_month(CAL_GREGORIAN, $now['month'], $now['year']);
    $now['month'] = (int) $now['month'] == 1 ? '12' : '0' . (int) $now['month'] - 1;
    if ($now['month'] == '12') {
        $now['year'] = (int) $now['year'] - 1;
    }
    $DataFinal = $now['year'] . "-" . $now['month'] . "-" . $QuantidadeDiasNoMes;

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "SELECT MONTH(P.dat_pedido), YEAR(P.dat_pedido),
 sum(((p1.qtd_pecas_solic - p1.qtd_pecas_cancel)* p1.PRE_UNIT) * ((100-p1.PCT_DESC_ADIC)/100) ) AS valor_pedido
FROM ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
AND P.DAT_PEDIDO >= {$DataInicial->getDate()}
AND P.DAT_PEDIDO <= {$DataFinal->getDate()})
WHERE p1.COD_EMPRESA = '" . $CodEmpresa . "' ";
    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }
    $Query .= " AND (p1.qtd_pecas_solic - p1.qtd_pecas_cancel)> 0
GROUP BY P.dat_pedido
ORDER BY YEAR(P.DAT_PEDIDO) ASC
, MONTH(P.DAT_PEDIDO) ASC ";


    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $result = $retorno->fetch(PDO::FETCH_BOTH);


    return $result[0];
}

function GetValoresResumoFaturamentoDesteAno() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $CodEmpresa = "01";
    $DataInicial = date('Y') . "-01-01";

    $QuantidadeDias = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
    $DataFinal = date('Y') . "-" . date('m') . "-" . $QuantidadeDias;

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "SELECT MONTH(P.dat_pedido), YEAR(P.dat_pedido),
 sum(((p1.qtd_pecas_solic - p1.qtd_pecas_cancel)* p1.PRE_UNIT) * ((100-p1.PCT_DESC_ADIC)/100) ) AS valor_pedido
FROM ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
AND P.DAT_PEDIDO >= {$DataInicial->getDate()}
AND P.DAT_PEDIDO <= {$DataFinal->getDate()})
WHERE p1.COD_EMPRESA = '" . $CodEmpresa . "' ";
    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }
    $Query .= " AND (p1.qtd_pecas_solic - p1.qtd_pecas_cancel)> 0
GROUP BY P.dat_pedido
ORDER BY YEAR(P.DAT_PEDIDO) ASC
, MONTH(P.DAT_PEDIDO) ASC ";

    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetchAll(PDO::FETCH_ASSOC);

    $indicadores = "";
    foreach ($dados as $row) {

        $explode = explode('.', $row['VALOR_PEDIDO']);
        $valor = $explode[0];

        if ($indicadores == null || $indicadores == "") {
            $indicadores = $valor;
        } else {
            $indicadores .= ", " . $valor;
        }
    }

    return $indicadores;
}

function GetValoresResumoFaturamentoPassado() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $CodEmpresa = "01";
    $DataInicial = (date('Y') - 1) . "-01-01";

    $QuantidadeDias = cal_days_in_month(CAL_GREGORIAN, 12, (date('Y') - 1));
    $DataFinal = (date('Y') - 1) . "-12-" . $QuantidadeDias;

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "SELECT MONTH(P.dat_pedido), YEAR(P.dat_pedido),
 sum(((p1.qtd_pecas_solic - p1.qtd_pecas_cancel)* p1.PRE_UNIT) * ((100-p1.PCT_DESC_ADIC)/100) ) AS valor_pedido
FROM ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
AND P.DAT_PEDIDO >= {$DataInicial->getDate()}
AND P.DAT_PEDIDO <= {$DataFinal->getDate()})
WHERE p1.COD_EMPRESA = '" . $CodEmpresa . "' ";
    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }
    $Query .= " AND (p1.qtd_pecas_solic - p1.qtd_pecas_cancel)> 0
GROUP BY P.dat_pedido
ORDER BY YEAR(P.DAT_PEDIDO) ASC
, MONTH(P.DAT_PEDIDO) ASC ";

    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetchAll(PDO::FETCH_ASSOC);

    $indicadores = "";
    foreach ($dados as $row) {

        $explode = explode('.', $row['VALOR_PEDIDO']);
        $valor = $explode[0];

        if ($indicadores == null || $indicadores == "") {
            $indicadores = $valor;
        } else {
            $indicadores .= ", " . $valor;
        }
    }

    return $indicadores;
}

function GetRecordeFaturamento() {

    $Valores = explode(", ", GetValoresResumoFaturamento());

    $Maior = 0;
    foreach ($Valores as $valor) {
        $Maior = ($valor > $Maior ? $valor : $Maior);
    }

    $Maior = number_format($Maior, 0, '', '.');

    return $Maior;
}

function GetPorcentagemFaturamentoMesAtual() {

    $Atual = GetFaturamentoMesAtual();
    $Atual = str_replace(".", "", $Atual);
    $Recorde = GetRecordeFaturamento();
    $Recorde = str_replace(".", "", $Recorde);
    $resultado = $Atual * 100 / $Recorde;
    $Porcentagem = number_format($resultado, 1);
    if (is_null($Porcentagem) || $Porcentagem == '' || $Porcentagem == 'nan') {
        return 0;
    }

    return $Porcentagem;
}

function GetFaturamentoMesAtual() {

    $Valores = GetValoresResumoFaturamentoMensal();
    $Valores = explode(',', $Valores);

    $Total = array_sum($Valores);
    $Valor = number_format($Total, 0, '', '.');

    return $Valor;
}

function GetFaturamentoAnoAtual() {

    $Valores = GetValoresResumoFaturamentoDesteAno();
    $valores = explode(", ", $Valores);

    $Total = 0;
    foreach ($valores as $Valor) {
        $Total += $Valor;
    }
    $Total = number_format($Total, 0, '', '.');

    return $Total;
}

function GetStringMesAtual($mes) {

    $meses = array(
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Março',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro'
    );

    return $meses[$mes];
}

function GetStringMeses() {
    $meses = array(
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Março',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro'
    );

    $String = "";
    foreach ($meses as $value) {
        if ($String == null || $String == "") {
            $String = "'" . $value . "'";
        } else {
            $String .= ", '" . $value . "'";
        }
    }

    return $String;
}

function GetPorcentagemDiasCorridosNoMesAtual() {

    $Dia = date('d');
    $QuantidadeDiasNoMes = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

    $Porcentagem = $Dia * 100 / $QuantidadeDiasNoMes;
    $Porcentagem = number_format($Porcentagem, 0);

    return $Porcentagem;
}

function GetValoresResumoFaturamentoMensal() {

    include_once '../Controller/Session.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/DAOPerfilUsuario.php.php';
    include_once '../Controller/DAOPerfil.php.php';

    $ObjDAOErp = new DaoErp();
    $ObjUsuario = new Usuario();
    $ObjPerfilUsuario = new PerfilUsuario();
    $ObjPerfil = new Perfil();

    $ObjUsuario = BuscaUsuarioPorID($_SESSION['id']);
    $objPerfilUsuario = buscaPerfilUsuarioPorIdUsuario($ObjUsuario->getID());
    $objPerfil = buscaPerfilPorId($objPerfilUsuario->getIDPerfil());

    $CodEmpresa = "01";

    $now = array(
        'day' => date('d'),
        'month' => date('m'),
        'year' => date('Y')
    );

    //Define a data minima anterior a um year atráz
    $ComecoMes = array(
        'day' => '01',
        'month' => $now['month'],
        'year' => $now['year']
    );
    $DataInicial = $ComecoMes['year'] . "-" . $ComecoMes['month'] . "-" . $ComecoMes['day'];

    //Monta o formato de data com máximo de days daquele month
    $QuantidadeDiasNoMes = cal_days_in_month(CAL_GREGORIAN, $now['month'], $now['year']);
    $DataFinal = $now['year'] . "-" . $now['month'] . "-" . $QuantidadeDiasNoMes;

    $DataInicial = new DataPortal($DataInicial);
    $DataFinal = new DataPortal($DataFinal);

    $Query = "SELECT DAY(P.dat_pedido) AS DIA, MONTH(P.dat_pedido), YEAR(P.dat_pedido),
 sum(((p1.qtd_pecas_solic - p1.qtd_pecas_cancel) * p1.PRE_UNIT)* ((100-p1.PCT_DESC_ADIC)/100) ) AS VALOR_PEDIDO
FROM ped_itens p1
INNER JOIN PEDIDOS P
ON (P.COD_EMPRESA = P1.cod_empresa
AND P.NUM_PEDIDO = p1.NUM_PEDIDO
AND P.IES_SIT_PEDIDO = 'N'
AND P.DAT_PEDIDO >= {$DataInicial->getDate()}
AND P.DAT_PEDIDO <= {$DataFinal->getDate()})
WHERE p1.COD_EMPRESA = '" . $CodEmpresa . "' ";
    if (strtoupper(trim($ObjPerfil->getDescricao())) == "REPRESENTANTE") {
        $Query .= " and P.COD_REPRES = {$ObjUsuario->getRepresentanteERP()}";
    }
    $Query .= "AND (p1.qtd_pecas_solic - p1.qtd_pecas_cancel)> 0
GROUP BY P.dat_pedido
ORDER BY YEAR(P.DAT_PEDIDO) ASC
, MONTH(P.DAT_PEDIDO) ASC";


    $retorno = $ObjDAOErp->ConsultaGenerica($Query);
    $dados = $retorno->fetchAll(PDO::FETCH_ASSOC);

    // Carregamos o array "mes" com todos dias do mes em questão
    $x = 1;
    $mes = array();
    while ($x <= $QuantidadeDiasNoMes) {
        $mes[$x] = 0;
        $x++;
    }

    // passamos os valores para os devidos dias
    foreach ($dados as $linha) {
        $mes[$linha['DIA']] = $linha['VALOR_PEDIDO'];
    }

    // monta-se a matriz de valores para javascript exibir
    $indicadores = "";
    foreach ($mes as $key => $row) {

        $explode = explode('.', $row);
        $valor = $explode[0];

        if ($indicadores == null || $indicadores == "") {
            $indicadores = $valor;
        } else {
            $indicadores .= ", " . $valor;
        }
    }

    return $indicadores;
}

function GetNumeroPedidosAprovacao() {

    include_once '../Model/DAO.Class.php';
    include_once '../Model/Pedido.Class.php';
    include_once '../Model/Pessoa.Class.php';
    include_once '../Model/Base.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';
    include_once '../Controller/Session.php';

    $ObjDAO = new DAO();
    $ObjPedido = new Pedido();
    $ObjPessoa = new Pessoa();
    $ObjBase = new Base();
    $objUsuario = new Usuario();

    $objUsuario = BuscaUsuarioPorID($_SESSION['id']);

    $nivel = BuscaNivelCanalVenda($objUsuario->getRepresentanteERP());

    $sql = "SELECT COUNT(*) FROM " . PEDIDO_TABLENAME . " PED
INNER JOIN " . PESSOA_TABLENAME . " PES on(PES." . PESSOA_COD . " = PED." . PEDIDO_ID_CLIENTE . " OR PES." . PESSOA_ID . " = CAST(PED." . PEDIDO_ID_CLIENTE . " AS BIGINT))
INNER JOIN " . BASE_TABLENAME . " ENT ON (ENT." . BASE_ID . " = PED." . PEDIDO_ID . ")
INNER JOIN cli_canal_venda ccv ON (ccv.cod_cliente=" . PESSOA_COD . " AND ccv.cod_nivel_{$nivel}= {$objUsuario->getRepresentanteERP()})
WHERE PED." . PEDIDO_STATUS . " = 'E' AND PED." . PEDIDO_VERSAO_ATUAL . " = 'S'";

    $Consulta = $ObjDAO->ConsultarCustom($sql);
    $result = $Consulta->fetch(PDO::FETCH_BOTH);

    return $result[0];
}

function GetNumeroPedidosAprovacaoFinanceira() {

    include_once '../Model/DAO.Class.php';
    include_once '../Model/Pedido.Class.php';
    include_once '../Model/Pessoa.Class.php';
    include_once '../Model/Base.Class.php';
    include_once '../Model/Usuario.Class.php';

    $ObjDAO = new DAO();
    $ObjPedido = new Pedido();
    $ObjPessoa = new Pessoa();
    $ObjBase = new Base();
    $ObjUsuario = new Usuario();

    $sql = "SELECT COUNT(*) FROM " . PEDIDO_TABLENAME . " PED
INNER JOIN " . PESSOA_TABLENAME . " PES on(PES." . PESSOA_COD . " = CAST(PED." . PEDIDO_ID_CLIENTE . " AS BIGINT))
INNER JOIN " . BASE_TABLENAME . " ENT ON (ENT." . BASE_ID . " = PED." . PEDIDO_ID . ")
INNER JOIN " . USUARIO_TABLENAME . " USU ON (USU." . USUARIO_ID . " = PED." . PEDIDO_ID_REPRESENTANTE . ")
WHERE PED." . PEDIDO_STATUS . " = 'B' AND PED." . PEDIDO_VERSAO_ATUAL . " = 'S'";

    $Consulta = $ObjDAO->ConsultarCustom($sql);
    $result = $Consulta->fetch(PDO::FETCH_BOTH);

    return $result[0];
}

function GetNumeroClientesAprovacao() {

    include_once '../Model/DAO.Class.php';
    include_once '../Model/Pessoa.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/Base.Class.php';

    $ObjDAO = new DAO();
    $ObjPessoa = new Pessoa();
    $ObjUsuario = new Usuario();
    $ObjBase = new Base();

    $sql = "SELECT COUNT(*) FROM " . PESSOA_TABLENAME . " PES
INNER JOIN " . BASE_TABLENAME . " ENT ON (ENT." . BASE_ID . " = PES." . PESSOA_ID . ")
WHERE PES." . PESSOA_STATUS . " = 'E'";

    $Consulta = $ObjDAO->ConsultarCustom($sql);
    $result = $Consulta->fetch(PDO::FETCH_BOTH);

    return $result[0];
}
