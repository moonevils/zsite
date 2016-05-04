<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<div class='col-xs-2'>
  <div class="hiddden-xs hidden-sm" style='height:600px;'>
    <div class='panel'>
      <?php foreach($lang->ui->folderList as $folder => $name):?>
        <div class='panel-heading'> <strong><i class='icon icon-folder-close'> </i><?php echo $name;?></strong> </div>
        <div class='panel-body'>
        <?php $fileList = zget($files, $folder);?>
        <?php foreach($fileList as $file => $name):?>
          <?php if(strpos($file, '/') !== false) list($folder, $file) = explode('/', $file);?>
          <?php $class = ($folder == $currentModule and $file == $currentFile) ? "class='active btn-file'" : "class='btn-file'";?>
          <?php echo html::a(inlink('edittemplate', "module={$folder}&file={$file}"), $name, "title='/{$folder}/{$file}.html.php' $class" );?>
        <?php endforeach;?>
        </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
<div class='col-xs-10'>
<form method='post' id='editForm'>
  <div class='panel' id='mainPanel'>
    <div class='panel-heading'>
      <strong><?php echo zget($lang->ui->folderList, $currentModule) . ' / ' . $files->{$currentModule}[$currentFile];?></strong>
    </div>
    <div class='tab-content'>
      <div class='tab-pane theme-control-tab-pane active' id='cssTab'>
        <?php echo html::textarea('content', $content, "rows='20' class='form-control codeeditor' data-mode='php' data-height='550'");?>
      </div>
    </div>
    <div class="panel-footer">
      <?php echo html::submitButton() . html::hidden('module', $currentModule) .html::hidden('file', $currentFile);?>
      <?php echo html::a("javascript:;", $lang->ui->reset, "id='resetBtn' class='btn btn-default'");?>
    </div>
  </div>
</form>
<textarea class='hide' id='rawContent'><?php echo $rawContent;?></textarea>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
