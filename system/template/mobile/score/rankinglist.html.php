{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{$common->printPositionBar('rankingList')}
<div class='row'>
  <div class='col-md-3'>
    <div class='panel'>
	  <div class='panel-heading'>{!echo $lang->score->totalRank}</div>
      <div class='panel-body'>
        <dl>
          <dt><strong><span>{!echo $lang->score->rank}</span>{!echo $lang->score->username}</strong></dt>
		  <dd class='strong'>{!echo $lang->score->common}</dd>
          {$i = 1}
          {foreach($allScore as $ranking)}
          {if($ranking->account == 'guest') continue}
          <dt>
            <span class='strong'>Top{!echo $i?></span>
{*php*}
            $basicInfo = $users[$ranking->account];
            echo $basicInfo->realname;
{*/php*}
          </dt>
          <dd>{!echo $ranking->score?></dd>
          {$i++}
          {/foreach}
        </dl>
      </div>
    </div>
  </div>
  <div class='col-md-3'>
    <div class='panel'>
      <div class='panel-heading'>{!echo $lang->score->monthRank}</div>
      <div class='panel-body'>
        <dl>
          <dt><strong><span>{!echo $lang->score->rank}</span>{!echo $lang->score->username}</strong></dt>
          <dd class='strong'>{!echo $lang->score->common}</dd>
          {$i = 1}
          {foreach($monthScore as $ranking)}
          {if($ranking->account == 'guest') continue}
          <dt>
            <span class='strong'>Top{!echo $i?></span>
{*php*}
            $ranking->account = trim($ranking->account);
            $basicInfo = $users[$ranking->account];
            echo $basicInfo->realname;
{*/php*}
          </dt>
          <dd>{!echo $ranking->sumScore?></dd>
          {$i++}
          {/foreach}
        </dl>
      </div>
    </div>
  </div>
  <div class='col-md-3'>
    <div class='panel'>
      <div class='panel-heading'>{!echo $lang->score->weekRank}</div>
      <div class='panel-body'>
        <dl>
          <dt><strong><span>{!echo $lang->score->rank}</span>{!echo $lang->score->username}</strong></dt>
          <dd class='strong'>{!echo $lang->score->common}</dd>
          {$i = 1}
          {foreach($weekScore as $ranking)}
          {if($ranking->account == 'guest') continue}
          <dt>
            <span class='strong'>Top{!echo $i?></span>
{*php*}
            $ranking->account = trim($ranking->account);
            $basicInfo = $users[$ranking->account];
            echo $basicInfo->realname;
{*/php*}
          </dt>
          <dd>{!echo $ranking->sumScore?></dd>
          {$i++}
          {/foreach}
        </dl>
      </div>
    </div>
  </div>
  <div class='col-md-3'>
    <div class='panel'>
      <div class='panel-heading'>{!echo $lang->score->dayRank}</div>
      <div class='panel-body'>
        <dl>
          <dt><strong><span>{!echo $lang->score->rank}</span>{!echo $lang->score->username}</strong></dt>
          <dd class='strong'>{!echo $lang->score->common}</dd>
          {$i = 1}
          {foreach($dayScore as $ranking)}
          {if($ranking->account == 'guest') continue}
          <dt>
            <span class='strong'>Top{!echo $i?></span>
{*php*}
            $ranking->account = trim($ranking->account);
            $basicInfo = $users[$ranking->account];
            echo $basicInfo->realname;
{*/php*}
          </dt>
          <dd>{!echo $ranking->sumScore?></dd>
          {$i++}
          {/foreach}
        </dl>
      </div>
    </div>
  </div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
