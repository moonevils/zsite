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
<?php include '../../common/view/header.admin.html.php';?>
<div class='row'>
  <div class='col-md-9'>
    <div class='panel'>
      <div class='panel-heading'><strong><?php echo $lang->order->productInfo;?></strong></div>
      <div class='panel-body'>
        <dl>
          <?php foreach($products as $product):?>
          <dd class='text-left'>
            <span><?php echo html::a(commonModel::createFrontLink('product', 'view', "id=$product->productID"), $product->productName, "target='_blank'");?></span>
            <span><?php echo $lang->order->price . $lang->colon . $product->price . ' ' . $lang->order->count . $lang->colon . $product->count;?></span>
          </dd>
          <?php endforeach;?>
        </dl>
      </div>
    </div>
    <div class='panel'>
      <div class='panel-heading'><strong><?php echo $lang->order->expressInfo;?></strong></div>
      <div class='panel-body'>
        <?php
        if($order->deliveryStatus !== 'not_send') 
        {
        echo $lang->order->express . $lang->colon . $this->order->expressInfo($order) . '</br>';
        echo $lang->order->waybill . $lang->colon . $order->waybill . '</br>'; 
        echo $lang->order->receiver . $lang->colon . $order->address . '</br>';
        }
        else
        {
            echo $lang->order->noRecord;
        }
        ?>
      </div>
    </div>
    <div class='panel'>
      <div class='panel-heading'><strong><?php echo $lang->order->info;?></strong></div>
      <div class='panel-body'>
        <table class='table table-form'>
          <tr>
            <th class='w-80px'><?php echo $lang->order->address;?></th>
            <td>
              <?php $address = json_decode($order->address);?>
              <?php echo $address->contact . ',' . $address->address . ',' . $address->phone . ',' . $address->zipcode;?>
            </td>
          </tr> 
          <tr>
            <th class='w-80px'><?php echo $lang->order->note;?></th>
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
        </table>
      </div>
    </div>
  </div>
  <div class='col-md-3'>
    <div class='panel'>
      <div class='panel-heading'><strong><?php echo $lang->order->basic;?></strong></div>
      <div class='panel-body'>
        <table class='table table-form'>
          <tr>
            <th class='w-80px'><?php echo $lang->order->account;?></th>
            <td><?php echo zget($users, $order->account, $order->account);?></td>
          </tr> 
          <tr>
            <th><?php echo $lang->order->status;?></th>
            <td><?php echo $this->order->processStatus($order);?></td>
          </tr> 
          <tr>
            <th><?php echo $lang->order->amount;?></th>
            <td><?php echo $order->amount;?></td>
          </tr> 
          <tr>
            <th><?php echo $lang->order->payment;?></th>
            <td><?php echo zget($lang->order->paymentList, $order->payment);?></td>
          </tr> 
        </table>
      </div>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
