<?php 
/**
 * The processorder view of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header.lite');?>
<div class='container' id='payResult'>
  <div class='modal-dialog w-450px'> 
    <div class='alert alert-success'>
      <div class='content'>
        <i class='icon icon-ok'> </i>
        <?php echo $lang->order->paidSuccess;?>
        <span style='padding-left:10px;'><?php echo html::a(inlink('browse'), "<i class='icon icon-shopping-cart'> </i>" . $lang->order->bought, "class='btn btn-primary btn-xs'");?></span>
      </div>
    </div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
<?php include TPL_ROOT . 'common/log.html.php';?>
</body>
</html>
