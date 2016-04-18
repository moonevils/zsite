ALTER TABLE `eps_layout` ADD object char(30) NOT NULL AFTER `region`;
ALTER TABLE `eps_order` CHANGE express express char(30) NOT NULL AFTER waybill;
