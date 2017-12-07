{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'header')}
<div class='panel panel-body'>
  <div class='panel panel-pure' id='checkEmail'>
    <div class='panel-heading'><strong>{!echo $lang->user->checkEmail}</strong></div>
    <div class='panel-body'>
      <form method='post' action='{!echo inlink('checkEmail')}' id='ajaxForm'>
        <table class='table table-form'>
          <tr>
            <th>{!echo $lang->user->email}</th>
            <td>{!echo html::input('email', $user->email, "class='form-control'")}</td>
            <td>{!echo html::a($control->createLink('mail', 'sendmailcode'), $lang->user->getEmailCode, "id='mailSender' class='btn btn-xs'")}</td>
          </tr>
          <tr>
            <th>{!echo $lang->user->captcha}</th>
            <td>{!echo html::input('captcha', '', "class='form-control'")}</td>
          </tr>
          <tr>
            <th></th>
            <td>{!echo html::submitButton() . html::hidden('referer', $referer)}</td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer')}
