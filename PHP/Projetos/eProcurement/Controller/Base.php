<?php

function CadastraEntidade($Descricao, $dados = null, $observacao = '', $idProprietario = '', $representante = null, $bloqueado = 0, $versao = 1) {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Base.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Controller/DAOUsuario.php';


    $objDao = new DAO();
    $objUsuario = new Usuario();

    $objUsuario = BuscaUsuarioPorID($_SESSION['id']);

    $data = array();

    if ($idProprietario == "" && is_null($idProprietario)) {
        $idProprietario = $_SESSION['id'];
    }
    $resultadoInsert = $objDao->ConsultarCustom("SELECT MAX(" . BASE_ID . ") FROM " . BASE_TABLENAME, 0, 1000000000000000);
    $resultadoInsert = $resultadoInsert->fetch(PDO::FETCH_BOTH);
    $ultimoID = $resultadoInsert[0] + 1;
    $data[BASE_ID] = $ultimoID;
    $data[BASE_CRIADOR_ID] = $_SESSION['id'];
    $data[BASE_PROPRIETARIO_ID] = $idProprietario;
    $data[BASE_REPRESENTANTE] = $representante;
    $data[BASE_MODIFICADO_POR] = $_SESSION['id'];
    $data[BASE_CREATEDTIME] = date("Y-m-d") . " " . date("H:i:s");
    $data[BASE_MODIFIEDTIME] = date("Y-m-d") . " " . date("H:i:s");
    $data[BASE_STATUS] = "NE";
    $data[BASE_VERSAO] = $versao;
    $data[BASE_DESCRICAO] = $Descricao;
    $data[BASE_OBSERVACAO] = $observacao;
    $data[BASE_BLOQUEADO] = $bloqueado;

    try {
        $table = BASE_TABLENAME; //podemos passar um prefixo pr� estabelecido
        $data = $objDao->Escapar($data);
//Pegamos apenas os nomes chaves do array e colocamos dentro de uma variavel # $var = "key1, key2, key3";
        $fields = implode(', ', array_keys($data));
//Pegamos o conteudo do array e colocamos dentro de uma variavel # $var = "dados1, dados2, dados3";
//$values = "'" . implode("', '", $data) . "'";
        foreach ($data as $value) {
            if ($contador == 0) {
                $separador = " ";
            } else {
                $separador = ", ";
            }
            if (substr_count(strtoupper($value), "SELECT") > 0 ||
                    substr_count(strtoupper($value), "TO_DATE") > 0 ||
                    substr_count(strtoupper($value), "DATETIME") > 0 ||
                    substr_count(strtoupper($value), "GETDATE") > 0 ||
                    substr_count(strtoupper($value), "SYSDATE") > 0) {
                $values = $values . $separador . $value . "";
            } else {
                $values = $values . $separador . "'" . $value . "'";
            }
            $contador++;
        }
        $sql = "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";


        $query = $objDao->Conectar()->prepare($sql);
        $query->execute();
    } catch (PDOException $e) {
        sleep(2);
        $resultadoInsert = $objDao->ConsultarCustom("SELECT MAX(" . BASE_ID . ") FROM " . BASE_TABLENAME, 0, 100000000000000000000);
        $resultadoInsert = $resultadoInsert->fetch(PDO::FETCH_BOTH);
        $ultimoID = $resultadoInsert[0] + 1;
        $data[BASE_ID] = $ultimoID;
        $id = $objDao->Inserir(BASE_TABLENAME, $data);
    }


    if ($versao == 1) {
        $acao = "INSERIR";
    } else {
        $acao = "ATUALIZAR";
    }

    return $ultimoID;
}

function CadastraTemporaria($tela, $idPessoa) {
    include_once '../Model/DAO.Class.php';

    $objDao = new DAO();
    $ControlaEfetivar = array();

    $ControlaEfetivar['CAC_TELA'] = $tela;
    $ControlaEfetivar['CAC_PES_ID'] = $idPessoa;

    try {
        $objDao->Inserir($objDao->getSchema() . "PTV_CONT_ALTE_CLI_CAC", $ControlaEfetivar);
    } catch (PDOException $e) {
        sleep(2);
        $objDao->Inserir($objDao->getSchema() . "PTV_CONT_ALTE_CLI_CAC", $ControlaEfetivar);
    }
}

function CadastraEntidadeItem($Descricao, $dados = null, $versao = 1, $observacao = '', $idProprietario = '') {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Base.Class.php';

    $objDao = new DAO();

    $objUsuario = BuscaUsuarioPorID($_SESSION['id']);

    $data = array();

    if ($idProprietario == "" && is_null($idProprietario)) {
        $idProprietario = $_SESSION['id'];
    }

    $resultadoInsert = $objDao->ConsultarCustom("SELECT MAX(" . BASE_ID . ") FROM " . BASE_TABLENAME, 0, 100000000000000000000000000000000000000);
    $resultadoInsert = $resultadoInsert->fetch(PDO::FETCH_BOTH);
    $ultimoID = $resultadoInsert[0] + 1;

    $data[BASE_ID] = $ultimoID;
    $data[BASE_CRIADOR_ID] = $_SESSION['id'];
    $data[BASE_PROPRIETARIO_ID] = $idProprietario;
    $data[BASE_MODIFICADO_POR] = $_SESSION['id'];
    $data[BASE_CREATEDTIME] = date("Y-m-d") . " " . date("H:i:s");
    $data[BASE_MODIFIEDTIME] = date("Y-m-d") . " " . date("H:i:s");
    $data[BASE_STATUS] = "NE";
    $data[BASE_VERSAO] = $versao;
    $data[BASE_DESCRICAO] = $Descricao;
    $data[BASE_OBSERVACAO] = $observacao;

    try {
        $id = $objDao->Inserir(BASE_TABLENAME, $data);
    } catch (PDOException $e) {
        sleep(2);
        $resultadoInsert = $objDao->ConsultarCustom("SELECT MAX(" . BASE_ID . ") FROM " . BASE_TABLENAME, 0, 100000000000000000000000000000000000000);
        $resultadoInsert = $resultadoInsert->fetch(PDO::FETCH_BOTH);
        $ultimoID = $resultadoInsert[0] + 1;
        $data[BASE_ID] = $ultimoID;
        $id = $objDao->Inserir(BASE_TABLENAME, $data);
    }

    
    return $ultimoID;
}

function updateEntidade($idBase, $observacao, $idProprietario, $dados = null, $dadosAntigo = null, $representante = null, $bloqueado = 0) {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Base.Class.php';
    include_once '../Model/Auditoria.Class.php';

    $objDao = new DAO();
    $objBase = new Base();
    $objAuditoria = new Auditoria();
    $objBase = buscaBasePorId($idBase);

    $data = array();

    if ($idProprietario == "" && is_null($idProprietario)) {

        $idProprietario = $_SESSION['id'];
    }

    if ($_SESSION['idRegistroPai'] != "" && !is_null($_SESSION['idRegistroPai'])) {
        $max = $objDao->ConsultarCustom("SELECT MAX(" . AUDITORIA_VERSAO . ") FROM " . AUDITORIA_TABLENAME . WHERE . AUDITORIA_ID_REGISTRO . IGUAL . $_SESSION['idRegistroPai']);
        $max = $max->fetch(PDO::FETCH_BOTH);
        $max = $max[0];
        if (is_null($max) || $max == "") {
            $max = 0;
        }

        $versao = $max + 1;
    } else {
        $versao = 1;
    }


    $data[BASE_PROPRIETARIO_ID] = $idProprietario;
    $data[BASE_REPRESENTANTE] = $representante;
    $data[BASE_MODIFICADO_POR] = $_SESSION['id'];
    $data[BASE_STATUS] = "NE";
    $data[BASE_VERSAO] = $versao;
    $data[BASE_OBSERVACAO] = $observacao;
    $data[BASE_MODIFIEDTIME] = date("Y-m-d") . " " . date("H:i:s");
    $data[BASE_BLOQUEADO] = $bloqueado;

    $id = $objDao->Atualizar(BASE_TABLENAME, $data, WHERE . BASE_ID . IGUAL . $idBase);

    return $id;
}

function buscaBasePorId($idBase) {
    include_once '../Controller/Session.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Base.Class.php';

    $objBase = new Base();
    $objDao = new DAO();

    $base = $objDao->Consultar(BASE_TABLENAME, "*", WHERE . BASE_ID . IGUAL . $idBase);

    $objBase->setCreatedtime($base[0][BASE_CREATEDTIME]);
    $objBase->setCriadorId($base[0][BASE_CRIADOR_ID]);
    $objBase->setDescricao($base[0][BASE_DESCRICAO]);
    $objBase->setId($base[0][BASE_ID]);
    $objBase->setLixeira($base[0][BASE_LIXEIRA]);
    $objBase->setModificadoPor($base[0][BASE_MODIFICADO_POR]);
    $objBase->setModifiedtime($base[0][BASE_MODIFIEDTIME]);
    $objBase->setObservacao($base[0][BASE_OBSERVACAO]);
    $objBase->setProprietarioId($base[0][BASE_PROPRIETARIO_ID]);
    $objBase->setStatusPai($base[0][BASE_STATUS]);
    $objBase->setVersao($base[0][BASE_VERSAO]);

    return $objBase;
}

