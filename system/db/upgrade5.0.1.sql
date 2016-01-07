ALTER TABLE `eps_layout` change `theme` plan varchar(100) NOT NULL after `page`;
DELETE FROM `eps_grouppriv` where `method` = 'setFavicon';
