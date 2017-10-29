<?php
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
?>
<?php $this->app->loadLang('message');?>
<div id="block<?php echo $block->id;?>" class='panel-block-message panel panel-block <?php echo $blockClass;?>'>
  <a href='#commentDialog' data-toggle='modal' class='btn primary block'><i class='icon-comment-alt'></i> <?php echo $this->lang->message->post; ?></a>
  <div class='modal fade' id='commentDialog'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
          <h5 class='modal-title'><i class='icon-comment-alt'></i> <?php echo $this->lang->message->post;?></h5>
        </div>
        <div class='modal-body'>
          <form method='post' id='commentForm' action="<?php echo helper::createLink('message', 'post', 'type=message');?>">
            <div class='form-group'>
              <?php 
              echo html::textarea('content', '', "class='form-control' rows='3' placeholder='{$this->lang->message->content}'");
              echo html::hidden('objectType', 'message');
              echo html::hidden('objectID', 0);
              ?>
            </div>
            <?php if($this->session->user->account == 'guest'): ?>
            <div class='form-group required'>
              <?php echo html::input('from', '', "class='form-control' placeholder='{$this->lang->message->from}'"); ?>
            </div>
            <div class='form-group'>
              <label><small class='text-important'><?php echo $this->lang->message->contactHidden;?></small></label>
              <?php echo html::input('phone', '', "class='form-control' placeholder='{$this->lang->message->phone}'"); ?>
            </div>
            <div class='form-group'>
              <?php echo html::input('qq', '', "class='form-control' placeholder='{$this->lang->message->qq}'"); ?>
            </div>
            <div class='form-group'>
              <?php echo html::input('email', '', "class='form-control' placeholder='{$this->lang->message->email}'"); ?>
            </div>
            <?php else: ?>
            <div class='form-group'>
              <span class='signed-user-info'>
                <i class='icon-user text-muted'></i> <strong><?php echo $this->session->user->realname ;?></strong>
                <?php if($this->session->user->email != ''): ?>
                <span class='text-muted'>&nbsp;(<?php echo str2Entity($this->session->user->email);?>)</span>
                <?php endif; ?>
              </span>
              <?php
              echo html::hidden('from',   $this->session->user->realname);
              echo html::hidden('email',  $this->session->user->email); 
              echo html::hidden('qq',     $this->session->user->qq); 
              echo html::hidden('phone',  $this->session->user->phone); ?>
            </div>
            <?php endif; ?>
            <div class='form-group'>
              <div class='checkbox'>
                <label><input type='checkbox' name='receiveEmail' value='1' checked /> <?php echo $this->lang->comment->receiveEmail; ?></label>
              </div>
            </div>
            <div class='form-group hide captcha-box'></div>
            <div class='form-group'>
              <?php echo html::submitButton('', 'btn primary');?>&nbsp; 
              <small class="text-important"><?php echo $this->lang->comment->needCheck;?></small>
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
