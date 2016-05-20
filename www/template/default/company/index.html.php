<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header'); ?>
<?php $common->printPositionBar($this->app->getModuleName());?>
<div class='row blocks' data-region='company_index-topBanner'><?php $this->block->printRegion($layouts, 'company_index', 'topBanner', true);?></div>
<div class='row' id='columns' data-page='company_index'>
  <?php if(!empty($layouts['company_index']['side']) and !empty($sideFloat) && $sideFloat != 'hidden'):?>
  <div class="col-md-<?php echo 12 - $sideGrid; ?> col-main<?php if($sideFloat === 'left') echo ' pull-right' ?>">
  <?php else:?>
  <div class="col-md-12">
  <?php endif;?>
    <div class='row blocks' data-region='company_index-top'><?php $this->block->printRegion($layouts, 'company_index', 'top', true);?></div>
    <div class='panel' id='company'>
      <div class='panel-heading'><strong><i class='icon-group'></i> <?php echo $lang->aboutUs; ?></strong></div>
      <div class="panel-body">
        <div class='article-content'>
          <?php echo $company->content;?>
        </div>
      </div>
    </div>
    <div class='row blocks' data-region='company_index-bottom'><?php $this->block->printRegion($layouts, 'company_index', 'bottom', true);?></div>
  </div>
  <?php if(!empty($layouts['company_index']['side']) and !(empty($sideFloat) || $sideFloat === 'hidden')):?>
  <div class='col-md-<?php echo $sideGrid ?> col-side'><side class='page-side blocks' data-region='company_index-side'><?php $this->block->printRegion($layouts, 'company_index', 'side');?></side></div>
  <?php endif;?>
</div>
<div class='row blocks' data-region='company_index-bottomBanner'><?php $this->block->printRegion($layouts, 'company_index', 'bottomBanner', true);?></div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'); ?>
