<?php
/**
 * The weichat module zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     weichat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->weichat->id        = '编号';
$lang->weichat->type      = '类型';
$lang->weichat->name      = '微信名';
$lang->weichat->account   = '微信号';
$lang->weichat->appID     = 'AppID';
$lang->weichat->appSecret = 'AppSecret';
$lang->weichat->token     = 'Token';
$lang->weichat->url       = '接入地址';
$lang->weichat->users     = '微信会员';
$lang->weichat->msgType   = '消息类型';
$lang->weichat->content   = '内容';

$lang->weichat->create            = '添加公众号';
$lang->weichat->admin             = '维护公众号';
$lang->weichat->list              = '公众号列表';
$lang->weichat->setMenu           = '菜单设置';
$lang->weichat->setResponse       = '响应设置';
$lang->weichat->defaultResponse   = '默认响应';
$lang->weichat->subscribeResponse = '订阅响应';
$lang->weichat->access            = '接入';

$lang->weichat->typeList['subscribe'] = '订阅号';
$lang->weichat->typeList['service']   = '服务号';

$lang->weichat->response = new stdclass();

$lang->weichat->response->type = '类型';
$lang->weichat->response->link = '链接';

$lang->weichat->response->typeList['link'] = '链接';
$lang->weichat->response->typeList['text'] = '文字内容';
$lang->weichat->response->typeList['rich'] = '图文内容';

$lang->weichat->accessInfo = <<<EOT
<ul style="padding-left: 10px">
  <li><strong>AppSecret</strong>： %s </li>
  <li><strong>接入地址</strong>： %s </li>
  <li><strong>Token</strong>： %s </li>
</ul>
EOT;
