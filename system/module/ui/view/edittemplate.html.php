<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<div id='mainMenu' class='clearfix'>
  <div id='navMenu'>
    <?php
    echo $lang->ui->editTemplate . ': ';
    echo "<div class='dropdown' id='moduleBox'>";
    echo "<a href='###' data-toggle='dropdown'>" . zget($lang->ui->folderList, $currentModule) . " <span class='icon-angle-down'></span></a>";
    echo "<ul class='dropdown-menu'>";
    foreach($lang->ui->folderList as $folder => $name)
    {
        $active = $currentModule == $folder ? "class='active'" : '';
        echo "<li $active>" . html::a($this->createLink('ui', 'editTemplate', "module=$folder&file=" . key(zget($files, $folder, array()))), $name) . "</li>";
    }
    echo '</ul></div>';
    
    if(isset($files->$currentModule))
    {
    echo "<div class='dropdown' id='fileBox'>";
    echo "<a href='###' data-toggle='dropdown'>" . zget($files->$currentModule, $currentFile) . " <span class='icon-angle-down'></span></a>";
    echo "<ul class='dropdown-menu'>";
    foreach($files->$currentModule as $file => $name)
    {
        $active = $currentFile == $file ? "class='active'" : '';
        echo "<li $active>" . html::a($this->createLink('ui', 'editTemplate', "module=$currentModule&file=$file"), $name) . "</li>";
    }
    echo '</ul></div>';
    }
    ?>
  </div>
  <div id='deviceMenu' class='btn-toolbar pull-right'>
    <?php
    echo html::a($this->createLink('ui', 'setDevice', "device=desktop"), $lang->ui->clientDesktop, $this->session->device != 'mobile' ? "class='active'" : '');
    echo html::a($this->createLink('ui', 'setDevice', "device=mobile"), $lang->ui->clientMobile, $this->session->device == 'mobile' ? "class='active'" : '');
    ?>
  </div>
</div>
<form method='post' id='editForm'>
  <div class='panel' id='mainPanel'>
    <div class='panel-heading'>
      <strong id='fileName'><?php echo zget($lang->ui->folderList, $currentModule) . ' / ' . zget($files->$currentModule, $currentFile);?> </strong>
      <span class='text-important'><?php echo $realFile;?></span>
      <div class='panel-actions'>
        <?php echo html::a("javascript:;", $lang->ui->reset, "id='resetBtn' class='btn btn-default'");?>
      </div>
    </div>
    <div class='tab-content'>
      <div class='tab-pane theme-control-tab-pane active' id='cssTab'>
        <?php echo html::textarea('content', $content, "rows='20' class='form-control codeeditor' data-mode='php' data-height='550'");?>
      </div>
    </div>
    <div class="panel-footer text-right">
      <?php echo html::submitButton() . html::hidden('module', $currentModule) .html::hidden('file', $currentFile);?>
    </div>
  </div>
</form>
<textarea class='hide' id='rawContent'><?php echo $rawContent;?></textarea>
<?php include '../../common/view/footer.admin.html.php';?>
