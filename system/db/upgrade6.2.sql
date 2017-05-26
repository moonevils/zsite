ALTER TABLE `eps_book` ADD `link` varchar(255) NOT NULL AFTER `order`;
ALTER TABLE `eps_book` ADD `articleID` smallint(5) unsigned not null default 0 AFTER `id`;
ALTER TABLE `eps_wx_public` ADD `remindUsers` text NOT NULL AFTER `addedDate`;
