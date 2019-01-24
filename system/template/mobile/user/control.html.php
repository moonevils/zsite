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
<style>
 .tag-block {margin:12px;background:#fff}
 .tag-block > .tag {width:100%;height:40px;line-height:40px;padding:0px 12px;position:relative} 
 .tag-block > .tag > img {float:left}
 .tag-block > .tag > .tag-body {position:absolute;width:100%;height:40px;padding-left:27px;margin-left:-12px;padding-right:12px}
 .tag-block > .tag > .tag-body > .tag-title {padding-left:15px;float:left}
 .tag-block > .tag > .tag-body > .tag-right {float:right}

 .tag-block.user-image {margin:0px;height:90px;padding:15px 0px}
 .tag-block.user-image > .tag {height:60px;line-height:60px}
 .tag-block.user-image > .tag > .tag-body {height:60px;padding-left:72px}
 .tag-block.user-image > .tag > .tag-body > .tag-title {padding:5px 0px 5px 25px}
 .tag-block.user-image > .tag > .tag-body > .tag-title > div {height:25px;line-height:25px;color:#999;font-size:1.5rem;font-weight:400}
 .tag-block.user-image > .tag > .tag-body > .tag-title > div:first-child {color:#333;font-size:1.8rem;font-weight:600}
 .tag-block.user-image > .tag > img {height:60px;width:60px}

 .tag-block.user-score {margin:0px;}
 .tag-block.user-score > .tag > .tag-body {padding-left:0px}

 .tag-block.user-recharge {margin:0px;height:74px;padding:12px 0px}
 .tag-block.user-recharge > .tag {height:50px;line-height:50px}
 .tag-block.user-recharge .btn-recharge {width:87px;height:30px;line-height:30px;border:1px solid #6F9AFE;color:#fff;background:linear-gradient(to right,#709BFE,#1B5AFF);float:right;text-align:center;margin-top:10px;margin-right:15px}

 .tag-score {width:90px;float:left;text-align:center}
 .score-number {height:30px;line-height:30px;font-size:3rem;font-weight:600}
 .score-title {height:20px;line-height:20px;color:#999}

 .user-control-nav {margin-top:1.2rem;}
 .user-control-nav > li {border:none;}
 .user-control-nav > li > a {font-size:1.7rem; border:none; text-align:left;}
 .user-control-nav > li > a > i {margin-right:0.5rem}
 .user-control-nav > li > a > .icon-chevron-right {float:right;color:#ddd;margin-top:2px}
</style>
<div class='tag-block user-image'>
  <div class='tag'>
    {if($app->user->account == 'guest')}
    {!html::image('/theme/mobile/common/img/default-head.png')}
    <div class='tag-body' data-url='{$control->createLink('user', 'login')}'>
      <div class='tag-title'>
        <div>{$lang->user->noLogged}</div>
        <div>{$lang->user->clickLogin}</div>
      </div> 
    {else}
    {!html::image('/theme/mobile/common/img/default-head.png')}
    <div class='tag-body' data-url='{$control->createLink('user', 'profile')}'>
      <div class='tag-title'>
        <div>{$app->user->realname}</div>
        <div>{$app->user->email}</div>
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
    <div class='tag-score' style='margin-right:10px'>
      <div class='score-number'>0</div>
      <div class='score-title'>{$lang->user->totalScore}</div>
    </div> 
    <div class='tag-score'>
      <div class='score-number'>0</div>
      <div class='score-title'>{$lang->user->levelScore}</div>
    </div> 
    <div class='btn-recharge'>{$lang->user->scoreRecharge}</div>
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
    $(document).on('click', '.tag-body', function()
    {
        window.location.href= $(this).attr('data-url');
    });
});
</script>

{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
