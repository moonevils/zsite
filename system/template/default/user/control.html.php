<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');?>
<div class="page-user-control">
  <div class="row">
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class="col-md-10">
      <div class="panel panel-body">
        <div class="jumbotron-bg">
          <?php printf($lang->user->control->welcome, $realname);?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
