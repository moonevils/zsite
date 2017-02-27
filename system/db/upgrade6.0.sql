ALTER TABLE `eps_article` ADD `titleColor`     varchar(10) NOT NULL AFTER `onlyBody`;
ALTER TABLE `eps_product` ADD `titleColor`     varchar(10) NOT NULL AFTER `js`;
ALTER TABLE `eps_user`    ADD `notification`   varchar(20) NOT NULL DEFAULT 'mail,' AFTER `security`;
