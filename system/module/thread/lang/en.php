<?php
/**
 * The thread module english file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     thread
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->thread->common    = 'Theme';

$lang->thread->id          = 'ID';
$lang->thread->title       = 'Title';
$lang->thread->board       = 'Board';
$lang->thread->author      = 'Author';
$lang->thread->content     = 'Content';
$lang->thread->file        = 'File: ';
$lang->thread->postedDate  = 'Posted on';
$lang->thread->replies     = 'Reply';
$lang->thread->views       = 'View';
$lang->thread->lastReply   = 'Last Reply';
$lang->thread->isLink      = 'Jump';
$lang->thread->link        = 'Link';

$lang->thread->post           = 'Post';
$lang->thread->postTo         = 'Post to';
$lang->thread->browse         = 'Thread List';
$lang->thread->stick          = 'Stick to Top';
$lang->thread->edit           = 'Edit s Thread';
$lang->thread->status         = 'Status';
$lang->thread->approve        = 'Pass';
$lang->thread->display        = 'Dispaly';
$lang->thread->hide           = 'Hide';
$lang->thread->show           = 'Show';
$lang->thread->transfer       = 'Transfer';
$lang->thread->switchStatus   = 'Hide/Display';
$lang->thread->deleteFile     = 'Delete File';
$lang->thread->unreplied      = "<span class='text-important'> Not Replied</span>";

$lang->thread->sticks[0] = 'Do not stick';
$lang->thread->sticks[1] = 'Stick to he Top of the Board';
$lang->thread->sticks[2] = 'Stick to the Top Globally';

$lang->thread->displayList['hidden'] = 'Hidden';
$lang->thread->displayList['Open'] = 'Normal';

$lang->thread->statusList['wait']     = 'Not Reviewed';
$lang->thread->statusList['approved'] = 'Approved';

$lang->thread->confirmDeleteThread = "Do you want to delete it?";
$lang->thread->confirmHideReply    = "Do you want to hide it?";
$lang->thread->confirmHideThread   = "Do you want to hide it?";
$lang->thread->confirmDeleteReply  = "Do you want to delete it?";
$lang->thread->confirmDeleteFile   = "Do you want to delete it?";

$lang->thread->lblEdited       = 'Last edited by %s on %s';
$lang->thread->message         = '%s replied in #%s the thread %s, which is %s';
$lang->thread->readonly        = 'Read Only';
$lang->thread->successStick    = 'Sticked!';
$lang->thread->successUnstick  = 'Cancelled the sticked!';
$lang->thread->successHide     = 'Hidden!';
$lang->thread->successShow     = 'Displayed!';
$lang->thread->readonlyMessage = 'This has been set as <strong>Read Only</strong>. You can not post any replied now.';
$lang->thread->successTransfer = 'Transferred!';
$lang->thread->thanks          = 'It will be posted to the board once approved.';

$lang->thread->score    = 'Reward Points';
$lang->thread->scoreSum = "<i class='text-warning icon icon-plus'><b>%s</b></i> ";
$lang->thread->scores[5]  = '+ 5';
$lang->thread->scores[10] = '+ 10';
$lang->thread->scores[50] = '+ 50';
$lang->thread->scores[100]= '+ 100';

$lang->thread->placeholder = new stdclass();
$lang->thread->placeholder->link = 'Enter a link. External one is OK.';

/* Adjust the pager. */
if(!isset($lang->pager->settedInForum))
{
    $lang->pager->noRecord = '';
    $lang->pager->digest   = str_replace('Record', 'Reply', $lang->pager->digest);
}
