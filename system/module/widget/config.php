<?php
/**
 * The config file of widget module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     widget 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
$config->widget->require = new stdclass();
$config->widget->require->create = 'type,title,grid';

$config->widget->editor = new stdclass();
$config->widget->editor->set = array('id' => 'html', 'tools' => 'simple');

$config->widget->gridOptions[6]  = '1/2';
$config->widget->gridOptions[4]  = '1/3';
$config->widget->gridOptions[8]  = '2/3';
$config->widget->gridOptions[3]  = '1/4';
$config->widget->gridOptions[9]  = '3/4';
$config->widget->gridOptions[12] = '100%';

$config->widget->dependence = new stdclass();
$config->widget->dependence->latestOrder    = 'shop';
$config->widget->dependence->latestThread   = 'forum';
$config->widget->dependence->message        = 'message';
$config->widget->dependence->submittion     = 'submittion';

$config->widget->moreLinkList = new stdclass();
$config->widget->moreLinkList->latestOrder    = 'order|admin|';
$config->widget->moreLinkList->latestThread   = 'forum|admin|';
$config->widget->moreLinkList->message        = 'message|admin|type=message';
$config->widget->moreLinkList->chanzhiDynamic = 'http://www.chanzhi.org/dynamic.html';
$config->widget->moreLinkList->html           = '';
$config->widget->moreLinkList->submittion     = 'article|admin|type=submittion&tab=user';
$config->widget->moreLinkList->wechatMessage  = 'wechat|message|mode=replied&replied=0';
