{*php*}
include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');
{*/php*}
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title'><strong>{!echo $lang->user->oauth->lblBind}</strong></div>
  </div>
  <div class='panel-body'>
    <form method='post' class='ajaxform' role='form'>
      <div class='form-group'>
        <label class='control-label' for='useraccount'>{!echo $lang->user->account}</label>
        {!echo html::input('account', '', "class='form-control'")}
      </div>
      <div class='form-group'>
        <label class='control-label' for='password'>{!echo $lang->user->password}</label>
        {!echo html::password('password', '', "class='form-control'")}
      </div>
      <div class='form-group'>
        {!echo html::submitButton($lang->login, 'btn primary block') . html::hidden('referer', $referer)}
      </div>
    </form>
  </div>
</div>
{include TPL_ROOT . 'common/form.html.php'}
