{*php*}
/**
 * The cart view of cart module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     cart 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
{*/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{!js::set('currencySymbol', $currencySymbol)}
<div class='panel panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'><i class='icon icon-shopping-cart'></i> <strong>{!echo $lang->cart->browse}</strong>{if(!empty($products)) echo ' (' . count($products) . ')' ?></div>
  </div>
  {if(!empty($products))}
  <form action='{!echo helper::createLink('order', 'confirm')}' method='post'>
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
                echo html::image($control->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, 'product', 'middleURL'), "title='{$product->name}' alt='{$product->name}'");
            }
{*/php*}
          </div>
          <div class='table-cell'>
            <table class='table table-layout table-condensed'>
              <tbody>
                <tr>
                  <td colspan='2'>
                    <strong>{!echo html::a($productLink, $product->name)}</strong>
                    <div class='pull-right'>
                      {!echo html::a(inlink('delete', "product={$product->id}"), $lang->delete, "class='deleter text-primary'")}
                      {!echo html::hidden("product[]", $product->id)}
                    </div>
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
                    <div class='input-group input-group-sm input-number'>
                      <span class='input-group-btn'>
                        <button class='btn default btn-minus' type='button'><i class='icon icon-minus'></i></button>
                      </span>
                      {!echo html::input("count[$product->id]", $product->count, "class='form-control-number form-control' data-price='{$price}'")}
                      <span class='input-group-btn'>
                        <button class='btn default btn-plus' type='button'><i class='icon icon-plus'></i></button>
                      </span>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    {/foreach}
    </div>
    <div class='panel-footer'>
      <div class='bg-primary-pale alert text-center'>
      {!printf($lang->order->selectProducts, count($products))}
      {!printf($lang->order->totalToPay, $currencySymbol . $total)}
      </div>
      {!echo html::submitButton($lang->cart->goAccount, 'btn-order-submit btn block danger')}
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

<script>
+(function($){
    'use strict';

    var minDelta = 20;

    $.fn.numberInput = function(){
        return $(this).each(function(){
            var $input = $(this);
            $input.on('click', '.btn-minus, .btn-plus', function(){
                var $val = $input.find('.form-control-number, [type="number"]');
                var val = parseInt($val.val());
                val = Math.max(1, $(this).hasClass('btn-minus') ? (val - 1) : (val + 1));
                $val.val(val).trigger('change');
            });
        });
    };

    $(function(){$('.input-number').numberInput();});
}(Zepto));

$(function()
{
    var caculateTotal = function()
    {
        var total = 0;
        $('.product-amount').each(function()
        {
            total += parseFloat($(this).text());
        });
        $('#amount').text(window.v.currencySymbol + total);
    };

    $('.form-control-number').on('change', function()
    {
        var $input = $(this);
        $input.closest('.card').find('.product-amount').text($input.val() * $input.data('price'));
        caculateTotal();
    });
});
</script>
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
