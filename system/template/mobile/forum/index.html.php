{*php
/**
 * The index view file of forum for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<div class='block-region region-top blocks' data-region='forum_index-top'>{$control->loadModel('block')->printRegion($layouts, 'forum_index', 'top')}</div>
{if($mode == 'latest' or $mode == 'stick')}
  <div class='panel'>
    <table class='table table-hover table-striped'>
      <thead>
        <tr class='text-center hidden-xxxs'>
          <th>{$lang->thread->title}</th>
          <th class='w-150px hidden-xxs'>{$lang->thread->author}</th>
          <th class='w-100px hidden-xs'>{$lang->thread->postedDate}</th>
          <th class='w-50px hidden-xs'>{$lang->thread->views}</th>
          <th class='w-50px'>{$lang->thread->replies}</th>
          <th class='w-200px hidden-sm hidden-xs'>{$lang->thread->lastReply}</th>
        </tr>  
      </thead>
      <tbody>
        {foreach($threads as $thread)}
          {$style = $thread->color ? "style='color:{{$thread->color}}'" : ''}
          <tr>
            <td class='text-left'>
              {!echo ($mode == 'latest' && $thread->isNew) ? "<i class='icon-comment-alt icon-large text-success'> </i>" : "<i class='icon-comment-alt icon-large text-muted'> </i>"}
              <span data-ve='thread' id='thread{$thread->id}'>{!echo '[' . zget($boards, $thread->board, $thread->board). '] ' . html::a($control->createLink('thread', 'view', "id=$thread->id"), $thread->title, $style)}</span>
            </td>
            <td class='hidden-xxs'><strong>{$thread->authorRealname}</strong></td>
            <td class='hidden-xs'>{!substr($thread->addedDate, 5, -3)}</td>
            <td class='hidden-xs'>{$thread->views}</td>
            <td class='hidden-xxxs'>{$thread->replies}</td>
            <td class='hidden-sm hidden-xs'>
            {if($thread->replies)}
              {!substr($thread->repliedDate, 5, -3) . ' '}
              {!html::a($control->createLink('thread', 'locate', "threadID={{$thread->id}}&replyID={{$thread->replyID}}"), $thread->repliedByRealname)}
            {/if}
            </td>  
          </tr>  
        {/foreach}
      </tbody>
      <tfoot>
        <tr><td colspan='7'>{$pager->show('right', 'short')}</td></tr>
      </tfoot>
    </table>
  </div>
{else}
  <div id='boards'>
  {foreach($boards as $parentBoard)}
    <div class='panel-section'>
      <div class='panel-heading page-header'>
        <div class='title'><i class='icon icon-comments'></i> <strong>{$parentBoard->name}</strong></div>
      </div>
      <div class='panel-body'>
        <div class='cards cards-list'>
        {foreach($parentBoard->children as $childBoard)}
          {$isNewBoard = $control->forum->isNew($childBoard)}
          {$moderators = ''}
          {foreach($childBoard->moderators as $moderator)}
            {if(!empty($moderator))}
              {$moderators .= $moderator . ' '}
            {/if}
          {/foreach}
          <a class='card' href='{!inlink('board', "id=$childBoard->id", "category={{$childBoard->alias}}")}'>
            <div class='table-layout'>
              <div class='table-cell'>
                <div class='card-heading'>
                  <h5>
                    {$childBoard->name}
                    {if(!empty($moderators))} {!printf('<small>' . $lang->forum->lblOwner . '</small>', $moderators)} {/if}
                  </h5>
                </div>
                <div class='card-content text-muted small'>{$childBoard->desc}</div>
                {if($childBoard->postedBy)}
                  <div class='card-footer small text-muted'>{$lang->forum->lastPost . ':'}
                    {!substr($childBoard->postedDate, 5, -3) . " {{$childBoard->postedByRealname}}"}
                  </div>
                {/if}
              </div>
              <div class='table-cell middle thumbnail-cell text-right'>
                <div class='counter text-center'><div class='title{if($isNewBoard)} {!echo ' text-success'} {/if}'>{$childBoard->threads}</div><div class='caption text-muted small'>{$lang->forum->threadCount}</div></div>
              </div>
            </div>
          </a>
        {/foreach}
        </div>
      </div>
    </div>
  {/foreach}
  </div>
{/if}
<div class='block-region region-bottom blocks' data-region='forum_index-bottom'>{$control->loadModel('block')->printRegion($layouts, 'forum_index', 'bottom')}</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
