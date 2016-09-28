<?php
/**
 * The uploadtheme view file of ui module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php if($canManage['result'] == 'success'):?>
<form method='post' enctype='multipart/form-data' id='uploadForm' action='<?php echo inlink('uploadtheme')?>'>
  <div id='responser'></div>
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->ui->importType;?></th>
      <td><?php echo html::radio('type', $lang->ui->importTypes, 'theme', "class='checkbox'")?></td>
    </tr>
    <tr>
      <th><?php echo $lang->ui->themePackage;?></th>
      <td> <input type='file' name='file' class='form-control' /> </td>
    </tr>
    <tr><th></th><td><?php echo html::submitButton($lang->ui->uploadTheme);?></td></tr>
  <table>
</form>
<?php else:?>
<div>
  <?php printf($lang->guarder->okFileVerify, $canManage['name'], $canManage['content']);?>
  <div class='text-right'><?php echo html::a($this->inlink('uploadtheme'), $lang->confirm, "class='btn btn-primary okFile loadInModal'");?></div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.modal.html.php';?>
