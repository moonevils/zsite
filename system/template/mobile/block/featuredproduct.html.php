{*php*}
/**
 * The featured product front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
{*/php*}
{*php*}
$content  = json_decode($block->content);
$product  = $control->loadModel('product')->getByID($content->product);
{*/php*}
{if(!empty($product))}
{*php*}
$category = array_shift($product->categories);
$alias    = !empty($category) ? $category->alias : '';
$url      = helper::createLink('product', 'view', "id={$product->id}", "category={$alias}&name={$product->alias}");
{*/php*}
<div id="block{!echo $block->id}" class='panel panel-block {!echo $blockClass} with-cards'>
  <div class='panel-body no-padding'>
    <div class='card'>
      <a href='{!echo $url ?>' class='card-img'>{!echo "<img class='lazy' alt='{$product->name}' title='{$product->name}' data-src='{$product->image->primary->middleURL}'> "}</a>
      <div class='card-heading'>
        {if(isset($content->showCategory) and $content->showCategory == 1)}
        {if($content->categoryName == 'abbr')}
        {$categoryName = '[' . ($category->abbr ? $category->abbr : $category->name) . '] '}
        {!echo html::a(helper::createLink('product', 'browse', "categoryID={$category->id}", "category={$category->alias}"), $categoryName, "class='text-special'")}
        {else}
        {!echo html::a(helper::createLink('product', 'browse', "categoryID={$category->id}", "category={$category->alias}"), '[' . $category->name . '] ', "class='text-special'")}
        {/if}
        {/if}
        <strong>{!echo $product->name}</strong>
        <div class='product-price'>
{*php*}
        if(!$product->unsaleable)
        {
            if($product->negotiate)
            { 
                echo "<strong class='text-danger'>" . $control->lang->product->negotiate . '</strong>';
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
        }
{*/php*}
        </div>
        <div class='product-desc text-muted small'>{!echo helper::substr(strip_tags($product->desc), 80)}</div>
      </div>
    </div>
  </div>
</div>
{/if}
