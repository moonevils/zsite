<div id="mainArea" class='row'>
  <?php foreach($themes as $theme):?>
  <?php $link      = inlink('installtheme', "package={$theme->name}&downLink=&md5=");?>
  <?php $installed = (isset($installedThemes['default'][$theme->name]) or isset($installedThemes['mobile'][$theme->name]));?>
  <div class='col-md-3'>
    <div class='panel theme-panel'>
      <div class='panel-body'>
        <div class='theme-title'>
          <?php echo $theme->name . ".zip";?>
          <?php if($installed) echo "<i class='label label-success icon icon-check'>{$lang->ui->installed}</i>";?>
        </div>
        <div class='text-muted'>
          <i class='span-time'><?php echo "<i class='icon icon-time'> </i>" . $theme->time;?></i>
          <i class='span-size'><?php echo "<i class='icon icon-file'> </i>" . helper::formatKB($theme->size / 1024);?></i>
        </div>
        <?php echo html::a($link, $lang->ui->installTheme, "class='btn btn-primary btn-xs btn-install'");?>
      </div>
    </div>
  </div>
  <?php endforeach;?>
  <div class='div-tip text-danger'><?php printf($lang->ui->packagePathTip, $packagePath);?></div>
</div>
<style>
.theme-panel > .panel-body{padding-top:4px !important; cursor:pointer;}
.theme-panel > .panel-body > .theme-title{font-size:16px; padding: 10px 0; color:#555; font-weight:bold;}
.theme-panel .span-size{margin-left:20px;}
.btn-install{position:absolute; right: 30px; top:50px;}
.div-tip{padding-left:10px}
</style>
<script>
$().ready(function()
{
    $('.btn-install').click(function()
    {

    });
});
</script>
