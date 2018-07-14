<?php

spl_autoload_register(function ($class_name) {
    include "../../Model/" . $class_name . '.Class.php';
    include "../../Controller/DAO" . $class_name . '.php';
});
$_SESSION['id'] = 118;

include_once '../../Model/DAO.Class.php';
include_once '../../Model/DaoErp.Class.php';
include_once '../../Controller/Base.php';
include_once '../../Controller/DAOUsuario.php';
include_once '../../Model/Pais.Class.php';

$objDao = new DAO();
$objDaoErp = new DaoErp();


##   PAREANDO PAIS   ##
$objPais = new Pais();

$Resultado = $objDaoErp->ConsultaGenerica("select  cod_pais, den_pais  from paises where cod_pais not in (select PAI_CODIGO from {$objPais->getSchema()}PTV_PAIS_PAI)");
$array = array();
while ($row = $Resultado->fetch(PDO::FETCH_BOTH)) {
    $BaseId = CadastraEntidade("Cadastro pais: " . $row[1]);
    $array[PAIS_ID] = $BaseId;
    $array[PAIS_CODIGO] = $row[0];
    $array[PAIS_DESCRICAO] = $row[1];
    $objDao->Inserir(PAIS_TABLENAME, $array);
}

## FIM PAREANDO PAIS ##
##   PAREANDO ESTADO   ##

include_once '../../Model/Estado.Class.php';
include_once '../../Controller/DAOEstado.php';

$objEstado = new Estado();

$Resultado = $objDaoErp->ConsultaGenerica("select cod_uni_feder, den_uni_feder, cod_pais from uni_feder WHERE cod_uni_feder not in (select " . ESTADO_CODIGO_UF . " FROM " . ESTADO_TABLENAME . " WHERE " . ESTADO_CODIGO_UF . "=cod_uni_feder)");
$array = array();
while ($row = $Resultado->fetch(PDO::FETCH_BOTH)) {

    $objPais = BuscaPaisPorCod($row['COD_PAIS']);
    $BaseId = CadastraEntidade("Cadastro pais: " . $row[1]);
    $array[ESTADO_ID] = $BaseId;
    $array[ESTADO_CODIGO_UF] = $row[0];
    $array[ESTADO_NOME] = $row[1];
    $array[ESTADO_SIGLA] = $row[0];
    $array[ESTADO_PAIS_ID] = $objPais->getID();
    $objDao->Inserir(ESTADO_TABLENAME, $array);
}

## FIM PAREANDO ESTADO ##
##   PAREANDO CIDADE   ##

include_once '../../Model/Cidade.Class.php';

$objCidade = new Cidade();

$Resultado = $objDaoErp->ConsultaGenerica("select cod_cidade,den_cidade,cod_uni_feder from cidades where cod_cidade not in (select CID_CODIGO from " . $objCidade->getSchema() . "ptv_cidade_cid where CID_CODIGO = cod_cidade )");
$array = array();

while ($row = $Resultado->fetch(PDO::FETCH_BOTH)) {
    $row[1] = str_replace("'", "", $row[1]);
    $objEstado = BuscaEstadoPorCod($row[2]);
    $BaseId = CadastraEntidade("Cadastro cid:" . $row[1]);
    $array[CIDADE_ID] = $BaseId;
    $array[CIDADE_ID_ESTADO] = $objEstado->getID();
    $array[CIDADE_NOME] = $row[1];
    $array[CIDADE_CODIGO] = $row[0];
    $objDao->Inserir(CIDADE_TABLENAME, $array);
}
## FIM PAREANDO CIDADE ##
##   PAREANDO NATUREZA OPERACAO   ##
include_once '../../Model/Operacoes.Class.php';

$objOperacoes = new Operacoes();

$sql = "select distinct natureza_operacao as Codigo_ERP, nat_operacao.den_nat_oper as Denominacao_ERP 
from fat_nf_mestre
inner join nat_operacao
on nat_operacao.cod_nat_oper = fat_nf_mestre. natureza_operacao
where natureza_operacao not in (select OPC_COD_ERP from {$objOperacoes->getSchema()}PTV_OPERACOES_OPC where OPC_COD_ERP = natureza_operacao)";

$Resultado = $objDaoErp->ConsultaGenericaTeste($sql);

$array = array();
while ($row = $Resultado->fetch(PDO::FETCH_BOTH)) {
    $objDao = new DAO();
    $BaseId = CadastraEntidade("Cadastro tipo venda : " . $row[1]);
    $array[OPERACOES_ID] = $BaseId;
    $array[OPERACOES_DESCRICAO] = $row[1];
    $array[OPERACOES_COD_ERP] = $row[0];
    $objDao->Inserir(OPERACOES_TABLENAME, $array);
}


## FIM PAREANDO NATUREZA OPERACAO ##
##   PAREANDO A CONDICAO DE PAGAMENTO   ##

include_once '../../Model/CondicaoPagamento.Class.php';

$objCondicaoPagamento = new CondicaoPagamento();


$Resultado = $objDaoErp->ConsultaGenerica("select distinct cod_cnd_pgto, den_cnd_pgto FROM cond_pgto WHERE COD_CND_PGTO NOT IN (SELECT " . CONDICAO_PAGAMENTO_COD_ERP . " FROM " . CONDICAO_PAGAMENTO_TABLENAME . " WHERE " . CONDICAO_PAGAMENTO_COD_ERP . " = COD_CND_PGTO)");


$array = array();
while ($row = $Resultado->fetch(PDO::FETCH_BOTH)) {
    $objCondicaoPagamento = buscaCondicaoPagamentoPorCodErp($row[0]);
    if ($objCondicaoPagamento->getId() == "" || is_null($objCondicaoPagamento->getId())) {
        $objDao = new DAO();
        $BaseId = CadastraEntidade("Cadastro condicao pagamento cod: " . $row[0]);
        $array[CONDICAO_PAGAMENTO_ID] = $BaseId;
        $array[CONDICAO_PAGAMENTO_NOME] = $row[1];
        $array[CONDICAO_PAGAMENTO_COD_ERP] = $row[0];

        $objDao->Inserir(CONDICAO_PAGAMENTO_TABLENAME, $array);
    }
}

## FIM PAREANDO A CONDICAO DE PAGAMENTO ##