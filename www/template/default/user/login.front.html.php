<?php
include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');
js::import($jsRoot . 'md5.js');
js::import($jsRoot . 'fingerprint/fingerprint.js');
js::set('random', $this->session->random);
?>
<div class='panel panel-body' id='login'>
  <div class='row'>
    <div class='panel panel-pure' id='login-pure'>
      <div id='login-region'>
        <div class='panel-heading'><span><?php echo $lang->user->login->welcome;?></span></div>
        <div class='panel-body'>
          <form method='post' id='ajaxForm' role='form' data-checkfingerprint='1'>
            <div class='form-group hiding'><div id='formError' class='alert alert-danger'></div></div>
            <div class='form-group'><?php echo html::input('account','',"placeholder='{$lang->user->inputAccountOrEmail}' class='form-control input-lg'");?></div>
            <div class='form-group'><?php echo html::password('password','',"placeholder='{$lang->user->inputPassword}' class='form-control input-lg'");?></div>
            <?php if($config->mail->turnon and $this->config->site->resetPassword == 'open') echo html::a(inlink('resetpassword'), $lang->user->recoverPassword, "id='reset-pass'");?>
            <?php echo html::a(inlink('register'), $lang->user->register->instant, "id='register'");?>
            <?php echo html::submitButton($lang->user->login->common, 'btn btn-primary btn-wider btn-lg btn-block');?> &nbsp; &nbsp; 
            <?php echo html::hidden('referer', $referer);?>
          </form>
          <?php include TPL_ROOT . 'user/oauthlogin.html.php';?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
