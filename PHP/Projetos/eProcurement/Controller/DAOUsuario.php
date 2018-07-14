<?PHP

// Busca usuario por nome de Usuario apra login ntegrado CRM
function BuscaUsuarioPorUsuario($Usuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    $ObjDaoUsuario = new DAO();
    $ObjUsuario = new Usuario();
    $Consulta = $ObjDaoUsuario->Consultar(USUARIO_TABLENAME, USUARIO_NOME, " WHERE " . USUARIO_NOME . " = '{$Usuario}'");
    return $Consulta[USUARIO_NOME];
}

function BuscaUsuarioPorLogin($usuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';

    $ObjDaoUsuario = new DAO();
    $ObjUsuario = new Usuario();
    $Consulta = $ObjDaoUsuario->ConsultarInnerEntidadePadrao(USUARIO_TABLENAME, "*", WHERE . USUARIO_USUARIO . " LIKE '%{$usuario}%'", USUARIO_ID);

    $ObjUsuario->alimentaObjUsuario($Consulta);

    return $ObjUsuario;
}

function ListaTodosRepresentantesERPCanalVendaNivel($nivel, $cod = null) {
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objDao = new DaoErp();
    $objUsuario = new Usuario();

    if ($cod != null) {
        $filtroCodigo = " AND cod_repres ={$cod} ";
    } else {
        $filtroCodigo = " ";
    }

    $Lista = $objDao->ConsultaGenerica(" SELECT DISTINCT COD_REPRES, RAZ_SOCIAL FROM CLI_CANAL_VENDA CCV WITH (NOLOCK) 
             INNER JOIN REPRESENTANTE WITH (NOLOCK) ON(COD_REPRES = COD_NIVEL_7 OR COD_REPRES = COD_NIVEL_6 OR COD_REPRES = COD_NIVEL_5 OR COD_REPRES = COD_NIVEL_4 OR COD_REPRES = COD_NIVEL_3 OR COD_REPRES = COD_NIVEL_2 OR COD_REPRES = COD_NIVEL_1) 
                         INNER JOIN " . USUARIO_TABLENAME . " ON ( " . USUARIO_REPRESENTANTE_ERP . "  = COD_REPRES) 
WHERE ((COD_NIVEL_{$nivel} = {$cod})) ORDER BY COD_REPRES  
");

    return $Lista;
}

function ListaTodosRepresentantesERPCanalVendaNivelComInfoUsuario($nivel, $cod = null) {
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objDao = new DaoErp();
    $objUsuario = new Usuario();

    if ($cod != null) {
        $filtroCodigo = " AND cod_repres ={$cod} ";
    } else {
        $filtroCodigo = " ";
    }

    $Lista = $objDao->ConsultaGenerica(" SELECT DISTINCT COD_REPRES, RAZ_SOCIAL, " . USUARIO_ID . ", " . USUARIO_NOME . " FROM CLI_CANAL_VENDA CCV WITH (NOLOCK) 
             INNER JOIN REPRESENTANTE WITH (NOLOCK) ON(COD_REPRES = COD_NIVEL_7 OR COD_REPRES = COD_NIVEL_6 OR COD_REPRES = COD_NIVEL_5 OR COD_REPRES = COD_NIVEL_4 OR COD_REPRES = COD_NIVEL_3 OR COD_REPRES = COD_NIVEL_2 OR COD_REPRES = COD_NIVEL_1) 
                         INNER JOIN " . USUARIO_TABLENAME . " ON ( " . USUARIO_REPRESENTANTE_ERP . "  = COD_REPRES) 
WHERE ((COD_NIVEL_{$nivel} = {$cod})) ORDER BY COD_REPRES  
");

    return $Lista;
}

function BuscaCanalVendaRepresentantePorRepresentante($repre) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DaoErp.Class.php';

    $objDaoErp = new DaoErp();
    $objDao = new DAO();

    function BuscaNomeRepresentante($cod) {
        include_once '../Model/DaoErp.Class.php';

        $objDaoErp = new DaoErp();
        $representante = $objDaoErp->BuscaRepresentantePorCod($cod);
        $representante = $representante->fetchAll(PDO::FETCH_ASSOC);
        if ($representante[0]['raz_social'] != "" && !is_null($representante[0]['raz_social'])) {
            $nome = $representante[0]['raz_social'];
        } else {
            $nome = '';
        }
        return $nome;
    }

    $RepresentanteERP = $repre;

    $Select = $objDaoErp->ConsultaGenerica("SELECT cod_nivel_1, cod_nivel_2, cod_nivel_3, cod_nivel_4, cod_nivel_5, cod_nivel_6, cod_nivel_7 FROM canal_venda WHERE (cod_nivel_1 = " . $RepresentanteERP . " OR cod_nivel_2 = " . $RepresentanteERP . " OR cod_nivel_3 = " . $RepresentanteERP . " OR cod_nivel_4 = " . $RepresentanteERP . " OR cod_nivel_5 = " . $RepresentanteERP . " OR cod_nivel_6 = " . $RepresentanteERP . " OR cod_nivel_7 = " . $RepresentanteERP . ") ORDER BY COD_NIVEL_1 OFFSET 0 ROWS FETCH NEXT 1 ROWS ONLY");
    while ($row = $Select->fetch(PDO::FETCH_BOTH)) {
        if ($row[6] == $RepresentanteERP) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "07";
        } elseif ($row[5] == $RepresentanteERP && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "06";
        } elseif ($row[4] == $RepresentanteERP && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "05";
        } elseif ($row[3] == $RepresentanteERP && $row[4] == 0 && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "04";
        } elseif ($row[2] == $RepresentanteERP && $row[3] == 0 && $row[4] == 0 && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "03";
        } elseif ($row[1] == $RepresentanteERP && $row[2] == 0 && $row[3] == 0 && $row[4] == 0 && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "02";
        } elseif ($row[0] == $RepresentanteERP && $row[1] == 0 && $row[2] == 0 && $row[3] == 0 && $row[4] == 0 && $row[5] == 0 && $row[6] == 0) {
            $NivelUm = $row[0];
            $NivelDois = $row[1];
            $NivelTres = $row[2];
            $NivelQuatro = $row[3];
            $NivelCinco = $row[4];
            $NivelSeis = $row[5];
            $NivelSete = $row[6];
            $Nivel = "01";
        }
    }

    $dados['Nivel_1'] = $NivelUm;
    $dados['Nivel_1_desc'] = BuscaNomeRepresentante($NivelUm);
    $dados['Nivel_2'] = $NivelDois;
    $dados['Nivel_2_desc'] = BuscaNomeRepresentante($NivelDois);
    $dados['Nivel_3'] = $NivelTres;
    $dados['Nivel_3_desc'] = BuscaNomeRepresentante($NivelTres);
    $dados['Nivel_4'] = $NivelQuatro;
    $dados['Nivel_4_desc'] = $NivelQuatro != "0" ? BuscaNomeRepresentante($NivelQuatro) : "";
    $dados['Nivel_5'] = $NivelCinco;
    $dados['Nivel_5_desc'] = $NivelCinco != "0" ? BuscaNomeRepresentante($NivelCinco) : "";
    $dados['Nivel_6'] = $NivelSeis;
    $dados['Nivel_6_desc'] = $NivelSeis != "0" ? BuscaNomeRepresentante($NivelSeis) : "";
    $dados['Nivel_7'] = $NivelSete;
    $dados['Nivel_7_desc'] = $NivelSete != "0" ? BuscaNomeRepresentante($NivelSete) : "";
    $dados['Nivel'] = $Nivel;

    return $dados;
}

function deletarUsuario($Valores) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/Upload.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';
    include_once '../Controller/Base.php';
    include_once '../Controller/DAOPerfilUsuario.php';

    $ObjDaoUsuario = new DAO();
    $ObjUsuario = new Usuario();
    $objPerfilUsuario = new PerfilUsuario();



    $idUsuario = $ObjDaoUsuario->Deletar(USUARIO_TABLENAME, WHERE . USUARIO_ID . IGUAL . $Valores['id']);
    $idPerfilUsuario = $ObjDaoUsuario->Deletar(PERFILUSUARIO_TABLENAME, WHERE . PERFILUSUARIO_USUARIO_ID . IGUAL . $Valores['id']);
    return $idUsuario;
}

function cadastraUsuario($ValoresPost, $ValoresFile) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/Upload.Class.php';
    include_once '../Controller/Base.php';

    $ObjDaoUsuario = new DAO();
    $ObjUsuario = new Usuario();

    $usuario = array();

    $usuario[USUARIO_ID] = $ValoresPost[USUARIO_ID];
    $usuario[USUARIO_NOME] = strtoupper($ValoresPost[USUARIO_NOME]);
    $usuario[USUARIO_USUARIO] = strtoupper($ValoresPost[USUARIO_USUARIO]);
    $usuario[USUARIO_RAMAL] = $ValoresPost[USUARIO_RAMAL];
    $usuario[USUARIO_ERP] = $ValoresPost[USUARIO_ERP];
    $usuario[USUARIO_REPRESENTANTE_ERP] = $ValoresPost[USUARIO_REPRESENTANTE_ERP];
    $usuario[USUARIO_EMAIL] = $ValoresPost[USUARIO_EMAIL];
    $usuario[USUARIO_EMPRESA] = $ValoresPost[USUARIO_EMPRESA];
    $usuario[USUARIO_COR_MENU] = $ValoresPost[USUARIO_COR_MENU];
    $usuario[USUARIO_COR_TEXTO_MENU] = $ValoresPost[USUARIO_COR_TEXTO_MENU];
    $usuario[USUARIO_EMAIL_SECUNDARIO] = $ValoresPost[USUARIO_EMAIL_SECUNDARIO];
    $usuario[USUARIO_TELEFONE] = $ValoresPost[USUARIO_TELEFONE];
    $usuario[USUARIO_CARTEIRA] = $ValoresPost[USUARIO_CARTEIRA];
    $usuario[USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO] = $ValoresPost[USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO];
    $usuario[USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE] = $ValoresPost[USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE];
    $usuario[USUARIO_CODIGO_FORNECEDOR] = $ValoresPost[USUARIO_CODIGO_FORNECEDOR];
    $usuario[USUARIO_CODIGO_COMPRADOR] = $ValoresPost[USUARIO_CODIGO_COMPRADOR];

    if (isset($ValoresPost[USUARIO_RECEBE_NOT_PEDIDO])) {
        $usuario[USUARIO_RECEBE_NOT_PEDIDO] = 1;
    } else {
        $usuario[USUARIO_RECEBE_NOT_PEDIDO] = 0;
    }

    if (isset($ValoresPost[USUARIO_CADASTRA_CONCORRENTE_CLIENTE])) {
        $usuario[USUARIO_CADASTRA_CONCORRENTE_CLIENTE] = 1;
    } else {
        $usuario[USUARIO_CADASTRA_CONCORRENTE_CLIENTE] = 0;
    }

    if (isset($ValoresPost[USUARIO_RECEBE_NOT_CLIENTE])) {
        $usuario[USUARIO_RECEBE_NOT_CLIENTE] = 1;
    } else {
        $usuario[USUARIO_RECEBE_NOT_CLIENTE] = 0;
    }

    if (isset($ValoresPost[USUARIO_LIBERA_PEDIDO_FECHADO])) {
        $usuario[USUARIO_LIBERA_PEDIDO_FECHADO] = 1;
    } else {
        $usuario[USUARIO_LIBERA_PEDIDO_FECHADO] = 0;
    }

    if (isset($ValoresPost[USUARIO_VISUALIZA_HIST_CREDITO])) {
        $usuario[USUARIO_VISUALIZA_HIST_CREDITO] = 1;
    } else {
        $usuario[USUARIO_VISUALIZA_HIST_CREDITO] = 0;
    }

    if (isset($ValoresPost[USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO])) {
        $usuario[USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO] = 1;
    } else {
        $usuario[USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO] = 0;
    }

    if (isset($ValoresPost[USUARIO_RECEBE_EMAIL_ENVIADO])) {
        $usuario[USUARIO_RECEBE_EMAIL_ENVIADO] = 1;
    } else {
        $usuario[USUARIO_RECEBE_EMAIL_ENVIADO] = 0;
    }

    if (isset($ValoresPost[USUARIO_VISUALIZA_CLIENTE_SEM_CANAL])) {
        $usuario[USUARIO_VISUALIZA_CLIENTE_SEM_CANAL] = 1;
    } else {
        $usuario[USUARIO_VISUALIZA_CLIENTE_SEM_CANAL] = 0;
    }
    if (isset($ValoresPost[USUARIO_RESPONDE_SAC])) {
        $usuario[USUARIO_RESPONDE_SAC] = 1;
    } else {
        $usuario[USUARIO_RESPONDE_SAC] = 0;
    }

    if (isset($ValoresPost[USUARIO_CADASTRA_PEDIDO_OUTRO])) {
        $usuario[USUARIO_CADASTRA_PEDIDO_OUTRO] = 1;
    } else {
        $usuario[USUARIO_CADASTRA_PEDIDO_OUTRO] = 0;
    }
    if (isset($ValoresPost[USUARIO_MODIFICA_PEDIDO_ERP])) {
        $usuario[USUARIO_MODIFICA_PEDIDO_ERP] = 1;
    } else {
        $usuario[USUARIO_MODIFICA_PEDIDO_ERP] = 0;
    }
    if (isset($ValoresPost[USUARIO_INTERNO])) {
        $usuario[USUARIO_INTERNO] = 1;
    } else {
        $usuario[USUARIO_INTERNO] = 0;
    }
    if (isset($ValoresPost[USUARIO_MODIFICA_CLIENTE_ERP])) {
        $usuario[USUARIO_MODIFICA_CLIENTE_ERP] = 1;
    } else {
        $usuario[USUARIO_MODIFICA_CLIENTE_ERP] = 0;
    }

    if (isset($ValoresPost[USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE])) {
        $usuario[USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE] = 1;
    } else {
        $usuario[USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE] = 0;
    }

    if (isset($ValoresPost[USUARIO_LIBERA_MODIFICACAO_USUARIO])) {
        $usuario[USUARIO_LIBERA_MODIFICACAO_USUARIO] = 1;
    } else {
        $usuario[USUARIO_LIBERA_MODIFICACAO_USUARIO] = 0;
    }

    if (isset($ValoresFile[USUARIO_IMAGEM]['name']) && $ValoresFile[USUARIO_IMAGEM]['name'] != "" && !is_null($ValoresFile[USUARIO_IMAGEM]['name'])) {
        $objImagemUpload = new Upload($ValoresFile[USUARIO_IMAGEM], 800, 600, "../Public/img/Usuarios/");
        $retorno = $objImagemUpload->salvar();
        if ($retorno != "Erro 4") {
            $usuario[USUARIO_IMAGEM] = $retorno;
        }
    }
    if ($ValoresPost['Acao'] == "Inserir") {
        $BaseId = CadastraEntidade("Cadastro usuario: " . $usuario[USUARIO_NOME]);
        $usuario[USUARIO_ID] = $BaseId;
        $usuario[USUARIO_SENHA] = '';

        $idUsuario = $ObjDaoUsuario->Inserir(USUARIO_TABLENAME, $usuario);
    } else {
        if ($ValoresPost['ZeraSenha'] == 'on') {
            $usuario[USUARIO_SENHA] = '';
        }


        $idUsuario = $ObjDaoUsuario->Atualizar(USUARIO_TABLENAME, $usuario, WHERE . USUARIO_ID . IGUAL . $ValoresPost[USUARIO_ID]);
    }
    return $idUsuario;
}

function BuscaUsuarioPorCodRepresentante($ID) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    $ObjDaoUsuario = new DAO();
    $ObjUsuario = new Usuario();
    $Consulta = $ObjDaoUsuario->ConsultarInnerEntidadePadrao(USUARIO_TABLENAME, '*', WHERE . USUARIO_REPRESENTANTE_ERP . IGUAL . "'" . $ID . "'", USUARIO_ID);

    $ObjUsuario->alimentaObjUsuario($Consulta);

    return $ObjUsuario;
}

function BuscaUsuarioPorCodComprador($codigo) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    $ObjDaoUsuario = new DAO();
    $ObjUsuario = new Usuario();
    $Consulta = $ObjDaoUsuario->ConsultarInnerEntidadePadrao(USUARIO_TABLENAME, '*', WHERE . USUARIO_CODIGO_COMPRADOR . IGUAL . "'" . $codigo . "'", USUARIO_ID);

    $ObjUsuario->alimentaObjUsuario($Consulta);

    return $ObjUsuario;
}
function BuscaUsuarioPorCodFornecedor($codigo) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    $ObjDaoUsuario = new DAO();
    $ObjUsuario = new Usuario();
    $Consulta = $ObjDaoUsuario->ConsultarInnerEntidadePadrao(USUARIO_TABLENAME, '*', WHERE . USUARIO_CODIGO_FORNECEDOR . IGUAL . "'" . $codigo . "'", USUARIO_ID);

    $ObjUsuario->alimentaObjUsuario($Consulta);

    return $ObjUsuario;
}
function BuscaUsuarioPorID($ID) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';

    $ObjDaoUsuario = new DAO();
    $ObjUsuario = new Usuario();
    $Consulta = $ObjDaoUsuario->ConsultarInnerEntidadePadrao(USUARIO_TABLENAME, "*", WHERE . USUARIO_ID . IGUAL . $ID, USUARIO_ID);

    $ObjUsuario->alimentaObjUsuario($Consulta);

    return $ObjUsuario;
}

function buscaPerfilDoUsuarioPorId($IdUsuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';
    $ObjDaoUsuario = new DAO();
    $ObjPerfilDoUsuario = new PerfilUsuario();

    $Consulta = $ObjDaoUsuario->Consultar(PERFILUSUARIO_TABLENAME, "*", WHERE . PERFILUSUARIO_USUARIO_ID . IGUAL . $IdUsuario);
    return $Consulta;
}

function BuscaPermissoesEspecificaUsuarioAcessar($IdUsuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/UsuarioPrograma.Class.php';
    include_once '../Model/Usuario.Class.php';
    $ObjDaoUsuario = new DAO();
    $ObjUsuarioPrograma = new UsuarioPrograma();
    $Resultado = $ObjDaoUsuario->Consultar(USUARIOPROGRAMA_TABLENAME, "*", WHERE . USUARIOPROGRAMA_USUARIO_ID . IGUAL . $IdUsuario);

    return $Resultado;
}

function BuscaPermissoesAcessar($IdPerfil, $idUsuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/UsuarioPrograma.Class.php';
    include_once '../Model/PerfilPrograma.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/Funcionalidades.Class.php';
    include_once '../Model/Programa.Class.php';
    include_once '../Controller/DAOUsuarioPrograma.php';
    include_once '../Controller/DAOPerfilPrograma.php';

    $ObjDaoUsuario = new DAO();
    $ObjPerfilPrograma = new PerfilPrograma();
    $objUsuarioPrograma = new UsuarioPrograma();
    $objUsuario = new Usuario();
    $objFuncionalidades = new Funcionalidades();
    $objPrograma = new Programa();

    $permissoes = array();
    if ($IdPerfil != "" && !is_null($IdPerfil)) {
        $sql = "SELECT " . PROGRAMA_COD_PTC . SEPARADOR . PROGRAMA_ID . " FROM " . PROGRAMA_TABLENAME;

        $Resultado = $ObjDaoUsuario->ConsultarCustom($sql);

        $existePermissaoUsuario = existePermissoesUsuario($idUsuario);
        while ($row = $Resultado->fetch(PDO::FETCH_BOTH)) {
            $acessar = 0;
            $incluir = 0;
            $alterar = 0;
            $lixeira = 0;
            if ($existePermissaoUsuario > 0) {
                $objUsuarioPrograma = buscaUsuarioProgramaPorIdPrograma($row[1], $idUsuario);

                $acessar = $objUsuarioPrograma->getAcessar();
                $incluir = $objUsuarioPrograma->getIncluir();
                $alterar = $objUsuarioPrograma->getAlterar();
                $lixeira = $objUsuarioPrograma->getLixeira();
            } else {
                $ObjPerfilPrograma = buscaPerfilProgramaPorIdPrograma($row[1], $IdPerfil);

                $acessar = $ObjPerfilPrograma->getAcessar();
                $incluir = $ObjPerfilPrograma->getIncluir();
                $alterar = $ObjPerfilPrograma->getAlterar();
                $lixeira = $ObjPerfilPrograma->getLixeira();
            }
            $permissoes[$row[0]] = array(
                'ACESSAR' => !is_null($acessar) ? $acessar : 0,
                'INCLUIR' => !is_null($incluir) ? $incluir : 0,
                'ALTERAR' => !is_null($alterar) ? $alterar : 0,
                'LIXEIRA' => !is_null($lixeira) ? $lixeira : 0);
        }
    } else {
        $objFuncionalidades->ExibeMensagem("Nao foi atribuido um perfil ao usuario, entre em contato com o administrador!");
        $objFuncionalidades->VoltarPaginaAnterior();
    }

    return $permissoes;
}

function UpdateSenhaUsuario($ObjUsuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    $ObjDaoUsuario = new DAO();
    $ObjUsuarioDao = new Usuario();
    $ObjUsuarioDao = $ObjUsuario;

    $usuario = array();
    $usuario[USUARIO_USUARIO] = $ObjUsuarioDao->getUsuario();
    $usuario[USUARIO_SENHA] = $ObjUsuarioDao->getSenha();

    $Resultado = $ObjDaoUsuario->Atualizar(USUARIO_TABLENAME, $usuario, WHERE . USUARIO_USUARIO . IGUAL . "'" . $usuario[USUARIO_USUARIO] . "'");

    return $Resultado;
}

function ListaUsuarioSemPerfil() {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';


    $objDao = new DAO();
    $objUsuario = new Usuario();

    //$ListaPerfil = $objDao->ConsultarCustom("SELECT * FROM " . USUARIO_TABLENAME . WHERE . USUARIO_ID . " NOT IN (SELECT " . PERFILUSUARIO_USUARIO_ID . " FROM " . PERFILUSUARIO_TABLENAME . WHERE . PERFILUSUARIO_USUARIO_ID . IGUAL . USUARIO_ID . ")");
    $ListaPerfil = $objDao->ConsultarCustom("SELECT * FROM " . USUARIO_TABLENAME);

    return $ListaPerfil;
}

function ListaUsuarioFornecedor() {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';


    $objDao = new DAO();
    $objUsuario = new Usuario();

    $ListaPerfil = $objDao->Consultar(USUARIO_TABLENAME, TUDO, WHERE . USUARIO_CODIGO_FORNECEDOR . DIFERENTE . "''");

    return $ListaPerfil;
}

function ListaTodosUsuarios() {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';


    $objDao = new DAO();
    $objUsuario = new Usuario();

    $Lista = $objDao->Consultar(USUARIO_TABLENAME, "*", ORDER . USUARIO_NOME . " ASC");

    return $Lista;
}

function ListaUsuarioRecebeEmailCliente($tipo) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/PerfilUsuario.Class.php';


    $objDao = new DAO();
    $objUsuario = new Usuario();

    $sql = "SELECT * FROM " . USUARIO_TABLENAME . "  WHERE " . USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE . " = '{$tipo}'";
    $Lista = $objDao->ConsultarCustom($sql);
    $Lista = $Lista->fetchAll(PDO::FETCH_BOTH);

    return $Lista;
}

function ListaTodosUsuarioPorRepresentanteERP($cod = null) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objDao = new Dao();
    $objUsuario = new Usuario();



    $Lista = $objDao->Consultar(USUARIO_TABLENAME, USUARIO_ID . SEPARADOR . USUARIO_NOME . SEPARADOR . USUARIO_REPRESENTANTE_ERP, WHERE . USUARIO_REPRESENTANTE_ERP . IGUAL . "'{$cod}' " . ORDER . USUARIO_NOME);

    return $Lista;
}

function ListaTodosRepresentantesERP($cod = null) {
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objUsuario = new Usuario();
    $objDao = new DaoErp();

    if ($cod != null) {
        $filtroCodigo = " AND cod_repres ={$cod} ";
    } else {
        $filtroCodigo = " ";
    }

    $Lista = $objDao->ConsultaGenerica("select cod_repres, raz_social from representante  WHERE cast(cod_repres as varchar) in (select " . USUARIO_REPRESENTANTE_ERP . " from " . USUARIO_TABLENAME . " where " . USUARIO_REPRESENTANTE_ERP . " = cast(cod_repres as varchar)) " . $filtroCodigo . " ORDER BY raz_social ASC");

    return $Lista;
}

function ListaTodosRepresentantesERPCanalVenda($cod = null) {
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objDao = new DaoErp();
    $objUsuario = new Usuario();

    if ($cod != null) {
        $filtroCodigo = " AND cod_repres ={$cod} ";
    } else {
        $filtroCodigo = " ";
    }


    $Lista = $objDao->ConsultaGenerica(" SELECT DISTINCT COD_REPRES, RAZ_SOCIAL, CCV.IES_NIVEL FROM CLI_CANAL_VENDA CCV 
             INNER JOIN REPRESENTANTE ON(COD_REPRES = COD_NIVEL_7 OR COD_REPRES = COD_NIVEL_6 OR COD_REPRES = COD_NIVEL_5 OR COD_REPRES = COD_NIVEL_4 OR COD_REPRES = COD_NIVEL_3 OR COD_REPRES = COD_NIVEL_2 OR COD_REPRES = COD_NIVEL_1) 
             WHERE ((COD_NIVEL_7 = {$cod} OR COD_NIVEL_6 = {$cod} OR COD_NIVEL_5 = {$cod} OR COD_NIVEL_4 = {$cod} OR COD_NIVEL_3 = {$cod} OR COD_NIVEL_2 = {$cod} OR COD_NIVEL_1 = {$cod}) AND 
             COD_REPRES IN (SELECT " . USUARIO_REPRESENTANTE_ERP . " FROM " . USUARIO_TABLENAME . " WHERE " . USUARIO_REPRESENTANTE_ERP . " = COD_REPRES))  
");

    return $Lista;
}

function BuscaRepresentanteCliente($codCliente) {
    include_once '../Model/Pedido.Class.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objPedido = new Pedido();
    $ObjDaoERP = new DaoErp();
    $ObjDao = new DAO();
    $objUsuario = new Usuario();
    $retorno = $ObjDaoERP->ConsultaGenerica("select cod_cliente, cod_nivel_4 from cli_canal_venda where cod_nivel_3 <> cod_nivel_4 AND cod_nivel_4 <> 0 AND COD_CLIENTE = '{$codCliente}'");
    $retorno = $retorno->fetch(PDO::FETCH_BOTH);

    if ($retorno[1] != "") {
        $usuario = $ObjDao->Consultar(USUARIO_TABLENAME, USUARIO_ID, WHERE . USUARIO_REPRESENTANTE_ERP . IGUAL . $retorno[1]);

        $objUsuario = BuscaUsuarioPorID($usuario[0][USUARIO_ID]);
    }
    return $objUsuario;
}

//funcao que identifica o nivel do cod do representante na canal de vendas
function BuscaNivelCanalVenda($cod) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objDAO = new DAO();
    $objUsuario = new Usuario();

    for ($i = 1; $i < 7; $i++) {
        $retorno = $objDAO->ConsultarComFiltro("{$objUsuario->getSchemaErp()}CANAL_VENDA", "COD_NIVEL_" . ($i + 1), " cod_nivel_{$i} = {$cod} ", 0, 1, null, " ORDER BY cod_nivel_" . ($i + 1), 0);
        $retorno = $retorno->fetchAll(PDO::FETCH_BOTH);

        if ($retorno[0]["COD_NIVEL_" . ($i + 1)] == '0') {
            $nivel = $i;
        }
    }
    return $nivel;
}

//funcao que busca um nivel especifico do canal de vendas
function BuscaNivelCanalPorNivel($cod, $nivel, $nivelRepresentante) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objDAO = new DAO();
    $objUsuario = new Usuario();


    $retorno = $objDAO->ConsultarComFiltro("{$objUsuario->getSchemaErp()}CANAL_VENDA", "COD_NIVEL_" . $nivel, " cod_nivel_{$nivelRepresentante} = {$cod} ", 0, 1, null, " ORDER BY cod_nivel_" . $nivel, 0);
    $retorno = $retorno->fetch(PDO::FETCH_BOTH);

    $nivel = $retorno[0];

    return $nivel;
}

// Lista representantes do canal por codigo
function buscaRepresentanteCanal($cod) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/DaoErp.Class.php';
    include_once '../Model/Usuario.Class.php';

    $objDAO = new DAO();
    $objUsuario = new Usuario();
    $objDaoErp = new DaoErp();

    //Busca nivel do representante
    $nivelCod = BuscaNivelCanalVenda($cod);

    $representantes = array();

    //busca os representantes a partir do nivel 
    $representantes[0] = $cod;
    $contadorArray = 1;

    for ($i = $nivelCod; $i < 7; $i++) {
        $retorno = $objDAO->ConsultarComFiltro("{$objUsuario->getSchemaErp()}CANAL_VENDA", " DISTINCT COD_NIVEL_" . ($i + 1), "COD_NIVEL_" . ($i + 1) . " <> 0 and cod_nivel_{$nivelCod} = {$cod} ", 0, 100000000000, null, " ORDER BY cod_nivel_" . ($i + 1), 0);

        while ($row = $retorno->fetch(PDO::FETCH_BOTH)) {
            // busca situacao do representante
            $situacao = $objDaoErp->BuscaRepresentantePorCod($row[0]);
            $situacao = $situacao->fetchAll(PDO::FETCH_BOTH);
            // lista apenas os situacao N-Normal
            if ($situacao[0][17] == "N") {
                $representantes[$contadorArray] = $row[0];
                $contadorArray++;
            }
        }
    }
// retorna a lista de representantes
    return $representantes;
}

function ListaTodosUsuariosCanalDeVendas($idUsuario) {
    include_once '../Model/DAO.Class.php';
    include_once '../Model/Usuario.Class.php';
    include_once '../Model/DaoErp.Class.php';


    $objDao = new DAO();
    $objUsuario = new Usuario();
    $objDaoErp = new DaoErp();

    $objUsuario = BuscaUsuarioPorID($idUsuario);

    // Buscando os representantes do canal de venda da analsita
    $CanalVendas = $objDaoErp->BuscaRepresentantesAnalista($objUsuario->getRepresentanteERP());
    $filtro = " ";
    $seqFiltro = 0;
    while ($row = $CanalVendas->fetch(PDO::FETCH_BOTH)) {
        if ($seqFiltro == 0) {
            $Separ = " ";
        } else {
            $Separ = " OR ";
        }
        $filtro .= " " . $Separ . " " . USUARIO_REPRESENTANTE_ERP . IGUAL . "'" . $row[0] . "'";
        $seqFiltro++;
    }

    $Lista = $objDao->Consultar(USUARIO_TABLENAME, "*", WHERE . $filtro . ORDER . USUARIO_REPRESENTANTE_ERP . " ASC");

    return $Lista;
}

function BuscaIdUsuariosPorPrograma($idPrograma) {

    include_once '../Model/DAO.Class.php';
    $ObjDAO = new DAO();

    $sql = "SELECT USU.USU_ID AS USU_ID FROM " . $ObjDAO->getSchema() . "PTV_USUARIO_USU USU
    INNER JOIN " . $ObjDAO->getSchema() . "PTV_PERFIL_USUARIO_PFU PFU ON (PFU.PFU_USU_ID = USU.USU_ID)
    INNER JOIN " . $ObjDAO->getSchema() . "PTV_PERFIL_PER PER ON (PER.PER_ID = PFU.PFU_PER_ID)
    INNER JOIN " . $ObjDAO->getSchema() . "PTV_PERFIL_PROGRAMA_PEP PEP ON (PEP.PEP_PER_ID = PER.PER_ID)
    WHERE PEP.PEP_PRO_ID = {$idPrograma} 
    AND PEP.PEP_ACESSAR = 1";

    $Retorno = $ObjDAO->ConsultarCustom($sql);
    $Retorno = $Retorno->fetchAll(PDO::FETCH_ASSOC);

    return $Retorno;
}
