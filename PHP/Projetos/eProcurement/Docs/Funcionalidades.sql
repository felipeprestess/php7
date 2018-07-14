# CRIA PROGRAMA E VINCULA AO MODULO#


DECLARE @idPrograma int;
DECLARE @idProgramaPerfil int;
DECLARE @nomePrograma varchar(30);
DECLARE @descricaoPrograma varchar(30);
DECLARE @idModulo int;
DECLARE @codPtvPrograma varchar(20);

--Deve ser setado manualemente o nome e descricao do programa e modulo
set @idModulo = 2;
set @nomePrograma =	'Faturamento Diario';
set @descricaoPrograma =	'Faturamento Diario';
set @codPtvPrograma =	'PTV0081';
-- fim

set @idPrograma = (select max(ent_id)+1 from PTV_ENTIDADE_ENT);
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (@idPrograma,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0);
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao, pro_cod_ptv) VALUES(@idPrograma, @nomePrograma, @descricaoPrograma,@codPtvPrograma);


set @idProgramaPerfil = (select max(ent_id)+1 from PTV_ENTIDADE_ENT);
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (@idProgramaPerfil,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0);
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(@idProgramaPerfil, @idPrograma, @idModulo);



# FIM CRIA PROGRAMA E VINCULA AO MODULO#

# CRIA PARAMETRO E VINCULA AO MODULO#


DECLARE @id int;
DECLARE @nomeParametro varchar(60);
DECLARE @descricaoParametro varchar(256);
DECLARE @valorParametro varchar(256);
DECLARE @tipoParametro varchar(30);
DECLARE @idModulo int;


--Deve ser setado manualemente o nome e descricao do programa e modulo
set @idModulo = 2;
set @nomeParametro =	'UTILIZA PERCA PEDIDO';
set @descricaoParametro =	'Parametro que habilita a opcao de perca de pedidos no portal, onde os pedidos e itens deixam de ser excluido e comecam a ser perdidos.';
set @valorParametro = '0';
set @tipoParametro = 'checkbox';
-- fim

set @id = (select max(ent_id)+1 from PTV_ENTIDADE_ENT);
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (@id,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0);
 INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo,PMP_DESCRICAO)
 VALUES(@id, 'P', @idModulo, @nomeParametro, @valorParametro, @tipoParametro,@descricaoParametro);


# FIM CRIA PARAMETRO E VINCULA AO MODULO#