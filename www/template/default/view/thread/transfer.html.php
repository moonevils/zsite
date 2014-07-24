<?php 
/**
 * The transfer view of thread module of ZenTaoMS.
 *
 * @copyright   Copyright 2013-2014 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     商业软件，非开源软件
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     thread 
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../common/header.modal.html.php';?>
<?php js::set('parents', $parents);?>
<form id='ajaxForm' class='form-horizontal' action='<?php echo inlink('transfer', "threadID={$thread->id}")?>'  method='post'>
  <div class='form-group'>
    <label for='link' class='col-xs-2 control-label'><?php echo $lang->thread->board;?></label>
    <div class='col-xs-8'>
      <?php echo html::select('targetBoard', $boards, $thread->board, "class='form-control chosen'");?>
    </div>
  </div>
  <div class='form-group'>
    <div class='col-xs-2'></div>
    <div class='col-xs-8'>
      <?php echo html::submitButton();?>
    </div>
  </div>
</form>
<?php include '../common/footer.modal.html.php';?>
