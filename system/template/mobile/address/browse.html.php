{*php
/**
 * The browse view file of address for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     address
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}

<div class='manage vertical-center'>
  <p name='operate' current='manage' style='{if(count($addresses) == 0)}display:none;{/if}'>{$lang->address->manage}</p>
  <input type='hidden' name='manage' value='{$lang->address->manage}'>
  <input type='hidden' name='manageDone' value='{$lang->address->manageDone}'>
</div>
<div class='panel'>
  <div class='panel-body'>
    <div class='title strong vertical-center'>
        <span class='vertical-line'></span><span class='browse'>{$lang->address->browse}</span>
    </div>
    <div id='addressListWrapper'>
      <div class='list container' id='addressList'>
        {@$i=0}
        {foreach($addresses as $address)}
          {@$i++}
          {$checked = isset($checked) ? '' : 'checked'}
          <div class='item'>
            <div class='vertical-center'>
              <label class='checkbox-circle item-checkbox'>
                <input type='checkbox' id='checkbox{$i}' name='deliveryAddress'  value='{$address->id}'>
                <label for='checkbox{$i}'></label>
              </label>
            </div>
            <div class='address-edit'>
              <div class='card-heading vertical-center'>
                <strong class='lead' style='position: absolute;'>{$address->contact}</strong>
                <span class='text' style='margin-left: 90px;'>{!substr($address->phone, 0, 3) . '****' . substr($address->phone, -4)}</span>
                {if(zget($address, 'isDefault', 0))}
                <span class='address-default text-primary'>{$lang->address->default}</span>
                {/if}
              </div>
              <div class='card-content vertical-center alignment-address'>
                <span class='address'>
                  {$address->address}
                </span>
                <span class='edit-button'>
                  {!html::a(helper::createLink('address', 'edit', "id={{$address->id}}"), $lang->edit, "class='editor text-primary' data-toggle='modal'")}
                </span>
              </div>
            </div>
          </div>
          {if($i < count($addresses))}
          <div class='divider'></div>
          {/if}
        {/foreach}
      </div>
    </div>
    <div class='bottom-operator'>
      <div class='{if(count($addresses) == 0)}create-center{/if}'>
        <button id='create' type='button' class='create-btn' data-toggle='modal' data-remote="{!inlink('create')}">
        {$lang->address->create}
        </button>
      </div>
      <div id='delete' class='vertical-center alignment-delete' style='display: none;'>
        <label class='all-delete checkbox-circle vertical-center'>
          <input type='checkbox' id='allDelete'>
          <label for='allDelete'></label>
          <span>{$lang->address->allDelete}</span>
        </label>
        {!html::a(helper::createLink('address', 'delete', "id="), $lang->delete, 'class="delete-btn vertical-center deleter"')}
      </div>
    </div>
  </div>
</div>
<script>
$(function()
{
    $.refreshAddressList = function()
    {
        $('#addressListWrapper').load(window.location.href + ' #addressList');
        $('p[name="operate"]').show();
        $('#create').parent().removeClass('create-center');
    };
});
</script>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
