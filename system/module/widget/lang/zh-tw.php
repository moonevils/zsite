<?php
/**
 * The zh-tw file of widget module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青島易軟天創網絡科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     widget 
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
$lang->widget->common = '區塊';
$lang->widget->name   = '區塊名稱';
$lang->widget->style  = '外觀';
$lang->widget->grid   = '寬度';
$lang->widget->color  = '顏色';

$lang->widget->lblEntry = '應用';
$lang->widget->lblBlock = '區塊';
$lang->widget->lblRss   = 'RSS地址';
$lang->widget->lblNum   = '條數';
$lang->widget->lblHtml  = 'HTML內容';

$lang->widget->params = new stdclass();
$lang->widget->params->name  = '參數名稱';
$lang->widget->params->value = '參數值';

$lang->widget->createBlock        = '添加區塊';
$lang->widget->editBlock          = '編輯區塊';
$lang->widget->ordersSaved        = '排序已保存';
$lang->widget->confirmRemoveBlock = '確定移除區塊【{0}】嗎？';

$lang->widget->allEntries  = '所有應用';
$lang->widget->dynamic     = '最新動態';
$lang->widget->dynamicInfo = "%s, %s <em>%s</em> %s <a href='%s'>%s</a>。";

$lang->widget->default['oa']['1']['title'] = '日曆';
$lang->widget->default['oa']['1']['widget'] = 'attend';
$lang->widget->default['oa']['1']['grid']  = 6;

$lang->widget->default['oa']['2']['title'] = '系統公告';
$lang->widget->default['oa']['2']['widget'] = 'announce';
$lang->widget->default['oa']['2']['grid']  = 4;

$lang->widget->default['oa']['2']['params']['num'] = 15;

$lang->widget->default['oa']['3']['title'] = '指派給我的任務';
$lang->widget->default['oa']['3']['widget'] = 'task';
$lang->widget->default['oa']['3']['grid']  = 4;

$lang->widget->default['oa']['3']['params']['num']     = 15;
$lang->widget->default['oa']['3']['params']['orderBy'] = 'id_desc';
$lang->widget->default['oa']['3']['params']['status']  = array();
$lang->widget->default['oa']['3']['params']['type']    = 'assignedTo';

$lang->widget->default['oa']['4']['title'] = '項目列表';
$lang->widget->default['oa']['4']['widget'] = 'project';
$lang->widget->default['oa']['4']['grid']  = 4;

$lang->widget->default['oa']['4']['params']['num']     = 15;
$lang->widget->default['oa']['4']['params']['orderBy'] = 'id_desc';
$lang->widget->default['oa']['4']['params']['status']  = 'doing';

$lang->widget->default['crm']['1']['title'] = '我的訂單';
$lang->widget->default['crm']['1']['widget'] = 'order';
$lang->widget->default['crm']['1']['grid']  = 4;

$lang->widget->default['crm']['1']['params']['num']     = 15;
$lang->widget->default['crm']['1']['params']['orderBy'] = 'id_desc';
$lang->widget->default['crm']['1']['params']['type']    = 'createdBy';
$lang->widget->default['crm']['1']['params']['status']  = array();

$lang->widget->default['crm']['2']['title'] = '我的合同';
$lang->widget->default['crm']['2']['widget'] = 'contract';
$lang->widget->default['crm']['2']['grid']  = 4;

$lang->widget->default['crm']['2']['params']['num']     = 15;
$lang->widget->default['crm']['2']['params']['orderBy'] = 'id_desc';
$lang->widget->default['crm']['2']['params']['type']    = 'returnedBy';
$lang->widget->default['crm']['2']['params']['status']  = array();

$lang->widget->default['crm']['3']['title'] = '本週聯繫';
$lang->widget->default['crm']['3']['widget'] = 'customer';
$lang->widget->default['crm']['3']['grid']  = 4;

$lang->widget->default['crm']['3']['params']['num']     = 15;
$lang->widget->default['crm']['3']['params']['orderBy'] = 'id_desc';
$lang->widget->default['crm']['3']['params']['type']    = 'thisweek';

$lang->widget->default['cash']['1']['title'] = '付款賬戶';
$lang->widget->default['cash']['1']['widget'] = 'depositor';
$lang->widget->default['cash']['1']['grid']  = 4;

$lang->widget->default['cash']['1']['params'] = array();

$lang->widget->default['cash']['2']['title'] = '賬目';
$lang->widget->default['cash']['2']['widget'] = 'trade';
$lang->widget->default['cash']['2']['grid']  = 4;

$lang->widget->default['cash']['2']['params']['num']     = 15;
$lang->widget->default['cash']['2']['params']['orderBy'] = 'id_desc';

$lang->widget->default['cash']['3']['title'] = '供應商';
$lang->widget->default['cash']['3']['widget'] = 'provider';
$lang->widget->default['cash']['3']['grid']  = 4;

$lang->widget->default['cash']['3']['params']['num']     = 15;
$lang->widget->default['cash']['3']['params']['orderBy'] = 'id_desc';

$lang->widget->default['team']['1']['title'] = '最新博客';
$lang->widget->default['team']['1']['widget'] = 'blog';
$lang->widget->default['team']['1']['grid']  = 4;

$lang->widget->default['team']['1']['params']['num'] = 15;

$lang->widget->default['team']['2']['title'] = '最新帖子';
$lang->widget->default['team']['2']['widget'] = 'thread';
$lang->widget->default['team']['2']['grid']  = 4;

$lang->widget->default['team']['2']['params']['num'] = 15;
$lang->widget->default['team']['2']['params']['type'] = 'new';

$lang->widget->default['team']['3']['title'] = '置頂帖子';
$lang->widget->default['team']['3']['widget'] = 'thread';
$lang->widget->default['team']['3']['grid']  = 4;

$lang->widget->default['team']['3']['params']['num']  = 15;
$lang->widget->default['team']['3']['params']['type'] = 'stick';

$lang->widget->default['sys']['1'] = $lang->widget->default['oa']['1'];
$lang->widget->default['sys']['1']['source'] = 'oa';
$lang->widget->default['sys']['2']['title']  = '最新動態';
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
$lang->widget->moreLinkList->order['assinedTo'] = '指派給我|sys|my|order|type=assinedTo';
$lang->widget->moreLinkList->order['createdBy'] = '由我創建|sys|my|order|type=createdBy';
$lang->widget->moreLinkList->order['signedBy']  = '由我簽約|sys|my|order|type=signedBy';

$lang->widget->moreLinkList->contract['returnedBy']     = '由我回款|sys|my|contract|type=returnedBy';
$lang->widget->moreLinkList->contract['deliveredBy']    = '由我交付|sys|my|contract|type=deliveredBy';
$lang->widget->moreLinkList->contract['normalstatus']   = '未完成|sys|my|contract|type=unfinished';
$lang->widget->moreLinkList->contract['closedstatus']   = '已完成|sys|my|contract|type=finished';
$lang->widget->moreLinkList->contract['canceledstatus'] = '已取消|sys|my|contract|type=canceled';

$lang->widget->moreLinkList->customer['today']    = '今天聯繫|crm|customer|browse|type=today';
$lang->widget->moreLinkList->customer['thisweek'] = '本週聯繫|crm|customer|browse|type=thisweek';

$lang->widget->moreLinkList->trade     = '賬目|cash|trade|browse|';
$lang->widget->moreLinkList->depositor = '賬戶|cash|depositor|index|';
$lang->widget->moreLinkList->provider  = '供應商|cash|provider|browse|';

$lang->widget->moreLinkList->announce = '公告|oa|announce|browse|';
$lang->widget->moreLinkList->attend   = '日曆|oa|todo|calendar|';

$lang->widget->moreLinkList->task['assignedTo'] = '指派給我|sys|my|task|type=assignedTo';
$lang->widget->moreLinkList->task['createdBy']  = '由我創建|sys|my|task|type=createdBy';
$lang->widget->moreLinkList->task['finishedBy'] = '由我完成|sys|my|task|type=finishedBy';
$lang->widget->moreLinkList->task['closedBy']   = '由我關閉|sys|my|task|type=closedBy';
$lang->widget->moreLinkList->task['canceledBy'] = '由我取消|sys|my|task|type=canceledBy';

$lang->widget->moreLinkList->project['doing']    = '進行中|oa|project|index|status=doing';
$lang->widget->moreLinkList->project['finished'] = '已完成|oa|project|index|status=finished';
$lang->widget->moreLinkList->project['suspend']  = '已掛起|oa|project|index|status=suspend';

$lang->widget->moreLinkList->blog = '最新博客|team|blog|index|';
$lang->widget->moreLinkList->thread['new']   = '最新帖子|team|forum|index|';
$lang->widget->moreLinkList->thread['stick'] = '置頂帖子|team|forum|index|';
