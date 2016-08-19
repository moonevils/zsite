<?php $this->app->loadLang('score');?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header.lite');?>
<?php if($result):?>
<div class='container' id='payResult'>
  <div class='modal-dialog w-450px'> 
    <div class='alert alert-success'>
      <div class='content'>
        <i class='icon icon-ok'> </i>
        <?php echo $lang->order->paidSuccess;?>
        <span style='padding-left:10px;'><?php echo html::a($this->createLink('user', 'score'), "<i class='icon icon-gift'> </i>" . $lang->score->details, "class='btn btn-xs btn-primary'");?></span>
      </div>
    </div>
  </div>
</div>
<?php else:?>
<h3 class='text-center text-danger'><?php echo $lang->score->payFail;?></h3>
<?php endif;?>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
<?php include TPL_ROOT . 'common/log.html.php';?>
</body>
</html>
