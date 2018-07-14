/*
* Tabela de entidades do sistema
*/

CREATE TABLE IF NOT EXISTS `ptv_entidade_ent` (
  `ent_id` int(19) NOT NULL AUTO_INCREMENT,
  `ent_criador_id` int(19) NOT NULL DEFAULT '0',
  `ent_proprietario_id` int(19) NOT NULL DEFAULT '0',
  `ent_modificado_por` int(19) NOT NULL DEFAULT '0',
  `ent_modulo` varchar(30) NOT NULL,
  `ent_descricao` text,
  `ent_createdtime` datetime NOT NULL,
  `ent_modifiedtime` datetime NOT NULL,
  `ent_viewedtime` datetime DEFAULT NULL,
  `ent_status` varchar(50) DEFAULT NULL,
  `ent_versao` int(19) NOT NULL DEFAULT '0',
  `ent_lixeira` int(1) NOT NULL DEFAULT '0',
  `ent_bloqueado` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
