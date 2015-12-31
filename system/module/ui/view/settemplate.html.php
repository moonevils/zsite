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
  <div class='panel panel-heading'>
    <strong><?php echo $lang->ui->currentTheme . $lang->colon . zget($template['themes'], $this->config->template->{$this->device}->theme);?></strong>
  </div>
  <div class='panel-body'>
    <ul class="nav nav-tabs">
        <li class="nav-heading">这是标题</li>
        <li class="active">
          <a href="###">首页</a>
        </li>
        <li>
          <a href="###">个人资料</a>
        </li>
        <li class="disabled">
          <a href="###">消息</a>
        </li>
        <li>
          <a class="dropdown-toggle" data-toggle="dropdown" href="###">更多 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="">Lorem ipsum.</a>
            </li>
            <li>
              <a href="">Optio, fuga.</a>
            </li>
            <li>
              <a href="">Dicta, vero.</a>
            </li>
            <li>
              <a href="">Doloribus, obcaecati.</a>
            </li>
          </ul>
        </li>
      </ul>   
  </div>
  <div class='panel-footer'>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
