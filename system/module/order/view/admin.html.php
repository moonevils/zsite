<?php 
/**
 * The admin view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('finishWarning', $lang->order->finishWarning);?>
<div class='panel'>
  <div class='panel-heading'>
    <ul id='typeNav' class='nav nav-tabs'>
      <li data-type='internal' <?php echo $param == 'normal' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "mode=status&status=normal"), $lang->order->statusList['normal']);?>
      </li>
      <li data-type='internal' <?php echo $param == 'finished' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "mode=status&status=finished"), $lang->order->statusList['finished']);?>
      </li>
      <li data-type='internal' <?php echo $param == 'canceled' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "mode=status&status=canceled"), $lang->order->statusList['canceled']);?>
      </li>
    </ul> 
  </div>
  <table class='table table-hover table-striped tablesorter table-fixed'>
    <thead>
      <tr class='text-center'>
        <?php $vars = "mode=$mode&param={$param}&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}";?>
        <th class='w-60px'><?php commonModel::printOrderLink('id', $orderBy, $vars, $lang->order->id);?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('type', $orderBy, $vars, $lang->order->type);?></th>
        <th class='w-90px'><?php commonModel::printOrderLink('account', $orderBy, $vars, $lang->order->account);?></th>
        <th><?php echo $lang->order->productInfo;?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('amount', $orderBy, $vars, $lang->order->amount);?></th>
        <th class='w-80px'><?php commonModel::printOrderLink('status', $orderBy, $vars, $lang->product->status);?></th>
        <th title='<?php echo $order->note?>'><?php echo $lang->order->note;?></th>
        <th class='w-180px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($orders as $order):?>
      <?php $goodsInfo = $this->order->printGoods($order);?>
      <tr class='text-center text-top'>
        <td><?php echo $order->id;?></td>
        <td> <?php echo zget($lang->order->types, $order->type);?> </td>
        <td><?php echo zget($users, $order->account);?></td>
        <td class='text-left' <?php echo strip_tags($goodsInfo);?>><?php echo $goodsInfo;?> </td>
        <td><?php echo $order->amount;?></td>
        <td><?php echo $this->order->processStatus($order);?></td>
        <td class='text-left'><?php echo $order->note;?></td>
        <td class='text-left'><?php $this->order->printActions($order);?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
