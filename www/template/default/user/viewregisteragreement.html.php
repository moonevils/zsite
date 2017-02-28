<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header'); ?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='panel' id='registerAgreement'>
  <div class='panel-heading'>
    <strong><i class='icon icon-file-o'></i> <?php echo isset($this->config->site->registerAgreementTitle) ? $this->config->site->registerAgreementTitle : $lang->user->registerAgreement;?></strong>
  </div>
  <div class='panel-body'>
    <div class="article-content">    
      <?php echo htmlspecialchars_decode($this->config->site->registerAgreementContent);?>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'); ?>
