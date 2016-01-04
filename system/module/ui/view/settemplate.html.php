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
<div class='panel'>
  <div>
    <ul class="nav nav-tabs" id='typeNav'>
        <li data-type='internal'><?php echo html::a('javascript:;', $lang->ui->internalTheme);?></li>
        <li data-type='store'><?php echo html::a('javascript:;', $lang->ui->themeStore);?></li>
     </ul>   
  </div>
  <div class='panel-body'>
    <section class="cards cards-products cards-borderless" id='internalSection'>
      <?php foreach($template['themes'] as $code => $theme):?>
      <?php $url = $this->createLink('ui', 'setTemplate', "template={$template['code']}&theme={$code}&custom=1");?>
      <?php $templateRoot = $webRoot . 'template/' . $template['code'] . '/';?>
      <div class="col-sm-2">
        <div class="card">
          <?php echo html::a($url, html::image($templateRoot . 'theme/' . $code . '/preview.png'), "class='media-wrapper'");?>
          <div class="card-heading text-center">
            <?php echo html::a($url, $theme, "class='btn btn-default btn-block'");?>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </section>
    <section class="cards cards-products cards-borderless" id='storeSection'> </section>
  </div>
  <div class='panel-footer'>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
