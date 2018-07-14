<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Rodrigo
 */
include_once '../Model/Base.Class.php';

class Usuario extends Base {

    private $ID;
    private $Usuario;
    private $Senha;
    private $Nome;
    private $Ramal;
    private $CorMenu;
    private $UsuarioERP;
    private $RepresentanteERP;
    private $Email;
    private $Telefone;
    private $Fax;
    private $Carteira;
    private $CadastraPedidoOutro;
    private $ModificaPedidoErp;
    private $ModificaClienteErp;
    private $UltimoLogin;
    private $Imagem;
    private $emailSecundario;
    private $liberaPedidoFechado;
    private $comissao;
    private $tipo;
    private $visualizaClienteSemCanal;
    private $visualizaHistoricoCredito;
    private $interno;
    private $cadastraDiasCondPatgo;
    private $liberaModificacaoUsuario;
    private $liberaModificacaoRepresentante;
    private $recebeEmailEnviado;
    private $recebeEmailAprovacaoReprovacao;
    private $recebeEmailAprovacaoReprovacaoCliente;
    private $respondeSac;
    private $RecebeNotificacaoPedido;
    private $CorTextoMenu;
    private $RecebeNotificacaoCliente;
    private $empresa;
    private $maxDiasCondPgto;
    private $cadastraConcorrenteCliente;
    private $codFornecedor;
    private $codComprador;
    private $idioma;

    function __construct() {
        define("USUARIO_TABLENAME", $this->getSchema() . "PTC_USUARIO_USU");
        define("USUARIO_ID", "USU_ID");
        define("USUARIO_NOME", "USU_NOME");
        define("USUARIO_USUARIO", "USU_USUARIO");
        define("USUARIO_SENHA", "USU_SENHA");
        define("USUARIO_ULTIMO_LOGIN", "USU_ULTIMO_LOGIN");
        define("USUARIO_RAMAL", "USU_RAMAL");
        define("USUARIO_ERP", "USU_USUARIO_ERP");
        define("USUARIO_REPRESENTANTE_ERP", "USU_REPRESENTANTE_ERP");
        define("USUARIO_EMAIL", "USU_EMAIL");
        define("USUARIO_EMAIL_SECUNDARIO", "USU_EMAIL_SECUNDARIO");
        define("USUARIO_TELEFONE", "USU_TELEFONE");
        define("USUARIO_FAX", "USU_FAX");
        define("USUARIO_CARTEIRA", "USU_CARTEIRA");
        define("USUARIO_CADASTRA_PEDIDO_OUTRO", "USU_CADASTRA_PEDIDO_OUTROS");
        define("USUARIO_MODIFICA_PEDIDO_ERP", "USU_MODIFICA_PEDIDO_ERP");
        define("USUARIO_MODIFICA_CLIENTE_ERP", "USU_MODIFICA_CLIENTE_ERP");
        define("USUARIO_IMAGEM", "USU_IMAGEM");
        define("USUARIO_LIBERA_PEDIDO_FECHADO", "USU_LIBERA_PEDIDO_FECHADO");
        define("USUARIO_COMISSAO", "USU_COMISSAO");
        define("USUARIO_TIPO", "USU_TIPO");
        define("USUARIO_VISUALIZA_CLIENTE_SEM_CANAL", "USU_VISUALIZA_CLI_SEM_CANAL");
        define("USUARIO_VISUALIZA_HIST_CREDITO", "USU_VISUALIZA_HIST_CREDITO");
        define("USUARIO_INTERNO", "USU_INTERNO");
        define("USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO", "USU_CAD_DIAS_MEDIA_COND_PTGO");
        define("USUARIO_LIBERA_MODIFICACAO_USUARIO", "USU_LIBERA_MODIFICACAO_USUARIO");
        define("USUARIO_RECEBE_EMAIL_ENVIADO", "USU_RECEBE_EMAIL_ENVIADO");
        define("USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE", "USU_LIBERA_MODIFICACAO_REPRES");
        define("USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO", "USU_RECEBE_EMAIL_APROV_REPROV");
        define("USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE", "USU_REC_EMAIL_APROV_REPROV_CLI");
        define("USUARIO_RESPONDE_SAC", "USU_RESPONDE_SAC");
        define("USUARIO_RECEBE_NOT_PEDIDO", "USU_REC_NOT_PED");
        define("USUARIO_COR_MENU", "USU_COR_MENU");
        define("USUARIO_RECEBE_NOT_CLIENTE", "USU_REC_NOT_CLI");
        define("USUARIO_COR_TEXTO_MENU", "USU_COR_TEXTO_MENU");
        define("USUARIO_EMPRESA", "USU_EMPRESA");
        define("USUARIO_MAX_DIAS_COND_PAGAMENTO", "USU_MAX_COND_PGTO");
        define("USUARIO_CADASTRA_CONCORRENTE_CLIENTE", "USU_CAD_CONCORRENTE_CLIENTE");
        define("USUARIO_CODIGO_FORNECEDOR", "USU_CODIGO_FORNECEDOR");
        define("USUARIO_CODIGO_COMPRADOR", "USU_CODIGO_COMPRADOR");
        define("USUARIO_IDIOMA", "USU_IDIOMA");
    }

    function getID() {
        return $this->ID;
    }

    function getUsuario() {
        return $this->Usuario;
    }

    function getSenha() {
        return $this->Senha;
    }

    function getNome() {
        return $this->Nome;
    }

    function getRamal() {
        return $this->Ramal;
    }

    function getCorMenu() {
        return $this->CorMenu;
    }

    function getUsuarioERP() {
        return $this->UsuarioERP;
    }

    function getRepresentanteERP() {
        return $this->RepresentanteERP;
    }

    function getEmail() {
        return $this->Email;
    }

    function getTelefone() {
        return $this->Telefone;
    }

    function getFax() {
        return $this->Fax;
    }

    function getCarteira() {
        return $this->Carteira;
    }

    function getCadastraPedidoOutro() {
        return $this->CadastraPedidoOutro;
    }

    function getModificaPedidoErp() {
        return $this->ModificaPedidoErp;
    }

    function getModificaClienteErp() {
        return $this->ModificaClienteErp;
    }

    function getUltimoLogin() {
        return $this->UltimoLogin;
    }

    function getImagem() {
        return $this->Imagem;
    }

    function getEmailSecundario() {
        return $this->emailSecundario;
    }

    function getLiberaPedidoFechado() {
        return $this->liberaPedidoFechado;
    }

    function getComissao() {
        return $this->comissao;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getVisualizaClienteSemCanal() {
        return $this->visualizaClienteSemCanal;
    }

    function getVisualizaHistoricoCredito() {
        return $this->visualizaHistoricoCredito;
    }

    function getInterno() {
        return $this->interno;
    }

    function getCadastraDiasCondPatgo() {
        return $this->cadastraDiasCondPatgo;
    }

    function getLiberaModificacaoUsuario() {
        return $this->liberaModificacaoUsuario;
    }

    function getLiberaModificacaoRepresentante() {
        return $this->liberaModificacaoRepresentante;
    }

    function getRecebeEmailEnviado() {
        return $this->recebeEmailEnviado;
    }

    function getRecebeEmailAprovacaoReprovacao() {
        return $this->recebeEmailAprovacaoReprovacao;
    }

    function getRecebeEmailAprovacaoReprovacaoCliente() {
        return $this->recebeEmailAprovacaoReprovacaoCliente;
    }

    function getRespondeSac() {
        return $this->respondeSac;
    }

    function getRecebeNotificacaoPedido() {
        return $this->RecebeNotificacaoPedido;
    }

    function getCorTextoMenu() {
        return $this->CorTextoMenu;
    }

    function getRecebeNotificacaoCliente() {
        return $this->RecebeNotificacaoCliente;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getMaxDiasCondPgto() {
        return $this->maxDiasCondPgto;
    }

    function getCadastraConcorrenteCliente() {
        return $this->cadastraConcorrenteCliente;
    }

    function getCodFornecedor() {
        return $this->codFornecedor;
    }

    function getCodComprador() {
        return $this->codComprador;
    }

    function getIdioma() {
        return $this->idioma;
    }

    function setID($ID) {
        $this->ID = $ID;
    }

    function setUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }

    function setSenha($Senha) {
        $this->Senha = $Senha;
    }

    function setNome($Nome) {
        $this->Nome = $Nome;
    }

    function setRamal($Ramal) {
        $this->Ramal = $Ramal;
    }

    function setCorMenu($CorMenu) {
        $this->CorMenu = $CorMenu;
    }

    function setUsuarioERP($UsuarioERP) {
        $this->UsuarioERP = $UsuarioERP;
    }

    function setRepresentanteERP($RepresentanteERP) {
        $this->RepresentanteERP = $RepresentanteERP;
    }

    function setEmail($Email) {
        $this->Email = $Email;
    }

    function setTelefone($Telefone) {
        $this->Telefone = $Telefone;
    }

    function setFax($Fax) {
        $this->Fax = $Fax;
    }

    function setCarteira($Carteira) {
        $this->Carteira = $Carteira;
    }

    function setCadastraPedidoOutro($CadastraPedidoOutro) {
        $this->CadastraPedidoOutro = $CadastraPedidoOutro;
    }

    function setModificaPedidoErp($ModificaPedidoErp) {
        $this->ModificaPedidoErp = $ModificaPedidoErp;
    }

    function setModificaClienteErp($ModificaClienteErp) {
        $this->ModificaClienteErp = $ModificaClienteErp;
    }

    function setUltimoLogin($UltimoLogin) {
        $this->UltimoLogin = $UltimoLogin;
    }

    function setImagem($Imagem) {
        $this->Imagem = $Imagem;
    }

    function setEmailSecundario($emailSecundario) {
        $this->emailSecundario = $emailSecundario;
    }

    function setLiberaPedidoFechado($liberaPedidoFechado) {
        $this->liberaPedidoFechado = $liberaPedidoFechado;
    }

    function setComissao($comissao) {
        $this->comissao = $comissao;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setVisualizaClienteSemCanal($visualizaClienteSemCanal) {
        $this->visualizaClienteSemCanal = $visualizaClienteSemCanal;
    }

    function setVisualizaHistoricoCredito($visualizaHistoricoCredito) {
        $this->visualizaHistoricoCredito = $visualizaHistoricoCredito;
    }

    function setInterno($interno) {
        $this->interno = $interno;
    }

    function setCadastraDiasCondPatgo($cadastraDiasCondPatgo) {
        $this->cadastraDiasCondPatgo = $cadastraDiasCondPatgo;
    }

    function setLiberaModificacaoUsuario($liberaModificacaoUsuario) {
        $this->liberaModificacaoUsuario = $liberaModificacaoUsuario;
    }

    function setLiberaModificacaoRepresentante($liberaModificacaoRepresentante) {
        $this->liberaModificacaoRepresentante = $liberaModificacaoRepresentante;
    }

    function setRecebeEmailEnviado($recebeEmailEnviado) {
        $this->recebeEmailEnviado = $recebeEmailEnviado;
    }

    function setRecebeEmailAprovacaoReprovacao($recebeEmailAprovacaoReprovacao) {
        $this->recebeEmailAprovacaoReprovacao = $recebeEmailAprovacaoReprovacao;
    }

    function setRecebeEmailAprovacaoReprovacaoCliente($recebeEmailAprovacaoReprovacaoCliente) {
        $this->recebeEmailAprovacaoReprovacaoCliente = $recebeEmailAprovacaoReprovacaoCliente;
    }

    function setRespondeSac($respondeSac) {
        $this->respondeSac = $respondeSac;
    }

    function setRecebeNotificacaoPedido($RecebeNotificacaoPedido) {
        $this->RecebeNotificacaoPedido = $RecebeNotificacaoPedido;
    }

    function setCorTextoMenu($CorTextoMenu) {
        $this->CorTextoMenu = $CorTextoMenu;
    }

    function setRecebeNotificacaoCliente($RecebeNotificacaoCliente) {
        $this->RecebeNotificacaoCliente = $RecebeNotificacaoCliente;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setMaxDiasCondPgto($maxDiasCondPgto) {
        $this->maxDiasCondPgto = $maxDiasCondPgto;
    }

    function setCadastraConcorrenteCliente($cadastraConcorrenteCliente) {
        $this->cadastraConcorrenteCliente = $cadastraConcorrenteCliente;
    }

    function setCodFornecedor($codFornecedor) {
        $this->codFornecedor = $codFornecedor;
    }

    function setCodComprador($codComprador) {
        $this->codComprador = $codComprador;
    }

    function setIdioma($idioma) {
        $this->idioma = $idioma;
    }

    public function alimentaObjUsuario($retorno) {
        $this->setID($retorno[0][USUARIO_ID]);
        $this->setUsuario($retorno[0][USUARIO_USUARIO]);
        $this->setSenha($retorno[0][USUARIO_SENHA]);
        $this->setNome($retorno[0][USUARIO_NOME]);
        $this->setRamal($retorno[0][USUARIO_RAMAL]);
        $this->setCorMenu($retorno[0][USUARIO_COR_MENU]);
        $this->setUsuarioERP($retorno[0][USUARIO_ERP]);
        $this->setRepresentanteERP($retorno[0][USUARIO_REPRESENTANTE_ERP]);
        $this->setEmail($retorno[0][USUARIO_EMAIL]);
        $this->setTelefone($retorno[0][USUARIO_TELEFONE]);
        $this->setFax($retorno[0][USUARIO_FAX]);
        $this->setCarteira($retorno[0][USUARIO_CARTEIRA]);
        $this->setCadastraPedidoOutro($retorno[0][USUARIO_CADASTRA_PEDIDO_OUTRO]);
        $this->setModificaPedidoErp($retorno[0][USUARIO_MODIFICA_PEDIDO_ERP]);
        $this->setModificaClienteErp($retorno[0][USUARIO_MODIFICA_CLIENTE_ERP]);
        $this->setUltimoLogin($retorno[0][USUARIO_ULTIMO_LOGIN]);
        $this->setImagem($retorno[0][USUARIO_IMAGEM]);
        $this->setEmailSecundario($retorno[0][USUARIO_EMAIL_SECUNDARIO]);
        $this->setLiberaPedidoFechado($retorno[0][USUARIO_LIBERA_PEDIDO_FECHADO]);
        $this->setComissao($retorno[0][USUARIO_COMISSAO]);
        $this->setTipo($retorno[0][USUARIO_TIPO]);
        $this->setVisualizaClienteSemCanal($retorno[0][USUARIO_VISUALIZA_CLIENTE_SEM_CANAL]);
        $this->setVisualizaHistoricoCredito($retorno[0][USUARIO_VISUALIZA_HIST_CREDITO]);
        $this->setInterno($retorno[0][USUARIO_INTERNO]);
        $this->setCadastraDiasCondPatgo($retorno[0][USUARIO_CADASTRA_DIAS_MEDIA_COND_PTGO]);
        $this->setLiberaModificacaoUsuario($retorno[0][USUARIO_LIBERA_MODIFICACAO_USUARIO]);
        $this->setLiberaModificacaoRepresentante($retorno[0][USUARIO_LIBERA_MODIFICACAO_REPRESENTANTE]);
        $this->setRecebeEmailEnviado($retorno[0][USUARIO_RECEBE_EMAIL_ENVIADO]);
        $this->setRecebeEmailAprovacaoReprovacao($retorno[0][USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO]);
        $this->setRecebeEmailAprovacaoReprovacaoCliente($retorno[0][USUARIO_RECEBE_EMAIL_APROVACAO_REPROVACAO_CLIENTE]);
        $this->setRespondeSac($retorno[0][USUARIO_RESPONDE_SAC]);
        $this->setRecebeNotificacaoPedido($retorno[0][USUARIO_RECEBE_NOT_PEDIDO]);
        $this->setCorTextoMenu($retorno[0][USUARIO_COR_TEXTO_MENU]);
        $this->setRecebeNotificacaoCliente($retorno[0][USUARIO_RECEBE_NOT_CLIENTE]);
        $this->setEmpresa($retorno[0][USUARIO_EMPRESA]);
        $this->setMaxDiasCondPgto($retorno[0][USUARIO_MAX_DIAS_COND_PAGAMENTO]);
        $this->setCadastraConcorrenteCliente($retorno[0][USUARIO_CADASTRA_CONCORRENTE_CLIENTE]);
        $this->setCodFornecedor($retorno[0][USUARIO_CODIGO_FORNECEDOR]);
        $this->setCodComprador($retorno[0][USUARIO_CODIGO_COMPRADOR]);
        $this->setIdioma($retorno[0][USUARIO_IDIOMA]);
    }

}
