<?php 
/**
 * The delivery view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
{include TPL_ROOT . 'common/header.modal.html.php'}
<table class='table table-form'>
  <tr>
    <th class='w-100px'>{!echo $lang->order->address}</th>
    <td>{!echo $fullAddress}</td>
  </tr>
  <tr>
    <th class='w-100px'>{!echo $lang->order->deliveriedDate}</th>
    <td>{!echo $order->deliveriedDate}</td>
  </tr>
  <tr>
    <th class='w-100px'>{!echo $lang->order->express}</th>
    <td>{!echo zget($expressList, $order->express, '')}</td>
  </tr>
  <tr>
    <th class='w-100px'>{!echo $lang->order->waybill}</th>
    <td>{!echo $order->waybill}</td>
  </tr>
</table>
{include TPL_ROOT .'/common/footer.modal.html.php'}
