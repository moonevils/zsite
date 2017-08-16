<?php $logoSetting = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();?>
<?php $logo = isset($logoSetting->$template->themes->$theme) ? $logoSetting->$template->themes->$theme : (isset($logoSetting->$template->themes->all) ? $logoSetting->$template->themes->all : false);?>
<?php if($logo):?>
<?php $logo->extension = $this->loadModel('file')->getExtension($logo->pathname);?>
<div class='site-logo' data-ve='block' data-id='<?php echo $block->id; ?>'>
  <?php echo html::a(helper::createLink('index'), html::image("{$this->config->webRoot}file.php?pathname={$logo->pathname}&objectType=logo&imageSize=realPath&extension={$logo->extension}", "class='logo' alt='{$this->config->company->name}' title='{$this->config->company->name}'"));?></div>
</div>
<?php else: ?>
<div class='site-name' data-ve='block' data-id='<?php echo $block->id; ?>'><h2 data-ve='logo'><?php echo html::a($this->config->webRoot, $this->config->site->name);?></h2></div>
<?php endif;?>
