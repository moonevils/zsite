<?php $logoSetting = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();?>
<?php $logo = isset($logoSetting->$template->themes->$theme) ? $logoSetting->$template->themes->$theme : (isset($logoSetting->$template->themes->all) ? $logoSetting->$template->themes->all : false);?>
<?php if($logo):?>
<div id='siteLogo' data-ve='block' data-id='<?php echo $block->id; ?>'>
  <?php echo html::a($this->config->webRoot, html::image($logo->webPath, " title='{$this->config->company->name}'"), " data-ve='logo'");?>
</div>
<?php else: ?>
<div id='siteName' data-ve='block' data-id='<?php echo $block->id; ?>'><h2 data-ve='logo'><?php echo html::a($this->config->webRoot, $this->config->site->name);?></h2></div>
<?php endif;?>
