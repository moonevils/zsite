<?php
/**
 * The article category zh-cn file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->article->common      = 'Article';
$lang->article->setting     = 'Basic Settings';
$lang->article->createDraft = 'Save the draft';
$lang->article->post        = 'Contribute';
$lang->article->check       = 'Review';
$lang->article->reject      = 'Reject';

$lang->article->id         = 'ID';
$lang->article->category   = 'Category';
$lang->article->categories = 'Category';
$lang->article->title      = 'Title';
$lang->article->alias      = 'Alias';
$lang->article->content    = 'Text';
$lang->article->source     = 'Source';
$lang->article->copySite   = 'Site';
$lang->article->copyURL    = 'URL';
$lang->article->keywords   = 'Keywords';
$lang->article->summary    = 'Summary';
$lang->article->author     = 'Author';
$lang->article->editor     = 'Edit';
$lang->article->addedDate  = 'Publish On';
$lang->article->editedDate = 'Edit On';
$lang->article->status     = 'Status';
$lang->article->type       = 'Type';
$lang->article->views      = 'Views';
$lang->article->comments   = 'Comment';
$lang->article->stick      = 'Sticky';
$lang->article->order      = 'Ranking';
$lang->article->isLink     = 'Link';
$lang->article->link       = 'Link';
$lang->article->css        = 'CSS';
$lang->article->js         = 'JS';
$lang->article->layout     = 'Layout';

$lang->article->forward2Blog     = 'To Blog';
$lang->article->forward2Forum    = 'To Forum';
$lang->article->selectCategories = 'Select Category';
$lang->article->selectBoard      = 'Select Board';
$lang->article->confirmReject    = 'Do you want to reject it?';

$lang->submittion= new stdclass();
$lang->submittion->common  = 'Contribute';
$lang->submittion->check   = 'Review';
$lang->submittion->list    = 'Contributions';
$lang->submittion->publish = 'Pass';
$lang->submittion->reject  = 'Reject';

$lang->submittion->status[0] = '';
$lang->submittion->status[1] = '<span class="label label-xsm label-primary">' . 'Pending' .'</span>';
$lang->submittion->status[2] = '<span class="label label-xsm label-success">' . 'Pass' . '</span>';
$lang->submittion->status[3] = 'Reject';

$lang->submittion->typeList = array();
$lang->submittion->typeList['article'] = 'Article';
$lang->submittion->typeList['blog']    = 'Blog';

$lang->article->onlyBody = 'Display body only (for custom).';

$lang->article->list          = 'List';
$lang->article->admin         = 'Maintain';
$lang->article->create        = 'Add Article';
$lang->article->setcss        = 'CSS Settings';
$lang->article->setjs         = 'JS Settings';
$lang->article->edit          = 'Edit';
$lang->article->files         = 'File';
$lang->article->images        = 'Image';

$lang->article->submittion     = 'Contribute';
$lang->article->submissionTime = 'Contribute On';
$lang->article->noSubmittion   = 'You have no contributions yet. Contribute and earn points NOW!';

$lang->article->submittionOptions = new stdclass;
$lang->article->submittionOptions->open  = 'On';
$lang->article->submittionOptions->close = 'Off';

$lang->blog->common = 'Blog';
$lang->blog->admin  = 'Maintain';
$lang->blog->list   = 'List';
$lang->blog->create = 'Add a Blog';
$lang->blog->edit   = 'Edit';

$lang->page->common = 'Page';
$lang->page->admin  = 'Maintain`';
$lang->page->list   = 'List';
$lang->page->create = 'Add a Page';
$lang->page->edit   = 'Edit';

$lang->article->sourceList['original']      = 'Original';
$lang->article->sourceList['copied']        = 'Copied';
$lang->article->sourceList['translational'] = 'Translated';
$lang->article->sourceList['article']       = 'Repost';

$lang->article->statusList['normal'] = 'Normal';
$lang->article->statusList['draft']  = 'Draft';

$lang->article->sticks[0] = 'No Sticky';
$lang->article->sticks[1] = 'Categorical';
$lang->article->sticks[2] = 'Global';

$lang->article->successStick   = 'Sticky!';
$lang->article->successUnstick = 'Sticky cancelled!';

$lang->article->confirmDelete = 'Do you want to delete this article?';
$lang->article->categoryEmpty = 'Choose Category';

$lang->article->lblAddedDate = '<strong>Added on </strong> %s &nbsp;&nbsp;';
$lang->article->lblAuthor    = "<strong>Author </strong> %s &nbsp;&nbsp;";
$lang->article->lblSource    = '<strong>Source </strong>';
$lang->article->lblViews     = '<strong>Viewed </strong> %s';
$lang->article->lblEditor    = 'Last edited by %s on %s';
$lang->article->lblComments  = '<strong>Commented by </strong> %s';

$lang->article->none      = 'The End';
$lang->article->previous  = 'Previous';
$lang->article->next      = 'Next';
$lang->article->directory = 'Back';
$lang->article->noCssTag  = 'No &lt;style&gt;&lt;/style&gt; tag';
$lang->article->noJsTag   = 'No &lt;script&gt;&lt;/script&gt;tag';

$lang->article->placeholder = new stdclass();
$lang->article->placeholder->addedDate = 'Select a date to publish.';
$lang->article->placeholder->link      = 'Enter the link here. External link is OK.';

$lang->article->approveMessage = 'Your contribution <strong>%s</strong> has passed the review. You have earned <strong>+%s</strong> points. Thank you!';
$lang->article->rejectMessage  = 'Your contribution <strong>%s</strong> did not pass the review. You can edit it and submit for review again. Thank you!';

$lang->article->forwardFrom = 'Repost from';
