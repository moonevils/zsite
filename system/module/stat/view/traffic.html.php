<?php
/**
 * The traffic view file of stat module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     stat
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/chart.html.php';?>
<?php js::set('labels', $labels);?>
<?php js::set('chartData', $chart);?>
<div class='panel'>
  <div class="panel-heading">
    <strong><i class='icon icon-bar-chart'></i> <?php echo $lang->stat->traffic;?></strong>
    <div class="panel-actions"> </div>
  </div>
  <table class='table table-bordered table-condensed'>
    <thead>
      <tr class='text-center'>
        <th></th>
        <th><?php echo $lang->stat->pv;?></th>
        <th><?php echo $lang->stat->uv;?></th>
        <th><?php echo $lang->stat->ipCount;?></th>
      </tr>
    </thead>
    <tbody>
      <tr class='text-center'>
      <?php if(!empty($todayReport)):?>
        <td class='text-center'><?php echo $lang->stat->today;?></td>
        <td><?php echo $todayReport->pv;?></td>
        <td><?php echo $todayReport->uv;?></td>
        <td><?php echo $todayReport->ip;?></td>
      </tr>
      <?php endif;?>
      <?php if(!empty($yestodayReport)):?>
      <tr class='text-center'>
        <td class='text-center'><?php echo $lang->stat->yestoday;?></td>
        <td><?php echo zget($yestodayReport->pv, 0);?></td>
        <td><?php echo zget($yestodayReport->uv, 0);?></td>
        <td><?php echo zget($yestodayReport->ip, 0);?></td>
      </tr>
      <?php endif;?>
    </tbody>
  </table> 
  <p></p>
</div>
<div class='panel'>
  <div>
    <ul class='nav nav-tabs'>
    <?php foreach($lang->stat->trafficModes as $code => $modeName):?>
    <?php $class = $mode == $code ? "class='active'" : '';?>
    <li <?php echo $class?>><?php echo html::a(inlink('traffic', "mode=$code"), $modeName);?></li>
    <?php endforeach;?>
    </ul>
  </div>
  <div class='chart-canvas'><canvas height='260' width='900' id='chartBox'></canvas></div>
</div>

<?php include '../../common/view/footer.admin.html.php';?>
