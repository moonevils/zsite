{*php
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
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
{!js::set('currencySymbol', $currencySymbol)}
<style>
  body {background:#f6f6f6}
  .panel.panel-section {border:0px;margin:0px}
  .panel-section .panel-heading.page-header {margin-top:0px;height:44px;line-height:44px;padding:0px 10px} 
  .panel-section .panel-heading.page-header .title {color:#999} 
  .cards.condensed.cards-list {background:#f6f6f6;padding-bottom:1px;overflow:hidden;padding:0px} 
  .cards.condensed .card {margin:10px;padding:0px}
  .input-group.input-group-sm.input-number {width:100px;float:right}
  .input-group input {text-align:center;height:32px}
  .media-placeholder {line-height:120px;padding:0px}
  .showcase {height:120px;;overflow:hidden;width:30%;text-align:center;float:left}
  .showcase img {height:100%;}
  .table-cell {float:left;width:62%;padding-left:10px;padding-right:10px}
  .table-layout > tbody > tr > th {width:30px;color:#999999}
  .table-layout > tbody > tr > td, .table-layout > tbody > tr > th, .table-layout > tfoot > tr > td, .table-layout > tfoot > tr > th, .table-layout > thead > tr >t d, .table-layout > thead > tr > th {padding-right:0px;padding-left:0px}
  .text-danger {color:#D0021B}
  .input-group-btn .btn.default {padding:5px 10px}
  .checkarea {float:left;width:8%;text-align:center;margin-top:45px;position: relative}
  .opt {float:right;font-size:1.5rem}
  .total {display: table-cell;vertical-align: middle;height:40px}
  .checkarea > label {position: relative;z-index: 0;padding: .25rem 0 .25rem 1.8rem}
  .checkarea > label:after, .checkarea > label:before {position: absolute;top: .3rem;left: 0;display: -ms-flexbox;display: flex;width: 1.5rem;height: 1.5rem;content: ' ';transition: .2s cubic-bezier(.175,.885,.32,1);color: transparent;border: .1rem solid rgba(0,0,0,.5);-ms-flex-align: center;align-items: center;-ms-flex-pack: center;justify-content: center;border-radius: 1.5rem}
  .footer-left > .checkarea > label:after, .footer-left > .checkarea > label:before {top:16px}
  .checkarea > input:checked + label:after, .checkarea > input:checked + label:before {color: #fff;border-radius: .1rem;background-color: #3280fc;border-radius: 1.5rem}
  .checkarea > label:after {font-family: ZenIcon;font-size: 1.5rem;font-weight: 400;font-style: normal;font-variant: normal;content: '\e60d';text-transform: none;border: none;speak: none;-webkit-font-smoothing: antialiased}
  .checkarea > input {position: absolute;z-index: 1;top: 0;left: 0;display: block;width: 100%;height: 100%;opacity: 0;}
  #footerNav {line-height:49px;height:49px}
  .footer-left {width:20%;float:left;padding-left:12px}
  .footer-left > a > img {width:20px;height:20px}
  .footer-left > a > span {position:absolute;z-index:1;top:-.8rem;right:-.8rem;width:18px;height:18px;text-align:center;line-height:18px}
  .footer-right {width:80%;float:right;}
  .footer-right > .right-btn {width:41.5%;float:right;margin-right:12px}
  .footer-right > .right-btn > .total > span {font-size:1rem}
  .footer-right > .right-btn > button,input {width:100%;line-height:28px;height:30px;border-radius:4px;padding:0px;outline:none}
  .footer-right > .right-btn > .btn-order-delete {border:1px solid #6F9AFE;color:#6F9AFE;background-color:#fff}
  .footer-right > .right-btn > .btn-order-submit {border:1px solid #6F9AFE;color:#fff;background:linear-gradient(to right,#709BFE,#1B5AFF)}
</style>
<div class='panel panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'>{if(!empty($products))} {$cartProducts = count($products)}{else}{$cartProducts = 0}{/if}{!printf($lang->order->cartProducts, $cartProducts)}</div>
    <div class='opt admin'>管理</div>
    <div class='opt complete hide'>完成</div>
  </div>
  {if(!empty($products))}
    <form action='{!helper::createLink('order', 'confirm')}' method='post'>
      <div class='cards condensed cards-list'>
      {$total = 0}
      {foreach($products as $productID => $product)}
        {$productLink = helper::createLink('product', 'view', "id=$productID", "category={{$product->categories[$product->category]->alias}}&name=$product->alias")}
        <div class='card'>
          <div class='table-layout'>
            <div class='checkarea'>
              <input class='check-product' type='checkbox' name='product[]' value='{$product->id}'>
              <label for='buyMethod'></label>
            </div>
            <div class='showcase'>
              {if(empty($product->image))}
                {$productName = helper::substr($product->name, 10, '...')}
                {$imgColor = $product->id * 57 % 360}
                <div class='media-holder'>
                  <div class='media-placeholder' style='background-color: hsl({$imgColor}, 60%, 80%); color: hsl({$imgColor}, 80%, 30%);' data-id='{$product->id}'>
                    {$productName}
                  </div>
                </div>
              {else}
                {$product->image->primary->objectType = 'product'}
                {!html::image($control->loadModel('file')->printFileURL($product->image->primary, 'middleURL'), "title='{{$product->name}}' alt='{{$product->name}}'")}
              {/if}
            </div>
            <div class='table-cell'>
              <table class='table table-layout table-condensed'>
                <tbody>
                  <tr>
                    <td colspan='3'>
                      <div style='height:40px;overflow:hidden;'>
                        <strong>{!html::a($productLink, $product->name)}</strong>
                      </div>
                      <!--<div class='pull-right'>
                        {!html::a(inlink('delete', "product={{$product->id}}"), $lang->delete, "class='deleter text-primary'")}
                        {!html::hidden("product[]", $product->id)}
                      </div>-->
                    </td>
                  </tr>
                  <tr>
                    <th class='small'>{$lang->order->price}</th>
                    <td colspan='2'>
                      {if($product->promotion != 0)}
                        {$price = $product->promotion}
                        <span>{!echo $currencySymbol . $product->promotion}</span>&nbsp;
                        <small class='text-muted text-line-through'>{!echo $currencySymbol . $product->price}</small>
                      {else}
                        {$price  = $product->price}
                        <span>{!echo $currencySymbol . $product->price}</span>
                      {/if}
                      {!html::hidden("price[$product->id]", $price)}
                      {$amount = $product->count * $price}
                      {$total += $amount}
                    </td>
                  </tr>
                  <tr>
                    <th class='small'>{$lang->order->amount}</th>
                    <td style='line-height:38px'>
                      <strong class='text-danger'>{$currencySymbol}<span class='product-amount'>{$amount}</span></strong>
                    </td>
                    <td>
                      <div class='input-group input-group-sm input-number'>
                        <span class='input-group-btn'>
                          <button class='btn default btn-minus' type='button'><i class='icon icon-minus'></i></button>
                        </span>
                        {!html::input("count[$product->id]", $product->count, "class='form-control-number form-control' data-price='{{$price}}'")}
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
      <footer class="appbar fix-bottom" id='footerNav' data-ve='navbar' data-type='mobile_bottom'>
      <div class='footer-left'>
        <div class='checkarea' style='margin-top:0px;padding-left:0px;width:100%;text-align:left'>
            <input type='checkbox' id='checkAll'>
            <label style='width:50px'>{$lang->selectAll}</label>
        </div>
      </div>          
      <div class='footer-right'>
        <div class='right-btn'>
          {!html::submitButton($lang->cart->goAccount, 'btn-order-submit')}
          <button type='button' class='btn-order-delete hide'>{$lang->delete}</button>
        </div>
        <div class='right-btn' style='margin-right:5px;width:auto'>
          <div class='total'>
            <span>{!printf($lang->order->statistics, 0, $currencySymbol . '0')}</span>
          </div>
        </div>
      </div>
      </footer>
    </form>
  {else}
    <div class='panel-body'>
      <div class='alert bg-warning-pale text-center'>
        <p><i class='icon-smile icon-x3'></i></p>
        {$lang->cart->noProducts}
      </div>
      <hr class='space'>
      <div class='row'>
        <div class='col-6'>
          {!html::a(helper::createLink('product', 'browse', 'category=0'), $lang->cart->pickProducts, "class='btn primary block'")}
        </div>
        <div class='col-6'>
          {!html::a(helper::createLink('index', 'index'), $lang->cart->goHome, "class='btn default block'")}
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
        statAll();
    };

    $('.form-control-number').on('change', function()
    {
        caculateTotal();
    });
});
</script>
{include TPL_ROOT . 'common/form.html.php'}

{if(isset($pageJS))} {!js::execute($pageJS)} {/if}
<div class='block-region region-footer hidden blocks' data-region='all-footer'>{$control->loadModel('block')->printRegion($layouts, 'all', 'footer')}</div>
</body>
</html>
