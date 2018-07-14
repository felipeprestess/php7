<?php

function CadastraPadroesModuloPorTipo($ValoresPost) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PadraoModulo.Class.php';
    include_once '../Controller/Base.php';

    $ObjPadraoModulo = new PadraoModulo();
    $ObjDao = new DAO();


    $padraoModulo = array();


    $ListaPadroesModulo = BuscaPadroesPorTipo('C');


    foreach ($ListaPadroesModulo as $chave_do_indice => $valor_do_indice) {
        if ($valor_do_indice[PADRAOMODULO_TIPO_CAMPO] == "checkbox") {
            if (isset($ValoresPost[$valor_do_indice[PADRAOMODULO_ID]])) {
                $padraoModulo[PADRAOMODULO_VALOR] = 1;
            } else {
                $padraoModulo[PADRAOMODULO_VALOR] = 0;
            }
        } else {
            $padraoModulo[PADRAOMODULO_VALOR] = $ValoresPost[$valor_do_indice[PADRAOMODULO_ID]];
        }

        $id = $ObjDao->Atualizar(PADRAOMODULO_TABLENAME, $padraoModulo, WHERE . PADRAOMODULO_ID . IGUAL . $valor_do_indice[PADRAOMODULO_ID]);
    }







    return $id;
}

function CadastraPadroesModulo($ValoresPost) {
    include_once './Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PadraoModulo.Class.php';
    include_once '../Controller/Base.php';

    $ObjPadraoModulo = new PadraoModulo();
    $ObjDao = new DAO();


    $padraoModulo = array();


    $ListaPadroesModulo = BuscaPadroesPorModulo($ValoresPost[PADRAOMODULO_PAI_ID]);


    foreach ($ListaPadroesModulo as $chave_do_indice => $valor_do_indice) {
        if ($valor_do_indice[PADRAOMODULO_TIPO_CAMPO] == "checkbox") {
            if (isset($ValoresPost[$valor_do_indice[PADRAOMODULO_ID]])) {
                $padraoModulo[PADRAOMODULO_VALOR] = 1;
            } else {
                $padraoModulo[PADRAOMODULO_VALOR] = 0;
            }
        } else {
            $padraoModulo[PADRAOMODULO_VALOR] = $ValoresPost[$valor_do_indice[PADRAOMODULO_ID]];
        }

        $id = $ObjDao->Atualizar(PADRAOMODULO_TABLENAME, $padraoModulo, WHERE . PADRAOMODULO_ID . IGUAL . $valor_do_indice[PADRAOMODULO_ID]);
    }







    return $id;
}

function BuscaPadroesPorID($IDPadrao) {
    include_once '../Model/PadraoModulo.Class.php';
    include_once '../Model/DAO.Class.php';

    $ObjPadroesModulo = new PadraoModulo();
    $ObjDaoPadroesmodulo = new DAO();

    $ResultadoBusca = $ObjDaoPadroesmodulo->ConsultarInnerEntidadePadrao(PADRAOMODULO_TABLENAME, PADRAOMODULO_ID, PADRAOMODULO_TIPO, PADRAOMODULO_PAI_ID, PADRAOMODULO_PARAMETRO, PADRAOMODULO_VALOR, PADRAOMODULO_TIPO_CAMPO, PADRAOMODULO_BLOQUEADO, PADRAOMODULO_LIXEIRA, " WHERE  PADRAOMODULO_ID = " . $IDPadrao, PADRAOMODULO_ID);

    $ObjPadroesModulo->setId($ResultadoBusca[0][PADRAOMODULO_ID]);
    $ObjPadroesModulo->setPai_id($ResultadoBusca[0][PADRAOMODULO_PAI_ID]);
    $ObjPadroesModulo->setBloqueado($ResultadoBusca[0][PADRAOMODULO_BLOQUEADO]);
    $ObjPadroesModulo->setParametro($ResultadoBusca[0][PADRAOMODULO_PARAMETRO]);
    $ObjPadroesModulo->setTipo($ResultadoBusca[0][PADRAOMODULO_TIPO]);
    $ObjPadroesModulo->setTipo_campo($ResultadoBusca[0][PADRAOMODULO_TIPO_CAMPO]);
    $ObjPadroesModulo->setValor($ResultadoBusca[0][PADRAOMODULO_VALOR]);


    return $ObjPadroesModulo;
}

function BuscaPadroesPorModulo($IDPadrao, $tipo = 'P') {
    include_once '../Model/PadraoModulo.Class.php';
    include_once '../Model/DAO.Class.php';

    $ObjPadroesModulo = new PadraoModulo();
    $ObjDaoPadroesmodulo = new DAO();

    $ResultadoBusca = $ObjDaoPadroesmodulo->Consultar(PADRAOMODULO_TABLENAME, "*", " WHERE " . PADRAOMODULO_PAI_ID . "= " . $IDPadrao . E . PADRAOMODULO_TIPO . IGUAL . "'" . $tipo . "'".ORDER.PADRAOMODULO_TIPO_CAMPO);




    return $ResultadoBusca;
}

function BuscaPadroesPorTipo($tipo) {
    include_once '../Model/PadraoModulo.Class.php';
    include_once '../Model/DAO.Class.php';

    $ObjPadroesModulo = new PadraoModulo();
    $ObjDaoPadroesmodulo = new DAO();

    $ResultadoBusca = $ObjDaoPadroesmodulo->Consultar(PADRAOMODULO_TABLENAME, "*", " WHERE " . PADRAOMODULO_TIPO . IGUAL . "'" . $tipo . "'");




    return $ResultadoBusca;
}

function buscaPadraoPorNome($nome) {
    include_once '../Model/PadraoModulo.Class.php';
    include_once '../Model/DAO.Class.php';

    $ObjPadroesModulo = new PadraoModulo();
    $ObjDaoPadroesmodulo = new DAO();

    $ResultadoBusca = $ObjDaoPadroesmodulo->Consultar(PADRAOMODULO_TABLENAME, "*", " WHERE " . PADRAOMODULO_PARAMETRO . "= '" . $nome . "'");

    $ObjPadroesModulo->setId($ResultadoBusca[0][PADRAOMODULO_ID]);
    $ObjPadroesModulo->setPai_id($ResultadoBusca[0][PADRAOMODULO_PAI_ID]);
    $ObjPadroesModulo->setBloqueado($ResultadoBusca[0][PADRAOMODULO_BLOQUEADO]);
    $ObjPadroesModulo->setParametro($ResultadoBusca[0][PADRAOMODULO_PARAMETRO]);
    $ObjPadroesModulo->setTipo($ResultadoBusca[0][PADRAOMODULO_TIPO]);
    $ObjPadroesModulo->setTipo_campo($ResultadoBusca[0][PADRAOMODULO_TIPO_CAMPO]);
    $ObjPadroesModulo->setValor($ResultadoBusca[0][PADRAOMODULO_VALOR]);

    return $ObjPadroesModulo;
}

/**
 * 
 * @param type $nome
 * @return string
 */
function buscaValorPadraoPorNome($nome) {
    include_once '../Model/DAO.Class.php';
    require_once '../Model/PadraoModulo.Class.php';

    $ObjPadroesModulo = new PadraoModulo();
    $ObjDaoPadroesmodulo = new DAO();

    $ResultadoBusca = $ObjDaoPadroesmodulo->Consultar(PADRAOMODULO_TABLENAME, "*", " WHERE " . PADRAOMODULO_PARAMETRO . "= '" . $nome . "'");

    return $ResultadoBusca[0][PADRAOMODULO_VALOR];
}
