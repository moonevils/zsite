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
<header id='header' class='compatible clearfix<?php if($isSearchAvaliable) echo ' with-searchbar';?>'>
  <div id='headNav'>
    <div class='wrapper'>
      <?php include $this->loadModel('ui')->getEffectViewFile('default', 'block', 'sitenav');?>
    </div>
  </div>
  <div id='headTitle'>
    <div class="wrapper">
      <?php if($logo):?>
      <div id='siteLogo' data-ve='logo'>
        <?php echo html::a(helper::createLink('index'), html::image("{$this->config->webRoot}file.php?f={$logo->pathname}&t={$logo->extension}&v={$this->config->site->lastUpload}", '', "{$logo->extension}"), "class='logo' alt='{$this->config->company->name}' title='{$this->config->company->name}'");?>
      </div>
      <?php else: ?>
      <div id='siteName' data-ve='logo'><h2><?php echo html::a(helper::createLink('index'), $this->config->site->name);?></h2></div>
      <?php endif;?>
      <div id='siteSlogan' data-ve='slogan'><span><?php echo $this->config->site->slogan;?></span></div>
    </div>
  </div>
  <?php include $this->loadModel('ui')->getEffectViewFile('default', 'block', 'searchbar');?>
</header>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'block', 'nav');?>
