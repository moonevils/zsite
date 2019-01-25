{*php
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
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
<style>
  .modal-content {border:0px}
</style>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-body'>
      <form id='editProfileForm' method='post' action="{!inlink('editInfo')}" data-checkfingerprint='1'>
        <div class='form-group form-pad-list'>
          <div class='form-group pad-label-left'>
            {!html::input($field, $user->$field, "class='form-control'")}
            {!html::input('field', $field, "class='hide'")}
            <label for='{$field}'>{$lang->user->$field}</label>
          </div>
        </div>
        <div class='form-group'>
          {!html::submitButton('', 'btn primary block')}
        </div>
      </form>
    </div>
  </div>
</div>
{noparse}
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
    }
    });
});
</script>
{/noparse}
