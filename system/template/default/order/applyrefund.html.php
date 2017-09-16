<?php 
/**
 * The apply refund view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.modal.html.php';?>
<form method='post' action='<?php echo inlink('applyrefund', "orderID={$orderID}");?>' id='ajaxForm'>
  <table class='table table-form'>
    <tr>
      <th class='w-60px'><?php echo $lang->order->comment;?></th>
      <td><?php echo html::textarea('comment', '', "rows='3' class='form-control'");?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton();?></td>
    </tr>
  </table>
</form>
<?php include TPL_ROOT .'/common/footer.modal.html.php';?>
