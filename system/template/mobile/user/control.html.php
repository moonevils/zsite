{*php
/**
 * The control view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
<div class='tag-block user-image'>
  <div class='tag'>
    {if($app->user->account == 'guest')}
    {!html::image('/theme/mobile/common/img/default-head.png')}
    <div class='tag-body' data-url='{$control->createLink('user', 'login')}'>
      <div class='tag-title'>
        <div>{$lang->user->unlogin}</div>
        <div>{$lang->user->clickLogin}</div>
      </div> 
    {else}
    {!html::image('/theme/mobile/common/img/default-head.png')}
    <div class='tag-body' data-url='{$control->createLink('user', 'profile')}'>
      <div class='tag-title'>
        <div>{$user->realname}</div>
        <div>{$user->email}</div>
      </div>
    {/if}
      <div class='tag-right'>
      {!html::image('/theme/mobile/common/img/right.png')}
      </div>
    </div>
  </div>
</div>
{if(commonModel::isAvailable('score'))}
<div class='tag-block user-score'>
  <div class='tag'>
    <div class='tag-body' data-url='{$control->createLink('user', 'score')}'>
      <div class='tag-title'>
        <div>
          {$lang->user->myScore}
        </div>
      </div>
      <div class='tag-right'>
        {!html::image('/theme/mobile/common/img/right.png')}
      </div>
    </div>
  </div>
</div>
<div class='tag-block user-recharge'>
  <div class='tag'>
    <div class='tag-score keepleft'>
      <div class='score-number'>{$user->score}</div>
      <div class='score-title'>{$lang->user->totalScore}</div>
    </div> 
    <div class='tag-score'>
      <div class='score-number'>{$user->rank}</div>
      <div class='score-title'>{$lang->user->levelScore}</div>
    </div> 
    <div class='btn-recharge' data-url='{$control->createLink('score', 'buyscore')}'>{$lang->user->scoreRecharge}</div>
  </div>
</div>
{/if}
{$control->loadModel('user')->fixMenus()}
{foreach($control->config->user->navGroups->mobile as $group => $items)}
<ul class='nav nav-primary user-control-nav nav-stacked'>
  {$navs = explode(',', $items)}
  {foreach($navs as $nav)}
    {$class = ''}
    {$menu = zget($lang->user->control->menus, $nav, '')}
    {if(empty($menu))} {continue} {/if}
    {@list($label, $module, $method) = explode('|', $menu)}
    {$module = strtolower($module)}
    {$method = strtolower($method)}
    {$menuInfo = explode('|', $menu)}
    {$params   = zget($menuInfo, 3 ,'')}
    {if(!commonModel::isAvailable($module))} {continue} {/if}
    {if($module == $control->app->getModuleName() && $method == $control->app->getMethodName())} {$class .= 'active'} {/if}
    <li class="{$class}">{!html::a($control->createLink($module, $method, $params), $label, "class='btn default'")}</li>
  {/foreach}
</ul>
{/foreach}
<script>
$(function()
{
    $(document).on('click', '.tag-body, .btn-recharge', function()
    {
        window.location.href= $(this).attr('data-url');
    });
});
</script>

{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
