
update ptv_programa_pro set pro_cod_ptv = 'PTV0008' where pro_id = 5
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0009' where pro_id = 6
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0010' where pro_id = 7
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0011' where pro_id = 8
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0012' where pro_id = 9
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0013' where pro_id = 10
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0014' where pro_id = 11
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0015' where pro_id = 12
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0016' where pro_id = 13
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0017' where pro_id = 14
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0018' where pro_id = 15
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0019' where pro_id = 16
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0020' where pro_id = 17
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0021' where pro_id = 18
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0022' where pro_id = 19
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0023' where pro_id = 20
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0024' where pro_id = 21
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0025' where pro_id = 22
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0026' where pro_id = 23
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0027' where pro_id = 24
GO
update ptv_programa_pro set pro_cod_ptv = 'PTV0028' where pro_id = 25
GO


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (70,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(70, 'P', 6, 'Usa Lista Preco Pedido', '0', 'checkbox') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (71,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(71, 'P', 8, 'Informa Portador Cliente', '0', 'text')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (72,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(72, 'P', 8, 'Classe Cliente', 'A', 'text')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (73,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(73, 'P', 6, 'Situacao de Entrada do Pedido', 'N', 'text')   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (74,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(74, 'P', 6, 'Pedido entra sem Lista de preco', '1', 'checkbox')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (75,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(75, 'P', 6, 'Data entrega em dias', '0', 'checkbox')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (76,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(76, 'P', 6, 'Condicao de pagamento direto erp', '1', 'checkbox')
   go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (77,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(77, 'P', 6, 'Usa Descontos', '0', 'checkbox')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (78,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(78, 'P', 6, 'Qtd de descontos em cascata', '0', 'text')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (79,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(79, 'P', 6, 'Quantidade de casa decimais', '4', 'number') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (80,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(80, 'P', 8, 'Cod Gru. E-mail Nfe', '1', 'text') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (81,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(81, 'P', 8, 'Descricao gru. e-mail Nfe', 'GUABIFIOS', 'text')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (82,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(82, 'P', 24, 'Qtd meses intivacao', '3', 'number')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (83,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(83, 'P', 24, 'Carteira transicao', '12', 'number') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (84,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(84, 'P', 6, 'Consi. ped. aberto saldo estoque', '1', 'checkbox')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (85,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(85, 'P', 8, 'Fornecedor integra ao contas a receber', '1', 'checkbox') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (86,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(86, 'P', 6, 'Incluir pedido sem estoque', '1', 'checkbox')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (87,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(87, 'P', 6, 'Sugere Respon/Repres canal venda', '1', 'checkbox')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (88,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(88, 'P', 6, 'Pedido fechado', '1', 'checkbox') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (89,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(89, 'P', 6, 'Permite Item sem Preco', '0', 'checkbox')
   go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (90,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_padroes_modulo_prog_pmp (pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo) VALUES(90, 'P', 6, 'Mot. cancel. Total', '1', 'text')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (91,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_perfil_per (per_id, per_nome) VALUES(91, 'Administrador') 
go





INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150183, 'P', 6, 'Amarra lista preco a regiao fiscal', '1', 'checkbox', 'Amarra Lista de preço à regiçao fiscal')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150183,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150184, 'P', 6, 'Exibe Quantidade Liberada Benef', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150184,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150185, 'P', 18, 'Nivel Analista ERP', '3', 'text', 'Nivel Analista ERP')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150185,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150186, 'P', 18, 'Nivel Representante ERP', '4', 'text', 'Nivel Analista ERP')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150186,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150187, 'P', 6, 'Entrada pedido necessita aprovacao comercial', '1', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150187,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150188, 'P', 6, 'Entrada pedido necessita aprovacao financeira', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150188,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150189, 'P', 6, 'Sugere enderedeco entrega padrao cliente no pedido', '1', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150189,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150190, 'P', 6, 'Utiliza texto item', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150190,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150191, 'P', 6, 'Carteiras que permitem alterar pedido', '04', 'text', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150191,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150192, 'P', 6, 'Utiliza data da aprovacao como data de entrada do pedido', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150192,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150193, 'P', 23, 'E-mails Pedido Isento', '', 'text', 'E-mails Pedido Isento')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150193,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150194, 'P', 6, 'Respeita Range Comissao', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150194,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150195, 'P', 6, 'Mot. cancel. Total', '1', 'text', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150195,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150196, 'P', 6, 'Controle estoque guabi', '1', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150196,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150197, 'P', 6, 'Utiliza reordenar itens', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150197,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150198, 'P', 6, 'Desconto item SC', '0', 'number', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150198,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150199, 'P', 6, 'Mostra endereco entrega', '1', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150199,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150200, 'P', 6, 'Emails cancelamento pedido/orc', 'rodrigo@forgesolucoes.com.br', 'text', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150200,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150201, 'P', 6, 'Transicao', '37', 'number', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150201,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150202, 'P', 6, 'Amarra empresa operacao fiscal no pedido', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150202,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150203, 'P', 6, 'Permite pedido previsao', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150203,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150204, 'P', 5, 'Logoff Sistema', '2017-05-18T10:48', 'datetime-local', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150204,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150205, 'P', 5, 'Fim Logoff Sistema', '2017-05-18T10:48', 'datetime-local', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150205,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150206, 'P', 5, 'Senha Padrao', '@forge2016', 'text', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150206,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150207, 'P', 23, 'Aprova Detalhes', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150207,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150208, 'P', 23, 'Aprova Contatos', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150208,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150209, 'P', 23, 'Aprova Documentos', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150209,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150210, 'P', 23, 'Aprova Enderecos', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150210,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150211, 'P', 23, 'Aprova Comentarios', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150211,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150212, 'P', 23, 'Aprova E-mail NFE', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150212,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150213, 'P', 23, 'Aprova Cond ptgo cliente', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150213,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150214, 'P', 8, 'obriga preencher principais clientes e fornecedores', '1', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150214,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150275, 'P', 8, 'Utiliza Quantidade max dias cond pagamento', '0', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150275,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150368, 'P', 8, 'Obriga preencher Data Nasc/Fundacao', '1', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150368,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150667, 'P', 8, 'Credito inicial cliente', '1', 'text', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150667,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150668, 'P', 8, 'Validade credito inicial', '01/01/2999', 'text', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150668,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150669, 'P', 8, 'Situacao aprovacao credito inicial', '1', 'text', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150669,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150674, 'P', 8, 'Codigo empresa logix', '16', 'text', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150674,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO

INSERT INTO informix.ptv_padroes_modulo_prog_pmp(pmp_id, pmp_tipo, pmp_pro_mod_id, pmp_parametro, pmp_valor, pmp_tipo_campo, pmp_descricao)
  VALUES(150683, 'P', 8, 'Gera codigo sequencial erp', '1', 'checkbox', '')
GO
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (150683,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 GO


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (1,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO PTV_MODULO_MOD(MOD_ID, MOD_NOME, MOD_DESCRICAO_CURTA, MOD_DESCRICAO) VALUES(1, 'Framework', 'Framework', 'Modulo do Framework do sistema')
go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (2,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO PTV_MODULO_MOD(MOD_ID, MOD_NOME, MOD_DESCRICAO_CURTA, MOD_DESCRICAO) VALUES(2, 'Pedidos', 'Pedidos', 'Modulo de pedidos do portal')
go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (3,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO PTV_MODULO_MOD(MOD_ID, MOD_NOME, MOD_DESCRICAO_CURTA, MOD_DESCRICAO) VALUES(3, 'Clientes', 'Cadastro de Clientes', 'Modulo de cadastro de clientes')
go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (4,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO PTV_MODULO_MOD(MOD_ID, MOD_NOME, MOD_DESCRICAO_CURTA, MOD_DESCRICAO) VALUES(4, 'Administracao', 'Administrativo', 'Modulo para administracao do sistema')
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (5,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(5, 'Home', 'Cadastro de Home')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (6,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(6, 'Pedido', 'Cadastro de Pedido')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (7,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(7, 'Operacoes', 'Cadastro de Operacoes')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (8,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(8, 'Cliente', 'Cadastro de Cliente')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (9,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(9, 'Tipo Frete', 'Cadastro de tipo de frete')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (10,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(10, 'Lista Preco', 'Cadastro de Lista de preco')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (11,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(11, 'Condicao Pagamento', 'Cadastro de condicao de pagamento') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (12,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(12, 'Tipo Cliente', 'Cadastro tipo de pessoa') 
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (13,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(13, 'Tipo Documento', 'Cadastro tipo documento')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (14,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(14, 'Administracao', 'Programa principal modulo administrativo') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (15,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
  go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(15, 'Perfil', 'Cadastro de Perfil') 
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (16,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(16, 'Perfil x Programa', 'Cadastro de programa por perfil')   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (17,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(17, 'Perfil x Usuario', 'Cadastro de usuario por perfil')   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (18,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(18, 'Usuario', 'Cadastro de usuarios do sistema')   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (19,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(19, 'Tipo Endereco', 'Cadastro de tipo endereco')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (20,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(20, 'Parametros', 'Cadastro de Padroes')   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (21,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(21, 'Aprovacao', 'Aprovacoes dos pedidos')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (22,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(22, 'Reducao de Estoque', 'Programa  para reducao de estoque')   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (23,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(23, 'Aprovacao de Cliente', 'Programa para aprovacao de cliente') 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (24,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(24, 'Rotinas', 'Programa para rotinas')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (25,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(25, 'Estoque', 'Estoque cliente')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (26,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go

INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES (26, 5, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (27,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(27, 6, 2)   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (28,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(28, 7, 2)   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (29,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(29, 8, 3)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (30,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(30, 9, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (31,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(31, 10, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (32,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(32, 11, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (33,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(33, 148, 3)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (34,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(34, 13, 3)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (35,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(35, 14, 4)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (36,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(36, 15, 4)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (37,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(37, 16, 4) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (38,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(38, 17, 4)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (39,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(39, 18, 4)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (40,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(40, 19, 3)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (41,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(41, 20, 4)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (42,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(42, 21, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (43,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(43, 22, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (44,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(44, 23, 3)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (45,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(45, 24, 4)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (46,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(46, 25, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (47,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go




INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(47, 5, 1, 'Home', 'Home.php', NULL, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (48,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(48, 6, 1, 'Pedido', '', NULL, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (49,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(49, 6, 0, 'Pedido', 'Pedidos.php', 48, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (50,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(50, 7, 0, 'Operacoes', 'Operacao.php', 48, 2) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (51,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(51, 8, 1, 'Cliente', '', NULL, 3) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (52,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(52, 8, 0, 'Cliente', 'Cliente.php', 51, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (53,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(53, 9, 0, 'Tipo Frete', 'TipoFrete.php', 48, 3)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (54,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(54, 10, 0, 'Lista Preco', 'ListaPreco.php', 48, 4) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (55,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(55, 11, 0, 'Condicao Pagamento', 'CondicaoPagamento.php', 48, 5)   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (56,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(56, 12, 0, 'Tipo Cliente', 'TipoPessoa.php', 51, 2)   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (57,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(57, 13, 0, 'Tipo Documento', 'TipoDocumento.php', 51, 3)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (58,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(58, 14, 1, 'Administrativo', '', NULL, 4) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (59,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(59, 15, 0, 'Perfil', 'Perfil.php', 58, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (60,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(60, 16, 0, 'Programa x perfil', 'ProgramaPorPerfil.php', 58, 2)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (61,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(61, 17, 0, 'Perfil x Usuario', 'PerfilUsuario.php', 58, 3) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (62,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(62, 18, 0, 'Usuario', 'Usuario.php', 58, 4)   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (63,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(63, 19, 0, 'Tipo Endereco', 'TipoEndereco.php', 51, 4) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (64,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(64, 20, 0, 'Parametros', 'Parametros.php', 58, 5) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (65,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(65, 21, 0, 'Aprovacao', 'Aprovacao.php', 48, 6)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (66,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(66, 22, 0, 'Reduzir Estoque', 'ReduzirEstoque.php', 48, 7) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (67,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(67, 23, 0, 'Aprovacao Cliente', 'AprovacaoCLiente.php', 51, 5)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (68,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(68, 23, 0, 'Rotinas', 'Rotinas.php', 58, 6)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (69,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(69, 25, 0, 'Posicao Estoque', 'ReduzirEstoque.php?R=TRUE', 48, 8) 
  go











INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (92,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(92, 91, 5, 1, 1, 1, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (93,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(93, 91, 6, 1, 1, 1, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (94,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(94, 91, 7, 1, 1, 1, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (95,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(95, 91, 8, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (96,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(96, 91, 9, 1, 1, 1, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (97,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(97, 91, 10, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (98,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(98, 91, 11, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (99,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(99, 91, 12, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (100,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(100, 91, 13, 1, 1, 1, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (101,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(101, 91, 14, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (102,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(102, 91, 15, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (103,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(103, 91, 16, 1, 1, 1, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (104,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(104, 91, 17, 1, 1, 1, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (105,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(105, 91, 18, 1, 1, 1, 1)   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (106,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(106, 91, 19, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (107,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(107, 91, 20, 1, 1, 1, 1)
   go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (108,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(108, 91, 21, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (109,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(109, 91, 22, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (110,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(110, 91, 23, 1, 1, 1, 1) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (111,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(111, 91, 24, 1, 1, 1, 1)
   go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (112,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go
INSERT INTO ptv_perfil_programa_pep (pep_id, pep_per_id, pep_pro_id, pep_acessar, pep_incluir, pep_alterar, pep_lixeira) VALUES(112, 91, 25, 1, 1, 1, 1)  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (113,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go


INSERT INTO ptv_perfil_usuario_pfu (pfu_id, pfu_per_id, pfu_usu_id) VALUES (113, 91, 118) 
  go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (114,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0) 
 go


INSERT INTO ptv_tipo_frete_tfr (tfr_id, tfr_cod, tfr_descricao) VALUES(114, '1', 'CIF')   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (115,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_tipo_frete_tfr (tfr_id, tfr_cod, tfr_descricao) VALUES(115, '2', 'CIF-Cobrado')
   go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (116,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go
INSERT INTO ptv_tipo_frete_tfr (tfr_id, tfr_cod, tfr_descricao) VALUES(116, '3', 'FOB')  
 go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (117,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go


INSERT INTO ptv_tipo_pedido_tpd (tpd_id, tpd_cod, tpd_descricao) VALUES (117, '1', 'Venda')   
go
INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (118,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)   
 go


INSERT INTO ptv_usuario_usu (usu_id, usu_nome, usu_usuario, usu_senha, usu_ultimo_login, usu_ramal, usu_usuario_erp, usu_representante_erp, usu_email, usu_fax, usu_carteira, usu_modifica_pedido_erp, usu_cadastra_pedido_outros, usu_telefone, usu_imagem, usu_email_secundario, usu_modifica_cliente_erp, usu_libera_pedido_fechado) VALUES
(118, 'ADMIN', 'ADMIN', '21232f297a57a5a743894a0e4a801fc3', '', '', 0, '400', 'rodrigo@forgesolucoes.com.br', NULL, '', 1, 1, '92874524', '1458764808.jpg', 'rodrigo@forgesolucoes.com.br', 1, 0)
go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (119,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO PTV_MODULO_MOD(MOD_ID, MOD_NOME, MOD_DESCRICAO_CURTA, MOD_DESCRICAO) VALUES(119, 'Configurador Produto', 'Config. Produto', 'Modulo dos cadastros do configurador de produto')




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (220,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(220, null, 1, 'Configurador Produto', null, null, 5)  
 go



INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (221,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(221, 'Restrições e Cadastro de Roteiros', 'Restrições e Cadastro de Roteiros')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (222,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(222, 119, 220)   
go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (223,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(223, 221, 0, 'Restrições e Cadastro de Roteiros', 'null', 221, 1)  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (224,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(224, 'Cor', 'Cor')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (225,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(225, 224, 220)   
go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (226,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(226, 224, 0, 'Cores', 'Cor.php', 221, 1)  
 go



INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (227,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(227, 'Perfil x Condição Pagamento', 'Perfil x Condição Pagamento')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (228,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(228, 227, 4)   
go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (228,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(228, 227, 0, 'Perfil x Condição Pagamento', 'CondicaoPagamentoPerfil.php', 58, 7)  
 go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (229,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO PTV_MODULO_MOD(MOD_ID, MOD_NOME, MOD_DESCRICAO_CURTA, MOD_DESCRICAO) VALUES(229, 'Configurador Preço', 'Config. Preço', 'Modulo dos cadastros do configurador de preço do produto')
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (230,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(230, 'Acrécismo cliente', 'Acrécismo cliente')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (231,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(231, 230, 229)   
go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (232,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(232, null, 1, 'Configurador de preço', null, null, 6)  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (233,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(233, 230, 0, 'Acréscimo de cliente', 'AcrescimoCliente.php', 232, 1)  
 go








INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (234,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(234, 'Acrécismo cond pgto', 'Acrécismo cond pgto')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (235,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(235, 234, 229)   
go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (236,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(236, 234, 0, 'Acréscimo cond ptgo', 'AcrescimoCondicaoPagamento.php', 232, 2)  
 go







INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (237,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(237, 'Acrécismo por cor', 'Acrécismo por cor')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (238,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(238, 237, 229)   
go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (239,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(239, 237, 0, 'Acréscimo por cor', 'AcrescimoCor.php', 232, 3)  
 go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (240,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(240, 'ICMS', 'ICMS')  
 go


INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (241,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(241, 240, 229)   
go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (242,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(242, 240, 0, 'ICMS', 'AcrescimoICMS.php', 232, 4)  
 go





INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (243,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(243, 'Acréscimo por largura', 'Acréscimo por largura')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (244,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(244, 243, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (245,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(245, 243, 0, 'Acréscimo por largura', 'AcrescimoLargura.php', 232, 5)  
 go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (246,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(246, 'Acréscimo por operação', 'Acréscimo por operação')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (247,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(247, 246, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (248,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(248, 246, 0, 'Acréscimo por operação', 'AcrescimoOperacao.php', 232, 6)  
 go



INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (249,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(249, 'Acréscimo operação área', 'Acréscimo operação área')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (250,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(250, 249, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (251,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(251, 249, 0, 'Acréscimo operação área', 'AcrescimoOperacaoArea.php', 232, 7)  
 go





INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (252,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(252, 'Acréscimo parãmetro', 'Acréscimo parãmetro')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (253,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(253, 252, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (254,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(254, 252, 0, 'Acréscimo parãmetro', 'AcrescimoParametro.php', 232, 8)  
 go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (254,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(254, 'Acréscimo recorte', 'Acréscimo recorte')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (255,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(255, 254, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (256,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(256, 254, 0, 'Acréscimo recorte', 'AcrescimoRecorte.php', 232, 9)  
 go



INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (257,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(257, 'Acréscimo tipo fundo', 'Acréscimo tipo fundo')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (258,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(258, 257, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (259,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(259, 257, 0, 'Acréscimo tipo fundo', 'AcrescimoTipoFundo.php', 232, 10)  
 go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (260,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(260, 'Divisor de custo', 'Divisor de custo')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (261,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(261, 260, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (262,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(262, 260, 0, 'Divisor de custo', 'DivisorCusto.php', 232, 11)  
 go




INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (260,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(260, 'Divisor de custo', 'Divisor de custo')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (261,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(261, 260, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (262,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(262, 260, 0, 'Divisor de custo', 'DivisorCusto.php', 232, 11)  
 go



INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (263,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(263, 'Máximo de cores por urdume', 'Máximo de cores por urdume')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (264,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(264, 263, 119)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (265,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(265, 263, 0, 'Divisor de custo', 'DivisorCusto.php', 221, 3)  
 go





INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (275,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(275, 'Simulador Faixa Preco', 'Simulador Faixa preco')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (276,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(276, 275, 229)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (277,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(277, 275, 0, 'Simulador Faixa Preco', 'SimuladorFaixaPreco.php', 76873, 12)  
 go








INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (269,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(269, 'Urdume x Fundo', 'Urdume x Fundo')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (270,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(270, 269, 119)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (271,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(271, 269, 0, 'Urdume x Fundo', 'UrdumeFundo.php', 76873, 4)  
 go





INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (272,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_pro (pro_id, pro_descricao_curta, pro_descricao) VALUES(272, 'Maximo Cor Urdume', 'Maximo Cor Urdume')  
 go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (273,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_programa_modulo_pgm (pgm_id, pgm_pro_id, pgm_mod_id) VALUES(273, 272, 119)   
go

INSERT INTO ptv_entidade_ent(ent_id, ent_criador_id, ent_proprietario_id, ent_modificado_por,
 ent_descricao, ent_observacao, ent_createdtime, ent_modifiedtime, ent_viewedtime, ent_status,
 ent_versao, ent_lixeira, ent_bloqueado) VALUES (274,118,118,118,'Padrao','Padrao','2016-06-16 00:00:00'
 ,'2016-06-16 00:00:00','2016-06-16 00:00:00','OK',1,0,0)  
 go
INSERT INTO ptv_menu_men (men_id, men_pro_id, men_principal, men_descricao_curta, men_destino, men_id_owner, men_ordem) VALUES(274, 272, 0, 'Maximo cor urdume', 'MaximoCorUrdume.php', 76873, 5)  
 go