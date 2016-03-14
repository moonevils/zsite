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
  <div id='headNav' class='<?php if($setting->slogan == 'topLeft') echo 'with-slogan' ?>'>
    <div class='row'>
      <?php if($setting->slogan == 'topLeft'):?>
      <div id="siteSlogan" class='pull-left'><span><?php echo $this->config->site->slogan;?></span></div>
      <?php endif;?>
      <nav class='pull-right'>
        <?php echo commonModel::printTopBar();?>
        <?php commonModel::printLanguageBar();?>
        <?php if($setting->searchbar == 'topRight') include 'searchbar.html.php';?>
      </nav>
    </div>
  </div>
  <div id='headTitle' class='<?php if($setting->nav == 'besideLogo') echo 'with-navbar' ?>'>
    <div class='row'>
      <?php if($logo):?>
      <div id='siteLogo' data-ve='logo'><?php echo html::a($this->config->webRoot, html::image($logo->webPath, "class='logo' title='{$this->config->company->name}'"));?></div>
      <?php else: ?>
      <div id='siteName' data-ve='logo'><h2><?php echo html::a($this->config->webRoot, $this->config->site->name);?></h2></div>
      <?php endif;?>

      <?php if($setting->nav == 'besideLogo'):?>
      <div id='navbarWrapper'><?php include 'nav.html.php' ?></div>
      <?php endif; ?>
      <?php if($setting->slogan == 'besideLogo'):?>
      <div id='siteSlogan' data-ve='slogan'><span><?php echo $this->config->site->slogan;?></span></div>
      <?php endif;?>
    </div>
  </div>
  <?php if($setting->searchbar == 'besideSlogan') include 'searchbar.html.php';?>
</header>
<?php if($setting->nav == 'row') include 'nav.html.php';?>
<style>
<?php if($setting->slogan == 'topLeft'):?>
#headNav.with-slogan {position: static}
<?php endif;?>
<?php if($setting->searchbar == 'insideNav'):?>
#searchbar{width:100%; position: static; display: block; padding: 3px; min-width: 120px;}
#searchbar #words{margin-top:none;}
<?php endif;?>
<?php if($setting->searchbar == 'topRight'):?>
#searchbar{width:260px;position:relative;top:10px;display:inline-block; bottom:0;}
#searchbar .form-control{ background-color: #fff; border: 1px solid #ccc;}
<?php endif;?>
<?php if($setting->nav == 'besideLogo'):?>
#headTitle.with-navbar > .row {margin: 0; display: table}
#headTitle.with-navbar > .row > #siteLogo,
#headTitle.with-navbar > .row > #siteName {display: table-cell; min-width: 150px; width: 200px; vertical-align: middle;}
#headTitle.with-navbar > .row > #navbarWrapper {display: table-cell; vertical-align: middle; padding-left: 8px;}
#headTitle.with-navbar > .row > #navbarWrapper > #navbar {margin:0}
@media (max-width: 767px)
{
  #headTitle.with-navbar {position: relative; top: 0; padding: 0; display: block; margin-top: 14px;}
  #headTitle.with-navbar > .row {margin: 0; display: block;}
  #headTitle.with-navbar > .row > #siteLogo,
  #headTitle.with-navbar > .row > #siteName {display: block; position: absolute; z-index: 10015}
  #headTitle.with-navbar > .row > #navbarWrapper {display: block; padding: 0}
  #headTitle.with-navbar > .row > #navbarWrapper > #navbar {margin-bottom: 14px; width: 100%}
  #headTitle.with-navbar #siteLogo img {margin-top: 2px;}
}
<?php endif;?>
</style>
