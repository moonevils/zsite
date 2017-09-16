<?php $this->app->loadLang('score');?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header.lite');?>
<?php if($result):?>
<div class='container' id='payResult'>
  <div class='modal-dialog w-450px'> 
  <div class='modal-body'><div class='alert alert-success text-center'><h4><i class="text-success icon-ok-sign"></i> <?php echo $lang->order->paidSuccess;?></h4></div></div>
  <div class='modal-footer'><?php echo html::a(helper::createLink('user', 'score'), $lang->score->details, "class='btn btn-success'");?></div>
</div>
<?php else:?>
<h3 class='text-center text-danger'><?php echo $lang->score->payFail;?></h3>
<?php endif;?>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
<?php include TPL_ROOT . 'common/log.html.php';?>
</body>
</html>
