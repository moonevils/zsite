<?php if(helper::isAjaxRequest()):?>
<?php
$webRoot            = $config->webRoot;
$jsRoot             = $webRoot . "js/";
$templateName       = $this->config->template->{$this->app->clientDevice}->name;
$themeName          = $this->config->template->{$this->app->clientDevice}->theme;
$templateRoot       = $webRoot . "template/{$templateName}/";
$templateThemeRoot  = "{$templateRoot}theme/";
$templateCommonRoot = "{$templateThemeRoot}common/";
$thisModuleName     = $this->app->getModuleName();
$thisMethodName     = $this->app->getMethodName();
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><?php echo !empty($title) ? $title : '';?></h5>
    </div>
    <div class='modal-body'>
<?php else:?>
<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.lite');?>
<div class='block-region region-all-top blocks' data-region='all-top'>
  <?php $this->block->printRegion($layouts, 'all', 'top');?>
</div>

<div class='block-region region-all-banner blocks' data-region='all-banner'>
  <?php $this->block->printRegion($layouts, 'all', 'banner');?>
</div>
<?php endif;?>
