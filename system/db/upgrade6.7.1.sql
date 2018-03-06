ALTER TABLE `eps_article`
ADD `stickTime` datetime NOT NULL AFTER `sticky`,
ADD `stickBold` enum('0', '1') NOT NULL DEFAULT '0' AFTER `stickTime`;

ALTER TABLE `eps_thread`
ADD `stickTime` datetime NOT NULL AFTER `stick`,
ADD `stickBold` enum('0', '1') NOT NULL DEFAULT '0' AFTER `stickTime`;
