<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');?>
<?php js::import($jsRoot . 'fingerprint/fingerprint.js');?>
<div class="page-user-control">
  <div class="row">
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-edit'></i> <?php echo $lang->user->setEmail;?></strong></div>
        <div class='panel-body'>
          <form method='post' id='ajaxForm' class='form form-horizontal' data-checkfingerprint='1'>
            <table class='table talbe-form table-borderless'>
              <tr>
                <th class='text-right w-80px'><?php echo $lang->user->password;?></th>
                <td class='w-p50'><?php echo html::password('oldPwd', '', "class='form-control' placeholder='{$lang->user->placeholder->password}'");?></td><td></td>
              </tr>
              <tr>
                <th class='text-right'><?php echo $lang->user->newEmail;?></th>
                <td><?php echo html::input('email', '', "class='form-control'");?></td><td></td>
              </tr>
              <tr>
                <th class='text-right'><?php echo $lang->user->captcha;?></th>
                <td><?php echo html::input('captcha', '', "class='form-control' placeholder='{$lang->user->placeholder->verifyCode}'");?></td>
                <td class='text-middle'><?php echo html::a($this->createLink('mail', 'sendmailcode'), $lang->user->getEmailCode, "id='mailSender' class='btn btn-sm btn-primary'");?></td>
              </tr>
              <tr>
                <th></th>
                <td colspan='2'><?php echo html::submitButton() . html::hidden('token', $token);?></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
