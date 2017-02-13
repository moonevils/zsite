ALTER table `eps_down`     CHANGE `ip` `ip` char(40) NOT NULL;
ALTER table `eps_message`  CHANGE `ip` `ip` varchar(40) NOT NULL;
ALTER table `eps_statlog`  CHANGE `ip` `ip` char(40) NOT NULL;
ALTER table `eps_thread`   CHANGE `ip` `ip` char(40) NOT NULL;
ALTER table `eps_user`     CHANGE `ip` `ip` char(40) NOT NULL DEFAULT '';
ALTER table `eps_log`      CHANGE `ip` `ip` char(40) NOT NULL;
