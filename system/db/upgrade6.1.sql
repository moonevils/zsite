ALTER TABLE `eps_book` ADD `link` varchar(255) NOT NULL AFTER `order`,
ADD `status` varchar(20) NOT NULL DEFAULT 'normal' AFTER `editedDate`;
