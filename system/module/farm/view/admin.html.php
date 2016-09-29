<?php
/**
 * The admin view file of farm module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     farm
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class="panel-heading">
    <strong><i class='icon-group'></i> <?php echo $lang->farm->admin;?></strong>
    <div class="panel-actions">
      <?php echo html::a(inlink('create'), $lang->farm->create, "class='btn btn-primary' data-toggle='modal'");?>
    </div>
  </div>
  <table class='table table-hover table-bordered table-striped table-fixed'>
    <thead>
      <tr class='text-center'>
        <th class='w-40px'><?php echo $lang->farm->id;?></th>
        <th class='w-180px'><?php echo $lang->farm->name;?></th>
        <th><?php echo $lang->farm->url;?></th>
        <th><?php echo $lang->farm->private;?></th>
        <th class='col-xs-2'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($farms as $farm):?>
      <tr class='text-center text-middle'>
        <td><?php echo $farm->id;?></td>
        <td><?php echo $farm->name;?></td>
        <td><?php echo $farm->url;?></td>
        <td class='text-left'><?php echo $farm->private;?></td>
        <td>
          <?php echo html::a(inlink('edit', "farmID={$farm->id}"), $lang->edit, "data-toggle='modal'");?>
          <?php echo html::a(inlink('delete', "farmID={$farm->id}"), $lang->delete, "class='deleter'");?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='4'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
