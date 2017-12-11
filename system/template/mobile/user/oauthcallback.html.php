{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<div class='panel-section'>
  <div class='panel-heading bg-gray-pale'>
    <strong>{!echo $lang->user->oauth->lblProfile}</strong>
    <div class='actions'>{!echo html::a(inlink('ignoreBind'), $lang->user->oauth->ignore . '>>', "class='text-primary'") . html::hidden('referer', $referer)}</div>
  </div>
  <hr class='space'>
  <div class='panel-body'>
    <form method='post' id='registerForm' class='ajaxform' action='{!echo $control->createLink('user', 'oauthRegister')}' role='form'>
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
<hr>
<div class='panel-section'>
  <div class='panel-heading bg-gray-pale'>
    <strong>{!echo $lang->user->oauth->lblBind}</strong>
    <div class='actions'>{!echo html::a(inlink('ignoreBind'), $lang->user->oauth->ignore . '>>', "class='text-primary'") . html::hidden('referer', $referer)}</div>
  </div>
  <hr class='space'>
  <div class='panel-body'>
    <form method='post' id='bindForm' class='ajaxform' action='{!echo $control->createLink('user', 'oauthBind')}' role='form'>
      <div class='form-group'>
        <label class='control-label' for='useraccount'>{!echo $lang->user->account}</label>
        {!echo html::input('account', '', "class='form-control'")}
      </div>
      <div class='form-group'>
        <label class='control-label' for='password'>{!echo $lang->user->password}</label>
        {!echo html::password('password', '', "class='form-control'")}
      </div>
      <div class='form-group'>
        {!echo html::submitButton($lang->login, 'btn block success') . html::hidden('referer', $referer)}
      </div>
    </form>
  </div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
