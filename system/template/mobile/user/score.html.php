{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
<style>
.panel-section {margin-left:0px;margin-right:0px;background-color:#f1f1f1}
.panel-heading {margin-left:5px}
.panel-heading.spacing{margin-bottom:12px}
.panel-body {background-color:#fff}
.table>thead>tr>th {border-bottom:0px}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding:5px;border-top:0px}
.tag-block {margin:12px;background:#fff}
.tag-block > .tag {width:100%;height:40px;line-height:40px;padding:0px 12px} 
.tag-block > .tag > img {float:left}
.tag-block > .tag > .tag-body {width:100%;height:40px;padding-left:12px;display:block}
.tag-block > .tag > .tag-body > .tag-title {float:left}
.tag-block > .tag > .tag-body > .tag-right {float:right}
.tag-block.user-score {margin:0px}
.tag-block.user-score > .tag > .tag-body {padding-left:0px}
.tag-block.user-score > .tag > .tag-body > .tag-title > div {color:#333;font-size:1.7rem}
.tag-block.user-recharge {margin:0px;height:74px;padding:12px 0px}
.tag-block.user-recharge > .tag {height:50px;line-height:50px}
.tag-block.user-recharge .btn-recharge {width:87px;height:30px;line-height:30px;border:1px solid #6F9AFE;color:#fff;background:linear-gradient(to right,#709BFE,#1B5AFF);float:right;text-align:center;margin-top:10px;margin-right:15px}
.tag-score {width:90px;float:left;text-align:center}
.tag-score.keepleft {margin-right:10px}
.score-number {height:30px;line-height:30px;font-size:3rem;font-weight:600}
.score-title {height:20px;line-height:20px;color:#999}
</style>
<div class='row'>
  <div class='col-md-10'>
    <div class='panel-section'>
      <div class='panel-heading'>
        <div class='title strong'>{$lang->user->details}</div>
      </div>
      <div class='panel-heading spacing'>
        <div class='tag-block user-recharge'>
          <div class='tag'>
            <div class='tag-score keepleft'>
              {if($app->user->account == 'guest')}
              <div class='score-number'>0</div>
              {else}
              <div class='score-number'>{$user->score}</div>
              {/if}
              <div class='score-title'>{$lang->user->totalScore}</div>
            </div>
            <div class='tag-score'>
              {if($app->user->account == 'guest')}
              <div class='score-number'>0</div>
              {else}
              <div class='score-number'>{$user->rank}</div>
              {/if}
              <div class='score-title'>{$lang->user->levelScore}</div>
            </div>
            {if(commonModel::hasOnlinePayment())}
            {!html::a($control->createLink('score', 'buyScore'), $lang->user->buyScore, "class='btn-recharge' data-toggle='modal'")}
            {/if}
          </div>
        </div>
      </div>
      <div class='panel-body'>
      <table class='table table-hover'>
        <thead>
          <tr>
            <th class='w-100px'>{$lang->score->time}</th>
            <th class='w-150px'>{$lang->score->method}</th>
            <th class='w-150px'>{$lang->score->count}</th>
            <th class='w-150px'>{$lang->score->score}</th>
            <th>{$lang->score->note}</th>
          </tr>
        </thead>
        <tbody>
          {foreach($scores as $score)}
            <tr>
              {$score->time = substr($score->time,0,10)}
              <td>{$score->time}</td>
              <td>{!echo $score->type == 'punish' ? $lang->score->methods[$score->type] : $lang->score->methods[$score->method]}</td>
              <td>{!echo ($score->type == 'in' ? '+' : '-') . $score->count}</td>
              <td>{$score->after}</td>
              <td>{$score->note}</td>
            </tr>  
          {/foreach}
        </tbody>
        <tfoot>
          <tr><td colspan='8' class='a-right'>{$pager->show('justify')}</td></tr>
        </tfoot>
      </table>
      </div>
    </div>
  </div>
</div>
{include TPL_ROOT . 'common/form.html.php'}
