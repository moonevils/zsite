<?php
/**
 * The edit view file of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include TPL_ROOT . 'common/header.modal.html.php';?>
<form method='post' id='editForm' class='form-inline' action="<?php echo inlink('edit', "orderID={$order->id}");?>">
  <table class='table table-form'>
    <?php $address = json_decode($order->address);?>
    <tr>
      <th class='w-80px'><?php echo $lang->order->contact;?></th>
      <td><?php echo html::input('contact', $address->contact, "class='form-control'");?></td>
    </tr> 
    <tr>
      <th class='w-80px'><?php echo $lang->order->phone;?></th>
      <td><?php echo html::input('phone', $address->phone, "class='form-control'");?></td>
    </tr> 
    <tr>
      <th class='w-80px'><?php echo $lang->order->address;?></th>
      <td><?php echo html::input('address', $address->address, "class='form-control'");?></td>
    </tr> 
    <tr>
      <th class='w-80px'><?php echo $lang->order->zipcode;?></th>
      <td><?php echo html::input('zipcode', $address->zipcode, "class='form-control'");?></td>
    </tr>
    <tr>
      <th class='w-80px'><?php echo $lang->order->frontNote;?></th>
      <td><?php echo html::input('note', $order->note, "class='form-control'");?></td>
    </tr> 
    <tr>
      <th></th>
      <td colspan='2'>
        <?php echo html::submitButton();?>
      </td>
    </tr>
  </table>
</form>
<script>
$(document).ready(function()
{   
    $.setAjaxForm('#editForm', function(data)
    {
        if(data.result == 'success') setTimeout(function(){parent.location.reload()}, 1500);
    }); 
});
</script>
<?php include TPL_ROOT .'/common/footer.modal.html.php';?>

