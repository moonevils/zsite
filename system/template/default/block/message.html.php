<?php
/**
 * The page form view file of block module of chanzhiEPS.
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

  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
  </div>

  <div class='panel-body'>

  <form method='post' class='form-horizontal' id='messageForm' action="<?php echo helper::createLink('message', 'post', 'type=message&block=block','',false);?>">
    <?php
      $from   = $this->session->user->account == 'guest' ? '' : $this->session->user->realname;
      $mobile = $this->session->user->account == 'guest' ? '' : $this->session->user->mobile;
      $qq     = $this->session->user->account == 'guest' ? '' : $this->session->user->qq;
    ?>

    <div class='form-group'>
    <label for='blockFrom' class='col-sm-2 control-label'><?php echo $this->lang->message->from; ?></label>
      <div class='col-sm-10 required'>
        <?php echo html::input('blockFrom', $from, "class='form-control'"); ?>
      </div>
    </div>

    <div class='form-group'>
      <label for='mobile' class='col-sm-2 control-label'><?php echo $this->lang->message->mobile; ?></label>
      <div class='col-sm-10'>
        <?php echo html::input('mobile', $mobile, "class='form-control'"); ?>
      </div>
    </div>

    <div class='form-group'>
      <label for='qq' class='col-sm-2 control-label'><?php echo $this->lang->message->qq;?></label>
      <div class='col-sm-10'>
        <?php echo html::input('qq', $qq, "class='form-control'"); ?>
      </div>
    </div>

    <div class='form-group'>
      <label for='blockContent' class='col-sm-2 control-label'><?php echo $this->lang->message->content;?></label>
      <div class='col-sm-10 required'>
        <?php
          echo html::textarea('blockContent', '', "class='form-control' rows='2'");
          echo html::hidden('objectType', 'message');
          echo html::hidden('objectID', 0);
        ?>
      </div>
    </div>

    <?php if(zget($this->config->site, 'captcha', 'auto') == 'open'):?>
      <div class='form-group' id='blockCaptchaBox'>
        <?php echo $this->loadModel('guarder')->create4Comment(false);?>
      </div>
    <?php else:?>
      <div class='form-group hiding' id='blockCaptchaBox'></div>
    <?php endif;?>

    <div class='form-group' align="center">
      <div class='col-sm-1'></div>
        <div class='col-sm-11 col-sm-offset-1'>
        <span><?php echo html::submitButton();?></span>
      </div>
    </div>

    </form>
  </div>
</div>

<script>
$(document).ready(function()
{
    $.setAjaxForm('#messageForm', function(response)
    {   
        if(response.result != 'success')
        {   
            if(response.reason == 'needChecking')
            {   
                $('#blockCaptchaBox').html(Base64.decode(response.captcha)).show();
            }
        }   
        else
        {
           location.href=createLink('message', 'index'); 
        }
    }); 
});
</script>
