<?php $templates       = $this->loadModel('ui')->getTemplates(); ?>
<?php $currentTemplate = $this->config->template->{$this->device}->name; ?>
<?php $currentTheme    = $this->config->template->{$this->device}->theme; ?>
<?php $currentDevice   = $this->session->device ? $this->session->device : 'desktop';?>
<nav id='menu'>
  <?php $moduleMenu = commonModel::createModuleMenu($this->moduleName, '', false);?>
  <?php if($moduleMenu) echo $moduleMenu;?>
  <div class="pull-right">
    <ul class="nav">
      <li><?php echo html::a(helper::createLink('visual', 'index'), '<i class="icon-magic"></i> ' . $lang->visualEdit, "target='_blank' class='navbar-link'");?></li>
      <li><?php commonModel::printLink('package', 'upload', '', '<i class="icon-download-alt"></i> ' . $lang->ui->installTemplate, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'uploadTheme', '', '<i class="icon-download-alt"></i> ' . $lang->ui->uploadTheme, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'exportTheme', '', '<i class="icon-upload-alt"></i> ' . $lang->ui->exportTheme, "data-toggle='modal' data-width='600'")?></li>
      <li><?php commonModel::printLink('ui', 'themestore',  '', '<i class="icon-th-large"></i> ' . $lang->ui->themeStore, "data-width='600'")?></li>
    </ul>
  </div>
</nav>
