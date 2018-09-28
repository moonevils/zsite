CREATE TABLE IF NOT EXISTS `eps_bearlog` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `objectType` varchar(30) NOT NULL,
  `objectID` mediumint(9) NOT NULL,
  `account` varchar(30) NOT NULL,
  `status` char(30) NOT NULL,
  `response` text NOT NULL,
  `time` datetime NOT NULL,
  `auto` enum('yes', 'no') NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account` (`account`),
  KEY `type` (`type`),
  KEY `objectType` (`objectType`),
  KEY `objectID` (`objectID`),
  KEY `time` (`time`),
  KEY `lang` (`lang`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
