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
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php $productCount = count($products); $item = 1;?>
<?php js::set('productCount', $productCount);?>
<form method='post' id='editForm' class='form-inline' action="<?php echo inlink('edit', "orderID={$order->id}");?>">
  <table class='table table-form'>
    <tr>
      <th class='w-80px'><?php echo $lang->order->deliveryStatus;?></th>
      <td><?php echo $lang->order->deliverList[$order->deliveryStatus];?></td>
    </tr>
    <tr>
      <th rowspan='<?php echo $productCount;?>'><?php echo $lang->order->productInfo;?></th>
      <?php $product = $products[0];?>
      <td>
        <div>
          <span><?php echo html::a(commonModel::createFrontLink('product', 'view', "id=$product->productID"), $product->productName, "target='_blank'");?></span>
          <span>
            <?php 
            echo $lang->order->price . $lang->colon . $product->price . ' ' . $lang->order->count . $lang->colon . html::input("product[$product->id]", $product->count, "class='form-control w-40px product-input'");
            ?>
          </span>
          <span>
            <?php echo $productCount == 1 ? '' : html::a('javascript:;', $lang->delete, "class='product-deleter'");?>
          </span>
        </div>
      </td>
    </tr>
    <?php if($productCount > 1):?>
    <?php while($item < $productCount):?>
    <tr>
      <?php $product = $products[$item]; $item += 1;?>
      <td>
        <div>
          <span><?php echo html::a(commonModel::createFrontLink('product', 'view', "id=$product->productID"), $product->productName, "target='_blank'");?></span>
          <span>
            <?php 
            echo $lang->order->price . $lang->colon . $product->price . ' ' . $lang->order->count . $lang->colon . html::input("product[$product->id]", $product->count, "class='form-control w-40px product-input'");
            ?>
          </span>
          <span>
            <?php echo html::a('javascript:;', $lang->delete, "class='product-deleter'");?>
          </span>
        </div>
      </td>
    </tr>
    <?php endwhile;?>
    <?php endif;?>
    <?php if($order->deliveryStatus === 'send'):?>
    <tr>
      <th class='w-80px'><?php echo $lang->order->express;?></th>
      <td><?php echo html::select('express', $expressList, $order->express, "class='form-control'");?></td>
    </tr>
    <tr>
      <th class='w-80px'><?php echo $lang->order->waybill;?></th>
      <td><?php echo html::input('waybill',  $order->waybill, "class='form-control'");?></td>
    </tr>
    <tr>
      <th class='w-80px'><?php echo $lang->order->deliveriedDate;?></th>
      <td>
        <div class="input-append date">
          <?php echo html::input('deliveriedDate', $order->deliveriedDate, "class='form-control'");?>
          <span class='add-on'><button class="btn btn-default" type="button"><i class="icon-calendar"></i></button></span>
        </div>
      </td>
    </tr>
    <?php endif;?>
    <?php if($order->deliveryStatus !== 'confirmed'):?>
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
    <?php endif;?> 
    <tr>
      <th class='w-80px'><?php echo $lang->order->note;?></th>
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
<?php include '../../common/view/footer.modal.html.php';?>
