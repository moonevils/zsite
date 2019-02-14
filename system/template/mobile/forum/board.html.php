{*php
/**
 * The board view file of forum for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
<div class='block-region region-top blocks' data-region='forum_board-top'>{$control->loadModel('block')->printRegion($layouts, 'forum_board', 'top')}</div>
<div class='panel-section'>
  {if(count($threads) > 5 && $control->forum->canPost($board))}
    <div class='panel-heading'>
      {!html::a($control->createLink('thread', 'post', "boardID=$board->id"), '<i class="icon-pencil"></i>&nbsp;&nbsp;' . $lang->forum->post, "class='btn primary block' data-toggle='modal'")}
    </div>
  {/if}

  <div class='thread-list'>
    <div class='sticks'>
    {foreach($sticks as $thread)}
      {$style = ($thread->color or $thread->stickBold) ? "style='" : ''}
      {$style .= $thread->color ? "color:{{$thread->color}};" : ''}
      {$style .= $thread->stickBold ? "font-weight:bold;" : ''}
      {$style .= ($thread->color or $thread->stickBold) ? "'" : ''}
      <div class='thread'>
        <div class='header'>
          <span class='title' {$style}>
             <span class='text-danger'>[{$lang->thread->stick}]</span>
            {$thread->title}
          </span>
          <span class='options'>
            <i class="icon icon-2x icon-circle"></i>
            <i class="icon icon-2x icon-circle"></i>
            <i class="icon icon-2x icon-circle"></i>
          </span>
        </div>
        <div class='{if(!empty($thread->image))}content{else}content-no-img{/if}'>
          <div class='left'>
            <span class='{if(!empty($thread->image))}desc{else}desc-no-img{/if}'>{!strip_tags($thread->content)}</span>
            <div class='ext'>
              <span class='views'>{!html::image('/theme/mobile/default/comments.png')} {$thread->views}</span>
              <span class='pub-time'>{!substr($thread->addedDate, 0, 10)}</span>
            </div>
          </div>
          {if(!empty($thread->image))}
          <div class='img'>
            {$title = $thread->image->primary->title ? $thread->image->primary->title : $thread->title}
            {$thread->image->primary->objectType = 'thread'}
            {!html::image($control->loadModel('file')->printFileURL($thread->image->primary, 'smallURL'), "title='{{$title}}' class='thumbnail'")}
          </div>
          {/if}
        </div>
      </div>
      {@unset($threads[$thread->id])}
    {/foreach}
    </div>
    <div class='threads'>
    {foreach($threads as $thread)}
      {$style = $thread->color ? " style='color:{{$thread->color}}'" : ''}
      <div class='thread'>
        <div class='header'>
            <span class='title' {$style}>{$thread->title}</span>
          <span class='options'>
              <i class="icon icon-2x icon-circle"></i>
              <i class="icon icon-2x icon-circle"></i>
              <i class="icon icon-2x icon-circle"></i>
            </span>
        </div>
        <div class='{if(!empty($thread->image))}content{else}content-no-img{/if}'>
          <div class='left'>
            <span class='{if(!empty($thread->image))}desc{else}desc-no-img{/if}'>{!strip_tags($thread->content)}</span>
            <div class='ext'>
              <span class='views'>{!html::image('/theme/mobile/default/comments.png')} {$thread->views}</span>
              <span class='pub-time'>{!substr($thread->addedDate, 0, 10)}</span>
            </div>
          </div>
          {if(!empty($thread->image))}
          <div class='img'>
            {$title = $thread->image->primary->title ? $thread->image->primary->title : $thread->title}
            {$thread->image->primary->objectType = 'thread'}
            {!html::image($control->loadModel('file')->printFileURL($thread->image->primary, 'smallURL'), "title='{{$title}}' class='thumbnail'")}
          </div>
          {/if}
        </div>
      </div>
    {/foreach}
    </div>
  </div>

  <div class='panel-footer'>
    {$pager->createPullUpJS('.threads', $lang->mobile->pullUpHint, '', false)}
    <hr class='space'>
    {if($control->forum->canPost($board))} {!html::a($control->createLink('thread', 'post', "boardID=$board->id"), '<i class="icon-pencil"></i>&nbsp;&nbsp;' . $lang->forum->post, "class='btn primary block' data-toggle='modal'")} {/if}
  </div>
</div>
<div class='block-region region-bottom blocks' data-region='forum_board-bottom'>{$control->loadModel('block')->printRegion($layouts, 'forum_board', 'bottom')}</div>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
