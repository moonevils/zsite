<?php
/**
 * The login view file of block module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php if($this->loadModel('user')->isLogon()) return true;?>
<div id="block<?php echo $block->id;?>" class='panel-block-login panel panel-block <?php echo $blockClass;?>'>
<?php
if(!$this->session->random) $this->session->set('random', md5(time() . mt_rand()));
$referer = $this->app->getURI();
js::import($this->config->webRoot . 'js/md5.js');
js::import($this->config->webRoot . 'js/fingerprint/fingerprint.js');
js::set('random', $this->session->random);
?>
  <div class='panel-heading'><strong><?php echo $icon . $block->title;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' role='form' data-checkfingerprint='1'>
      <div class='form-group hiding'><div id='formError' class='alert alert-danger'></div></div>
      <div class='form-group'><?php echo html::input('account','',"placeholder='{$this->lang->user->inputAccountOrEmail}' class='form-control input-lg'");?></div>
      <div class='form-group'><?php echo html::password('password','',"placeholder='{$this->lang->user->inputPassword}' class='form-control input-lg'");?></div>
      <?php if($this->config->mail->turnon and $this->config->site->resetPassword == 'open') echo html::a(helper::createLink('user', 'resetpassword'), $this->lang->user->recoverPassword, "id='reset-pass' style='margin-left:5px;color:gray;'");?>
      <?php echo html::a(helper::createLink('user', 'register'), $this->lang->user->register->instant, "id='register' style='float:right;right:5px;margin-bottom:8px;'");?>
      <?php echo html::submitButton($this->lang->user->login->common, 'btn btn-primary btn-wider btn-lg btn-block');?> 
    </form>
    <?php include TPL_ROOT . 'user/oauthlogin.html.php';?>
  </div>
</div>
<script>
$(function()
{
    $('.panel-block-login #submit').click(function()
    {
        var $form    = $(this).closest('form');
        var account  = $form.find('#account').val();
        var password = $form.find('#password').val();
        var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
        if(!reg.test(account)) password = md5(md5(md5(password) + account) + v.random);

        fingerprint = getFingerprint();

        loginURL = createLink('user', 'login');
        $.ajax(
        {
            type: "POST",
            data:"account=" + account + '&password=' + password + '&referer=' + encodeURIComponent(self.location.href) + '&fingerprint=' + fingerprint,
            url:loginURL,
            dataType:'json',
            success:function(data)
            {
                if(data.result == 'success') return location.href=data.locate;
                $.ajax(
                {
                    type: "POST",
                    data:"account=" + account + '&password=' + $form.find('#password').val() + '&referer=' + encodeURIComponent(self.location.href) + '&fingerprint=' + fingerprint,
                    url:loginURL,
                    dataType:'json',
                    success:function(data)
                    {
                        if(data.result == 'fail') showFormError(data.message);
                        if(data.result == 'success') location.href=data.locate;
                        if(typeof(data) != 'object') showFormError(data);
                    },
                    error:function(data){showFormError(data.responseText);}
                })
            },
            error:function(data)
            {
                var error = $form.find('#formError').text(data.responseText);
                var parent = error.closest('.form-group');
                if(parent.length) parent.show();
                else error.show();
            }
        })
        return false;
    });
});
</script>
