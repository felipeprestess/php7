-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 15-Jun-2016 às 10:29
-- Versão do servidor: 5.6.12-log
-- versão do PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: portal_vendas_ptv
--
CREATE DATABASE portal_vendas_ptv DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE portal_vendas_ptv;

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_cfop_cfo
--
CREATE TABLE ptv_entidade_ent (
  ent_id SERIAL PRIMARY KEY,
  ent_criador_id integer DEFAULT 0,
  ent_proprietario_id integer DEFAULT 0,
  ent_modificado_por integer  DEFAULT 0,
  ent_descricao varchar(100),
  ent_observacao varchar(100),
  ent_createdtime varchar(25) NOT NULL,
  ent_modifiedtime varchar(25) NOT NULL,
  ent_viewedtime varchar(25) DEFAULT NULL,
  ent_status varchar(50) DEFAULT NULL,
  ent_versao integer  DEFAULT 0,
  ent_lixeira integer  DEFAULT 0,
  ent_bloqueado integer  DEFAULT 0
)
go


CREATE TABLE ptv_pais_pai(
  pai_id integer PRIMARY KEY,
  pai_descricao varchar(50) NOT NULL,
  pai_codigo varchar(5) NOT NULL,
  pai_continente varchar(50) DEFAULT NULL,
  pai_mercado varchar(50) DEFAULT NULL
  
) 
go

CREATE TABLE ptv_tipo_pessoa_tps (
  tps_id integer PRIMARY KEY,
  tps_codigo_erp varchar(25) DEFAULT NULL,
  tps_tipo varchar(250) DEFAULT NULL
)
go

CREATE TABLE IF NOT EXISTS `ptv_pessoa_pes` (
  `pes_id` INTEGER NOT NULL,
  `pes_tipo` INTEGER DEFAULT NULL,
  `pes_cpf` char(14) DEFAULT NULL,
  `pes_cnpj` varchar(20) DEFAULT NULL,
  `pes_nome_reduzido` varchar(15) DEFAULT NULL,
  `pes_inscricao_estadual` varchar(16) DEFAULT NULL,
  `pes_inscricao_municipal` varchar(16) DEFAULT NULL,
  `pes_razao_social` varchar(60) DEFAULT NULL,
  `pes_suframa` varchar(60) DEFAULT NULL,
  `pes_logradouro` varchar(60) DEFAULT NULL,
  `pes_numero` varchar(15) DEFAULT NULL,
  `pes_bairro` varchar(30) DEFAULT NULL,
  `pes_cid_id` INTEGER DEFAULT NULL,
  `pes_cep` char(8) DEFAULT NULL,
  `pes_telefone` char(20) DEFAULT NULL,
  `pes_celular` char(20) DEFAULT NULL,
  `pes_data_validade_suframa` varchar(20) DEFAULT NULL,
  `pes_data_nasc_fund` varchar(20) DEFAULT NULL,
  `pes_fornecedor` varchar(20) DEFAULT NULL,
  `pes_cod` varchar(20) DEFAULT NULL,
  `pes_cliente` varchar(20) DEFAULT NULL,
  `pes_funcionario` varchar(20) DEFAULT NULL,
  `pes_observacao` text,
  `pes_orgao_emissor` varchar(20) DEFAULT NULL,
  `pes_rg` varchar(20) DEFAULT NULL,
  `pes_telefone_fax` char(11) NOT NULL,
  `pes_transportadora` varchar(20) DEFAULT NULL,
  `pes_vendedor` varchar(20) DEFAULT NULL,
  `pes_email` varchar(100) DEFAULT NULL,
  `pes_email_secundario` varchar(100) DEFAULT NULL,
  `pes_email_nfe` varchar(100) DEFAULT NULL,
  `pes_situacao` char(1) DEFAULT NULL,
  `pes_imagem` varchar(250) DEFAULT NULL,
  `pes_tipo_cadastro` char(1) DEFAULT NULL,
  `pes_isento` char(1) DEFAULT NULL,
  `pes_simples_nacional` char(1) DEFAULT NULL,
  `pes_status` char(2) DEFAULT NULL,
  `pes_recebe_info_nitem_ped_xped` INTEGER DEFAULT 0,
  `pes_qtd_max_dias_condicao_pgto` INTEGER DEFAULT NULL,
  PRIMARY KEY (`pes_id`),
  KEY `fk_pes_tipo` (`pes_tipo`)
) 
CREATE TABLE ptv_pessoa_pes (
  pes_id integer PRIMARY KEY,
  pes_tipo integer DEFAULT NULL,
  pes_cpf char(14) DEFAULT NULL,
  pes_cnpj varchar(20) DEFAULT NULL,
  pes_nome_reduzido varchar(15) DEFAULT NULL,
  pes_inscricao_estadual varchar(14) DEFAULT NULL,
  pes_inscricao_municipal varchar(15) DEFAULT NULL,
  pes_razao_social varchar(60) DEFAULT NULL,
  pes_suframa varchar(60) DEFAULT NULL,
  pes_logradouro varchar(60) DEFAULT NULL,
  pes_numero varchar(15) DEFAULT NULL,
  pes_bairro varchar(30) DEFAULT NULL,
  pes_cid_id integer DEFAULT NULL,
  pes_cep char(8) DEFAULT NULL,
  pes_telefone char(20) DEFAULT NULL,
  pes_celular char(20) DEFAULT NULL,
  pes_data_validade_suframa varchar(20) DEFAULT NULL,
  pes_data_nasc_fund varchar(20) DEFAULT NULL,
  pes_fornecedor varchar(20) DEFAULT NULL,
  pes_cod varchar(20) DEFAULT NULL,
  pes_cliente varchar(20) DEFAULT NULL,
  pes_funcionario varchar(20) DEFAULT NULL,
  pes_observacao text,
  pes_orgao_emissor varchar(20) DEFAULT NULL,
  pes_rg varchar(20) DEFAULT NULL,
  pes_telefone_fax char(11) NOT NULL,
  pes_transportadora varchar(20) DEFAULT NULL,
  pes_vendedor varchar(20) DEFAULT NULL,
  pes_email varchar(100) DEFAULT NULL,
  pes_email_secundario varchar(100) DEFAULT NULL,
  pes_email_nfe varchar(100) DEFAULT NULL,
  pes_situacao char(1) DEFAULT NULL,
  pes_imagem varchar(250) DEFAULT NULL,
  pes_tipo_cadastro char(1) DEFAULT NULL,
  pes_isento char(1) DEFAULT NULL,
  pes_simples_nacional char(1) DEFAULT NULL,
  pes_status char(2) DEFAULT NULL
)
go


CREATE TABLE ptv_estado_est (
  est_id integer PRIMARY KEY,
  est_sigla char(2) NOT NULL,
  est_nome varchar(50) NOT NULL,
  est_codigo_uf integer NOT NULL,
  est_pai_id integer NOT NULL,
  est_regiao varchar(100) DEFAULT NULL,
FOREIGN KEY (est_pai_id) REFERENCES ptv_pais_pai(pai_id)
)
go





CREATE TABLE ptv_cfop_cfo (
  cfo_id integer PRIMARY KEY,
  cfo_codigo varchar(4) NOT NULL,
  cfo_descricao varchar(100) NOT NULL,
  cfo_tipo integer NOT NULL,
  CONSTRAINT uq_cfo_codigo UNIQUE (cfo_codigo)
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_cidade_cid
--

CREATE TABLE ptv_cidade_cid (
  cid_id integer PRIMARY KEY,
  cid_codigo varchar(10) NOT NULL UNIQUE CONSTRAINT uq_cid_codigo,
  cid_nome varchar(50) NOT NULL,
  cid_est_id integer NOT NULL,
FOREIGN KEY (cid_est_id) REFERENCES ptv_estado_est(est_id)

)
go
-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_cli_canal_venda_ccv
--

CREATE TABLE ptv_cli_canal_venda_ccv (
  ccv_cod_cliente char(15) NOT NULL,
  ccv_cod_nivel_1 decimal(4,0) NOT NULL,
  ccv_cod_nivel_2 decimal(4,0) NOT NULL,
  ccv_cod_nivel_3 decimal(4,0) NOT NULL,
  ccv_cod_nivel_4 decimal(4,0) NOT NULL,
  ccv_cod_nivel_5 decimal(4,0) NOT NULL,
  ccv_cod_nivel_6 decimal(4,0) NOT NULL,
  ccv_cod_nivel_7 decimal(4,0) NOT NULL,
  ccv_ies_nivel char(2) NOT NULL,
  ccv_cod_tip_carteira char(2) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_condicao_pagamento_cdp
--

CREATE TABLE ptv_condicao_pagamento_cdp (
  cdp_id integer PRIMARY KEY,
  cdp_cod_erp varchar(15) DEFAULT NULL,
  cdp_nome varchar(150) DEFAULT NULL,
  cdp_carteira varchar(20) DEFAULT NULL,
  cdp_valor_minimo varchar(20) DEFAULT NULL,
  cdp_parcelado integer DEFAULT NULL

)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_condicao_pagamento_cliente_cpc
--



-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_contato_pessoa_cop
--

CREATE TABLE ptv_contato_pessoa_cop (
  cop_id integer PRIMARY KEY,
  cop_nome varchar(50) NOT NULL,
  cop_email varchar(80) NOT NULL,
  cop_email_secundario varchar(80) NOT NULL,
  cop_telefone char(11) NOT NULL,
  cop_celular char(11) NOT NULL,
  cop_imagem char(80) NOT NULL,
  cop_pes_id integer NOT NULL,
  cop_cargo varchar(80) DEFAULT NULL,
   	 FOREIGN KEY (cop_pes_id) REFERENCES ptv_pessoa_pes(pes_id)
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_defeito_def
--

CREATE TABLE ptv_defeito_def (
  def_id integer PRIMARY KEY,
  def_descricao varchar(60) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_documento_pessoa_dcc
--

CREATE TABLE ptv_tipo_documento_tdc (
  tdc_id integer PRIMARY KEY,
  tdc_tipo varchar(60) DEFAULT NULL,
  tdc_obrigatorio integer DEFAULT NULL,
  tdc_validade_dias varchar(20) DEFAULT NULL,
  tdc_libera_obrigatorio integer DEFAULT 0
)
go


CREATE TABLE ptv_documento_pessoa_dcc (
  dcc_id integer PRIMARY KEY,
  dcc_pes_id integer DEFAULT NULL,
  dcc_tdc_id integer DEFAULT NULL,
  dcc_data_cadastro varchar(11) DEFAULT NULL,
  dcc_descricao text,
  dcc_documento varchar(200) DEFAULT NULL,
    FOREIGN KEY (dcc_tdc_id) REFERENCES ptv_tipo_documento_tdc(tdc_id),
	FOREIGN KEY (dcc_pes_id) REFERENCES ptv_pessoa_pes(pes_id)
)
go


-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_email_nfe_pessoa_enp
--

CREATE TABLE ptv_email_nfe_pessoa_enp (
  enp_id integer PRIMARY KEY,
  enp_pes_id integer DEFAULT NULL,
  enp_padrao integer DEFAULT NULL,
  enp_email text,
  FOREIGN KEY (enp_pes_id) REFERENCES ptv_pessoa_pes(pes_id)

)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_endereco_entrega_pedido_eep
--


CREATE TABLE ptv_pedido_ped (
  ped_id integer PRIMARY KEY,
  ped_cod_orcamento INTEGER NOT NULL,
  ped_id_representante varchar(15) DEFAULT NULL,
  ped_id_cliente varchar(15) DEFAULT NULL,
  ped_efetivado integer DEFAULT 0,
  ped_id_trans varchar(25) DEFAULT NULL,
  ped_id_trans_redes varchar(25) DEFAULT NULL,
  ped_tipo_frete INTEGER DEFAULT NULL,
  ped_tipo_venda INTEGER DEFAULT NULL,
  ped_tipo_entrega INTEGER DEFAULT NULL,
  ped_operacao_fiscal INTEGER DEFAULT NULL,
  ped_lista_preco INTEGER DEFAULT NULL,
  ped_condicao_pagamento INTEGER DEFAULT NULL,
  ped_desconto_adicional varchar(10) DEFAULT NULL,
  ped_prazo_entrega varchar(10) DEFAULT NULL,
  ped_data_emissao varchar(10) DEFAULT NULL,
  ped_hora_emissao varchar(8) DEFAULT NULL,
  ped_cod_pedido_cliente varchar(50) DEFAULT NULL,
  ped_cod_pedido_repres varchar(15) DEFAULT NULL,
  ped_nome_contato varchar(60) DEFAULT NULL,
  ped_email_contato varchar(60) DEFAULT NULL,
  ped_telefone_contato varchar(20) DEFAULT NULL,
  ped_tipo_orcamento INTEGER DEFAULT NULL,
  ped_id_cliente_triangulacao varchar(15) DEFAULT NULL,
  ped_usa_end_ent INTEGER DEFAULT NULL,
  ped_status varchar(10) DEFAULT NULL,
  ped_data_efetivacao varchar(31) DEFAULT NULL,
  ped_usuario_gravou INTEGER DEFAULT NULL,
  ped_versao integer NOT NULL,
  ped_versao_atual char(1) NOT NULL,
  ped_id_cliente_indicacao varchar(15) DEFAULT NULL,
  ped_cop_id INTEGER DEFAULT NULL,
  ped_empresa char(2) NOT NULL,
  ped_calcula_comissao integer DEFAULT NULL,
  ped_comissao varchar(20) DEFAULT NULL,
  ped_romaneado char(1) DEFAULT 'N',
  ped_faturado char(1) DEFAULT 'N',
  ped_situacao varchar(2) DEFAULT NULL,
  ped_rep_secundario varchar(15) DEFAULT NULL,
  ped_rep_terciario varchar(15) DEFAULT NULL,
  ped_rep_secundario_comissao varchar(15) DEFAULT '0',
  ped_rep_terciario_comissao varchar(15) DEFAULT '0'
)
go


CREATE TABLE ptv_end_ent_pedido_eep (
  eep_id integer PRIMARY KEY,
  eep_ped_id integer NOT NULL,
  eep_logradouro varchar(60) NOT NULL,
  eep_numero varchar(15) NOT NULL,
  eep_complemento varchar(60) NOT NULL,
  eep_bairro varchar(30) NOT NULL,
  eep_cid_id integer NOT NULL,
  eep_cep char(8) NOT NULL,
  eep_padrao integer NOT NULL DEFAULT 0,
    FOREIGN KEY (eep_ped_id) REFERENCES ptv_cidade_cid(cid_id)
	)
	go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_endereco_entrega_pedido_historico_eph
--

CREATE TABLE ptv_endereco_entrega_pedido_historico_eph (
  eph_id integer PRIMARY KEY,
  eph_ped_id integer NOT NULL,
  eph_logradouro varchar(60) NOT NULL,
  eph_numero varchar(15) NOT NULL,
  eph_complemento varchar(60) NOT NULL,
  eph_bairro varchar(30) NOT NULL,
  eph_cid_id integer NOT NULL,
  eph_cep char(8) NOT NULL,
  eph_padrao integer NOT NULL DEFAULT 0,
  eph_versao integer NOT NULL,
    FOREIGN KEY (eph_cid_id) REFERENCES ptv_cidade_cid(cid_id),
	  FOREIGN KEY (eph_ped_id) REFERENCES ptv_pedido_ped(ped_id)
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_endereco_pessoa_edp
--

CREATE TABLE ptv_endereco_pessoa_edp (
  edp_id integer PRIMARY KEY,
  edp_pes_id integer NOT NULL,
  edp_logradouro varchar(60) NOT NULL,
  edp_numero varchar(15) NOT NULL,
  edp_complemento varchar(60) NOT NULL,
  edp_bairro varchar(30) NOT NULL,
  edp_tpe_id integer DEFAULT NULL,
  edp_cid_id integer NOT NULL,
  edp_cep char(10) NOT NULL,
  edp_tipo char(8) NOT NULL,
  edp_padrao integer NOT NULL DEFAULT 0,
      FOREIGN KEY (edp_pes_id) REFERENCES ptv_pessoa_pes(pes_id), 
	  FOREIGN KEY (edp_cid_id) REFERENCES ptv_cidade_cid(cid_id)
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_entidade_ent
--


-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_estado_est
--



-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_familia_fam
--

CREATE TABLE ptv_familia_fam (
  fam_id integer PRIMARY KEY,
  fam_nome varchar(40) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_forma_pagamento_fpg
--

CREATE TABLE ptv_forma_pagamento_fpg (
  fpg_id integer PRIMARY KEY,
  fpg_descricao varchar(50) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_forma_parcelamento_fpc
--

CREATE TABLE ptv_forma_parcelamento_fpc (
  fpc_id integer PRIMARY KEY,
  fpc_descricao varchar(50) NOT NULL,
  fpc_dias_primeira_parcela integer NOT NULL,
  fpc_tipo integer NOT NULL,
  fpc_numero_parcela integer NOT NULL,
  fpc_dias_entre_parcela integer NOT NULL,
  fpc_mesmo_dia_vencimento integer NOT NULL DEFAULT 0
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_grupo_gru
--

CREATE TABLE ptv_grupo_gru (
  gru_id integer PRIMARY KEY,
  gru_nome varchar(40) NOT NULL,
  gru_fam_id integer NOT NULL,
   FOREIGN KEY (gru_fam_id) REFERENCES ptv_familia_fam(fam_id)

)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_lista_preco_ltp
--

CREATE TABLE ptv_lista_preco_ltp (
  ltp_id integer PRIMARY KEY,
  ltp_cod_erp varchar(15) DEFAULT NULL,
  ltp_descricao varchar(150) DEFAULT NULL,
  ltp_desconto_maximo varchar(6) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_menu_men
--

CREATE TABLE ptv_menu_men (
  men_id integer PRIMARY KEY,
  men_pro_id integer DEFAULT NULL,
  men_principal integer NOT NULL DEFAULT 0,
  men_descricao_curta varchar(20) DEFAULT NULL,
  men_destino varchar(200) NOT NULL,
  men_id_owner integer DEFAULT NULL,
  men_ordem integer DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_modulo_empresa_mep
--

CREATE TABLE ptv_modulo_empresa_mep (
  mep_id integer PRIMARY KEY,
  mep_emp_id integer NOT NULL,
  mep_mod_id integer NOT NULL
)
go

CREATE INDEX uq_mep_emp_id ON ptv_modulo_empresa_mep (mep_emp_id,mep_mod_id)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_modulo_mod
--

CREATE TABLE ptv_modulo_mod (
  mod_id integer PRIMARY KEY,
  mod_nome varchar(30) NOT NULL,
  mod_descricao_curta varchar(50) NOT NULL,
  mod_descricao text NOT NULL
)
go

CREATE INDEX uq_mod_nome ON ptv_modulo_mod (mod_nome)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_operacoes_opc
--

CREATE TABLE ptv_operacoes_opc (
  opc_id integer PRIMARY KEY,
  opc_descricao varchar(60) DEFAULT NULL,
  opc_cod_erp int(60) DEFAULT NULL,
  opc_nat_remessa_conta_ordem varchar(20) DEFAULT NULL,
  opc_condicao_pagto_conta_ordem varchar(20) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_padroes_modulo_programa_pmp
--

CREATE TABLE ptv_padroes_modulo_prog_pmp (
  pmp_id integer PRIMARY KEY,
  pmp_tipo char(1) DEFAULT NULL,
  pmp_pro_mod_id integer DEFAULT NULL,
  pmp_parametro varchar(100) DEFAULT NULL,
  pmp_valor varchar(250) DEFAULT NULL,
  pmp_tipo_campo varchar(20) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_padroes_pad
--

CREATE TABLE ptv_padroes_pad (
  pad_id integer PRIMARY KEY,
  pad_nome_projeto varchar(60) DEFAULT NULL,
  pad_email_administrador_interno varchar(150) DEFAULT NULL,
  pad_email_administrador varchar(150) DEFAULT NULL,
  pad_bnc_id integer NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_pais_pai
--


-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_parcela_percentual_ppc
--

CREATE TABLE ptv_parcela_percentual_ppc (
  ppc_id integer PRIMARY KEY,
  ppc_fpc_id integer NOT NULL,
  ppc_parcela integer NOT NULL,
  ppc_percentual float(5,2) NOT NULL
)
go

CREATE INDEX fk_ppc_forma_parcelamento ON ptv_parcela_percentual_ppc (ppc_fpc_id)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_pedido_dig_texto_nota_historio_pnh
--

CREATE TABLE ptv_pedido_dig_texto_nota_historio_pnh (
  pnh_id integer PRIMARY KEY,
  pnh_ped_id integer DEFAULT NULL,
  pnh_texto_nota_um varchar(4000) DEFAULT NULL,
  pnh_texto_nota_dois varchar(4000) DEFAULT NULL,
  pnh_texto_nota_tres varchar(4000) DEFAULT NULL,
  pnh_texto_nota_quatro varchar(4000) DEFAULT NULL,
  pnh_texto_nota_cinco varchar(4000) DEFAULT NULL,
  pnh_sequencia integer DEFAULT NULL,
  pnh_versao integer NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_pedido_dig_texto_nota_ptn
--

CREATE TABLE ptv_pedido_dig_texto_nota_ptn (
  ptn_id integer PRIMARY KEY,
  ptn_ped_id integer DEFAULT NULL,
  ptn_texto_nota_um varchar(4000) DEFAULT NULL,
  ptn_texto_nota_dois varchar(4000) DEFAULT NULL,
  ptn_texto_nota_tres varchar(4000) DEFAULT NULL,
  ptn_texto_nota_quatro varchar(4000) DEFAULT NULL,
  ptn_texto_nota_cinco varchar(4000) DEFAULT NULL,
  ptn_sequencia integer DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_pedido_dig_texto_observacao_historico_toh
--

CREATE TABLE ptv_pedido_dig_texto_observacao_historico_toh (
  toh_id integer PRIMARY KEY,
  toh_ped_id int(15) DEFAULT NULL,
  toh_texto_um varchar(4000) DEFAULT NULL,
  toh_texto_dois varchar(4000) DEFAULT NULL,
  toh_sequencia integer DEFAULT NULL,
  toh_versao integer NOT NULL)
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_pedido_dig_texto_observacao_pto
--

CREATE TABLE ptv_pedido_dig_texto_obs_pto (
  pto_id integer PRIMARY KEY,
  pto_ped_id int(15) DEFAULT NULL,
  pto_texto_um varchar(4000) DEFAULT NULL,
  pto_texto_dois varchar(4000) DEFAULT NULL,
  pto_sequencia int(15) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_pedido_historico_pdh
--

CREATE TABLE ptv_pedido_historico_pdh (
  pdh_id integer PRIMARY KEY,
  pdh_cod_orcamento int(15) NOT NULL,
  pdh_id_pedido int(15) DEFAULT NULL,
  pdh_id_representante varchar(15) DEFAULT NULL,
  pdh_id_cliente varchar(15) DEFAULT NULL,
  pdh_efetivado int(15) DEFAULT NULL,
  pdh_id_trans varchar(25) DEFAULT NULL,
  pdh_id_trans_redes varchar(25) DEFAULT NULL,
  pdh_tipo_frete int(15) DEFAULT NULL,
  pdh_tipo_venda int(15) DEFAULT NULL,
  pdh_tipo_entrega int(15) DEFAULT NULL,
  pdh_operacao_fiscal int(15) DEFAULT NULL,
  pdh_lista_preco int(15) DEFAULT NULL,
  pdh_condicao_pagamento int(15) DEFAULT NULL,
  pdh_desconto_adicional varchar(10) DEFAULT NULL,
  pdh_prazo_entrega varchar(10) DEFAULT NULL,
  pdh_data_emissao varchar(10) DEFAULT NULL,
  pdh_hora_emissao varchar(8) DEFAULT NULL,
  pdh_cod_pedido_cliente varchar(50) DEFAULT NULL,
  pdh_cod_pedido_repres int(15) DEFAULT NULL,
  pdh_nome_contato varchar(60) DEFAULT NULL,
  pdh_email_contato varchar(60) DEFAULT NULL,
  pdh_telefone_contato varchar(20) DEFAULT NULL,
  pdh_tipo_orcamento int(15) DEFAULT NULL,
  pdh_versao int(15) DEFAULT NULL,
  pdh_usuario_gravou varchar(20) DEFAULT NULL,
  pdh_hora_gravou varchar(20) DEFAULT NULL,
  pdh_data_gravou varchar(20) DEFAULT NULL,
  pdh_id_cliente_trian varchar(15) DEFAULT NULL,
  pdh_usa_end_ent int(15) DEFAULT NULL,
  pdh_status varchar(10) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_pedido_ped
--


-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_perfil_per
--

CREATE TABLE ptv_perfil_per (
  per_id integer PRIMARY KEY,
  per_nome varchar(40) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_perfil_programa_pep
--

CREATE TABLE ptv_perfil_programa_pep (
  pep_id integer PRIMARY KEY,
  pep_per_id integer NOT NULL,
  pep_pro_id integer NOT NULL,
  pep_acessar integer NOT NULL DEFAULT 0,
  pep_incluir integer NOT NULL DEFAULT 0,
  pep_alterar integer NOT NULL DEFAULT 0,
  pep_lixeira integer NOT NULL DEFAULT 0
)
go


CREATE INDEX fk_perfil_programa_perfil ON ptv_perfil_programa_pep (pep_per_id)
GO


CREATE INDEX fk_perfil_programa_programa ON ptv_perfil_programa_pep (pep_pro_id)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_perfil_usuario_pfu
--

CREATE TABLE ptv_perfil_usuario_pfu (
  pfu_id integer PRIMARY KEY,
  pfu_per_id integer NOT NULL,
  pfu_usu_id integer NOT NULL
)
go

CREATE INDEX fk_perfil_usuario_perfil ON ptv_perfil_usuario_pfu (pfu_per_id)
GO

CREATE INDEX fk_perfil_usuario_usuario ON ptv_perfil_usuario_pfu (pfu_usu_id)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_pessoa_pes
--
-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_produto_prd
--

CREATE TABLE ptv_produto_prd (
  prd_id integer PRIMARY KEY,
  prd_descricao varchar(100) NOT NULL,
  prd_referencia varchar(20) DEFAULT NULL,
  prd_codigo_barras varchar(14) DEFAULT NULL,
  prd_ncm varchar(8) NOT NULL,
  prd_preco_custo float(10,6) NOT NULL,
  prd_und_id integer NOT NULL,
  prd_fam_id integer DEFAULT NULL,
  prd_gru_id integer DEFAULT NULL,
  prd_sgp_id integer DEFAULT NULL,
  KEY fk_prd_unidade_medida (prd_und_id),
  KEY fk_prd_familia (prd_fam_id),
  KEY fk_prd_grupo (prd_gru_id),
  KEY fk_prd_sub_grupo (prd_sgp_id)
)
go

CREATE INDEX fk_prd_unidade_medida ON ptv_produto_prd (prd_und_id)
GO

CREATE INDEX fk_prd_familia ON ptv_produto_prd (prd_fam_id)
GO

CREATE INDEX fk_prd_grupo ON ptv_produto_prd (prd_gru_id)
GO

CREATE INDEX fk_prd_sub_grupo ON ptv_produto_prd (prd_sgp_id)
GO
-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_programa_modulo_pgm
--

CREATE TABLE ptv_programa_modulo_pgm (
  pgm_id integer PRIMARY KEY,
  pgm_pro_id integer NOT NULL,
  pgm_mod_id integer NOT NULL
)
go

CREATE INDEX uq_pgm_pro_id ON ptv_programa_modulo_pgm (pgm_pro_id,pgm_mod_id)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_programa_pro
--

CREATE TABLE ptv_programa_pro (
  pro_id integer PRIMARY KEY,
  pro_descricao_curta varchar(20) NOT NULL,
  pro_descricao varchar(60) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_reducao_estoque_rde
--

CREATE TABLE ptv_reducao_estoque_rde (
  rde_id integer PRIMARY KEY,
  rde_cod_item varchar(20) DEFAULT NULL,
  rde_quantidade_reduzida varchar(20) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_servico_ser
--

CREATE TABLE ptv_servico_ser (
  ser_id integer PRIMARY KEY,
  ser_descricao varchar(100) NOT NULL,
  ser_referencia varchar(20) DEFAULT NULL,
  ser_und_id integer NOT NULL,
  ser_preco_custo decimal(10,6) NOT NULL,
  KEY fk_ser_unidade_medida (ser_und_id)
)
go

CREATE INDEX fk_ser_unidade_medida ON ptv_servico_ser (ser_und_id)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_sub_grupo_sgp
--

CREATE TABLE ptv_sub_grupo_sgp (
  sgp_id integer PRIMARY KEY,
  sgp_nome varchar(40) NOT NULL,
  sgp_gru_id integer NOT NULL,
  KEY fk_grupo_sub_grupo (sgp_gru_id)
)
go


CREATE INDEX fk_grupo_sub_grupo ON ptv_sub_grupo_sgp (sgp_gru_id)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_telas_programa_tlp
--

CREATE TABLE ptv_telas_programa_tlp (
  tlp_id integer PRIMARY KEY,
  tlp_pro_id integer DEFAULT NULL,
  tlp_nome_arquivo varchar(100) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_tipo_documento_tdc
--

CREATE TABLE ptv_tipo_documento_tdc (
  tdc_id integer PRIMARY KEY,
  tdc_tipo varchar(60) DEFAULT NULL,
  tdc_obrigatorio integer DEFAULT NULL,
  tdc_validade_dias varchar(20) DEFAULT NULL,
  tdc_libera_obrigatorio integer DEFAULT 0
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_tipo_endereco_tpe
--

CREATE TABLE ptv_tipo_endereco_tpe (
  tpe_id integer PRIMARY KEY,
  tpe_nome varchar(100) NOT NULL,
  tpe_codigo varchar(20) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_tipo_frete_tfr
--

CREATE TABLE ptv_tipo_frete_tfr (
  tfr_id integer PRIMARY KEY,
  tfr_cod varchar(25) DEFAULT NULL,
  tfr_descricao varchar(60) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_tipo_pedido_tpd
--

CREATE TABLE ptv_tipo_pedido_tpd (
  tpd_id integer PRIMARY KEY,
  tpd_cod varchar(30) DEFAULT NULL,
  tpd_descricao varchar(100) DEFAULT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_tipo_pessoa_tps
--


-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_tipo_venda_tpv
--

CREATE TABLE ptv_tipo_venda_tpv (
  tpv_id integer PRIMARY KEY,
  tpv_cod_tipo_venda int(15) NOT NULL,
  tpv_descricao_tipo_venda char(15) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_unidade_medida_und
--

CREATE TABLE ptv_unidade_medida_und (
  und_id integer PRIMARY KEY,
  und_codigo varchar(6) NOT NULL,
  und_descricao varchar(30) NOT NULL
)
go

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_usuario_programa_upg
--

CREATE TABLE ptv_usuario_programa_upg (
  upg_id integer PRIMARY KEY,
  upg_usu_id integer NOT NULL,
  upg_pro_id integer NOT NULL,
  upg_acessar integer NOT NULL DEFAULT 0,
  upg_incluir integer NOT NULL DEFAULT 0,
  upg_alterar integer NOT NULL DEFAULT 0,
  upg_lixeira integer NOT NULL DEFAULT 0
)
go

CREATE INDEX fk_upg_usuario ON ptv_usuario_programa_upg (upg_usu_id)
GO


CREATE INDEX fk_upg_programa ON ptv_usuario_programa_upg (upg_pro_id)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela ptv_usuario_usu
--

CREATE TABLE ptv_usuario_usu (
  usu_id integer PRIMARY KEY,
  usu_nome varchar(60) NOT NULL,
  usu_usuario varchar(20) NOT NULL,
  usu_senha varchar(250) NOT NULL,
  usu_ultimo_login varchar(20) NOT NULL,
  usu_ramal varchar(10) DEFAULT NULL,
  usu_usuario_erp INTEGER DEFAULT NULL,
  usu_representante_erp varchar(15) DEFAULT NULL,
  usu_email varchar(100) DEFAULT NULL,
  usu_fax varchar(25) DEFAULT NULL,
  usu_carteira varchar(20) DEFAULT NULL,
  usu_modifica_pedido_erp integer DEFAULT NULL,
  usu_cadastra_pedido_outros integer DEFAULT NULL,
  usu_telefone varchar(25) DEFAULT NULL,
  usu_imagem text,
  usu_email_secundario varchar(100) DEFAULT NULL,
  usu_modifica_cliente_erp integer DEFAULT NULL,
  usu_libera_pedido_fechado INTEGER NOT NULL DEFAULT 0,
  CONSTRAINT uq_usu_usuario UNIQUE (usu_usuario)
)
go

CREATE UNIQUE uq_usu_usuario ON ptv_usuario_usu (usu_usuario)
GO

-- --------------------------------------------------------

--
-- Estrutura da tabela pvt_itens_pedido_ipd
--

CREATE TABLE pvt_itens_pedido_ipd (
  ipd_id integer PRIMARY KEY,
  ipd_sequencia integer DEFAULT NULL,
  ipd_usp_id varchar(15) DEFAULT NULL,
  ipd_ped_id varchar(15) DEFAULT NULL,
  ipd_item_cod varchar(25) DEFAULT NULL,
  ipd_descricao_item varchar(256) DEFAULT NULL,
  ipd_texto_item varchar(380) DEFAULT NULL,
  ipd_quantidade varchar(50) DEFAULT NULL,
  ipd_preco_bruto varchar(30) DEFAULT NULL,
  ipd_prazo_entrega varchar(14) DEFAULT NULL,
  ipd_voltagem varchar(30) DEFAULT NULL,
  ipd_comissao varchar(6) DEFAULT NULL,
  ipd_qtd_cancelada varchar(50) DEFAULT '0'
)
go

CREATE TABLE pvt_cor_item_cim (
  cim_id integer PRIMARY KEY,
  cim_ipd_id integer DEFAULT NULL,
  cim_codigo varchar(25) DEFAULT NULL,
  cim_local varchar(60) DEFAULT NULL,
  cim_descricao varchar(256) DEFAULT NULL,
  cim_comprimento_cor varchar(35) DEFAULT NULL,
  CONSTRAINT fk_cim_id FOREIGN KEY (cim_id) REFERENCES ptv_entidade_ent (ent_id),
  CONSTRAINT fk_cim_ipd_id FOREIGN KEY (cim_ipd_id) REFERENCES pvt_itens_pedido_ipd (ipd_id)
)
go

CREATE TABLE pvt_manequim_item_mqi (
  mqi_id integer PRIMARY KEY,
  mqi_ipd_id integer DEFAULT NULL,
  mqi_codigo varchar(25) DEFAULT NULL,
  mqi_codigo_cliente varchar(25) DEFAULT NULL,
  mqi_observacao varchar(256) DEFAULT NULL,
  CONSTRAINT fk_mqi_id FOREIGN KEY (mqi_id) REFERENCES ptv_entidade_ent (ent_id),
  CONSTRAINT fk_mqi_ipd_id FOREIGN KEY (mqi_ipd_id) REFERENCES pvt_itens_pedido_ipd (ipd_id)
)
go

CREATE TABLE pvt_desenho_item_dni (
  dni_id integer PRIMARY KEY,
  dni_ipd_id integer DEFAULT NULL,
  dni_desenho varchar(45) DEFAULT NULL,
  dni_observacao varchar(4000) DEFAULT NULL,
  CONSTRAINT fk_dni_id FOREIGN KEY (dni_id) REFERENCES ptv_entidade_ent (ent_id),
  CONSTRAINT fk_dni_ipd_id FOREIGN KEY (dni_ipd_id) REFERENCES pvt_itens_pedido_ipd (ipd_id)
)
go



CREATE TABLE PVT_SIMULADOR_FAIXA_ITEM_SMF (
  smf_id integer PRIMARY KEY,
  smf_codigo_item varchar(25) DEFAULT NULL,
  smf_qtd_inicial varchar(45) DEFAULT NULL,
  smf_qtd_final varchar(45) DEFAULT NULL,
  smf_preco_milheiro varchar(20) DEFAULT NULL,
  smf_preco_unitario varchar(20) DEFAULT NULL,
  smf_fator varchar(10) DEFAULT NULL,
  CONSTRAINT fk_smf_id FOREIGN KEY (smf_id) REFERENCES ptv_entidade_ent (ent_id)
)
go

CREATE TABLE ptv_condicao_pagto_cliente_cpc (
  cpc_id integer PRIMARY KEY,
  cpc_pes_id integer DEFAULT NULL,
  cpc_condicao_pagamento_id integer DEFAULT NULL,
  cpc_ver integer DEFAULT NULL,
    FOREIGN KEY (cpc_pes_id) REFERENCES ptv_pessoa_pes(pes_id),
	 FOREIGN KEY (cpc_condicao_pagamento_id) REFERENCES ptv_condicao_pagamento_cdp(cdp_id)
)
go
CREATE TABLE IF NOT EXISTS `ptv_condicao_pagamento_cliente_cpc` (
  `cpc_id` int(11) NOT NULL,
  `cpc_pes_id` int(11) DEFAULT NULL,
  `cpc_condicao_pagamento_id` int(11) DEFAULT NULL,
  `cpc_ver` int(15) DEFAULT NULL,
  PRIMARY KEY (`cpc_id`),
   FOREIGN KEY (cpc_pes_id) REFERENCES ptv_pessoa_pes(pes_id),
 FOREIGN KEY  cpc_condicao_pagamento_id (`cpc_condicao_pagamento_id`)
) 


CREATE TABLE ptv_comentario_pessoa_ctp(
    ctp_id                   INTEGER not null PRIMARY KEY,
    ctp_pes_id                      int(11),
    ctp_comentario                  varchar(250),
    FOREIGN KEY(ctp_id) REFERENCES ptv_entidade_ent(ent_id), 
   FOREIGN KEY(ctp_pes_id) REFERENCES ptv_pessoa_pes(pes_id)
)
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela ptv_cfop_cfo
--
ALTER TABLE ptv_cfop_cfo
  ADD CONSTRAINT fk_cfo_id FOREIGN KEY (cfo_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_cidade_cid
--
ALTER TABLE ptv_cidade_cid
  ADD CONSTRAINT fk_cid_estado FOREIGN KEY (cid_est_id) REFERENCES ptv_estado_est (est_id),
  ADD CONSTRAINT fk_cid_id FOREIGN KEY (cid_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_condicao_pagamento_cdp
--
ALTER TABLE ptv_condicao_pagamento_cdp
  ADD CONSTRAINT fk_cdp_id FOREIGN KEY (cdp_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_condicao_pagamento_cliente_cpc
--
ALTER TABLE ptv_condicao_pagamento_cliente_cpc
  ADD CONSTRAINT fk_cpc_condicao_pagamento_id FOREIGN KEY (cpc_condicao_pagamento_id) REFERENCES ptv_condicao_pagamento_cdp (cdp_id),
  ADD CONSTRAINT fk_cpc_id FOREIGN KEY (cpc_id) REFERENCES ptv_entidade_ent (ent_id),
  ADD CONSTRAINT fk_pes_id FOREIGN KEY (cpc_pes_id) REFERENCES ptv_pessoa_pes (pes_id);

--
-- Limitadores para a tabela ptv_contato_pessoa_cop
--
ALTER TABLE ptv_contato_pessoa_cop
  ADD CONSTRAINT fk_cop_id FOREIGN KEY (cop_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_defeito_def
--
ALTER TABLE ptv_defeito_def
  ADD CONSTRAINT fk_def_id FOREIGN KEY (def_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_documento_pessoa_dcc
--
ALTER TABLE ptv_documento_pessoa_dcc
  ADD CONSTRAINT fk_dcc_id FOREIGN KEY (dcc_id) REFERENCES ptv_entidade_ent (ent_id),
  ADD CONSTRAINT fk_dcc_tdc_id FOREIGN KEY (dcc_tdc_id) REFERENCES ptv_tipo_documento_tdc (tdc_id);

--
-- Limitadores para a tabela ptv_email_eml
--
ALTER TABLE ptv_email_eml
  ADD CONSTRAINT fk_eml_id FOREIGN KEY (eml_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_email_nfe_pessoa_enp
--
ALTER TABLE ptv_email_nfe_pessoa_enp
  ADD CONSTRAINT fk_enp_id FOREIGN KEY (enp_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_endereco_entrega_pedido_eep
--
ALTER TABLE ptv_endereco_entrega_pedido_eep
  ADD CONSTRAINT fk_eep_cidade FOREIGN KEY (eep_cid_id) REFERENCES ptv_cidade_cid (cid_id),
  ADD CONSTRAINT fk_eep_id FOREIGN KEY (eep_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_endereco_entrega_pedido_historico_eph
--
ALTER TABLE ptv_endereco_entrega_pedido_historico_eph
  ADD CONSTRAINT fk_eph_cidade FOREIGN KEY (eph_cid_id) REFERENCES ptv_cidade_cid (cid_id),
  ADD CONSTRAINT fk_eph_id FOREIGN KEY (eph_id) REFERENCES ptv_entidade_ent (ent_id),
  ADD CONSTRAINT fk_eph_ped_id FOREIGN KEY (eph_ped_id) REFERENCES ptv_pedido_ped (ped_id);

--
-- Limitadores para a tabela ptv_endereco_pessoa_edp
--
ALTER TABLE ptv_endereco_pessoa_edp
  ADD CONSTRAINT fk_edp_cidade FOREIGN KEY (edp_cid_id) REFERENCES ptv_cidade_cid (cid_id),
  ADD CONSTRAINT fk_edp_id FOREIGN KEY (edp_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_estado_est
--
ALTER TABLE ptv_estado_est
  ADD CONSTRAINT fk_est_id FOREIGN KEY (est_id) REFERENCES ptv_entidade_ent (ent_id),
  ADD CONSTRAINT fk_est_pais FOREIGN KEY (est_pai_id) REFERENCES ptv_pais_pai (pai_id);

--
-- Limitadores para a tabela ptv_familia_fam
--
ALTER TABLE ptv_familia_fam
  ADD CONSTRAINT fk_fam_id FOREIGN KEY (fam_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_forma_pagamento_fpg
--
ALTER TABLE ptv_forma_pagamento_fpg
  ADD CONSTRAINT fk_fpg_id FOREIGN KEY (fpg_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_forma_parcelamento_fpc
--
ALTER TABLE ptv_forma_parcelamento_fpc
  ADD CONSTRAINT fk_fpc_id FOREIGN KEY (fpc_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_grupo_gru
--
ALTER TABLE ptv_grupo_gru
  ADD CONSTRAINT fk_grupo_familia FOREIGN KEY (gru_fam_id) REFERENCES ptv_familia_fam (fam_id),
  ADD CONSTRAINT fk_gru_id FOREIGN KEY (gru_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_lista_preco_ltp
--
ALTER TABLE ptv_lista_preco_ltp
  ADD CONSTRAINT fk_ltp_id FOREIGN KEY (ltp_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_menu_men
--
ALTER TABLE ptv_menu_men
  ADD CONSTRAINT fk_menu_menu FOREIGN KEY (men_id_owner) REFERENCES ptv_menu_men (men_id),
  ADD CONSTRAINT fk_menu_programa FOREIGN KEY (men_pro_id) REFERENCES ptv_programa_pro (pro_id),
  ADD CONSTRAINT fk_men_id FOREIGN KEY (men_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_modulo_empresa_mep
--
ALTER TABLE ptv_modulo_empresa_mep
  ADD CONSTRAINT fk_mep_id FOREIGN KEY (mep_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_modulo_mod
--
ALTER TABLE ptv_modulo_mod
  ADD CONSTRAINT fk_mod_id FOREIGN KEY (mod_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_operacoes_opc
--
ALTER TABLE ptv_operacoes_opc
  ADD CONSTRAINT fk_opc_id FOREIGN KEY (opc_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_padroes_modulo_programa_pmp
--
ALTER TABLE ptv_padroes_modulo_programa_pmp
  ADD CONSTRAINT fk_pmp_id FOREIGN KEY (pmp_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_padroes_pad
--
ALTER TABLE ptv_padroes_pad
  ADD CONSTRAINT fk_pad_id FOREIGN KEY (pad_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_pais_pai
--
ALTER TABLE ptv_pais_pai
  ADD CONSTRAINT fk_pai_id FOREIGN KEY (pai_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_parcela_percentual_ppc
--
ALTER TABLE ptv_parcela_percentual_ppc
  ADD CONSTRAINT fk_ppc_forma_parcelamento FOREIGN KEY (ppc_fpc_id) REFERENCES ptv_forma_parcelamento_fpc (fpc_id),
  ADD CONSTRAINT fk_ppc_id FOREIGN KEY (ppc_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_pedido_dig_texto_nota_historio_pnh
--
ALTER TABLE ptv_pedido_dig_texto_nota_historio_pnh
  ADD CONSTRAINT fk_pnh_id FOREIGN KEY (pnh_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_pedido_dig_texto_nota_ptn
--
ALTER TABLE ptv_pedido_dig_texto_nota_ptn
  ADD CONSTRAINT fk_ptn_id FOREIGN KEY (ptn_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_pedido_dig_texto_observacao_historico_toh
--
ALTER TABLE ptv_pedido_dig_texto_observacao_historico_toh
  ADD CONSTRAINT fk_toh_id FOREIGN KEY (toh_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_pedido_dig_texto_observacao_pto
--
ALTER TABLE ptv_pedido_dig_texto_observacao_pto
  ADD CONSTRAINT fk_pto_id FOREIGN KEY (pto_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_pedido_historico_pdh
--
ALTER TABLE ptv_pedido_historico_pdh
  ADD CONSTRAINT fk_pdh_id FOREIGN KEY (pdh_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_pedido_ped
--
ALTER TABLE ptv_pedido_ped
  ADD CONSTRAINT fk_ped_id FOREIGN KEY (ped_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_perfil_per
--
ALTER TABLE ptv_perfil_per
  ADD CONSTRAINT fk_per_id FOREIGN KEY (per_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_perfil_programa_pep
--
ALTER TABLE ptv_perfil_programa_pep
  ADD CONSTRAINT fk_pep_id FOREIGN KEY (pep_id) REFERENCES ptv_entidade_ent (ent_id),
  ADD CONSTRAINT fk_perfil_programa_perfil FOREIGN KEY (pep_per_id) REFERENCES ptv_perfil_per (per_id),
  ADD CONSTRAINT fk_perfil_programa_programa FOREIGN KEY (pep_pro_id) REFERENCES ptv_programa_pro (pro_id);

--
-- Limitadores para a tabela ptv_perfil_usuario_pfu
--
ALTER TABLE ptv_perfil_usuario_pfu
  ADD CONSTRAINT fk_perfil_usuario_perfil FOREIGN KEY (pfu_per_id) REFERENCES ptv_perfil_per (per_id),
  ADD CONSTRAINT fk_perfil_usuario_usuario FOREIGN KEY (pfu_usu_id) REFERENCES ptv_usuario_usu (usu_id),
  ADD CONSTRAINT fk_pfu_id FOREIGN KEY (pfu_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_produto_prd
--
ALTER TABLE ptv_produto_prd
  ADD CONSTRAINT fk_prd_familia FOREIGN KEY (prd_fam_id) REFERENCES ptv_familia_fam (fam_id),
  ADD CONSTRAINT fk_prd_grupo FOREIGN KEY (prd_gru_id) REFERENCES ptv_grupo_gru (gru_id),
  ADD CONSTRAINT fk_prd_id FOREIGN KEY (prd_id) REFERENCES ptv_entidade_ent (ent_id),
  ADD CONSTRAINT fk_prd_sub_grupo FOREIGN KEY (prd_sgp_id) REFERENCES ptv_sub_grupo_sgp (sgp_id),
  ADD CONSTRAINT fk_prd_unidade_medida FOREIGN KEY (prd_und_id) REFERENCES ptv_unidade_medida_und (und_id);

--
-- Limitadores para a tabela ptv_programa_modulo_pgm
--
ALTER TABLE ptv_programa_modulo_pgm
  ADD CONSTRAINT fk_pgm_id FOREIGN KEY (pgm_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_programa_pro
--
ALTER TABLE ptv_programa_pro
  ADD CONSTRAINT fk_pro_id FOREIGN KEY (pro_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_reducao_estoque_rde
--
ALTER TABLE ptv_reducao_estoque_rde
  ADD CONSTRAINT fk_rde_id FOREIGN KEY (rde_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_servico_ser
--
ALTER TABLE ptv_servico_ser
  ADD CONSTRAINT fk_ser_id FOREIGN KEY (ser_id) REFERENCES ptv_entidade_ent (ent_id),
  ADD CONSTRAINT fk_ser_unidade_medida FOREIGN KEY (ser_und_id) REFERENCES ptv_unidade_medida_und (und_id);

--
-- Limitadores para a tabela ptv_sub_grupo_sgp
--
ALTER TABLE ptv_sub_grupo_sgp
  ADD CONSTRAINT fk_grupo_sub_grupo FOREIGN KEY (sgp_gru_id) REFERENCES ptv_grupo_gru (gru_id),
  ADD CONSTRAINT fk_sgp_id FOREIGN KEY (sgp_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_telas_programa_tlp
--
ALTER TABLE ptv_telas_programa_tlp
  ADD CONSTRAINT fk_tlp_id FOREIGN KEY (tlp_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_tipo_documento_tdc
--
ALTER TABLE ptv_tipo_documento_tdc
  ADD CONSTRAINT fk_tdc_id FOREIGN KEY (tdc_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_tipo_endereco_tpe
--
ALTER TABLE ptv_tipo_endereco_tpe
  ADD CONSTRAINT fk_tpe_id FOREIGN KEY (tpe_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_tipo_frete_tfr
--
ALTER TABLE ptv_tipo_frete_tfr
  ADD CONSTRAINT fk_tfr_id FOREIGN KEY (tfr_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_tipo_pedido_tpd
--
ALTER TABLE ptv_tipo_pedido_tpd
  ADD CONSTRAINT fk_tpd_id FOREIGN KEY (tpd_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_tipo_pessoa_tps
--
ALTER TABLE ptv_tipo_pessoa_tps
  ADD CONSTRAINT fk_tps_id FOREIGN KEY (tps_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_tipo_venda_tpv
--
ALTER TABLE ptv_tipo_venda_tpv
  ADD CONSTRAINT fk_tpv_id FOREIGN KEY (tpv_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_unidade_medida_und
--
ALTER TABLE ptv_unidade_medida_und
  ADD CONSTRAINT fk_und_id FOREIGN KEY (und_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela ptv_usuario_programa_upg
--
ALTER TABLE ptv_usuario_programa_upg
  ADD CONSTRAINT fk_upg_id FOREIGN KEY (upg_id) REFERENCES ptv_entidade_ent (ent_id),
  ADD CONSTRAINT fk_upg_programa FOREIGN KEY (upg_pro_id) REFERENCES ptv_programa_pro (pro_id),
  ADD CONSTRAINT fk_upg_usuario FOREIGN KEY (upg_usu_id) REFERENCES ptv_usuario_usu (usu_id);

--
-- Limitadores para a tabela ptv_usuario_usu
--
ALTER TABLE ptv_usuario_usu
  ADD CONSTRAINT fk_usu_id FOREIGN KEY (usu_id) REFERENCES ptv_entidade_ent (ent_id);

--
-- Limitadores para a tabela pvt_itens_pedido_ipd
--
ALTER TABLE pvt_itens_pedido_ipd
  ADD CONSTRAINT fk_ipd_id FOREIGN KEY (ipd_id) REFERENCES ptv_entidade_ent (ent_id);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
