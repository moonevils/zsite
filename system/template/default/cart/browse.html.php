{*
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
*}
{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'header')}
{!js::set('currencySymbol', $currencySymbol)}
{if(!empty($products))}
{$total = 0}
<div class='panel my-cart'>
  <div class='panel-heading'>
    <strong>{!echo $lang->cart->browse}</strong>
  </div>
  <form action='{!echo helper::createLink('order', 'confirm')}' method='post'>
    <div class='panel-body'>
      <table class='table table-list'>
        <thead>
          <tr class='text-center'>
            <td colspan='2' class='text-left'>{!echo $lang->order->productInfo}</td>
            <td class='text-left'>{!echo $lang->order->price}</td>
            <td>{!echo $lang->order->count}</td>
            <td>{!echo $lang->order->amount}</td>
            <td>{!echo $lang->actions}</td>
          </tr>
        </thead>
        {foreach($products as $productID => $product)}
        {$productLink = helper::createLink('product', 'view', "id=$productID", "category={{$product->categories[$product->category]->alias}}&name=$product->alias")}
        <tr>
          <td class='w-100px'>
            {if(!empty($product->image))}
                {$title = $product->image->primary->title ? $product->image->primary->title : $product->name}
                {!echo html::a($productLink, html::image($control->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, '', 'smallURL'), "title='$title' alt='$product->name'"), "class='media-wrapper'")}
            {/if}
          </td>
          <td class='text-left text-middle'>
            {!echo html::a($productLink, '<div class="" data-id="' . $product->id . '">' . $product->name . '</div>', "class='media-wrapper'")}
          </td>
          <td class='w-100px text-middle'> 
            {if($product->promotion != 0)}
              {$price = $product->promotion}
              <div class='text-muted'><del>{!echo $currencySymbol . $product->price}</del></div>
              <div class='text-price'>{!echo $currencySymbol . $product->promotion}</div>
            {else}
              {$price  = $product->price}
              <div class='text-price'>{!echo $currencySymbol . $product->price}</div>
            {/if}
            {!echo html::hidden("price[$product->id]", $price)}
            {$amount = $product->count * $price}
            {$total += $amount}
          </td>
          <td class='w-140px text-middle'>
            <div class='input-group'>
              <span class='input-group-addon'><i class='icon icon-minus'></i></span>
              {!echo html::input("count[$product->id]", $product->count, "class='form-control'")}
              <span class='input-group-addon'><i class='icon icon-plus'></i></span>
            </div>
          </td>
          <td class='w-200px text-center text-middle'>
            <strong class='text-danger'>{!echo $currencySymbol}</strong>
            <strong class='text-danger amountContainer'>{!echo $amount?></strong>
          </td>
          <td class='text-middle text-center'>
            {!echo html::a(inlink('delete', "product=$product->id"), $lang->delete, "class='deleter'")}
            {!echo html::hidden("product[]", $product->id)}
          </td>
        </tr>
        {/foreach}
      </table>
    </div>
    <div class='panel-footer text-right'>
      {!printf($lang->order->selectProducts, count($products))}
      {!printf($lang->order->totalToPay, $currencySymbol . $total)}
      {!echo html::submitButton($lang->cart->goAccount, 'btn-order-submit')}
    </div>
  </form>
</div>
{else}
<div class='panel'>
  <div class='panel-heading'>
    <strong>{!echo $lang->cart->browse}</strong>
  </div>
  <div class='panel-body'>
    {!echo $lang->cart->noProducts}
    {!echo html::a(helper::createLink('product', 'browse', 'category=0'), $lang->cart->pickProducts, "class='btn btn-xs btn-primary'")}
    {!echo html::a(helper::createLink('index', 'index'), $lang->cart->goHome, "class='btn btn-xs btn-default'")}
  </div>
</div>
{/if}
{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer')}
