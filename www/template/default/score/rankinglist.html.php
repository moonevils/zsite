<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');?>
<?php $common->printPositionBar('rankingList')?>
<div class='panel'>
  <div class='panel-heading' id='nav-heading'>
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
      <div class='col-md-3'>
        <div class='panel'>
    	  <div class='panel-heading'><?php echo $lang->score->totalRank;?></div>
          <div class='panel-body'>
            <dl>
              <?php $i = 1;?>
              <?php foreach($allScore as $ranking):?>
              <?php if($ranking->account == 'guest') continue;?>
              <dt>
                <span class='strong'>Top<?php echo $i?></span>
                <?php
                $basicInfo = $users[$ranking->account];
                echo $basicInfo->realname;
                ?>
              </dt>
              <dd><?php echo $ranking->score?></dd>
              <?php $i++;?>
              <?php endforeach;?>
            </dl>
          </div>
        </div>
      </div>
      <div class='col-md-3'>
        <div class='panel'>
          <div class='panel-heading'><?php echo $lang->score->monthRank;?></div>
          <div class='panel-body'>
            <dl>
              <?php $i = 1;?>
              <?php foreach($monthScore as $ranking):?>
              <?php if($ranking->account == 'guest') continue;?>
              <dt>
                <span class='strong'>Top<?php echo $i?></span>
                <?php
                $ranking->account = trim($ranking->account);
                $basicInfo = $users[$ranking->account];
                echo $basicInfo->realname;
                ?>
              </dt>
              <dd><?php echo $ranking->sumScore?></dd>
              <?php $i++;?>
              <?php endforeach;?>
            </dl>
          </div>
        </div>
      </div>
      <div class='col-md-3'>
        <div class='panel'>
          <div class='panel-heading'><?php echo $lang->score->weekRank;?></div>
          <div class='panel-body'>
            <dl>
              <?php $i = 1;?>
              <?php foreach($weekScore as $ranking):?>
              <?php if($ranking->account == 'guest') continue;?>
              <dt>
                <span class='strong'>Top<?php echo $i?></span>
                <?php
                $ranking->account = trim($ranking->account);
                $basicInfo = $users[$ranking->account];
                echo $basicInfo->realname;
                ?>
              </dt>
              <dd><?php echo $ranking->sumScore?></dd>
              <?php $i++;?>
              <?php endforeach;?>
            </dl>
          </div>
        </div>
      </div>
      <div class='col-md-3'>
        <div class='panel'>
          <div class='panel-heading'><?php echo $lang->score->dayRank;?></div>
          <div class='panel-body'>
            <dl>
              <?php $i = 1;?>
              <?php foreach($dayScore as $ranking):?>
              <?php if($ranking->account == 'guest') continue;?>
              <dt>
                <span class='strong'>Top<?php echo $i?></span>
                <?php
                $ranking->account = trim($ranking->account);
                $basicInfo = $users[$ranking->account];
                echo $basicInfo->realname;
                ?>
              </dt>
              <dd><?php echo $ranking->sumScore?></dd>
              <?php $i++;?>
              <?php endforeach;?>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
