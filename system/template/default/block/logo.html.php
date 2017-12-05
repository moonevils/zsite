{$logoSetting = isset($config->site->logo) ? json_decode($lang->site->logo) : new stdclass()}
{$logo = false}
{if(isset($logoSetting->$template->themes->all))}    {$logo = $logoSetting->$template->themes->all} {/if}
{if(isset($logoSetting->$template->themes->$theme))} {$logo = $logoSetting->$template->themes->$theme} {/if}
{if($logo) $logo->extension = $model->loadModel('file')->getExtension($logo->pathname)}
<div class='site-logo' data-ve='block' data-id='{!echo $block->id}'>
  {!echo html::a(helper::createLink('index'), html::image($model->loadModel('file')->printFileURL($logo->pathname, $logo->extension), "class='logo' alt='{{$lang->company->name}}' title='{{$lang->company->name}}'"))}</div>
</div>
{else}
<div class='site-name' data-ve='block' data-id='{!echo $block->id}'><h2 data-ve='logo'>{!echo html::a($config->webRoot, $lang->site->name)}</h2></div>
{/if}
