<?php
/**
 * The en file of widget module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     widget 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
$lang->widget->common = 'Block';
$lang->widget->title  = 'Block Name';
$lang->widget->style  = 'Style';
$lang->widget->type   = 'Type ';
$lang->widget->grid   = 'Width';
$lang->widget->color  = 'Color';
$lang->widget->status = 'Status';

$lang->widget->create    = 'Create Block';
$lang->widget->hidden    = 'Hide';
$lang->widget->lblWidget = 'block';
$lang->widget->lblRss    = 'RSS URL';
$lang->widget->lblNum    = 'Limit';
$lang->widget->content   = 'Content';

$lang->widget->params = new stdclass();
$lang->widget->params->name  = 'Name';
$lang->widget->params->value = 'Value';

$lang->widget->createWidget        = 'Create Block';
$lang->widget->editWidget          = 'Edit Block';
$lang->widget->ordersSaved         = 'Sort have been saved';
$lang->widget->confirmRemoveWidget = 'Are you sure remove widget [{0}] ?';

$lang->widget->dynamic     = 'Dynamic';
$lang->widget->dynamicInfo = "%s, %s <em>%s</em> %s <a href='%s'>%s</a>。";

$lang->widget->default = array();
$lang->widget->default['1']['title'] = 'Latest Order';
$lang->widget->default['1']['type']  = 'latestOrder';
$lang->widget->default['1']['grid']  = 4;

$lang->widget->default['2']['title'] = 'latest Thread';
$lang->widget->default['2']['type']  = 'latestThread';
$lang->widget->default['2']['grid']  = 4;

$lang->widget->default['3']['title'] = 'Latest Message';
$lang->widget->default['3']['type']  = 'message';
$lang->widget->default['3']['grid']  = 4;

$lang->widget->default['4']['title'] = 'Latest Submittion';
$lang->widget->default['4']['type']  = 'submittion';
$lang->widget->default['4']['grid']  = 4;

$lang->widget->default['5']['title'] = 'Common menu';
$lang->widget->default['5']['type']  = 'commonMenu';
$lang->widget->default['5']['grid']  = 4;

$lang->widget->default['6']['title'] = 'Chanzhi Dynamic';
$lang->widget->default['6']['type']  = 'chanzhiDynamic';
$lang->widget->default['6']['grid']  = 4;

$lang->widget->typeList = new stdclass();
$lang->widget->typeList->latestOrder    = 'Latest Order';
$lang->widget->typeList->latestThread   = 'Latest Thread';
$lang->widget->typeList->message        = 'Messages';
$lang->widget->typeList->wechatMessage  = 'Wechat Message';
$lang->widget->typeList->submittion     = 'Submittion';
$lang->widget->typeList->chanzhiDynamic = 'Chanzhi Dynamic';
$lang->widget->typeList->html           = 'HTML';
$lang->widget->typeList->commonMenu     = 'Common menus';
