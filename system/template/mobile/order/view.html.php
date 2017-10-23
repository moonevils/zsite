<?php 
/**
 * The view view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>

<style>
#orderDetailTable {margin-bottom: 0;}
#orderDetailTable > tbody > tr > th {text-align: right; width: 90px;}
#orderDetailTable > tbody > tr > th,
#orderDetailTable > tbody > tr > td {border: none;}
</style>
<table class='table' id='orderDetailTable'>
  <tbody>
    <tr>
      <th><?php echo $lang->order->productInfo;?></th>
      <td>
          <?php foreach($products as $product):?>
          <div>
            <span><?php echo html::a(commonModel::createFrontLink('product', 'view', "id=$product->productID"), $product->productName, "target='_blank'");?></span>
            <span><?php echo $lang->order->price . $lang->colon . $product->price . ' ' . $lang->order->count . $lang->colon . $product->count;?></span>
          </div>
          <?php endforeach;?>
        </dl>
      </td>
    </tr>
    <?php if($type == 'shop'):?>
    <tr>
      <th><?php echo $lang->order->expressInfo;?></th>
      <td>
      <?php
      if($order->deliveryStatus !== 'not_send') 
      {
      echo $this->order->expressInfo($order) . '&nbsp;' . $order->waybill; 
      }
      else
      {
          echo $lang->order->noRecord;
      }
      ?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->order->address;?></th>
      <td>
        <?php $address = json_decode($order->address);?>
        <?php echo $address->contact . ',' . $address->address . ',' . str2Entity($address->phone) . ',' . $address->zipcode;?>
      </td>
    </tr> 
    <?php endif;?>
    <tr>
      <th><?php echo $lang->order->account;?></th>
      <td><?php echo zget($users, $order->account, $order->account);?></td>
    </tr> 
    <tr>
      <th><?php echo $lang->order->status;?></th>
      <td><?php echo $this->order->processStatus($order);?></td>
    </tr> 
    <tr>
      <th><?php echo $lang->order->amount;?></th>
      <td class='text-price'><?php echo $order->amount;?></td>
    </tr> 
    <tr>
      <th><?php echo $lang->order->payment;?></th>
      <td><?php echo zget($lang->order->paymentList, $order->payment);?></td>
    </tr> 
    <tr>
      <th><?php echo $lang->order->note;?></th>
      <td><?php echo $order->note;?></td>
    </tr> 
    <tr>
      <th><?php echo $lang->order->createdDate;?></th>
      <td><?php echo $order->createdDate;?></td>
    </tr> 
    <?php if($order->payment != 'COD' and ($order->paidDate > $order->createdDate)):?>
    <tr>
      <th><?php echo $lang->order->paidDate;?></th>
      <td><?php echo $order->paidDate;?></td>
    </tr> 
    <?php endif;?>
    <?php if($order->deliveriedDate > $order->createdDate):?>
    <tr>
      <th><?php echo $lang->order->deliveriedDate;?></th>
      <td><?php echo $order->deliveriedDate;?></td>
    </tr> 
    <?php endif;?>
    <?php if($order->confirmedDate > $order->deliveriedDate):?>
    <tr>
      <th><?php echo $lang->order->confirmedDate;?></th>
      <td><?php echo $order->confirmedDate;?></td>
    </tr> 
    <?php endif;?>
    <?php if($order->payment == 'COD' and ($order->paidDate > $order->createdDate)):?>
    <tr>
      <th><?php echo $lang->order->paiedDate;?></th>
      <td><?php echo $order->paiedDate;?></td>
    </tr> 
    <?php endif;?>
  </tbody>
</table>
