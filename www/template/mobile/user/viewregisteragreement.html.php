<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');?>
<div class='panel-section article'>
  <div class='panel-heading'>
    <strong><i class='icon icon-file-o'></i> <?php echo isset($this->config->site->registerAgreementTitle) ? $this->config->site->registerAgreementTitle : $lang->user->registerAgreement;?></strong>
  </div>
  <hr/>
  <div class='panel-body'>
    <div class='article-content' id='company'>
      <?php echo htmlspecialchars_decode($this->config->site->registerAgreementContent);?>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer');?>
