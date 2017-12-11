{*php*}
/**
 * The register view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
{*/php*}
{*php*}
include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');
{*/php*}
{*php*}
  if(isset($control->config->site->agreement) and $control->config->site->agreement == 'open')
  {
    js::set('agreement', 'open');
  }
{else}
  {
    js::set('agreement', 'close');
  }
{*/php*}
<hr class='space'>
<div class='panel-section'>
  {include TPL_ROOT . 'user/oauthlogin.html.php'}
  <div class='panel-heading'>
    <div class='title'><strong>{!echo $lang->user->register->welcome}</strong></div>
  </div>
  <div class='panel-body'>
  <form class="ajaxform" method='post' id='regForm' role='form' data-checkfingerprint='1'>
    <div class='form-group hide form-message alert text-danger bg-danger-pale'>
      <i class='icon icon-info-sign icon-s1'></i>
      <div class='content'></div>
    </div>
    <div class='form-group'>
      <label class='control-label' for='account'>{!echo $lang->user->account}</label>
      {!echo html::input('account', '', "class='form-control form-control' autocomplete='off' placeholder='" . $lang->user->register->lblAccount . "'")}
    </div>
    <div class='form-group'>
      <label class='control-label' for='realname'>{!echo $lang->user->realname}</label>
      {!echo html::input('realname', '', "class='form-control'")}
    </div>
    <div class='form-group'>
      <label class='control-label' for='email'>{!echo $lang->user->email}</label>
      {!echo html::input('email', '', "class='form-control' autocomplete='off'") . ''}
    </div>
    <div class='form-group'>
      <label class='control-label' for='password1'>{!echo $lang->user->password}</label>
      {!echo html::password('password1', '', "class='form-control' autocomplate='off' placeholder='" . $lang->user->register->lblPassword . "'")}
    </div>
    <div class='form-group'>
      <label class='control-label' for='password2'>{!echo $lang->user->password2}</label>
      {!echo html::password('password2', '', "class='form-control'")}
    </div>
    <div class='form-group'>
      <label class='control-label' for='company'>{!echo $lang->user->company}</label>
      {!echo html::input('company', '', "class='form-control'")}
    </div>
    <div class='form-group'>
      <label class='control-label' for='phone'>{!echo $lang->user->phone}</label>
      {!echo html::input('phone', '', "class='form-control'")}
    </div>
    {if(isset($control->config->site->agreement) and $control->config->site->agreement == 'open')}
    <div class='form-group'>
      <label class='control-label' for='agreement'></label>
      <input type="checkbox" id="agreement" name="agreement" value="1">
      <span>{!echo $lang->user->register->agree . '《'. html::a(helper::createLink('user', 'agreement'), $control->config->site->agreementTitle ? $control->config->site->agreementTitle : $control->lang->user->register->agreement, "data-toggle='modal'") . '》'}</span>
    </div>
    {/if}
    <div class='form-group'>{!echo html::submitButton($lang->register, 'btn primary block')}{!echo html::hidden('referer', $referer)}</div>
  </form>
  </div>
</div>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
