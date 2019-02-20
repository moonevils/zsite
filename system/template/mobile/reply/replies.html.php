{*php
/**
* The comment view file of message for mobile template of chanzhiEPS.
*
* @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
* @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
* @author      Xianggang Cheng <chengxianggang@cnezsoft.com>
* @package     message
* @version     $Id$
* @link        http://www.chanzhi.org
*/
/php*}
{if(isset($pageCSS))} {!css::internal($pageCSS)} {/if}
<div class='comments panel'>
  <div class='comment-list' style="{if(!isset($replies) || !$replies)}display:none;{/if}">
    <div class='title vertical-center'>
      <span class='vertical-line'></span>
      <span class="list-text">{$lang->reply->list}</span>
    </div>
    <div id="commentsListAsync">
      <div id="commentsListWrapper">
        <div class='condensed bordered' id="commentsList">
          {foreach($replies as $number => $reply)}
          <div class='comment'>
            <div class='comment-heading vertical-center'>
              <div class='left vertical-center'>
                <div class="avatar vertical-center text-muted">
                  {if(empty($reply->avatar))}
                  <i class="icon icon-user icon-10x"></i>
                  {else}
                  <img src="{$reply->avatar}" alt="">
                  {/if}
                </div>
                <div class="comment-ext">
                      <span class="authorName">
                        {$reply->author}
                      </span>
                  <span class="addedDate">{!formatTime($reply->addedDate)}</span>
                </div>
              </div>
              <div class='actions reply-text'>
                {if($control->app->user->account != 'guest')}
                  <a href='#replyDialog' data-toggle='modal' data-reply-id='{$reply->id}' class='text-muted thread-reply-btn'>{$lang->reply->reply}</a>
                {else}
                  <a href="{!$control->createLink('user', 'login', 'referer=' . helper::safe64Encode($control->app->getURI(true)))}#reply" class="thread-reply-btn text-muted">{$lang->reply->reply}</a>
                {/if}
              </div>
            </div>
            <div class="comment-content">{!nl2br($reply->content)}</div>
            {$control->reply->getRepliesByReply($reply)}
          </div>
          {/foreach}
        </div>
        <div id="paginator">
          {$pager->createPullUpJS('#commentsList', $lang->mobile->pullUpHint, helper::createLink('reply', 'replies', 'threadID=' . $thread->id . '&pageID=$ID'))}
        </div>
      </div>
    </div>
  </div>
  <div class='comment-post vertical-center'>
    <form class='comment-form vertical-center' method='post' id='commentForm' action='{$control->createLink("reply", "post", "thread=$thread->id")}'>
      <div class='form-group required'>
        <input class="comment-input" type="text" name="content" id="commentContent" value="" rows="5" placeholder="&nbsp&nbsp{$lang->reply->inputPlaceholder}">
      </div>
      <div class='form-group'>
        {if($control->app->user->account != 'guest')}
        <input type="submit" class="submitComment" id="submitComment" value="{$lang->reply->post}" data-loading="{$lang->reply->submitting}...">
        {else}
        <a href="{!$control->createLink('user', 'login', 'referer=' . helper::safe64Encode($control->app->getURI(true)))}#reply" class="thread-reply-btn text-muted submitComment">{$lang->reply->post}</a>
        {/if}
      </div>
    </form>
  </div>
</div>

{if(!$thread->readonly)}
<div class='modal fade' id='replyDialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
        <h5 class='modal-title'><i class='icon-reply'></i> {$lang->reply->common}</h5>
      </div>
      <div class='modal-body'>
        <form method='post' enctype='multipart/form-data' id='replyForm' action='{$control->createLink("reply", "post", "thread=$thread->id")}'>
        <div class='form-group' id='reply-content'>
          {!html::textarea('content', '', "rows='6' class='form-control' placeholder='{{$lang->reply->content}}'")}
        </div>
        <div class='form-group clearfix captcha-box hide'></div>
        <div class='form-group'>{!html::submitButton('', 'btn primary block')}</div>
        {!html::hidden('reply', 0)}
        </form>
      </div>
    </div>
  </div>
</div>
{/if}

{include TPL_ROOT . 'common/form.html.php'}
{if(isset($pageJS))} {!js::execute($pageJS)} {/if}