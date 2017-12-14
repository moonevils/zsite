{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<div class='row'>
  {include $control->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side')}
  <div class='col-md-10'>
    <div class='panel-section'>
      <div class='panel-heading'>{!echo html::a($control->createLink('score', 'buyScore'), $lang->user->buyScore, "class='btn primary block' data-toggle='modal'")?></div>
      <div class='panel-heading'>
        <strong class='red'>{!printf($lang->score->lblTotal, $user->score, $user->rank)}</strong>
      </div>
      <div class='panel-body'>
      <table class='table table-hover table-striped'>
        <thead>
          <tr>
            <th class='w-100px'>{!echo $lang->score->time}</th>
            <th class='w-150px'>{!echo $lang->score->method}</th>
            <th class='w-150px'>{!echo $lang->score->count}</th>
            <th class='w-150px'>{!echo $lang->score->before}</th>
            <th class='w-150px'>{!echo $lang->score->after}</th>
            <th>{!echo $lang->score->note}</th>
          </tr>
        </thead>
        <tbody>
          {foreach($scores as $score)}
          <tr>
            {$score->time = substr($score->time,0,10)}
            <td>{!echo $score->time}</td>
            <td>{!echo $lang->score->methods[$score->method]}</td>
            <td>{!echo ($score->type == 'in' ? '+' : '-') . $score->count}</td>
            <td>{!echo $score->before}</td>
            <td>{!echo $score->after}</td>
            <td>{!echo $score->note}</td>
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
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
