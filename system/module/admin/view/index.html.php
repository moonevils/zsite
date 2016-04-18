<?php
/**
 * The index view file of admin module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiyingl@xirangit.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php if(!$ignoreUpgrade) js::import('http://api.chanzhi.org/latest.php?version=' . $this->config->version);?>
<div class='container' id='shortcutBox'>

  <?php if(strpos($this->server->php_self, '/admin.php') !== false && empty($this->config->global->ignoreAdminEntry)):?>
  <form method='post' id='ajaxForm' action='<?php echo $this->createLink('admin', 'ignore');?>'>
    <div class="alert alert-danger">
      <button type="submit" class="close">&times;</button>
      <strong><?php echo $lang->admin->adminEntry;?></strong>
    </div>
  </form>
  <?php endif;?>

  <?php if(!$ignoreUpgrade):?>
  <div class='alert alert-success' id='upgradeNotice'>
    <div>
      <?php echo $lang->newVersion;?>
      <button class="close"><?php echo html::a(inlink('ignoreUpgrade'), '&times;', "class='reload'");?></button>
    </div>
  </div>
  <?php endif;?>

  <?php if(!$checkLocation):?>
  <div class='alert alert-success'>
    <div>
      <?php echo $lang->site->changeLocation;?>
      <?php echo html::a($this->createLink('site', 'setsecurity'), $lang->site->changeSetting, "class='red'");?>
    </div>
  </div>
  <?php endif;?>
  <div class='text-right panel-control'>
    <a href='javascript:;' class='refresh-all-panel'><i class='icon-repeat'></i></a>
    <a data-toggle='modal' href='<?php echo $this->createLink("widget", "create"); ?>' title='<?php echo $lang->widget->create; ?>'><i class='icon-plus'></i></a>
  </div>
  <div id='dashboardWrapper'>
    <div class='panels-container dashboard' id='dashboard' data-confirm-remove-block='<?php  echo $lang->widget->confirmRemoveWidget;?>'>

  <div class='row summary'>
    <?php
    $index = 0;
    reset($widgets);
    ?>
    <?php foreach($widgets as $key => $widget):?>
    <?php
    $index = $key;
    list($moreModule, $moreMethod, $moreParams) = explode('|', $widget->moreLink);
    ?>
    <div class='col-xs-<?php echo $widget->grid;?> pull-left'>
      <div class='panel <?php if(isset($widget->params->color)) echo 'panel-' . $widget->params->color;?>' id='widget<?php echo $index?>' data-id='<?php echo $index?>' data-name='<?php echo $widget->title?>' data-url='<?php echo $this->createLink('entry', 'printBlock', 'index=' . $index) ?>'>
        <div class='panel-heading'>
          <div class='panel-actions'>
            <?php if(isset($widget->moreLink)) echo html::a(helper::createLink($moreModule, $moreMethod, $moreParams), $lang->more . "<i class='icon-double-angle-right'></i>", "class='more app-btn'");?>
            <button class="btn btn-mini refresh-panel" type='button'><i class="icon-repeat"></i></button>
            <div class='dropdown'>
              <button role="button" class="btn btn-mini" data-toggle="dropdown" type='button'><span class="caret"></span></button>
              <ul class="dropdown-menu pull-right" role="menu">
                <li><a href="<?php echo $this->createLink("widget", "edit", "index=$widget->id"); ?>" data-toggle='modal' class='edit-widget' data-title='<?php echo $widget->title; ?>' data-icon='icon-pencil'><i class="icon-pencil"></i> <?php echo $lang->edit;?></a></li>
                <li><a href="javascript:;" class="remove-panel"><i class="icon-remove"></i> <?php echo $lang->delete; ?></a></li>
                <?php if($widget->type == 'html'):?>
                  <li><a href="javascript:hiddenBlock(<?php echo $index;?>)" class="hidden-panel"><i class='icon-eye-close'></i> <?php echo $lang->index->hidden; ?></a></li>
                <?php endif;?>
              </ul>
            </div>
          </div>
          <?php echo $widget->title;?>
        </div>
        <div class='panel-body no-padding'>
          <?php echo $this->fetch('widget', 'printWidget', 'widget=' . $widget->id);?>
        </div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
