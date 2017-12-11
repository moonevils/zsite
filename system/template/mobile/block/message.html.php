{*php*}
/**
 * The message view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
{*/php*}
{$control->app->loadLang('message')}
<div id="block{!echo $block->id}" class='panel-block-message panel panel-block {!echo $blockClass}'>
  <a href='#commentDialog' data-toggle='modal' class='btn primary block'><i class='icon-comment-alt'></i> {!echo $control->lang->message->post}</a>
  <div class='modal fade' id='commentDialog'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
          <h5 class='modal-title'><i class='icon-comment-alt'></i> {!echo $control->lang->message->post}</h5>
        </div>
        <div class='modal-body'>
          <form method='post' id='commentForm' action="{!echo helper::createLink('message', 'post', 'type=message')}">
            <div class='form-group'>
{*php*}
              echo html::textarea('content', '', "class='form-control' rows='3' placeholder='{$control->lang->message->content}'");
              echo html::hidden('objectType', 'message');
              echo html::hidden('objectID', 0);
{*/php*}
            </div>
            {if($control->session->user->account == 'guest')}
            <div class='form-group required'>
              {!echo html::input('from', '', "class='form-control' placeholder='{$control->lang->message->from}'")}
            </div>
            <div class='form-group'>
              <label><small class='text-important'>{!echo $control->lang->message->contactHidden}</small></label>
              {!echo html::input('phone', '', "class='form-control' placeholder='{$control->lang->message->phone}'")}
            </div>
            <div class='form-group'>
              {!echo html::input('qq', '', "class='form-control' placeholder='{$control->lang->message->qq}'")}
            </div>
            <div class='form-group'>
              {!echo html::input('email', '', "class='form-control' placeholder='{$control->lang->message->email}'")}
            </div>
            {else}
            <div class='form-group'>
              <span class='signed-user-info'>
                <i class='icon-user text-muted'></i> <strong>{!echo $control->session->user->realname }</strong>
                {if($control->session->user->email != '')}
                <span class='text-muted'>&nbsp;({!echo str2Entity($control->session->user->email)})</span>
                {/if}
              </span>
{*php*}
              echo html::hidden('from',   $control->session->user->realname);
              echo html::hidden('email',  $control->session->user->email); 
              echo html::hidden('qq',     $control->session->user->qq); 
              echo html::hidden('phone',  $control->session->user->phone)}
            </div>
            {/if}
            <div class='form-group'>
              <div class='checkbox'>
                <label><input type='checkbox' name='receiveEmail' value='1' checked /> {!echo $control->lang->comment->receiveEmail}</label>
              </div>
            </div>
            <div class='form-group hide captcha-box'></div>
            <div class='form-group'>
              {!echo html::submitButton('', 'btn primary')}&nbsp; 
              <small class="text-important">{!echo $control->lang->comment->needCheck}</small>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(function()
{
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
    }});
});
</script>
