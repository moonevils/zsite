{*php
/**
 * The reply view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
<style>
.panel > .panel-heading, .panel-section > .panel-heading {padding:12px 10px 0px 10px}
.cards.condensed .card-fix {width:100%}
.card .card-top {width:100%;overflow:hidden;margin-bottom:8px}
.card .card-body {width:100%;overflow:hidden;margin-bottom:8px}
.card-fix .card-title {float:left;max-width:55%;margin-right:10%;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;font-size:1.6rem;font-weight:600;color:#333}
.card-fix .card-theard {float:left;max-width:30%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#676767}
.card-fix .text-muted {font-size:1.4rem}
.card-content, .card-footer {padding:0px}
</style>
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'>{$lang->user->reply}</div>
  </div>
  <div class='cards condensed cards-list'>
    {foreach($replies as $reply)}
      <a href='{$control->createLink('thread', 'view', "id=$reply->thread") . "#$reply->id"}' class='card'>
        <div class='card-fix'>
          <div class='card-top'>
            <div class='card-title'>{$reply->title}</div>
            <div class='card-theard'>{$reply->boardName}</div>
          </div>
          <div class='card-body'>{$reply->content}</div>
          <div class='card-content text-muted'>
            {$lang->reply->addedDate} {!substr($reply->addedDate, 2, -3)}
          </div>
        </div>
      </a>
    {/foreach}
  </div>
  {$pager->createPullUpJS('#articles', $lang->mobile->pullUpHint)}
</div>
