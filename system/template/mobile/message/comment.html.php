{*php*}
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
{*/php*}
{*php*}
js::set('objectType', $objectType);
js::set('objectID',   $objectID);
js::set('messageRefreshUrl', $control->createLink('message', 'comment', "objecType=$objectType&objectID=$objectID"));
if(isset($pageCSS)) css::internal($pageCSS);
{*/php*}
<hr>
<div class='panel panel-section'>
  <div class='panel-heading'>
    <a href='#commentDialog' data-toggle='modal' class='btn primary block'><i class='icon-comment-alt'></i> {!echo $lang->message->post}</a>
  </div>

  <div id='commentsListWrapper'><div id='commentsList'> <?php // Double div for ajax load. ?>
    {if(isset($comments) and $comments)}
    <div class='panel-heading'>
      <div class='title'><i class='icon-comments'></i> {!echo $lang->message->list}</div>
    </div>
    <div class='cards condensed bordered'>
      {foreach($comments as $number => $comment)}
        <div class='card comment'>
          <div class='card-heading'>
            <span class='text-special name'>{!echo $comment->from?></span> &nbsp; <small class='text-muted time'>{!echo formatTime($comment->date, 'Y/m/d H:m')}</small>
            <div class='actions'>
              {!echo html::a($control->createLink('message', 'reply', "commentID=$comment->id"), $lang->comment->reply, "data-toggle='modal' data-type='ajax' data-icon='reply' data-title='{$lang->comment->reply}'")}
            </div>
          </div>
          <div class='card-content'>{!echo nl2br($comment->content)}</div>
          {$control->message->getFrontReplies($comment, 'simple')}
        </div>
      {/foreach}
    </div>
    <div class='panel-body'>
      <hr class='space'>
      {$pager->show('justify')}
    </div>
    <div class='panel-footer'>
      {if(count($comments) > 5)}
      <a href='#commentDialog' data-toggle='modal' class='btn primary block'><i class='icon-comment-alt'></i> {!echo $lang->message->post}</a>
      {/if}
    </div>
    {/if}
  </div></div>
</div>
<hr class='space'>

<div class='modal fade' id='commentDialog'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
        <h5 class='modal-title'><i class='icon-comment-alt'></i> {!echo $lang->message->post}</h5>
      </div>
      <div class='modal-body'>
        <form method='post' id='commentForm' action="{!echo $control->createLink('message', 'post', 'type=comment')}">
          <div class='form-group required'>
{*php*}
            echo html::textarea('content', '', "class='form-control' rows='3' placeholder='{$lang->message->content}'");
            echo html::hidden('objectType', $objectType);
            echo html::hidden('objectID', $objectID);
{*/php*}
          </div>
          {if($control->session->user->account == 'guest')}
          <div class='form-group required'>
            {!echo html::input('from', '', "class='form-control' placeholder='{$lang->message->from}'")}
          </div>
          <div class='form-group'>
            {!echo html::input('email', '', "class='form-control' placeholder='{$lang->message->email}'")}
          </div>
          <div class='form-group'>
            <div class='checkbox'>
              <label><input type='checkbox' name='receiveEmail' value='1' checked /> {!echo $lang->comment->receiveEmail}</label>
            </div>
          </div>
          {else}
          <div class='form-group'>
            <span class='signed-user-info'>
              <i class='icon-user text-muted'></i> <strong>{!echo $control->session->user->realname }</strong>
              {!echo html::hidden('from', $control->session->user->realname)}
              {if($control->session->user->email != '')}
              <span class='text-muted'>&nbsp;({!echo str2Entity($control->session->user->email)})</span>
              {!echo html::hidden('email', $control->session->user->email)}
              {/if}
            </span>&nbsp;
            <label class='checkbox-inline'><input type='checkbox' name='receiveEmail' value='1' checked /> {!echo $lang->comment->receiveEmail}</label>
          </div>
          {/if}
          <div class='form-group hide captcha-box'></div>
          <div class='form-group'>
            {!echo html::submitButton('', 'btn primary')}&nbsp;
            <small class="text-important">{!echo $lang->comment->needCheck}</small>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{include TPL_ROOT . 'common/form.html.php'}
{if(isset($pageJS)) js::execute($pageJS)}
<script>
$(function()
{
    $.refreshCommentList = function()
    {
        $('#commentsListWrapper').load(window.location.href + ' #commentsList');
    };

    var $commentForm = $('#commentForm'),
        $commentBox = $('#commentBox');

    $commentBox.find('.pager').on('click', 'a', function()
    {
        $commentBox.load($(this).attr('href'));
        return false;
    });

    $commentForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $('#commentDialog').modal('hide');
            $commentForm.find('#content').val('');
            setTimeout($.refreshCommentList, 200)
        }
        if(response.reason == 'needChecking')
        {
            $commentForm.find('.captcha-box').html(Base64.decode(response.captcha)).removeClass('hide');
        }
    }});
});
</script>
