<?php
/**
 * The settheme view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php $currentTheme    = $this->config->template->{$this->app->clientDevice}->theme; ?>
<?php $currentTemplate = $this->config->template->{$this->app->clientDevice}->name; ?>
<div id='mainMenu' class='clearfix'>
  <div id='navMenu'>
    <?php echo html::a('#internalSection', $lang->ui->files->default->user['thread'], "data-toggle='tab' class='active'");?>
    <?php echo html::a(inlink('themestore'), $lang->ui->themeStore);?>
  </div>
  <div id='deviceMenu' class='btn-toolbar pull-right'>
    <?php
    echo html::a($this->createLink('ui', 'setDevice', "device=desktop"), $lang->ui->clientDesktop, $this->session->device != 'mobile' ? "class='active'" : '');
    echo "|";
    echo html::a($this->createLink('ui', 'setDevice', "device=mobile"), $lang->ui->clientMobile, $this->session->device == 'mobile' ? "class='active'" : '');
    ?>
  </div>
</div>
<div class='panel' id='mainPanel'>
  <form method='post'>
    <div class='panel-heading'>
      <ul class='nav nav-tabs' id='typeNav'>
        <li data-type='internal' class='active'><?php echo html::a('#internalSection', $lang->ui->installedThemes, "data-toggle='tab' class='active'");?></li>
        <?php if($app->clientLang != 'en'):?>
        <li data-type='internal'><?php echo html::a('#packageSection', $lang->ui->themePackage, "data-toggle='tab'");?></li>
        <?php endif;?>
        <li data-type='internal'><?php echo html::a('#', $lang->ui->addTheme . "<i class='icon-plus-sign'></i>", "class='radius-btn'");?></li>
        <li data-type='internal'><?php echo html::a(inlink('uploadTheme'), $lang->ui->uploadTheme . "<i class='icon icon-download'></i>", "class='radius-btn'");?></li>
        <?php echo html::input('searchTheme', '', "placeholder={$lang->ui->searchTheme}")?>
      </ul>
    </div>
  </form>
  <div class='panel-body tab-content'>
    <section class='cards cards-borderless themes tab-pane active' id='internalSection'>
      <?php foreach($template['themes'] as $code => $theme):?>
      <?php $url = $this->createLink('ui', 'setTemplate', "template={$template['code']}&theme={$code}&custom=1");?>
      <?php $templateRoot = $webRoot . 'template/' . $template['code'] . '/';?>
      <?php $isCurrent =  $currentTheme === $code; ?>
      <div class='col-theme'>
        <div class='card theme <?php if($isCurrent) echo 'current';?>' data-url='<?php echo $url?>'>
          <i class='icon-ok icon'></i>
          <?php echo html::a($url, html::image($webRoot . 'theme/' . $template['code'] . '/' . $code . '/preview.png'), "class='media-wrapper theme-img'");?>
          <div class='text-center theme-name text-ellipsis'>
            <?php echo $theme;?>
          </div>
          <div class='actions'>
            <?php if(!in_array("$currentTemplate.$code", $this->config->ui->systemThemes)) commonModel::printLink('ui', 'deleteTheme', "template={$currentTemplate}&theme={$code}", "<span class='icon-trash'></span>", "title='{$lang->delete}' class='deleter btn btn-link btn-mini' data-type='ajax' data-backdrop='true'") ?>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </section>
    <?php if($app->clientLang != 'en'):?>
    <section class='tab-pane' id='storeSection'>
      <div class='text-center text-muted load-icon' style='padding: 50px'><i class='icon icon-2x icon-spinner icon-spin'></i></div>
    </section>
    <section class='tab-pane' id='packageSection'>
      <div class='text-center text-muted load-icon' style='padding: 50px'><i class='icon icon-2x icon-spinner icon-spin'></i></div>
    </section>
    <?php endif;?>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
