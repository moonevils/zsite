<?php
/**
 * The reply view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side');?>

<div class='panel-section'>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-reply'></i> <?php echo $lang->user->reply?></div>
  </div>
  <div class='cards condensed cards-list'>
    <?php foreach($replies as $reply):?>
    <a href='<?php echo $this->createLink('thread', 'view', "id=$reply->thread") . "#$reply->id";?>' class='card'>
      <div class='card-heading'>
        <h5><?php echo $reply->title?></h5>
      </div>
      <div class='card-content text-muted'>
        <?php echo $lang->reply->addedDate;?> <?php echo substr($reply->addedDate, 2, -3);?>
      </div>
    </a>
    <?php endforeach;?>
  </div>
  <div class='panel-footer'>
    <?php $pager->show('justify');?>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer');?>
