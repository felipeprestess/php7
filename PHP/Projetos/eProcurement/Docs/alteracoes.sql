#     DIA 30/03/17    #
# # # # # # # # # # # #
# Cliente # TST # PRD #
# # # # # # # # # # # #
#    MP   # OK  #  OK #
#   GUABI # OK  #     #
#   TERMO #     #  OK #
# # # # # # # # # # # #

alter table ptv_pessoa_pes add PES_EXPORTACAO INTEGER DEFAULT 0
go
alter table ptv_pessoa_pes add PES_PRINCIPAIS_CLIENTES varchar2(250) default ''
go
alter table ptv_pessoa_pes add PES_PRINCIPAIS_FORNECEDORES varchar2(250) default ''
go

alter table PTV_OPERACOES_OPC add OPC_LIVRE_DEBITO INTEGER DEFAULT 0
go
alter table PTV_OPERACOES_OPC add OPC_ITEM_INDUSTRIALIZACAO varchar2(25) default ''
go


alter table PTV_OPERACOES_OPC add OPC_LIVRE_DEBITO INTEGER DEFAULT 0
go
alter table PTV_OPERACOES_OPC add OPC_ITEM_INDUSTRIALIZACAO varchar2(25) default ''
go



alter table PTV_LISTA_PRECO_LTP add LTP_CARTEIRA varchar2(50) default ''
go
alter table PTV_LISTA_PRECO_LTP add LTP_TIPO_FRETE integer default null
go
alter table PTV_LISTA_PRECO_LTP add LISTA_PRECO_REGIAO_FISCAL varchar2(250) default ''
go



alter table PTV_ENDERECO_PESSOA_EDP add EDP_SEM_NUMERO integer default 0
go

CREATE TABLE PTV_LINHA_TRABALHO_PESSOA_LTP ( 
    LTP_ID            	INTEGER NOT NULL,
    LTP_LINHA_TRABALHO	VARCHAR2(250) NOT NULL,
    PRIMARY KEY(LTP_ID)
)
go

CREATE TABLE PTV_LINHA_PESSOA_LHP ( 
    LHP_ID            	INTEGER NOT NULL,
    LHP_LTP	INTEGER default null,
    LHP_PES_ID	INTEGER default null,
    PRIMARY KEY(LHP_ID)
)
go

--fazer ainda
CREATE TABLE PTV_ITEM_PROMOCAO_IPM ( 
    IPM_ID            	INTEGER NOT NULL,
    IPM_CODIGO_ITEM	varchar2(25) default '',
    IPM_PESO_MINIMO	INTEGER default null,
    PRIMARY KEY(IPM_ID)
)
go

alter table PTV_CONDICAO_PAGAMENTO_CDP add CDP_BNDS INTEGER default 0
go


alter table PTV_ITENS_PEDIDO_IPD add IPD_ITEM_DESENVOLVIDO varchar(500) default ''
go
alter table PTV_ITENS_PEDIDO_IPD add IPD_DESENV_ESPECIAL_OBS varchar(500) default ''
go
alter table PTV_ITENS_PEDIDO_IPD add IPD_BASE varchar(500) default ''
go
alter table PTV_ITENS_PEDIDO_IPD add IPD_COR_FUNDO varchar(500) default ''
go
alter table PTV_ITENS_PEDIDO_IPD add IPD_ESPAMPA varchar(500) default ''
go
alter table PTV_ITENS_PEDIDO_IPD add IPD_COR_ESPAMPA varchar(500) default ''
go


CREATE TABLE PTV_CONTRO_ITEM_PAI_INDUST_CII ( 
    CII_ID            	INTEGER NOT NULL,
    CII_EMPRESA 	varchar2(2) default '',
    CII_PEDIDO 	varchar2(20) default '',
    CII_SEQ_ITEM_PAI	INTEGER default null,
    CII_SEQ_ITEM_FILHO	INTEGER default null,
    PRIMARY KEY(CII_ID)
)
go
--criar parametro Sugere enderedeco entrega padrao cliente no pedido
# FIM DIA 30/03/17 #







########################################################################
#     DIA 07/04/17    #
# # # # # # # # # # # #
# Cliente # TST # PRD #
# # # # # # # # # # # #
#    MP   #     #     #
#   GUABI # OK  #     #
#   TERMO #     # OK  #
# # # # # # # # # # # #

-- Criar a tabela para cadastro das imagens dos itens do catalogo
CREATE TABLE PTV.PTV_OPERACAO_DESCONTO_SC_ODS ( 
    ODS_ID         	NUMBER(15,5) NOT NULL,
    ODS_OPC_ID   	INTEGER NOT NULL,
    ODS_DESCONTO	VARCHAR(25) NOT NULL,
    CONSTRAINT ODS_ID PRIMARY KEY(ODS_ID)
)
GO



# FIM DIA 05/04/17 #


#     DIA 17/04/17    #
# # # # # # # # # # # #
# Cliente # TST # PRD #
# # # # # # # # # # # #
#    MP   # OK  #     #
#   GUABI #     #     #
#   TERMO #     #  OK #
# # # # # # # # # # # #


CREATE TABLE PTV.PTV_EMAIL_FAT_AMOSTRA_EFA ( 
    EFA_ID         	NUMBER(15,5) NOT NULL,
    EFA_TRANS_NOTA_FISCAL   	INTEGER NOT NULL,
    EFA_EMPRESA	VARCHAR(25) NOT NULL,
    PRIMARY KEY(EFA_ID)
)
GO
CREATE TABLE PTV.PTV_ROTINA_ROT ( 
    ROT_ID         	INTEGER NOT NULL,
    ROT_ROTINA   	varchar(250) NOT NULL,
    ROT_QTD_EXECUCAO_DIA	INTEGER NOT NULL,
    ROT_ATIVA   	INTEGER NOT NULL,
    PRIMARY KEY(ROT_ID)
)
GO
 CREATE TABLE PTV.PTV_ROTINA_EXEC_RTE ( 
    RTE_ID         	INTEGER NOT NULL,
    RTE_ROT_ID   	INTEGER NOT NULL,
    RTE_DATA_HORA       date default sysdate not null,
    PRIMARY KEY(RTE_ID)
)
GO

# FIM DIA 17/04/17 #



#     DIA 03/05/17    #
# # # # # # # # # # # #
# Cliente # TST # PRD #
# # # # # # # # # # # #
#    MP   # OK  #     #
#   GUABI #     #     #
#   TERMO #     #  OK #
# # # # # # # # # # # #


alter table ptv.ptv_ped_status_alcancado_psa add psa_aprovado_comercial integer default 0
go

alter table ptv.ptv_ped_status_alcancado_psa add psa_aprovado_financeiro integer default 0

# FIM DIA 03/05/17 #

alter table ptv_notificacao_not
add NOT_PROGRAMA varchar(20) NULL


#    DIA 12/09/17     #
# # # # # # # # # # # #
# Cliente # TST # PRD #
# # # # # # # # # # # #
#   SA    # OK  #     #
#   BR    # OK  #     #
# # # # # # # # # # # #


alter table PTV_COMENTARIO_PESSOA_CTP add CTP_OGI_ID integer default null

/*
- Criado a tabela PTV_ORIGEM_INTERACAO_OGI
- Criado a tabela PTV_MOT_PERCA_PEDIDO_MPP
*/

#   FIM DIA 12/09/17  #



#    DIA 13/09/17     #
# # # # # # # # # # # #
# Cliente # TST # PRD #
# # # # # # # # # # # #
#   BR    # OK  #  OK #
# # # # # # # # # # # #

ALTER TABLE PTV_CONDICAO_PAGTO_CLIENTE_CPC
ADD CPC_INDICE_DESPESA_FINANCEIRA VARCHAR(20)

/*
- ADICONANDO CAMPO A TABELA tabela PTV_CONDICAO_PAGTO_CLIENTE_CPC
*/

#   FIM DIA 13/09/17  #




#    DIA 14/09/17     #
# # # # # # # # # # # #
# Cliente # TST # PRD #
# # # # # # # # # # # #
#   BR    # OK  #  OK #
# # # # # # # # # # # #

alter table ptv_notificacao_not
modify not_valor  varchar(100)
GO


alter table ptv_notificacao_not
modify not_programa  varchar(10)
GO
alter table ptv_pessoa_pes add PES_CONCORRENTE int default 0

#   FIM DIA 14/09/17  #

















