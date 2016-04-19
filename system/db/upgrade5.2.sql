ALTER TABLE `eps_layout` ADD object char(30) NOT NULL AFTER `region`;
ALTER TABLE `eps_order` CHANGE express express char(30) NOT NULL AFTER waybill;
-- DROP TABLE IF EXISTS `eps_widget`;
CREATE TABLE `eps_widget` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` char(30) NOT NULL,
  `type`    char(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `params` text NOT NULL,
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `grid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `hidden` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`),
  UNIQUE KEY `accountAppOrder` (`account`, `order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
