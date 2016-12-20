<div id="mainArea" class='row'>
  <?php foreach($themes as $theme):?>
  <?php $link = inlink('installtheme', "package={$theme->name}&downLink=&md5=&type=theme");?>
  <div class='col-md-3'>
    <div class='panel theme-panel'>
      <div class='panel-body text-info'>
        <h3><?php echo $theme->name . ".zip";?></h3>
        <div class='text-muted'>
          <i class='span-time'><?php echo "<i class='icon icon-time'> </i>" . $theme->time;?></i>
          <i class='span-size'><?php echo "<i class='icon icon-file'> </i>" . helper::formatKB($theme->size / 1024);?></i>
        </div>
        <?php echo html::a($link, $lang->ui->installTheme, "class='btn btn-success btn-xs btn-install ' data-toggle='modal'");?>
      </div>
    </div>
  </div>
  <?php endforeach;?>
  <div class='div-tip text-danger'><?php printf($lang->ui->packagePathTip, $packagePath);?></div>
</div>
<style>
.theme-panel > .panel-body{padding-top:4px !important; cursor:pointer;}
.theme-panel .span-size{margin-left:20px;}
.btn-install{position:absolute; right: 30px; top:50px;}
.div-tip{padding-left:10px}
</style>
