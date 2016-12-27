ALTER TABLE `eps_file` CHANGE `size` `size` int(10) UNSIGNED NOT NULL;
ALTER TABLE `eps_blacklist` ADD `addedDate` datetime NOT NULL AFTER `expiredDate`;
ALTER TABLE `eps_blacklist` ADD index `addedDate` (`addedDate`);
