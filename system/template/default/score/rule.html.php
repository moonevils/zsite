<?php
/**
 * The setCounts view file of score of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     Score
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');?>
<?php $common->printPositionBar();?>
<div class='panel'>
  <div class='panel-heading'>
    <?php if(count($this->config->score->ruleNav) > 1):?>
    <ul id='typeNav' class='nav nav-tabs'>
    <?php foreach($this->config->score->ruleNav as $nav):?>
      <li data-type='internal' <?php echo $type == $nav ? "class='active'" : '';?>>
        <?php echo html::a(inlink($nav), $lang->score->$nav);?>
      </li>
    <?php endforeach;?>
    </ul>
    <?php else:?>
    <strong><?php echo $lang->score->rule;?></strong>
    <?php endif;?>
  </div>
  <div class='panel-body'>
    <ol>
      <?php foreach($config->score->methodOptions as $item => $type):?>
        <?php if($type != 'award' and $type != 'punish') continue;?>
        <?php $count = zget($this->config->score->counts, $item, '0');?>
        <?php if($count == '0' or $count == '') continue;?>
        <?php if($item == 'expend') $item = 'expendproduct';?>
        <?php if($item == 'recharge') $item = 'rechargebalance';?>
        <?php $count = ($type == 'award' ? '+' : '-') . $count;?>
        <li class='w-120px'>
          <span class='method'><?php echo $lang->score->methods[$item];?></span>
          <span class='pull-right <?php echo $type == 'award' ? 'green' : 'red';?>'><?php echo $count;?></span>
        </li>
      <?php endforeach;?>
    </ol>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
