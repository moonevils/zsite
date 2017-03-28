ALTER TABLE `eps_article` ADD `titleColor`     varchar(10) NOT NULL AFTER `onlyBody`;
ALTER TABLE `eps_product` ADD `titleColor`     varchar(10) NOT NULL AFTER `js`;
ALTER TABLE `eps_user`    ADD `notification`   varchar(20) NOT NULL DEFAULT 'mail,' AFTER `security`;
ALTER TABLE `eps_file`    CHANGE `primary` `order` smallint(5) unsigned NOT NULL;
ALTER TABLE `eps_category` ADD `discussion` enum('0', '1') NOT NULL DEFAULT '0' AFTER `unsaleable`;
ALTER TABLE `eps_thread` ADD `discussion` enum('0', '1') NOT NULL DEFAULT '0' AFTER `title`;
ALTER TABLE `eps_reply` ADD `reply` mediumint(8) unsigned NOT NULL AFTER `thread`;
