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
    <div class='row'>
      <div class='col-md-4 col-md-offset-2'>
        <table class='table table-bordered'>
          <tbody>
            <tr><th colspan='2'><?php echo $lang->score->methods['award']?></th></tr>
            <?php foreach($config->score->methodOptions as $item => $type):?>
              <?php if($type != 'award') continue;?>
              <?php $count = zget($this->config->score->counts, $item, '0');?>
              <?php if($count == '0') continue;?>
              <?php if($item == 'expend') $item = 'expendproduct';?>
              <?php if($item == 'recharge') $item = 'rechargebalance';?>
              <tr>
                <td><?php echo $lang->score->methods[$item];?></td>
                <td><?php echo  '+' . $count;?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
      <div class='col-md-4'>
        <table class='table table-bordered'>
          <tbody>
            <tr><th colspan='2'><?php echo $lang->score->methods['punish']?></th></tr>
            <?php foreach($config->score->methodOptions as $item => $type):?>
              <?php if($type != 'punish') continue;?>
              <?php $count = zget($this->config->score->counts, $item, '0');?>
              <?php if($count == '0') continue;?>
              <tr>
                <td><?php echo $lang->score->methods[$item];?></td>
                <td><?php echo '-' . $count;?></td>
              </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
