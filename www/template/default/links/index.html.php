<?php 
include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');
?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='panel' id='links'>
  <div class='panel-heading'><strong><i class='icon-link'></i> <?php echo $lang->links->common;?></strong></div>
  <div class='panel-body'><?php echo $links->all;?></div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'); ?>
