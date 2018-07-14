<?php

function CadastraOrdemHistorico($ValoresPost) {
    include_once '../Controller/Session.php';
    include_once '../Controller/Base.php';
    include_once '../Model/DAO.Class.php';

    $ObjDao = new DAO();

    $ordemHistorico = array();

    $ordemHistorico['ODH_ID_FORNECEDOR'] = $ValoresPost['ODH_ID_FORNECEDOR'];
    $ordemHistorico['ODH_ID_EMPRESA'] = $ValoresPost['ODH_ID_EMPRESA'];
    $ordemHistorico['ODH_NUM_ORDEM'] = $ValoresPost['ODH_NUM_ORDEM'];
    $ordemHistorico['ODH_ACAO'] = $ValoresPost['ODH_ACAO'];
    $ordemHistorico['ODH_DATA'] = $ValoresPost['ODH_DATA'];
    $ordemHistorico['ODH_OBSERVACAO'] = $ValoresPost['ODH_OBSERVACAO'];

    $BaseId = CadastraEntidade("Cadastro de ordem historico " . $ordemHistorico['ODH_NUM_ORDEM']);
    $ordemHistorico["ODH_ID"] = $BaseId;

    $id = $ObjDao->Inserir("PTC_ORDEM_HISTORICO_ODH", $ordemHistorico);

    return $id;
}
