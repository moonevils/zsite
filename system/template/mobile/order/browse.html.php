{*php
/**
 * The browse view file of order for mobile template of chanzhiEPS.
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
<style>
body.with-appbar-bottom {padding-bottom:0px}
.card {border:0px}
.bg-gray-pale {background-color:#fff}
.text-danger {color:#D0021B}
.card .showcase {height:80px;;overflow:hidden;width:80px;text-align:center;float:left}
.card .showcase img {height:100%;}
.card .table-cell {width:100%;padding-left:10px;padding-right:10px}
.card .table-layout > tbody > tr > th {width:40px;color:#999999;font-weight:400}
.card .table-layout > tbody > tr > td, .table-layout > tbody > tr > th, .table-layout > tfoot > tr > td, .table-layout > tfoot > tr > th, .table-layout > thead > tr >t d, .table-layout > thead > tr > th {padding-right:0px;padding-left:0px}
.media-placeholder {display: block; width: 100%; height: 100%; color: #fff; font-weight: bold; padding: 0px; font-size: 12px; word-spacing:normal; word-break:break-all; text-align: center; text-shadow: 1px 1px 0 rgba(255,255,255,.5), 4px 4px 0 rgba(0,0,0,.2); display: table-cell; vertical-align: middle; max-height: 80px; min-height: 80px;line-height:80px;padding:0px}
.media-holder {display: table; width: 100%;}
.table .product-title {height:20px;overflow:hidden;margin-bottom:5px}
.table-condensed>tbody>tr>td, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>td, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>thead>tr>th {padding:0px}
li {list-style:none;color:#999999}
.order-track-list {padding-left:0px}
.btn {height:30px;line-height:28px;width:23%;padding:0px;text-align:center;border-radius:4px;outline:none;color:#6F9AFE;border:1px solid #6F9AFE}
.btn-goToPay {color:#fff;background:linear-gradient(to right,#709BFE,#1B5AFF);border:0px}
.btn-link:focus, .btn-link:hover{color:#6F9AFE;background:#fff;border:1px solid #6F9AFE}
.btn-goToPay.btn-link:focus, .btn-goToPay.btn-link:hover{color:#fff;background:linear-gradient(to right,#709BFE,#1B5AFF);border:0px}
</style>
<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'></i> {$lang->order->admin}</div>
  </div>
  <div class='panel-body' id='orderListWrapper'>
    <div class='cards' id='orderList'>
      {foreach($orders as $order)}
        <div class='card card-block' style='box-shadow:0 0px 0px'>
          <div class='card-heading bg-gray-pale'>
            {$amount = isset($order->balance) ? $order->amount + $order->balance : $order->amount}
            {$currencySymbol = isset($control->config->product->currencySymbol) ? $control->config->product->currencySymbol : ''}
            <span>{!printf($lang->order->orderProducts, count($order->products), $currencySymbol, $amount)}</span>
            <span>
              <strong class='text-danger'>
              </strong>
            </span> 
            <div class='pull-right'>
              {$order->status == ''}
              {if($order->status == 'normal' and 'not_paid')} {$statusClass = 'danger'}    {/if}
              {if($order->status == 'paid' and 'not_send')}   {$statusClass = 'important'} {/if}
              {if($order->status == 'send')}                  {$statusClass = 'special'}   {/if}
              {if($order->status == 'confirmed')}             {$statusClass = 'primary'}   {/if}
              {if($order->status == 'finished')}              {$statusClass = 'success'}   {/if}
              {if($order->status == 'canceled')}              {$statusClass = 'muted'}     {/if}
              <span class='text-{$statusClass}'>{$control->order->processStatus($order)}</span>
            </div>
          </div>
          <div class='list-group simple'>
          {foreach($order->products as $product)}
          {$productLink = helper::createLink('product', 'view', "id={{$product->productID}}")}
          <div class='card' style='box-shadow:0 0px 0px'>
            <div class='table-layout'>
              <div class='showcase'>
                {if(empty($product->image))}
                  {$imgColor = $product->id * 57 % 360}
                  <div class='media-holder'>
                    <div class='media-placeholder' style='background-color: hsl({$imgColor}, 60%, 80%); color: hsl({$imgColor}, 80%, 30%);' data-id='{$product->id}'>
                      {$product->productName}
                    </div>
                  </div>
                {else}
                  {$product->image->primary->objectType = 'product'}
                  {!html::image($control->loadModel('file')->printFileURL($product->image->primary, 'middleURL'), "title='{{$product->productName}}' alt='{{$product->productName}}'")}
                {/if}
              </div>
              <div class='table-cell'>
                <table class='table table-layout table-condensed'>
                  <tbody>
                    <tr>
                      <td colspan='3'>
                        <div class='product-title'>
                          <strong>{!html::a($productLink, $product->productName)}</strong>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th class='small'>{$lang->order->price}</th>
                      <td colspan='2'>
                        {$price  = $product->price}
                        <span>{!echo $currencySymbol . $product->price}</span>
                        {!html::hidden("price[$product->productID]", $price)}
                        {$amount = $product->count * $price}
                      </td>
                    </tr>
                    <tr>
                      <th class='small'>{$lang->order->amount}</th>
                      <td class='product-price'>
                        <strong class='text-danger'>{$currencySymbol}{$amount}</strong>
                      </td>
                    </tr>
                    <tr>
                      <th class='small'>{$lang->order->count}</th>
                      <td>
                        <span>{$product->count}</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          {/foreach}
          </div>
          <div class='card-footer'>
            {$history = '<li>' . $lang->order->createdDate . $lang->colon .  $order->createdDate . '</li>'}
            {if($order->payment != 'COD' and ($order->paidDate > $order->createdDate))}
              {$history .= '<li>' . $lang->order->paidDate . $lang->colon .  $order->paidDate . '</li>'}
            {/if}
            {if($order->deliveriedDate > $order->createdDate)}
              {$history .= '<li>' . $lang->order->deliveriedDate . $lang->colon .  $order->deliveriedDate . '</li>'}
            {/if}
            {if($order->confirmedDate > $order->deliveriedDate)} 
              {$history .= '<li>' . $lang->order->confirmedDate . $lang->colon .  $order->confirmedDate . '</li>'}
            {/if}
            {if($order->payment == 'COD' and ($order->paidDate > $order->createdDate))}
              {$history .= '<li>' . $lang->order->paidDate . $lang->colon .  $order->paidDate . '</li>'}
            {/if}
            {if($order->note)}
              {$history .= '<li>' . $lang->order->note . $lang->colon . $order->note . '</li>'}
            {/if}
            <ul class='order-track-list text-muted'>{$history}</ul>
          </div>
          <div class='order-actions text-right'>
            {$control->order->printActions($order)}
          </div>
        </div>
      {/foreach}
    </div>
  </div>
  {$pager->createPullUpJS('#orderListWrapper', $lang->mobile->pullUpHint, helper::createLink('order', 'browse', "recTotal=$pager->recTotal&recPerPage=$pager->recPerPage&pageID=\$ID"))}
</div>
<script>
$(function()
{
    var cancelWarning  = '{$lang->order->cancelWarning}';
    var confirmWarning = '{$lang->order->confirmWarning}';

    {noparse}
    var refreshOrderList = function()
    {
        $('#orderListWrapper').load(window.location.href + ' #orderList');
    };

    $(document).on('click', '.cancelLink', function(e)
    {
        var $this   = $(this);
        var options = $.extend({url: $this.data('rel'), confirm: cancelWarning, onSuccess: refreshOrderList}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    }).on('click', '.confirmDelivery', function(e)
    {
        var $this   = $(this);
        var options = $.extend({url: $this.data('rel'), confirm: confirmWarning, onSuccess: refreshOrderList}, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    });
    {/noparse}
});
</script>
{include TPL_ROOT . 'common/form.html.php'}
