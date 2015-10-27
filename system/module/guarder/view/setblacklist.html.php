<?php
/**
 * The setBlacklist view file of guard module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1 (http://www.chanzhi.org/license/)
 * @author      Qiaqia LI <liqiaqia@cnezsoft.cn>
 * @package     guard
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class="panel-heading pd-l0">
    <div class="panel-actions pull-left"> 
      <ul class='nav nav-tabs'>
        <?php foreach($lang->guarder->blacklistModes as $code => $modeName):?>
        <?php $class = $mode == $code ? "class='active'" : '';?>
        <li <?php echo $class?>><?php echo html::a(inlink('setBlacklist', "mode=$code"), $modeName);?></li>
        <?php endforeach;?>
      </ul>
    </div>
    <span class='panel-actions pull-right'><?php commonModel::printLink('guarder', 'add', "type={$mode}", '<i class="icon-plus"></i> ' . $lang->guarder->add, 'class="btn btn-primary" data-toggle="modal"');?></span>
  </div>
  <table class='table table-bordered'>
    <thead>
      <tr>
        <th><?php echo $lang->guarder->content;?></th>
        <th class='text-center w-300px'><?php echo $lang->guarder->expiration;?></th>
        <th><?php echo $lang->guarder->reason;?></th>
        <th class='text-center w-200px'><?php echo $lang->guarder->action;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($blacklist as $object):?>
      <tr>
        <td>
        <?php echo $object->identity;?>
        </td>
        <td>
        <?php echo ($object->expiredDate == '0000-00-00 00:00:00') ? $lang->guarder->permanent : $object->expiredDate;?>
        </td>
        <td>
        <?php echo $object->reason;?>
        </td>
        <td class='text-center text-middle'>
          <?php commonModel::printLink('guarder', 'delete', "type=$object->type&identity=$object->identity", $lang->delete, "class='deleter'");?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='7' class='text-right'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
