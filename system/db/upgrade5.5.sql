ALTER TABLE `eps_file` CHANGE `size` `size` int(10) UNSIGNED NOT NULLL;
ALTER TABLE `eps_blacklist` ADD `addedDate` datetime NOT NULL AFTER `expiredDate`;
