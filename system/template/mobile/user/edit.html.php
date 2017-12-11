{*php*}
/**
 * The edit view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
{*/php*}
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-edit'></i> {!echo $lang->user->editProfile}</h5>
    </div>
    <div class='modal-body'>
      <form id='editProfileForm' method='post' action="{!echo inlink('edit')}" data-checkfingerprint='1'>
        <div class='form-group form-pad-list'>
          <label for='realname' class='text-muted small'>{!echo $lang->user->realname}</label>
          {if($user->admin == 'super')}
            {if(count(explode(',', $control->config->enabledLangs)) > 1)}
            {if(strpos($control->config->enabledLangs, 'zh-cn') !== false)}
            <div class='form-group pad-lable-left'>
              {!echo html::input("realnames[cn]", isset($user->realnames->cn) ? $user->realnames->cn : '', "class='form-control'")}
              <label>{!echo $config->langs['zh-cn']?></label>
            </div>
            {/if}
            {if(strpos($control->config->enabledLangs, 'zh-tw') !== false)}
            <div class='form-group pad-lable-left'>
              {!echo html::input("realnames[tw]", isset($user->realnames->tw) ? $user->realnames->tw : '', "class='form-control'")}
              <label>{!echo $config->langs['zh-tw']}</label>
            </div>
            {/if}
            {if(strpos($control->config->enabledLangs, 'en') !== false)}
            <div class='form-group pad-lable-left'>
              {!echo html::input("realnames[en]", isset($user->realnames->en) ? $user->realnames->en : '', "class='form-control'")}
              <label>{!echo $config->langs['en']?></label>
            </div>
            {/if}
            {else}
            {$clientLang = $control->config->defaultLang}
            {$clientLang = strpos($clientLang, 'zh-') !== false ? str_replace('zh-', '', $clientLang) : $clientLang}
            {!echo html::input("realnames[{$clientLang}]", $user->realname, "class='form-control'")}
            {/if}
          {else}
          {!echo html::input('realname', $user->realname, "class='form-control'")}
          {/if}
        </div>
        <div class='form-group form-pad-list'>
          <label class='text-muted small'>{!echo $lang->user->password}</label>
          <div class='form-group pad-lable-left'>
            {!echo html::password('oldPwd', '', "class='form-control'")}
            <label for='oldPwd'>{!echo $lang->user->oldPwd}</label>
          </div>
          <div class='form-group pad-lable-left'>
            {!echo html::password('password1', '', "class='form-control'")}
            <label for='password'>{!echo $lang->user->password}</label>
          </div>
          <div class='form-group pad-lable-left'>
            {!echo html::password('password2', '', "class='form-control'")}
            <label for='password2'>{!echo $lang->user->password2}</label>
          </div>
        </div>
        <div class='form-group pad-lable-left'>
          {!echo html::input('company', $user->company, "class='form-control'")}
          <label for='company'>{!echo $lang->user->company}</label>
        </div>
        <div class='form-group form-pad-list'>
          <div class='form-group pad-lable-left'>
            {!echo html::input('address', $user->address, "class='form-control'")}
            <label for='address'>{!echo $lang->user->address}</label>
          </div>
          <div class='form-group pad-lable-left'>
            {!echo html::input('zipcode', $user->zipcode, "class='form-control'")}
            <label for='zipcode'>{!echo $lang->user->zipcode}</label>
          </div>
          <div class='form-group pad-lable-left'>
            {!echo html::input('mobile', $user->mobile, "class='form-control'")}
            <label for='mobile'>{!echo $lang->user->mobile}</label>
          </div>
          <div class='form-group pad-lable-left'>
            {!echo html::input('phone', $user->phone, "class='form-control'")}
            <label for='phone'>{!echo $lang->user->phone}</label>
          </div>
          <div class='form-group pad-lable-left'>
            {!echo html::input('qq', $user->qq, "class='form-control'")}
            <label for='qq'>{!echo $lang->user->qq}</label>
          </div>
          <div class='form-group pad-lable-left'>
            {!echo html::input('gtalk', $user->gtalk, "class='form-control'")}
            <label for='gtalk'>{!echo $lang->user->gtalk}</label>
          </div>
        </div>
        <div class='form-group'>
          {!echo html::submitButton('', 'btn primary block') . html::hidden('token', $token)}
        </div>
      </form>
    </div>
  </div>
</div>
<script>
$(function()
{
    var $editProfileForm = $('#editProfileForm');
    $editProfileForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $.closeModal();
        }
    }});
});
</script>
