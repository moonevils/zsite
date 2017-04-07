<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');?>
<div class='panel-section article'>
  <div class='panel-heading'>
    <strong><i class='icon icon-file-text'></i> <?php echo !empty($this->config->site->regAgreementTitle) ? $this->config->site->regAgreementTitle : $lang->user->register->agreement;?></strong>
  </div>
  <hr/>
  <div class='panel-body'>
    <div class='article-content' id='company'>
      <?php echo htmlspecialchars_decode($this->config->site->regAgreementContent);?>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer');?>
