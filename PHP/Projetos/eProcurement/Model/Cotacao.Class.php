<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cotacao
 *
 * @author Forge
 */
include_once '../Model/Base.Class.php';
include_once '../Model/IClass.php';

class Cotacao extends Base implements IClass {

    public function __construct() {
        parent::__construct();
    }

    private $id;
    private $cod_empresa;
    private $oc;
    private $numero;
    private $item;
    private $fabricante;
    private $entrega_prevista;
    private $data_limite_cotacao;
    private $preco_unit;
    private $unidade_medida;
    private $ipi;
    private $orcamento_valido;
    private $prazo_entrega;
    private $moeda;
    private $condicoes_pagamento;
    private $modo_envio;
    private $chat;
    private $fornecedor;

    const _TABLENAME = "PTC_COTACAO_COT";
    const _ID = "COT_ID";
    const _COD_EMPRESA = "COT_EMPRESA";
    const _NUMERO = "COT_NUMERO";
    const _ITEM = "COT_ITEM";
    const _FABRICANTE = "COT_FABRICANTE";
    const _ENTREGA_PREVISTA = "COT_ENTREGA_PREVISTA";
    const _DATA_LIMITE_COTACAO = "COT_DATA_LIMITE_COTACAO";
    const _PRECO_UNITARIO = "COT_PRECO_UNIT";
    const _UNIDADE_MEDIDA = "COT_UNIDADE_MEDIDA";
    const _IPI = "COT_IPI";
    const _ORCAMENTO_VALIDO = "COT_ORCAMENTO_VALIDO";
    const _PRAZO_ENTREGA = "COT_PRAZO_ENTREGA";
    const _MOEDA = "COT_MOEDA";
    const _CONDICOES_PAGAMENTO = "COT_CONDICOES_PAGAMENTO";
    const _MODO_ENVIO = "COT_MODO_ENVIO";
    const _OC = "COT_OC";
    const _CHAT = "COT_CHAT";
    const _FORNECEDOR = "COT_FORNECEDOR";

    function getId() {
        return $this->id;
    }

    function getCod_empresa() {
        return $this->cod_empresa;
    }

    function getOc() {
        return $this->oc;
    }

    function getNumero() {
        return $this->numero;
    }

    function getItem() {
        return $this->item;
    }

    function getFabricante() {
        return $this->fabricante;
    }

    function getEntrega_prevista() {
        return $this->entrega_prevista;
    }

    function getData_limite_cotacao() {
        return $this->data_limite_cotacao;
    }

    function getPreco_unit() {
        return $this->preco_unit;
    }

    function getUnidade_medida() {
        return $this->unidade_medida;
    }

    function getIpi() {
        return $this->ipi;
    }

    function getOrcamento_valido() {
        return $this->orcamento_valido;
    }

    function getPrazo_entrega() {
        return $this->prazo_entrega;
    }

    function getMoeda() {
        return $this->moeda;
    }

    function getCondicoes_pagamento() {
        return $this->condicoes_pagamento;
    }

    function getModo_envio() {
        return $this->modo_envio;
    }

    function getChat() {
        return $this->chat;
    }

    function getFornecedor() {
        return $this->fornecedor;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCod_empresa($cod_empresa) {
        $this->cod_empresa = $cod_empresa;
    }

    function setOc($oc) {
        $this->oc = $oc;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setItem($item) {
        $this->item = $item;
    }

    function setFabricante($fabricante) {
        $this->fabricante = $fabricante;
    }

    function setEntrega_prevista($entrega_prevista) {
        $this->entrega_prevista = $entrega_prevista;
    }

    function setData_limite_cotacao($data_limite_cotacao) {
        $this->data_limite_cotacao = $data_limite_cotacao;
    }

    function setPreco_unit($preco_unit) {
        $this->preco_unit = $preco_unit;
    }

    function setUnidade_medida($unidade_medida) {
        $this->unidade_medida = $unidade_medida;
    }

    function setIpi($ipi) {
        $this->ipi = $ipi;
    }

    function setOrcamento_valido($orcamento_valido) {
        $this->orcamento_valido = $orcamento_valido;
    }

    function setPrazo_entrega($prazo_entrega) {
        $this->prazo_entrega = $prazo_entrega;
    }

    function setMoeda($moeda) {
        $this->moeda = $moeda;
    }

    function setCondicoes_pagamento($condicoes_pagamento) {
        $this->condicoes_pagamento = $condicoes_pagamento;
    }

    function setModo_envio($modo_envio) {
        $this->modo_envio = $modo_envio;
    }

    function setChat($chat) {
        $this->chat = $chat;
    }

    function setFornecedor($fornecedor) {
        $this->fornecedor = $fornecedor;
    }

    public function alimentaObj($retorno) {
        $this->setId($retorno[self::_ID]);
        $this->setCod_empresa($retorno[self::_COD_EMPRESA]);
        $this->setNumero($retorno[self::_NUMERO]);
        $this->setItem($retorno[self::_ITEM]);
        $this->setFabricante($retorno[self::_FABRICANTE]);
        $this->setEntrega_prevista($retorno[self::_ENTREGA_PREVISTA]);
        $this->setData_limite_cotacao($retorno[self::_DATA_LIMITE_COTACAO]);
        $this->setPreco_unit($retorno[self::_PRECO_UNITARIO]);
        $this->setUnidade_medida($retorno[self::_UNIDADE_MEDIDA]);
        $this->setIpi($retorno[self::_IPI]);
        $this->setOrcamento_valido($retorno[self::_ORCAMENTO_VALIDO]);
        $this->setPrazo_entrega($retorno[self::_PRAZO_ENTREGA]);
        $this->setMoeda($retorno[self::_MOEDA]);
        $this->setCondicoes_pagamento($retorno[self::_CONDICOES_PAGAMENTO]);
        $this->setModo_envio($retorno[self::_MODO_ENVIO]);
        $this->setChat($retorno[self::_CHAT]);
        $this->setOc($retorno[self::_OC]);
        $this->setFornecedor($retorno[self::_FORNECEDOR]);
    }

}
