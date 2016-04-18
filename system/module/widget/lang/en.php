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

$lang->widget->moreLinkList = new stdclass();
$lang->widget->moreLinkList->order['assinedTo'] = 'Assigned To Me|sys|my|order|type=assinedTo';
$lang->widget->moreLinkList->order['createdBy'] = 'Created By Me|sys|my|order|type=createdBy';
$lang->widget->moreLinkList->order['signedBy']  = 'Signed By Me|sys|my|order|type=signedBy';

$lang->widget->moreLinkList->contract['returnedBy']     = 'Returned By Me|sys|my|contract|type=returnedBy';
$lang->widget->moreLinkList->contract['deliveredBy']    = 'Delivered By Me|sys|my|contract|type=deliveredBy';
$lang->widget->moreLinkList->contract['normalstatus']   = 'Unfinished|sys|my|contract|type=unfinished';
$lang->widget->moreLinkList->contract['closedstatus']   = 'Finished|sys|my|contract|type=finished';
$lang->widget->moreLinkList->contract['canceledstatus'] = 'Canceled|sys|my|contract|type=canceled';

$lang->widget->moreLinkList->customer['today']    = 'Today|crm|customer|browse|type=today';
$lang->widget->moreLinkList->customer['thisweek'] = 'This Week|crm|customer|browse|type=thisweek';

$lang->widget->moreLinkList->trade     = 'Trade|cash|trade|browse|';
$lang->widget->moreLinkList->depositor = 'Depositor|cash|depositor|index|';
$lang->widget->moreLinkList->provider  = 'Provider|cash|provider|browse|';

$lang->widget->moreLinkList->announce = 'Announce|oa|announce|browse|';
$lang->widget->moreLinkList->attend   = 'Attend|oa|todo|calendar|';

$lang->widget->moreLinkList->task['assignedTo'] = 'Assigned To Me|sys|my|task|type=assignedTo';
$lang->widget->moreLinkList->task['createdBy']  = 'Created By Me|sys|my|task|type=createdBy';
$lang->widget->moreLinkList->task['finishedBy'] = 'Finished By Me|sys|my|task|type=finishedBy';
$lang->widget->moreLinkList->task['closedBy']   = 'Closed By Me|sys|my|task|type=closedBy';
$lang->widget->moreLinkList->task['canceledBy'] = 'Canceled By Me|sys|my|task|type=canceledBy';

$lang->widget->moreLinkList->project['doing']    = 'Doing|oa|project|index|status=doing';
$lang->widget->moreLinkList->project['finished'] = 'Finished|oa|project|index|status=finished';
$lang->widget->moreLinkList->project['suspend']  = 'Suspend|oa|project|index|status=suspend';

$lang->widget->moreLinkList->blog = 'Latest Blog|team|blog|index|';
$lang->widget->moreLinkList->thread['new']   = 'Latest Thread|team|forum|index|';
$lang->widget->moreLinkList->thread['stick'] = 'Stick Thread|team|forum|index|';
