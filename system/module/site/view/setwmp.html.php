<?php
/**
 * The setwmp view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-globe'></i> <?php echo $lang->site->setWmp;?></strong>
    <div class='panel-actions'>
      <?php commonModel::printLink('site', 'downloadwmppackage', '', '<i class="icon-download-alt"></i> ' . $lang->site->download, 'class="btn btn-primary"');?>
    </div>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->site->wmp->appID;?></th> 
          <td class='w-p40'><?php echo html::input('appID',  isset($this->config->wmp->appID) ? $this->config->wmp->appID : '', "class='form-control'");?></td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->wmp->projectName;?></th> 
          <td><?php echo html::input('projectName',  isset($this->config->wmp->projectName) ? $this->config->wmp->projectName : '', "class='form-control'");?></td>
          <td></td>
        </tr>
        <tr>
          <th></th>
          <td><?php echo html::submitButton();?></td>
          <td></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
