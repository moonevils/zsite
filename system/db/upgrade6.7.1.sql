alter table `eps_action` add key(`objectType`);

alter table `eps_article` add key(`type`);
alter table `eps_article` add key(`order`);
alter table `eps_article` add key(`status`);
alter table `eps_article` add key(`addedDate`);

alter table `eps_slide` add key(`group`);

alter table `eps_block` add key(`type`);
alter table `eps_block` add key(`template`);

alter table `eps_book` add key(`status`);
alter table `eps_book` add key(`addedDate`);

alter table `eps_category` add key(`grade`);

alter table `eps_package` add key(`type`);

alter table `eps_file` add key(`pathname`);

alter table `eps_message` add key(`type`);
alter table `eps_message` add key(`to`);
alter table `eps_message` add key(`account`);
alter table `eps_message` add key(`readed`);

alter table `eps_product` add key(`status`);

alter table `eps_relation` add key(`id`);
alter table `eps_relation` add key(`category`);

alter table `eps_reply` add key(`reply`);
alter table `eps_reply` add key(`hidden`);
alter table `eps_reply` add key(`editedDate`);

alter table `eps_thread` add key(`hidden`);
alter table `eps_thread` add key(`status`);
alter table `eps_thread` add key(`addedDate`);

alter table `eps_user` add key(`score`);
alter table `eps_user` add key(`rank`);

alter table `eps_log` add key(`ip`);
alter table `eps_log` add key(`type`);
alter table `eps_log` add key(`account`);
alter table `eps_log` add key(`date`);

alter table `eps_wx_message` add key(`type`);
alter table `eps_wx_message` add key(`public`);
alter table `eps_wx_message` add key(`from`);
alter table `eps_wx_message` add key(`to`);
alter table `eps_wx_message` add key(`replied`);

alter table `eps_score` add key(`time`);
alter table `eps_score` add key(`type`);

alter table `eps_order` add key(`deliveryStatus`);
alter table `eps_order` add key(`payStatus`);
alter table `eps_order` add key(`type`);

alter table `eps_cart` add key(`product`);

alter table `eps_widget` add key(`hidden`);
