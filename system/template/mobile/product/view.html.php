{*php*}
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
{*/php*}
{*php*}
include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');
include TPL_ROOT . 'common/files.html.php';

/* set categoryPath for topNav highlight. */
js::set('path',  $product->path);
js::set('categoryID', $category->id);
js::set('categoryPath', explode(',', trim($category->path, ',')));
js::set('addToCartSuccess', $lang->product->addToCartSuccess);
js::set('gotoCart', $lang->product->gotoCart);
js::set('goback', $lang->product->goback);
js::set('stockOpened', $stockOpened);
js::set('stock', $product->amount);
css::internal($product->css);
js::execute($product->js);
{*/php*}
<div class='block-region region-top blocks' data-region='product_view-top'>{$control->loadModel('block')->printRegion($layouts, 'product_view', 'top')}</div>
<div id='product' data-id='{!echo $product->id}'>
<div class='appheader'>
{if(!empty($product->image->list))}
  {if(count($product->image->list) > 1)}
  <div id='productSlide' class='carousel slide' data-ride='carousel'>
    <div class='carousel-inner'>
{*php*}
    $imgIndex = 0;
    $indicators = '';
{*/php*}
    {foreach($product->image->list as $image)}
      <div class='item{if($imgIndex === 0) echo ' active'}'>{!echo html::image($control->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, 'product', 'middleURL'), "title='{$title}' alt='{$product->name}'")}</div>
      {$indicators .= "<li data-target='#productSlide' data-slide-to='{$imgIndex}' class='" . ($imgIndex === 0 ? 'active':'') . "'></li>"}
    {$imgIndex++}
    {/foreach}
    </div>
    {!echo "<ol class='carousel-indicators fix-top-right'>{$indicators}</ol>"}
    <a class='left carousel-control' href='#productSlide' data-slide='prev'>
      <i class='icon icon-chevron-left'></i>
    </a>
    <a class='right carousel-control' href='#productSlide' data-slide='next'>
      <i class='icon icon-chevron-right'></i>
    </a>
  </div>
  {else}
  {!echo html::image($control->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, 'product', 'largeURL'), "title='{$title}' alt='{$product->name}'")}
  {/if}
{/if}
  <div class='heading'>
    <h2>{!echo $product->name}</h2>
{*php*}
    if(!$product->unsaleable)
    {
        echo "<div class='caption'>";
        if($product->negotiate)
        {
            echo "<strong class='text-danger'>" . $lang->product->negotiate . '</strong>';
        }
{else}
        {
            if($product->promotion != 0)
            {
                echo "<strong class='text-danger'>" . $control->config->product->currencySymbol . $product->promotion . '</strong>';
                if($product->price != 0)
                {
                    echo "&nbsp;&nbsp;<small class='text-muted text-line-through'>" . $control->config->product->currencySymbol . $product->price . '</small>';
                }
            }
            else if($product->price != 0)
            {
                echo "<strong class='text-danger'>" . $control->config->product->currencySymbol . $product->price . '</strong>';
            }
        }
        echo '</div>';
    }
{*/php*}
  </div>
</div>

{*php*}
$attributeHtml = '';
if($product->amount and $control->config->product->stock)
{
    $attributeHtml .= "<tr><th>" . $lang->product->stock . "</th>";
    $attributeHtml .= "<td>" . $product->amount . " <small>" . $product->unit . "</small></td></tr>";
}
if($product->brand)
{
    $attributeHtml .= "<tr><th>" . $lang->product->brand . "</th>";
    $attributeHtml .= "<td>" . $product->brand . " <small>" . $product->model . "</small></td></tr>";
}
if(!$product->brand and $product->model)
{
    $attributeHtml .= "<tr><th>" . $lang->product->model . "</th>";
    $attributeHtml .= "<td>" . $product->model . "</td></tr>";
}
if($product->color)
{
  $attributeHtml .= "<tr><th>" . $lang->product->color . "</th>";
  $attributeHtml .= "<td>" . $product->color . "</td></tr>";
}
if($product->origin)
{
  $attributeHtml .= "<tr><th>" . $lang->product->origin . "</th>";
  $attributeHtml .= "<td>" . $product->origin . "</td></tr>";
}
foreach($product->attributes as $attribute)
{
    if(empty($attribute->label) and empty($attribute->value)) continue;
    $attributeHtml .= "<tr><th>" . $attribute->label . "</th>";

    $http  = strpos($attribute->value, 'https') !== false ? 'https://' : 'http://';
    $attribute->value = str_replace($http, '', $attribute->value);
    $value = strpos($attribute->value, ':') !== false ? substr($attribute->value, 0, strpos($attribute->value, ':')) : $attribute->value;
    if(preg_match('/^([a-z0-9\-]+\.)+[a-z0-9\-]+$/', $value))
    {
        $attributeHtml .= "<td>" . html::a($http . $attribute->value, $attribute->value, "target='_blank'") . "</td></tr>";
    }
{else}
    {
        $attributeHtml .= "<td>" . $attribute->value . "</td></tr>";
    }
}
{*/php*}
<table class='table table-layout small'>
  <tbody>
{*php*}
    if(empty($attributeHtml))
    {
        echo "<tr><td colspan='2' class='small'>{$product->desc}</td></tr>";
    }
{else}
    {
        echo $attributeHtml;
    }
{*/php*}
    {if(!$product->unsaleable and commonModel::isAvailable('shop') and !$product->negotiate)}
    {if(!$stockOpened or $product->amount > 0)}
    <tr>
      <th>{!echo $lang->product->count}</th>
      <td>
        <div class='input-group input-group-sm input-number'>
          <span class='input-group-btn'>
            <button class='btn default btn-minus' type='button'><i class='icon icon-minus'></i></button>
          </span>
          <input type='number' class='form-control text-center' value='1' id='count' name='count'>
          <span class='input-group-btn'>
            <button class='btn default btn-plus' type='button'><i class='icon icon-plus'></i></button>
          </span>
        </div>
      </td>
    </tr>
    {/if}
    <tr>
      <td colspan='2'>
        {if($stockOpened and $product->amount < 1)}
        <button type='button' class='btn block  btn-soldout'>{!echo $lang->product->soldout}</button></div>
        {else}
        <div class='row'>
          <div class='col-6'><button type='button' class='btn block primary btn-buy' data-url='{!echo $control->createLink('order', 'confirm', "product={$product->id}&count=productcount")}'>{!echo $lang->product->buyNow}</button></div>
          <div class='col-6'><button type='button' class='btn block warning btn-cart' data-url='{!echo $control->createLink('cart', 'add', "product={$product->id}&count=productcount")}'>{!echo $lang->product->addToCart}</button></div>
        </div>
        {/if}
      </td>
    </tr>
    {/if}
    {if(!commonModel::isAvailable('shop') and !$product->unsaleable and $product->mall and !$product->negotiate)}
    <tr>
      <td colspan='2'>
        {!echo html::a(inlink('redirect', "id={$product->id}"), $lang->product->buyNow . ' <i class="icon icon-external-link"></i>', "class='btn block primary' target='_blank'")}
      </td>
    </tr>
    {/if}
  </tbody>
</table>
<hr class='space'>
<div class='panel panel-section'>
  <div class='panel-heading head-dividing hidden'><i class='icon-file-text-alt text-muted'></i>&nbsp;<strong>{!echo $lang->product->content}</strong></div>
  <div class='panel-body'>
    <div class='article-content'>
      {!echo $product->content}
    </div>
  </div>
  {if(!empty($product->files))}
  <section class='article-files'>
    {$control->loadModel('file')->printFiles($product->files)}
  </section>
  {/if}
</div>
</div>
{if(commonModel::isAvailable('message'))}
<div id='commentBox'>
  {!echo $control->fetch('message', 'comment', "objectType=product&objectID={$product->id}")}
</div>
{/if}

<div class='block-region region-bottom blocks' data-region='product_view-bottom'>{$control->loadModel('block')->printRegion($layouts, 'product_view', 'bottom')}</div>
<style>
  #productSlide{height:320px;text-align:center;}
  #productSlide .carousel-inner{width:320px;height:320px;display:inline-block;}
</style>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
