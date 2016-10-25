ALTER TABLE `eps_order` add `humanID` char(13) NOT NULL after id;
ALTER TABLE `eps_order` ADD `last` datetime NOT NULL AFTER `status`;
