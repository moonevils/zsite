<?php
/**
 * The front login view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header'); ?>
<hr class='space'>
<div class='panel-section'>
  <?php include TPL_ROOT . 'user/oauthlogin.html.php';?>
  <div class='panel-heading'>
    <div class='title'><strong><?php echo $lang->user->login->welcome;?></strong></div>
  </div>
  <div class='panel-body'>
  <form method='post' id='loginForm' role='form' data-checkfingerprint='1'>
    <div class='form-group hide form-message alert text-danger bg-danger-pale'>
      <i class='icon icon-info-sign icon-s1'></i>
      <div class='content'></div>
    </div>
    <div class='form-group'><?php echo html::input('account','',"placeholder='{$lang->user->inputAccountOrEmail}' class='form-control'");?></div>
    <div class='form-group'><?php echo html::password('password','',"placeholder='{$lang->user->inputPassword}' class='form-control'");?></div>
    <div class='form-group'><?php echo html::submitButton($lang->user->login->common, 'btn primary block');?></div>
    <div class='form-group'>
      <?php if($config->mail->turnon and $this->config->site->resetPassword == 'open') echo html::a(inlink('resetpassword'), $lang->user->recoverPassword, "class='btn btn-link'") . ' ';?>
      <?php echo html::a(inlink('register'), $lang->user->register->common, "class='btn btn-link'");?>
      <?php echo html::hidden('referer', $referer);?>
    </div>
  </form>
  </div>
</div>
<?php include TPL_ROOT . 'common/form.html.php'; ?>
<script>
$(function()
{
    $('#loginForm').ajaxform(
    {
        onSubmit: function(data)
        {
            var account = data['account'];
            var password = data['password'];
            var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
            if(!reg.test(account)) password = md5(md5(md5(password) + account) + v.random);
            data['password'] = password;
        }
    });
});
</script>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer');?>
