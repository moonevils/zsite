{*php
/**
 * The view file of product for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
{include TPL_ROOT . 'common/files.html.php'}

{* Set categoryPath for topNav highlight. *}
{!js::set('path',  $product->path)}
{!js::set('categoryID', $category->id)}
{!js::set('categoryPath', explode(',', trim($category->path, ',')))}
{!js::set('addToCartSuccess', $lang->product->addToCartSuccess)}
{!js::set('gotoCart', $lang->product->gotoCart)}
{!js::set('goback', $lang->product->goback)}
{!js::set('stockOpened', $stockOpened)}
{!js::set('stock', $product->amount)}
{!css::internal($product->css)}
{!js::execute($product->js)}
<div class='block-region region-top blocks' data-region='product_view-top'>{$control->loadModel('block')->printRegion($layouts, 'product_view', 'top')}</div>
<div id='product' data-id='{$product->id}'>
<div class='appheader'>
{if(!empty($product->image->list))}
  {if(count($product->image->list) > 1)}
    <div id='productSlide' class='carousel slide' data-ride='carousel'>
      <div class='carousel-inner'>
        {$imgIndex = 0}
        {$indicators = ''}
        {foreach($product->image->list as $image)}
          <div class="item{if($imgIndex === 0)} {!echo ' active'} {/if}">
            {$image->objectType =  'product'}
            {!html::image($control->loadModel('file')->printFileURL($image, 'middleURL'), "title='{{$title}}' alt='{{$product->name}}'")}
          </div>
          {$indicators .= "<li data-target='#productSlide' data-slide-to='{{$imgIndex}}' class='" . ($imgIndex === 0 ? 'active' : '') . "'></li>"}
          {@$imgIndex++}
        {/foreach}
      </div>
      <ol class='carousel-indicators'>{$indicators}</ol>
      <a class='left carousel-control' href='#productSlide' data-slide='prev'>
        <i class='icon icon-chevron-left'></i>
      </a>
      <a class='right carousel-control' href='#productSlide' data-slide='next'>
        <i class='icon icon-chevron-right'></i>
      </a>
    </div>
  {else}
    {$product->image->primary->objectType = 'product'}
    {!html::image($control->loadModel('file')->printFileURL($product->image->primary, 'largeURL'), "title='{{$title}}' alt='{{$product->name}}'")}
  {/if}
{/if}
  <div class='heading'>
    <h2>{$product->name}</h2>
    {if(!$product->unsaleable)}
      <div class='caption'>
      {if($product->negotiate)}
        <strong class='text-danger'>{$lang->product->negotiate}</strong>
      {else}
        {if($product->promotion != 0)}
          <strong class='text-danger'>{!echo $control->config->product->currencySymbol . $product->promotion}</strong>
          {if($product->price != 0)}
            &nbsp;&nbsp;<small class='text-muted text-line-through'>{!echo $control->config->product->currencySymbol . $product->price}</small>
          {/if}
        {elseif($product->price != 0)}
          <strong class='text-danger'>{!echo $control->config->product->currencySymbol . $product->price}</strong>
        {/if}
      {/if}
      </div>
    {/if}
  </div>
</div>

{$attributeHtml = ''}
{if($product->amount and isset($control->config->product->stock))}
  {$attributeHtml .= "<tr><th>" . $lang->product->stock . "</th>"}
  {$attributeHtml .= "<td>" . $product->amount . " <small>" . $product->unit . "</small></td></tr>"}
{/if}
{if($product->brand)}
  {$attributeHtml .= "<tr><th>" . $lang->product->brand . "</th>"}
  {$attributeHtml .= "<td>" . $product->brand . " <small>" . $product->model . "</small></td></tr>"}
{/if}
{if(!$product->brand and $product->model)}
  {$attributeHtml .= "<tr><th>" . $lang->product->model . "</th>"}
  {$attributeHtml .= "<td>" . $product->model . "</td></tr>"}
{/if}
{if($product->color)}
  {$attributeHtml .= "<tr><th>" . $lang->product->color . "</th>"}
  {$attributeHtml .= "<td>" . $product->color . "</td></tr>"}
{/if}
{if($product->origin)}
  {$attributeHtml .= "<tr><th>" . $lang->product->origin . "</th>"}
  {$attributeHtml .= "<td>" . $product->origin . "</td></tr>"}
{/if}
{foreach($product->attributes as $attribute)}
  {if(empty($attribute->label) and empty($attribute->value))} {continue} {/if}
  {$attributeHtml .= "<tr><th>" . $attribute->label . "</th>"}

  {$http  = strpos($attribute->value, 'https') !== false ? 'https://' : 'http://'}
  {$attribute->value = str_replace($http, '', $attribute->value)}
  {$value = strpos($attribute->value, ':') !== false ? substr($attribute->value, 0, strpos($attribute->value, ':')) : $attribute->value}
  {if(preg_match('/^([a-z0-9\-]+\.)+[a-z0-9\-]+$/', $value))}
    {$attributeHtml .= "<td>" . html::a($http . $attribute->value, $attribute->value, "target='_blank'") . "</td></tr>"}
  {else}
    {$attributeHtml .= "<td>" . $attribute->value . "</td></tr>"}
  {/if}
{/foreach}
<hr class='space'>
<table class='table table-layout small' style='background:#fff'>
  <tbody>
    {if(empty($attributeHtml))}
      <tr><td colspan='2' class='small'>{$product->desc}</td></tr>
    {else}
      {$attributeHtml}
    {/if}
    {if(!$product->unsaleable and commonModel::isAvailable('shop') and !$product->negotiate and !$product->mall)}
      {if(!$stockOpened or $product->amount > 0)}
      <tr>
        <th>{$lang->product->count}</th>
        <td>
          <div class='input-group input-group-sm input-number'>
            <span class='input-group-btn'>
              <button class='btn default btn-minus' type='button'><i class='icon icon-minus'></i></button>
            </span>
            <input type='number' class='btn-number text-center' value='1' id='count' name='count'>
            <span class='input-group-btn'>
              <button class='btn default btn-plus' type='button'><i class='icon icon-plus'></i></button>
            </span>
          </div>
        </td>
      </tr>
      {/if}
    {/if}
  </tbody>
</table>
<hr class='space'>
<div class='panel panel-section'>
  <div class='panel-heading head-dividing hidden'><i class='icon-file-text-alt text-muted'></i>&nbsp;<strong>{$lang->product->content}</strong></div>
  <div class='panel-body'>
    <div class='article-content'>
      {$product->content}
    </div>
  </div>
  {if(!empty($product->files))} <section class='article-files'> {$control->loadModel('file')->printFiles($product->files)} </section> {/if}
</div>
</div>
<div class='block-region region-bottom blocks' data-region='product_view-bottom'>{$control->loadModel('block')->printRegion($layouts, 'product_view', 'bottom')}</div>
{noparse}
<style>
  .btn-number {width:100%;height:38px;border:1px solid #ddd;border-radius:0px}
  #product {background:#ddd}
  #productSlide{text-align:center;height:226px;background:#fff}
  #productSlide .carousel-inner{max-width:350px;height:226px;display:inline-block;}
  .red {color:#fff!important;border-color:#ea644a!important;background-color:#ea644a!important;}
  .carousel-inner > .item {height:100%;width:100%;overflow:hidden;position:relative}
  .carousel-inner > .item > img {position: absolute;max-height:100%;width:auto;left:0px;top:0px;right:0px;bottom:0px;margin:auto}
  #footerNav {line-height:49px;height:49px}
  .footer-left {width:10%;float:left;padding-left:12px}
  .footer-left > a > img {width:20px;height:20px}
  .footer-left > a > span {position:absolute;z-index:1;top:-.8rem;right:-.8rem;width:18px;height:18px;text-align:center;line-height:18px}
  .footer-right {width:54%;float:right;}
  .footer-right > .right-btn {width:41.5%;float:right;margin-right:12px}
  .footer-right > .right-btn > button {width:100%;line-height:28px;height:30px;border-radius:4px;padding:0px;outline:none}
  .footer-right > .right-btn > .btn-cart {border:1px solid #6F9AFE;color:#6F9AFE;background-color:#fff}
  .footer-right > .right-btn > .btn-buy {border:1px solid #6F9AFE;color:#fff;background:linear-gradient(to right,#709BFE,#1B5AFF)}
  .footer-right > .right-btn > .btn-soldout {border:0px;color:#333;background-color:#ddd}
  .table-layout > tbody > tr > th {color:#999}
  .panel-section {margin:0px}
  .article-content {border:0px}
</style>
{/noparse}
<footer class="appbar fix-bottom" id='footerNav' data-ve='navbar' data-type='mobile_bottom'>
<div class='footer-left'>
    {!html::a(helper::createLink('cart', 'browse', 'source=product'), html::image('/theme/mobile/product/cart.png') . "<span class='label badge red circle'>$cartCount</span>", "style='position:relative'")}
</div>
<div class='footer-left'>
    {!html::a(helper::createLink('cart', 'browse'), html::image('/theme/mobile/product/comment.png'))}
</div>
<div class='footer-right'>
{if(!$product->unsaleable and commonModel::isAvailable('shop') and !$product->negotiate and !$product->mall)}
  {if($stockOpened and $product->amount < 1)}
    <div class='right-btn'><button type='button' class='btn-soldout'>{$lang->product->soldout}</button></div>
  {else}
    <div class='right-btn' style='float:left'><button type='button' class='btn-cart' data-url='{!$control->createLink('cart', 'add', "product={{$product->id}}&count=productcount")}'>{$lang->product->addToCart}</button></div>
    <div class='right-btn'><button type='button' class='btn-buy' data-url='{!$control->createLink('order', 'confirm', "product={{$product->id}}&count=productcount")}'>{$lang->product->buyNow}</button></div>
  {/if}
{/if}
{if(!$product->unsaleable and $product->mall and !$product->negotiate)}
    <div class='right-btn'><button type='button' class='btn-buy' data-url='{!$control->createLink('product', 'redirect', "id={{$product->id}}")}'>{$lang->product->buyNow}</button></div>
{/if}
</div>
</footer>
{if(isset($pageJS))} {!js::execute($pageJS)} {/if}
<div class='block-region region-footer hidden blocks' data-region='all-footer'>{$control->loadModel('block')->printRegion($layouts, 'all', 'footer')}</div>
</body>
</html>
