{*php*}
/**
 * The confirm view file of order for mobile template of chanzhiEPS.
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
    <div class='title'><i class='icon icon-shopping-cart'></i> <strong>{!echo $lang->order->confirm}</strong></div>
  </div>
  {if(!empty($products))}
  <form id='confirmOrderForm' action='{!echo helper::createLink('order', 'create')}' method='post'>
    <div class='panel-body'>
      <div class='alert bg-gray-pale'><strong>{!echo $lang->order->address}</strong></div>
      <div id='addressListWrapper' class='form-group'><i class='icon icon-spin icon-spinner-indicator'></i></div>
      <button type='button' class='btn default btn-link' data-toggle='modal' data-remote='{!echo helper::createLink('address', 'create')}'><i class='icon icon-plus'></i> {!echo $lang->address->create?></button>
      {!echo html::hidden("createAddress", '')}
    </div>
    <div class='panel-body'>
      <div class='alert bg-gray-pale'><strong>{!echo $lang->order->productInfo} ({!echo count($products) ?>)</strong></div>
      <div class='cards condensed cards-list'>
        {$total = 0}
        {foreach($products as $productID => $product)}
          {$productLink = helper::createLink('product', 'view', "id=$productID", "category={$product->categories[$product->category]->alias}&name=$product->alias")}
          <div class='card'>
            <div class='table-layout'>
              <div class='table-cell thumbnail-cell'>
{*php*}
                if(empty($product->image)) 
                {
                    $productName = helper::substr($product->name, 10, '...');
                    $imgColor = $product->id * 57 % 360;
                    echo "<div class='media-holder'><div class='media-placeholder' style='background-color: hsl({$imgColor}, 60%, 80%); color: hsl({$imgColor}, 80%, 30%);' data-id='{$product->id}'>{$productName}</div></div>";
                }
{else}
                {
                    echo html::image($control->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, '', 'middleURL'), "title='{$product->name}' alt='{$product->name}'");
                }
{*/php*}
              </div>
              <div class='table-cell'>
                <table class='table table-layout table-condensed'>
                  <tbody>
                    <tr>
                      <td colspan='2'>
                        <strong>{!echo html::a($productLink, $product->name)}</strong>
                      </td>
                    </tr>
                    <tr>
                      <th class='small'>{!echo $lang->order->price}</th>
                      <td>
                        {if($product->promotion != 0)}
                        {$price = $product->promotion}
                        <span>{!echo $currencySymbol . $product->promotion}</span>&nbsp;
                        <small class='text-muted text-line-through'>{!echo $currencySymbol . $product->price}</small>
                        {else}
                        {$price  = $product->price}
                        <span>{!echo $currencySymbol . $product->price}</span>
                        {/if}
                        {!echo html::hidden("price[$product->id]", $price)}
                        {$amount = $product->count * $price}
                        {$total += $amount}
                      </td>
                    </tr>
                    <tr>
                      <th class='small'>{!echo $lang->order->amount}</th>
                      <td><strong class='text-danger'>{!echo $currencySymbol} <span class='product-amount'>{!echo $amount?></span></strong></td>
                    </tr>
                    <tr>
                      <th class='small'>{!echo $lang->order->count}</th>
                      <td>
                        {!echo $product->count}
                        {!echo html::hidden("product[$product->id]", $product->id)}
                        {!echo html::hidden("count[$product->id]", $product->count)}
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        {/foreach}
      </div>
      <hr class='space'>
      <div class='alert bg-primary-pale'>
        {!printf($lang->order->selectProducts, count($products))}
        {!printf($lang->order->totalToPay, $currencySymbol . $total)}
        {!echo html::a(helper::createLink('cart', 'browse'), "<i class='icon icon-shopping-cart'></i> " . $lang->order->backToCart, "class='text-primary pull-right'")}
      </div>
    </div>
    <div class='panel-body'>
      <div class='alert bg-gray-pale'><strong>{!echo $lang->order->note}</strong></div>
      <div>{!echo html::textarea('note', '', "class='form-control' rows=1")}</div>
    </div>
    <div class='panel-footer'>
      {!echo html::submitButton($lang->order->submit, 'btn-order-submit btn danger block')}
    </div>
  </form>
  {else}
  <div class='panel-body'>
    <div class='alert bg-warning-pale text-center'>
      <p><i class='icon-smile icon-x3'></i></p>
      {!echo $lang->cart->noProducts}
    </div>
    <hr class='space'>
    <div class='row'>
      <div class='col-6'>
        {!echo html::a(helper::createLink('product', 'browse', 'category=0'), $lang->cart->pickProducts, "class='btn primary block'")}
      </div>
      <div class='col-6'>
        {!echo html::a(helper::createLink('index', 'index'), $lang->cart->goHome, "class='btn default block'")}
      </div>
    </div>
  </div>
  {/if}
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
            if($('#addressList').find('.card').size() == 0)
            {
                $('#createAddress').val(1);
                $('[name=address]').prop('checked', false);
            }
{else}
            {
                $('#createAddress').val(0);
            }
            $('#addressList').find('.card-footer').remove();
        });
    };

    $.refreshAddressList();

    var $confirmOrderForm = $('#confirmOrderForm');
    $confirmOrderForm.ajaxform({onResultSuccess: function(response)
    {
        $.messager.success('{!echo $lang->order->createdSuccess?>');
        window.location.href = response.locate ? response.locate : '{!echo helper::createLink('order', 'browse')}';
    }});
});
</script>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
