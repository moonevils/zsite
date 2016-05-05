<?php
/**
 * The browse view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong class='pull-left'> <?php printf($lang->block->currentLayout, $plans[$plan]);?> </strong> &nbsp;
    <ul class='pull-left'>
      <li class="dropdown">
        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <?php echo $lang->block->switchPlan;?> <i class="icon icon-chevron-down"></i>
        </a>
        <ul class="dropdown-menu layout-menu">
          <?php foreach($plans as $planID => $name):?>
          <li<?php if($plan == $planID) echo " class='active'";?>>
            <?php echo html::a(inlink('switchlayout', "plan={$planID}"), $name);?>
            <div class='actions'>
              <?php if($planID) echo html::a(inlink('renamelayout',   "plan={$planID}"), "<i class='icon icon-pencil'></i>", "data-toggle='modal'");?>
              <?php if($planID) echo html::a(inlink('removelayout',   "plan={$planID}"), "<i class='icon icon-remove'></i>", "class='deleter'");?>
            </div>
          </li>
          <?php endforeach;?>
        </ul>
      </li>
    </ul>
    <div class='panel-actions'>
      <?php if($plan != 0) echo html::a(inlink('renamelayout', "plan={$plan}"), $lang->block->renameLayout, "class='btn btn-sm btn-default' data-toggle='modal'");?>
      <?php echo html::a(inlink('clonelayout', "plan={$plan}"), $lang->block->cloneLayout, "class='btn btn-primary' data-toggle='modal'");?>
    </div>
  </div>
  <div class='panel-body'>
    <div>
    <?php foreach($this->lang->block->{$template}->pages as $page => $name):?>
    <?php if(empty($lang->block->$template->regions->$page)) continue;?>
    <div style='margin:6px; width:160px;float:left;'>
      <?php echo html::a('javascript:;', $name, "class='btn-page' data-page='{$page}'  data-toggle='modal' data-target='#region{$page}'");?>
      <div class="modal fade" id="<?php echo 'region' .  $page;?>" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title"><?php echo $name;?></h4>
            </div>
            <div class="modal-body">
            <table class='table table-borderless w-p100 table-regions'>
            <?php
            $regions = $lang->block->$template->regions->$page;
            if(isset($regions['side']))
            {
                $rows = count($regions) - 1;

                $i = 1;
                foreach($regions as $region => $regionName)
                {
                    if($region != 'side')
                    {
                        echo '<tr>';
                        if($custom['sidebar-pull-left'] != 'false' and $i == 1)
                        {
                            echo "<td rowspan='$rows' class='text-middle'>";
                            commonModel::printLink('block', 'setregion', "page={$page}&region=side", $regions['side'], "class='btn-region btn-side' data-toggle='modal'");
                            echo '</td>';
                        }
                        echo "<td class='w-p80'>";
                        commonModel::printLink('block', 'setregion', "page={$page}&region={$region}", $regionName, "class='btn-region' data-toggle='modal'");
                        echo '</td>';
                        if($custom['sidebar-pull-left'] == 'false' and $i == 1)
                        {
                            echo "<td rowspan='$rows' class='text-middle'>";
                            commonModel::printLink('block', 'setregion', "page={$page}&region=side", $regions['side'], "class='btn-region btn-side' data-toggle='modal'");
                            echo '</td>';
                        }
                        echo '</tr>';
                    }
                    $i ++;
                }
            }
            else
            {
                foreach($regions as $region => $regionName)
                {
                    echo '<tr><td>';
                    commonModel::printLink('block', 'setregion', "page={$page}&region={$region}", $regionName, "class='btn-region' data-toggle='modal'");
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach;?>
    </div>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
