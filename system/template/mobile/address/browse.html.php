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
{*include $control->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side')*}

<div class='manage'>
  <p name="operate" current="manage">{$lang->address->manage}</p>
  <input type="hidden" name="manage" value="{$lang->address->manage}">
  <input type="hidden" name="manageDone" value="{$lang->address->manageDone}">
</div>
<div class='panel'>
  <div class="panel-body">
    <div class='title strong vertical-center'>
        <span class="vertical-line"></span><span class="address">{$lang->address->browse}</span>
    </div>
    <div id='addressListWrapper'>
      <div class='list' id='addressList'>
        {@$i=0}
        {foreach($addresses as $address)}
          {@$i++}
          {$checked = isset($checked) ? '' : 'checked'}
          <div class='item'>
            <div class='card-heading'>
              <label class="checkbox-circle" style="display: none;">
                  <input type="checkbox" id="checkbox{$i}" name='delAddresses'  value='{$address->id}'>
                  <label for="checkbox{$i}"></label>
              </label>
              <strong class='lead' style="position: absolute;">{$address->contact}</strong>
              <span class='text' style="margin-left: 7rem;">{!substr($address->phone, 0, 3) . '****' . substr($address->phone, -4)}</span>
              {if(!$address->isDefault)}
              <label class="label-default text-primary">{$lang->address->default}</label>
              {/if}
            </div>
            <div class='card-content'>
              {$address->address}
              <span class="edit-button">
                {!html::a(helper::createLink('address', 'edit', "id={{$address->id}}"), $lang->edit, "class='editor text-primary' data-toggle='modal'")}
              </span>
            </div>
            <div class='card-footer'>
              {*!html::a(helper::createLink('address', 'delete', "id={{$address->id}}"), $lang->delete, "class='deleter text-danger'")*}
            </div>
          </div>
          {if($i < count($addresses))}
          <div class="divider"></div>
          {/if}
        {/foreach}
          <button id="create" type='button' class='btn primary outline' data-toggle='modal' data-remote='{!inlink('create')}'>{$lang->address->create}</button>
          {!html::a(helper::createLink('address', 'delete', "id={{$address->id}}"), $lang->delete, "class='deleter text-danger'")}
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
    };
});
</script>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
