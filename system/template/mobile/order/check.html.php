{*php*}
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
{*/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{!js::set('currencySymbol', $currencySymbol)}
{!js::set('createdSuccess', $lang->order->createdSuccess)}
{!js::set('goToPay', $lang->order->goToPay)}

<div class='panel panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'><i class='icon icon-shopping-cart'></i> <strong>{!echo $lang->order->selectPayment}</strong></div>
  </div>
  <form id='checkForm' action='{!echo helper::createLink('order', 'pay', "orderID=$order->id")}' method='post' target='_blank'>
    <div class="panel-body">
      <div class='alert bg-gray-pale'><strong>{!echo $lang->order->payment}</strong></div>
      <div class="form-group">
        {!echo html::radio('payment', $paymentList)}
      </div>
    </div>
    <div class='panel-body'>
      <div class='alert bg-primary-pale'>
        {!printf($lang->order->selectProducts, count($products))}
        {!printf($lang->order->totalToPay, $currencySymbol . $order->amount)}
      </div>
    </div>
    <div class='panel-footer'>
      {!echo html::submitButton($lang->order->settlement, 'btn-order-submit btn danger block')}
      {!echo html::a(helper::createLink('order', 'browse'), $lang->order->admin, "class='btn default block'")}
    </div>
  </form>
</div>

{include TPL_ROOT . 'common/form.html.php'}
<script>
$(function()
{
    $('[name=payment]').first().prop('checked', true);

    $.refreshAddressList = function()
    {
        $('#addressListWrapper').load('{!echo helper::createLink('address', 'browse') ?> #addressList', function()
        {
            $('#addressList').find('.card-footer').remove();
        });
    };

    $.refreshAddressList();

    $('#submit').click(function(){
        var payment = $('input:radio[name=payment]:checked').val();
        if(payment == 'COD')
        {
            $('#checkForm').attr('target', '');
        }
{else}
        {
            $('#checkForm').attr('target', '_blank');

            bootbox.dialog(
            {  
                message: v.goToPay,  
                buttons:
                {  
                    paySuccess:
                    {
                        label:     v.paid,  
                        className: 'btn-primary',  
                        callback:  function() { setTimeout(function(){location.href = createLink('order', 'browse');}, 600); }  
                    }
                }
            });
        }
    });
});
</script>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
