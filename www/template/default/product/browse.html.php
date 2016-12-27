<?php
/**
 * The browse view file of product of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     product
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');
$path = isset($category->pathNames) ? array_keys($category->pathNames) : array(0);
js::set('path', $path);
js::set('categoryID', $category->id);
js::set('pageLayout', $this->block->getLayoutScope('product_browse', $category->id));
?>
<?php echo $common->printPositionBar($category, isset($product) ? $product : '');?>
<?php if(isset($productList)):?>
<script><?php echo "place" . md5(time()). "='" . $config->idListPlaceHolder . $productList. $config->idListPlaceHolder . "';";?></script>
<?php else:?>
<script><?php echo "place" . md5(time()) . "='" . $config->idListPlaceHolder . '' . $config->idListPlaceHolder . "';";?></script>
<?php endif;?>
<div class='row blocks' data-region='product_browse-topBanner'><?php $this->block->printRegion($layouts, 'product_browse', 'topBanner', true);?></div>
<div class='row' id='columns' data-page='product_browse'>
  <?php if(!empty($layouts['product_browse']['side']) and !empty($sideFloat) && $sideFloat != 'hidden'):?>
  <div class="col-md-<?php echo 12 - $sideGrid; ?> col-main<?php if($sideFloat === 'left') echo ' pull-right' ?>">
  <?php else:?>
  <div class='col-md-12'>
  <?php endif;?>
    <div class='list list-condensed' id='products'>
      <div class='row blocks' data-region='product_browse-top'><?php $this->block->printRegion($layouts, 'product_browse', 'top', true);?></div>
      <header>
        <strong><i class='icon-th'></i> <?php echo $category->name;?></strong>
        <div class='pull-right btn-group' id="modeControl">
          <?php foreach($lang->product->listMode as $mode => $text):?>
          <?php echo html::a("javascript:;", $text, "data-mode='{$mode}' class='btn'");?>
          <?php endforeach;?>
        </div>
      </header>
      <?php include $this->loadModel('ui')->getEffectViewFile('default', 'product', 'browse.card');?>
      <?php include $this->loadModel('ui')->getEffectViewFile('default', 'product', 'browse.list');?>
      <footer class='clearfix'>
        <?php $pager->show('right', 'short');?>
      </footer>
    </div>
    <div class='row blocks' data-region='product_browse-bottom'><?php $this->block->printRegion($layouts, 'product_browse', 'bottom', true);?></div>
  </div>
  <?php if(!empty($layouts['product_browse']['side']) and !(empty($sideFloat) || $sideFloat === 'hidden')):?>
  <div class='col-md-<?php echo $sideGrid ?> col-side'>
    <side class='page-side blocks' data-region='product_browse-side'><?php $this->block->printRegion($layouts, 'product_browse', 'side');?></side>
  </div>
  <?php endif;?>
</div>
<div class='row blocks' data-region='product_browse-bottomBanner'><?php $this->block->printRegion($layouts, 'product_browse', 'bottomBanner', true);?></div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
