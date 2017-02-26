<?php
/**
 * The hot product front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php 
$content  = json_decode($block->content);
$type     = str_replace('product', '', strtolower($block->type));
$method   = 'get' . $type;
if(empty($content->category)) $content->category = 0;
$image = isset($content->image) ? true : false;
$products = $this->loadModel('product')->$method($content->category, $content->limit, $image);
?>
<div id="block<?php echo $block->id;?>" class="panel-cards panel panel-block <?php echo $blockClass;?>">
  <div class='panel-heading'>
    <strong><?php echo $icon;?> <?php echo $block->title;?></strong>
    <?php if(isset($content->moreText) and isset($content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText);?></div>
    <?php endif;?>
  </div>
  <?php 
    $wwwPath = $this->app->getWwwRoot();
    if(isset($content->image))
    {
        include $wwwPath . 'template/default/block/latestproductwithimage.html.php';
    }
    else
    {
        include $wwwPath . 'template/default/block/latestproductwithoutimage.html.php';
    }
  ?>
</div>
