{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{if($result)}
<h1 class='f-16px text-center green'>{!echo $lang->score->paySuccess} </h1>
<p class='text-center'>{!echo html::a($control->createLink('user', 'score'), $lang->score->details, "class='btn'")}</p>
{else}
<h1 class='f-16px text-center red'>{!echo $lang->score->payFail}</h1>
{/if}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
