{*php
/**
 * The check view file of order for mobile template of chanzhiEPS.
 * The file should be used as ajax content
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
{!js::set('currencySymbol', $currencySymbol)}
{!js::set('createdSuccess', $lang->order->createdSuccess)}
{!js::set('goToPay', $lang->order->goToPay)}
<style>
.text-danger {color:#D0021B}
.panel-body .bg-gray-pale {background-color:#fff;padding:8px 0px;font-size:1.5rem}
.panel-body .bg-gray-pale > strong {border-left:2px solid #3C77FE;padding-left:5px}
.bg-primary-pale {background-color:#E0E9FF}
.form-group {overflow:hidden;margin-bottom:10px}

#footer {line-height:49px;height:49px}
.footer-right {width:100%;text-align:center}
.footer-right > .right-total {float:right;margin-right:12px}
.footer-right > .right-btn {width:84px;float:right;margin-right:12px}
.footer-right > .right-btn > input,a {width:100%;line-height:28px;height:30px;border-radius:4px;padding:0px;outline:none}
.footer-right > .right-btn > .btn-order-submit {border:1px solid #6F9AFE;color:#fff;background:linear-gradient(to right,#709BFE,#1B5AFF)}
.footer-right > .right-btn > .btn-order-manage {border:1px solid #6F9AFE;color:#6F9AFE;background-color:#fff;padding:0px;line-height:28px}

.checkarea > label {float:left;width:50%;margin-top:5px;position: relative;padding-left:25px;margin-bottom:14px}
.checkarea > label > label {z-index: 0;padding-bottom:13px}
.checkarea > label > label:after, .checkarea > label > label:before {position: absolute;top: .3rem;left: 0;display: -ms-flexbox;display: flex;width: 1.5rem;height: 1.5rem;content: ' ';transition: .2s cubic-bezier(.175,.885,.32,1);color: transparent;border: .1rem solid rgba(0,0,0,.5);-ms-flex-align: center;align-items: center;-ms-flex-pack: center;justify-content: center;border-radius: 1.5rem}
.footer-left > .checkarea > label > label:after, .footer-left > .checkarea > label > label:before {top:18px}
.checkarea > label > input:checked + label:after, .checkarea > label > input:checked + label:before {color: #fff;border-radius: .1rem;background-color: #3280fc;border-radius: 1.5rem}
.checkarea > label > label:after {font-family: ZenIcon;font-size: 1.5rem;font-weight: 400;font-style: normal;font-variant: normal;content: '\e60d';text-transform: none;border: none;speak: none;-webkit-font-smoothing: antialiased}
.checkarea > label > input {position: absolute;z-index: 1;top: 0;left: 0;display: block;width: 100%;height: 100%;opacity: 0;}

</style>
<div class='panel panel-section'>
  <form id='checkForm' action='{!helper::createLink('order', 'pay', "orderID=$order->id")}' method='post' target='_blank'>
    <div class="panel-body">
      <div class='bg-gray-pale'><strong>{$lang->order->payment}</strong></div>
      <div class="form-group">
        <div class='checkarea'>
          {!html::radio('payment', $paymentList)}
        </div>
      </div>
      {if($inWechat)}<div class='alert bg-primary-pale'>{$lang->order->inWechatTip}</div>{/if}
    </div>
    <div class='panel-body'>
      <div class='alert bg-primary-pale'>
        {!printf($lang->order->selectProducts, count($products))}
        {!printf($lang->order->totalToPay, $currencySymbol . $order->amount)}
      </div>
    </div>
    <div class='panel-footer'>
    </div>
    <footer class="appbar fix-bottom" id='footer' data-ve='navbar' data-type='mobile_bottom'>
      <div class='footer-right'>
        <div class='right-btn'>
          {!html::submitButton($lang->order->settlement, 'btn-order-submit btn danger')}
        </div>
        <div class='right-btn'>
          {!html::a(helper::createLink('order', 'browse'), $lang->order->admin, "class='btn-order-manage btn'")}
        </div>
      </div>
    </footer>
  </form>
</div>

{include TPL_ROOT . 'common/form.html.php'}
{noparse}
<script>
$(function()
{
    $('[name=payment]').eq(0).prop('checked', true);

    $('#checkForm').ajaxform(
    {
        onSuccess: function(response)
        {
            if(response.result != 'success') $.messager.success(response.message);
            if(response.locate) window.location.href = response.locate;
        }
    });

});
</script>
{/noparse}
