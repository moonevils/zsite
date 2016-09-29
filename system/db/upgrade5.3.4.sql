CREATE TABLE `eps_farm` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `url` char(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `admin` char(30) NOT NULL,
  `password` char(32) NOT NULL,
  `private` char(32) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `eps_order` change status status enum('normal','canceled','finished','deleted','expired') NOT NULL DEFAULT 'normal';
