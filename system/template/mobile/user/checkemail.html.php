{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<hr class='space'>
<div class='panel-section' id='checkEmail'>
  <div class='panel-heading'><strong>{!echo $lang->user->checkEmail}</strong></div>
  <div class='panel-body'>
    <form method='post' class='ajaxform' action='{!echo inlink('checkEmail')}'>
      <div class='form-group hide form-message alert text-danger bg-danger-pale'>
        <i class='icon icon-info-sign icon-s1'></i>
        <div class='content'></div>
      </div>
      <div class='form-group'>
        <label class='control-label' for='email'>{!echo $lang->user->email}</label>
        {!echo html::input('email', $user->email, "class='form-control'")}
      </div>
      <div class='form-group'>
        {!echo html::a($control->createLink('mail', 'sendmailcode'), $lang->user->getEmailCode, "id='mailSender' class='btn default ajaxaction'")}</td>
      </div>
      <div class='form-group'>
        <label class='control-label' for='captcha'>{!echo $lang->user->captcha}</label>
        {!echo html::input('captcha', '', "class='form-control'")}
      </div>
      <div class='form-group'>{!echo html::submitButton('', 'btn primary block')}{!echo html::hidden('referer', $referer)}</div>
    </form>
  </div>
</div>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
