{*php
/**
 * The comment view file of message for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{!js::set('objectType', $objectType)}
{!js::set('objectID',   $objectID)}
{!js::set('messageRefreshUrl', $control->createLink('message', 'comment', "objecType=$objectType&objectID=$objectID"))}
{if(isset($pageCSS))} {!css::internal($pageCSS)} {/if}
<hr>
<div class='panel panel-section'>
  <div class='comment-list' id="commentsListWrapper">
    {if(isset($comments) and $comments)}
      <div class='title vertical-center'>
        <span class='vertical-line'></span>
        <span class="list-text">{$lang->message->list}</span>
      </div>
      <div class='condensed bordered' id="commentsList">
        {foreach($comments as $number => $comment)}
          <div class='comment'>
            <div class='comment-heading vertical-center'>
              <div class="avatar vertical-center text-muted">
                {if(empty($author->avatar))}
                <i class="icon icon-user icon-10x"></i>
                {else}
                <img src="{$comment->avatar}" alt="">
                {/if}
              </div>
              <div class="comment-ext">
                <span class="authorName">
                  {if(!empty($comment->nickname))}
                    {$comment->nickname}
                  {elseif(!empty($comment->from))}
                    {$comment->from}
                  {else}
                    {$lang->comment->defaultNickname}
                  {/if}
                </span>
                <span class="addedDate">{!formatTime($comment->date)}</span>
              </div>
              <div class='actions reply-text'>
                {!html::a($control->createLink('message', 'reply', "commentID=$comment->id"), $lang->comment->reply, "data-toggle='modal' data-type='ajax' data-icon='reply' data-title='{{$lang->comment->reply}}'")}
              </div>
            </div>
            <div class="comment-content">{!nl2br($comment->content)}</div>
            {$control->message->getFrontReplies($comment)}
          </div>
        {/foreach}
      </div>
    {/if}
  </div>
  <div class='comment-post vertical-center'>
    <form class='comment-form vertical-center' method='post' id='commentForm' action="{$control->createLink('message', 'post', 'type=comment')}">
      <div class='form-group required'>
        <input class="comment-input" type="text" name="content" id="commentContent" value="" rows="5" placeholder="   {$lang->comment->inputPlaceholder}">
        {!html::hidden('objectType', $objectType)}
        {!html::hidden('objectID', $objectID)}
      </div>
      <div class='form-group'>
        <input type="submit" id="submitComment" value="{$lang->comment->submit}" data-loading="{$lang->comment->submitting}...">
      </div>
    </form>
  </div>
</div>

{$pager->createPullUpJS('#commentsList', $lang->mobile->pullUpHint)}

{include TPL_ROOT . 'common/form.html.php'}
{if(isset($pageJS))} {!js::execute($pageJS)} {/if}
