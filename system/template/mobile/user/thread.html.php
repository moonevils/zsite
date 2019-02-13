{*php
/**
 * The thread view file of user for mobile template of chanzhiEPS.
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
.card-fix .card-top {width:100%;overflow:hidden;margin-bottom:12px}
.card-fix .card-left {float:left;width:80%}
.card-fix .card-title{float:left;max-width:55%;margin-right:15%;text-overflow:ellipsis;overflow:hidden;white-space:nowrap;font-size:1.5rem;font-weight:600;color:#333}
.card-fix .card-theard{float:left;max-width:30%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;color:#676767}
.card-fix .card-body {width:100%;overflow:hidden;position:relative}
.card-fix .pub-time {float:left}
.card-fix .reply {float:right;position:absolute;bottom:0px;right:0px;padding:0px}
.card-fix .card-content,.card-footer {padding:0px}
.card-fix .card-footer {color:#666;margin-top:8px}
.card-fix .reply .text-muted {color:#666;font-size:1.5rem}
.card-fix .counter .title {margin-bottom:5px}
.text-danger {color:#D0021B}
</style>
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'>{$lang->user->thread}</div>
  </div>
  <div class='cards condensed cards-list'>
    {foreach($threads as $thread)}
      <a href='{!$control->createLink('thread', 'view', "id=$thread->id")}' class='card'>
        <div class='card-fix'>
          <div class='card-body'>
            <div class='card-left'>
              <div class='card-top'>
                <div class='card-title'>{$thread->title}</div>
                <div class='card-theard'>{$thread->title}</div>
              </div>
              <div class='pub-time'>
                <div class='card-content text-muted'>
                  {$lang->thread->postedDate}：{!substr($thread->addedDate, 5, -3)}
                </div>
                {if($thread->replies)}
                  <div class='card-footer text-muted'>
                    {$lang->thread->lastReply}：{!substr($thread->repliedDate, 5, -3) . ' ' . $thread->repliedByRealname}
                  </div>
                {/if}
              </div>
            </div>
            <div class='reply middle thumbnail-cell text-right'>
              <div class='counter text-center'><div class='title text-danger'>{$thread->replies}</div><div class='caption text-muted small'>{$lang->thread->number}</div></div>
              </div>
          </div>
        </div>
      </a>
    {/foreach}
  </div>
  {$pager->createPullUpJS('#articles', $lang->mobile->pullUpHint)}
</div>
