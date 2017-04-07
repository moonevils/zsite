<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header'); ?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='panel' id='registerAgreement'>
  <div class='panel-heading'>
    <strong><i class='icon-file-text'> </i> <?php echo !empty($this->config->site->regAgreementTitle) ? $this->config->site->regAgreementTitle : $lang->user->register->agreement;?></strong>
  </div>
  <div class='panel-body'>
    <div class="article-content">    
      <?php echo htmlspecialchars_decode($this->config->site->regAgreementContent);?>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'); ?>
