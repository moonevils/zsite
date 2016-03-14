<?php
/**
 * The header view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<header id='header' class='clearfix<?php if($isSearchAvaliable) echo ' with-searchbar';?>' data-ve='block' data-id='<?php echo $block->id;?>'>
  <div class='row'>
    <?php if($setting->slogan == 'topLeft'):?>
    <div class='pull-left'><span><?php echo $this->config->site->slogan;?></span></div>
    <?php endif;?>
    <nav class='pull-right'>
      <?php echo commonModel::printTopBar();?>
      <?php commonModel::printLanguageBar();?>
      <?php if($setting->searchbar == 'topRight') include 'searchbar.html.php';?>
    </nav>
  </div>
  <div id='headTitle'>
    <div class="wrapper">
      <?php if($logo):?>
      <div id='siteLogo' data-ve='logo'><?php echo html::a($this->config->webRoot, html::image($logo->webPath, "class='logo' title='{$this->config->company->name}'"));?></div>
      <?php else: ?>
      <div id='siteName' data-ve='logo'><h2><?php echo html::a($this->config->webRoot, $this->config->site->name);?></h2></div>
      <?php endif;?>

      <?php if($setting->nav == 'besideLogo') include 'nav.html.php';?>

      <?php if($setting->slogan == 'besideLogo'):?>
      <div id='siteSlogan' data-ve='slogan'><span><?php echo $this->config->site->slogan;?></span></div>
      <?php endif;?>

    </div>
  </div>
  <?php if($setting->searchbar == 'besideSlogan') include 'searchbar.html.php';?>
</header>
<?php if($setting->nav == 'row') include 'nav.html.php';?>
<style>
<?php if($setting->searchbar == 'insideNav'):?>
#searchbar{width:260px;position:relative;top:0;padding:0px;margin-bottom: -2px;}
#searchbar #words{margin-top:none;}
<?php endif;?>
<?php if($setting->searchbar == 'topRight'):?>
#searchbar{width:260px;position:relative;top:0;display:inline-block; bottom:0;}
#searchbar .form-control{ background-color: #fff; border: 1px solid #ccc;height:30px;}
<?php endif;?>
</style>
