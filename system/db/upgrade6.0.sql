ALTER TABLE `eps_article` ADD `titleColor`     varchar(10) NOT NULL AFTER `onlyBody`;
ALTER TABLE `eps_product` ADD `titleColor`     varchar(10) NOT NULL AFTER `js`;
ALTER TABLE `eps_user`    ADD `notification`   varchar(20) NOT NULL DEFAULT 'mail,' AFTER `security`;
ALTER TABLE `eps_file`    CHANGE `primary` `order` smallint(5) unsigned NOT NULL;
ALTER TABLE `eps_category` ADD `discussion` enum('0', '1') NOT NULL DEFAULT '0' AFTER `unsaleable`;
ALTER TABLE `eps_thread` ADD `discussion` enum('0', '1') NOT NULL DEFAULT '0' AFTER `title`;
ALTER TABLE `eps_reply` ADD `reply` mediumint(8) unsigned NOT NULL AFTER `thread`;
ALTER TABLE `eps_order` ADD `refundSN` char(50) NOT NULL AFTER `sn`;
ALTER TABLE `eps_order` CHANGE `payStatus` `payStatus` enum('not_paid', 'paid', 'refunded') NOT NULL DEFAULT 'not_paid';

-- DROP TABLE IF EXISTS `eps_action`;
CREATE TABLE IF NOT EXISTS `eps_action` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `objectType` varchar(30) NOT NULL default '',
  `objectID` mediumint(8) unsigned NOT NULL default '0',
  `actor` varchar(30) NOT NULL default '',
  `action` varchar(30) NOT NULL default '',
  `date` datetime NOT NULL,
  `comment` text NOT NULL,
  `extra` varchar(255) NOT NULL,
  `lang` char(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
