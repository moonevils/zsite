{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<div class='panel-section'>
  <div class='panel-heading'><strong>{!echo $lang->user->oauth->lblProfile}</strong></div>
  <div class='panel-body'>
    <form method='post' class='ajaxform'>
      <div class='form-group'>
        <label class='control-label' for='username'>{!echo $lang->user->account}</label>
        {!echo html::input('account', '', "class='form-control' placeholder='{$lang->user->register->lblAccount}'")}
      </div>
      <div class='form-group'>
        <label class='control-label' for='realname'>{!echo $lang->user->realname}</label>
        {!echo html::input('realname', '', "class='form-control'")}
      </div>
      <div class='form-group'>
        <label class='control-label' for='email'>{!echo $lang->user->email}</label>
        {!echo html::input('email', '', "class='form-control'")}
      </div>
      <div class='form-group'>
        <label class='control-label' for='password'>{!echo $lang->user->password}</label>
        {!echo html::password('password1', '', "class='form-control'")}
      </div>
      <div class='form-group'>
        <label class='control-label' for='password'>{!echo $lang->user->password2}</label>
        {!echo html::password('password2', '', "class='form-control'")}
      </div>
      <div class='form-group'>
        {!echo html::submitButton('', 'btn block success') . html::hidden('referer', $referer)}
      </div>
    </form>
  </div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
