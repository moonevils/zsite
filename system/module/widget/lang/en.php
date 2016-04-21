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
$lang->widget->name   = 'Name';
$lang->widget->style  = 'Style';
$lang->widget->grid   = 'Width';
$lang->widget->color  = 'Color';

$lang->widget->lblEntry = 'Entry';
$lang->widget->lblBlock = 'Block';
$lang->widget->lblRss   = 'RSS';
$lang->widget->lblNum   = 'Number';
$lang->widget->lblHtml  = 'HTML';

$lang->widget->params = new stdclass();
$lang->widget->params->name  = 'Name';
$lang->widget->params->value = 'Value';

$lang->widget->createBlock        = 'Create Block';
$lang->widget->editBlock          = 'Edit Block';
$lang->widget->ordersSaved        = 'Sort have been saved';
$lang->widget->confirmRemoveBlock = 'Are you sure remove widget [{0}] ?';

$lang->widget->allEntries  = 'All Entries';
$lang->widget->dynamic     = 'Latest Dynamic';
$lang->widget->dynamicInfo = "%s, %s <em>%s</em> %s <a href='%s'>%s</a>。";

$lang->widget->default['oa']['1']['title'] = 'Calendar';
$lang->widget->default['oa']['1']['widget'] = 'attend';
$lang->widget->default['oa']['1']['grid']  = 6;

$lang->widget->default['oa']['2']['title'] = 'System Announcement';
$lang->widget->default['oa']['2']['widget'] = 'announce';
$lang->widget->default['oa']['2']['grid']  = 4;

$lang->widget->default['oa']['2']['params']['num'] = 15;

$lang->widget->default['oa']['3']['title'] = 'The task of assigned to me';
$lang->widget->default['oa']['3']['widget'] = 'task';
$lang->widget->default['oa']['3']['grid']  = 4;

$lang->widget->default['oa']['3']['params']['num']     = 15;
$lang->widget->default['oa']['3']['params']['orderBy'] = 'id_desc';
$lang->widget->default['oa']['3']['params']['status']  = array();
$lang->widget->default['oa']['3']['params']['type']    = 'assignedTo';

$lang->widget->default['oa']['4']['title'] = 'Project list';
$lang->widget->default['oa']['4']['widget'] = 'project';
$lang->widget->default['oa']['4']['grid']  = 4;

$lang->widget->default['oa']['4']['params']['num']     = 15;
$lang->widget->default['oa']['4']['params']['orderBy'] = 'id_desc';
$lang->widget->default['oa']['4']['params']['status']  = 'doing';

$lang->widget->default['crm']['1']['title'] = 'My Order';
$lang->widget->default['crm']['1']['widget'] = 'order';
$lang->widget->default['crm']['1']['grid']  = 4;

$lang->widget->default['crm']['1']['params']['num']     = 15;
$lang->widget->default['crm']['1']['params']['orderBy'] = 'id_desc';
$lang->widget->default['crm']['1']['params']['type']    = 'createdBy';
$lang->widget->default['crm']['1']['params']['status']  = array();

$lang->widget->default['crm']['2']['title'] = 'My Contract';
$lang->widget->default['crm']['2']['widget'] = 'contract';
$lang->widget->default['crm']['2']['grid']  = 4;

$lang->widget->default['crm']['2']['params']['num']     = 15;
$lang->widget->default['crm']['2']['params']['orderBy'] = 'id_desc';
$lang->widget->default['crm']['2']['params']['type']    = 'returnedBy';
$lang->widget->default['crm']['2']['params']['status']  = array();

$lang->widget->default['crm']['3']['title'] = 'This week';
$lang->widget->default['crm']['3']['widget'] = 'customer';
$lang->widget->default['crm']['3']['grid']  = 4;

$lang->widget->default['crm']['3']['params']['num']     = 15;
$lang->widget->default['crm']['3']['params']['orderBy'] = 'id_desc';
$lang->widget->default['crm']['3']['params']['type']    = 'thisweek';

$lang->widget->default['cash']['1']['title'] = 'Payment Depositor';
$lang->widget->default['cash']['1']['widget'] = 'depositor';
$lang->widget->default['cash']['1']['grid']  = 4;

$lang->widget->default['cash']['1']['params'] = array();

$lang->widget->default['cash']['2']['title'] = 'Trade';
$lang->widget->default['cash']['2']['widget'] = 'depositor';
$lang->widget->default['cash']['2']['grid']  = 4;

$lang->widget->default['cash']['2']['params']['num']     = 15;
$lang->widget->default['cash']['2']['params']['orderBy'] = 'id_desc';

$lang->widget->default['cash']['3']['title'] = 'Provider';
$lang->widget->default['cash']['3']['widget'] = 'depositor';
$lang->widget->default['cash']['3']['grid']  = 4;

$lang->widget->default['cash']['3']['params']['num']     = 15;
$lang->widget->default['cash']['3']['params']['orderBy'] = 'id_desc';

$lang->widget->default['team']['1']['title'] = 'Latest Blog';
$lang->widget->default['team']['1']['widget'] = 'blog';
$lang->widget->default['team']['1']['grid']  = 4;

$lang->widget->default['team']['1']['params']['num'] = 15;

$lang->widget->default['team']['2']['title'] = 'Latest Thread';
$lang->widget->default['team']['2']['widget'] = 'thread';
$lang->widget->default['team']['2']['grid']  = 4;

$lang->widget->default['team']['2']['params']['num'] = 15;
$lang->widget->default['team']['2']['params']['type'] = 'new';

$lang->widget->default['team']['3']['title'] = 'Sticked Thread';
$lang->widget->default['team']['3']['widget'] = 'thread';
$lang->widget->default['team']['3']['grid']  = 4;

$lang->widget->default['team']['3']['params']['num']  = 15;
$lang->widget->default['team']['3']['params']['type'] = 'stick';

$lang->widget->default['sys']['1'] = $lang->widget->default['oa']['1'];
$lang->widget->default['sys']['1']['source'] = 'oa';
$lang->widget->default['sys']['2']['title']  = 'Latest Dynamic';
$lang->widget->default['sys']['2']['widget']  = 'dynamic';
$lang->widget->default['sys']['2']['grid']   = 6;
$lang->widget->default['sys']['2']['source'] = '';
$lang->widget->default['sys']['3'] = $lang->widget->default['oa']['2'];
$lang->widget->default['sys']['3']['source'] = 'oa';
$lang->widget->default['sys']['4'] = $lang->widget->default['crm']['2'];
$lang->widget->default['sys']['4']['source'] = 'crm';
$lang->widget->default['sys']['5'] = $lang->widget->default['crm']['1'];
$lang->widget->default['sys']['5']['source'] = 'crm';
$lang->widget->default['sys']['6'] = $lang->widget->default['cash']['1'];
$lang->widget->default['sys']['6']['source'] = 'cash';
$lang->widget->default['sys']['7'] = $lang->widget->default['team']['1'];
$lang->widget->default['sys']['7']['source'] = 'team';
$lang->widget->default['sys']['8'] = $lang->widget->default['team']['2'];
$lang->widget->default['sys']['8']['source'] = 'team';
