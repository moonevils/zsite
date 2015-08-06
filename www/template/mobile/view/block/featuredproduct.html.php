<?php
/**
 * The featured product front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php 
$content  = json_decode($block->content);
$product  = $this->loadModel('product')->getByID($content->product);
?>
<?php if(!empty($product)):?>
<?php
$category = array_shift($product->categories);
$alias    = !empty($category) ? $category->alias : '';
$url      = helper::createLink('product', 'view', "id={$product->id}", "category={$alias}&name={$product->alias}");
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-body no-padding'>
    <div class='card'>
      <a href='<?php echo $url ?>' class='card-img'><?php echo html::image($product->image->primary->middleURL, "title='{$product->name}' alt='{$product->name}'"); ?></a>
      <div class='card-heading'>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($category->abbr ? $category->abbr : $category->name) . '] ';?>
        <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$category->id}", "category={$category->alias}"), $categoryName, "class='text-special'");?>
        <?php else:?>
        <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$category->id}", "category={$category->alias}"), '[' . $category->name . '] ', "class='text-special'");?>
        <?php endif;?>
        <?php endif;?>
        <strong><?php echo $product->name; ?></strong>
        <div class='product-price'>
        <?php
        if(!$product->unsaleable)
        {
            if($product->promotion != 0)
            {
                echo "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->promotion . '</strong>';
                if($product->price != 0)
                {
                    echo "&nbsp;&nbsp;<small class='text-muted text-line-through'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</small>';
                }
            }
            else if($product->price != 0)
            {
                echo "<strong class='text-danger'>" . $this->lang->product->currencySymbols[$this->config->product->currency] . $product->price . '</strong>';
            }
        }
        ?>
        </div>
        <div class='product-desc text-muted small'><?php echo helper::substr(strip_tags($product->desc), 80);?></div>
      </div>
    </div>
  </div>
</div>
<?php endif;?>
