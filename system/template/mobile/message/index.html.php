{*php
/**
 * The index view file of message for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{* TODO: check follow methods: showDetail and hideDetail *}
<div class='block-region region-top blocks' data-region='message_index-top'>{$control->loadModel('block')->printRegion($layouts, 'message_index', 'top')}</div>
<div class='messages panel'>
  <div class='comment-list'>
    {if(isset($messages) and $messages)}
    <div id="commentsListAsync">
      <div id="commentsListWrapper">
        <div class='condensed bordered' id="commentsList">
          {foreach($messages as $number => $comment)}
          <div class='comment'>
            <div class='comment-heading vertical-center'>
              <div class="avatar vertical-center text-muted">
                {if(empty($comment->avatar))}
                <i class="icon icon-user icon-10x"></i>
                {else}
                <img src="{$comment->avatar}" alt="">
                {/if}
              </div>
              <div class="comment-ext">
                    <span class="authorName">
                      {if(!empty($comment->realname))}
                        {$comment->realname}
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
        <div id="paginator">
          {$pager->createPullUpJS('#commentsList', $lang->mobile->pullUpHint, helper::createLink('message', 'index', 'pageID=$ID'), false)}
        </div>
      </div>
    </div>
    {/if}
  </div>
  <div class='comment-post vertical-center'>
    <form class='comment-form vertical-center' method='post' id='commentForm' action="{$control->createLink('message', 'post', 'type=message')}">
      <div class='form-group required'>
        <input class="comment-input" type="text" name="content" id="commentContent" value="" rows="5" placeholder="   {$lang->message->inputPlaceholder}">
        {!html::hidden('objectType', 'message')}
        {!html::hidden('objectID', 0)}
      </div>
      <div class='form-group'>
        <input type="submit" id="submitComment" value="{$lang->message->submit}" data-loading="{$lang->comment->submitting}...">
      </div>
    </form>
  </div>
</div>

{include TPL_ROOT . 'common/form.html.php'}
{if(isset($pageJS))} {!js::execute($pageJS)} {/if}
{noparse}
<script>
$(function()
{
    $.refreshCommentList = function()
    {
        $('#commentsListWrapper').load(window.location.href + ' #commentsList');
    };

    var $commentForm = $('#commentForm');
    $commentForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $('#commentDialog').modal('hide');
            if(window.v)
            {
                $commentForm.find('#content').val('');
                setTimeout($.refreshCommentList, 200)
            }
        }
        if(response.reason == 'needChecking')
        {
            $commentForm.find('.captcha-box').html(Base64.decode(response.captcha)).removeClass('hide');
        }
    } });
});
</script>
{/noparse}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
