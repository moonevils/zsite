{*php*}
/**
 * The browse view file of product for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
{*/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<script>{!echo "place" . md5(time()) . "='" . $config->idListPlaceHolder . '' . $config->idListPlaceHolder . "';"}</script>
{!js::set('pageLayout', $control->block->getLayoutScope('product_browse', $category->id))}
<div class='block-region region-top blocks' data-region='product_browse-top'>{$control->loadModel('block')->printRegion($layouts, 'product_browse', 'top')}</div>
<div class='panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'><strong>{!echo $category->name}</strong></div>
  </div>
  <div class='panel-body'>
{*php*}
    $count = count($products);
    if($count == 0) $count = 1;
    $recPerRow = min($count, 2);
{*/php*}
    <div class='cards cards-products' data-cols='{!echo $recPerRow?>' id='products'>
      <style>{!echo ".col-custom-{$recPerRow} {width: " . (100/$recPerRow) . "%}"}</style>
{*php*}
      $index = 0;
      foreach($products as $product):
{*/php*}
      {$rowIndex = $index % $recPerRow}
      {if($rowIndex === 0)}
      <div class='row'>
      {/if}

      <div class='col col-custom-{!echo $recPerRow?>'>
      {$url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias")}
        <div class='card' id='product{!echo $product->id?>' data-ve='product'>
          <a class='card-img' href='{!echo $url?>'>
{*php*}
            if(empty($product->image))
            {
                $imgColor = $product->id * 57 % 360;
                echo "<div class='media-placeholder' style='background-color: hsl({$imgColor}, 60%, 80%); color: hsl({$imgColor}, 80%, 30%);' data-id='{$product->id}'>{$product->name}</div>";
            }
{else}
            {
                $imgsrc = $control->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, 'product', 'middleURL');
                echo "<img class='lazy' alt='{$product->name}' title='{$product->name}' data-src='{$imgsrc}'> ";
            }
{*/php*}
          </a>
          <div class='card-content'>
{*php*}
            echo "<a href='{$url}' style='color:{$product->titleColor}'>{$product->name}</a>";
            if(!$product->unsaleable)
            {
                if($product->negotiate)
                {
                    echo "<div><strong class='text-danger'>" . $lang->product->negotiate . '</strong></div>';
                }
{else}
                {
                    if($product->promotion != 0)
                    {
                        echo "<div><strong class='text-danger'>" . $control->config->product->currencySymbol . $product->promotion . '</strong>';
                        if($product->price != 0)
                        {
                            echo "&nbsp;&nbsp;<small class='text-muted text-line-through'>" . $control->config->product->currencySymbol . $product->price . '</small>';
                        }
                        echo "</div>";
                    }
                    else if($product->price != 0)
                    {
                        echo "<div><strong class='text-danger'>" . $control->config->product->currencySymbol . $product->price . '</strong></div>';
                    }
                }
            }
{*/php*}
          </div>
        </div>
      </div>

      {if($recPerRow === 1 || $rowIndex === ($recPerRow - 1))}
      </div>
      {/if}
      {$index++}
      {/foreach}
    </div>
  </div>
  <div class='panel-footer'>{$pager->show('justify')}</div>
</div>

<div class='block-region region-bottom blocks' data-region='product_browse-bottom'>{$control->loadModel('block')->printRegion($layouts, 'product_browse', 'bottom')}</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
