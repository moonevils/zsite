{*php
/**
 * The profile view file of user for mobile template of chanzhiEPS.
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
{!js::import($control->config->webRoot . 'js/fingerprint/fingerprint.js')}
<style>
  .user-control-nav {margin-bottom:1.2rem;}
 .user-control-nav > li {border:none;}
 .user-control-nav > li > a {font-size:1.7rem; border:none; text-align:left;}
 .user-control-nav > li > a.avatar {height:80px;line-height:60px}
 .user-control-nav > li > a > span {float:right;margin-right:16px}
 .user-control-nav > li > a > img {float:right;margin-right:16px;width:60px;height:60px}
 .user-control-nav > li > a > i {margin-right:0.5rem}
 .user-control-nav > li > a > .icon-chevron-right {float:right;color:#ddd;margin-top:2px}
</style>
{foreach($control->config->user->infoGroups->mobile as $group => $items)}
<ul class='nav nav-primary user-control-nav nav-stacked'>
  {$navs = explode(',', $items)}
  {foreach($navs as $nav)}
  {if($nav == 'avatar')}
    {$html = html::image('/theme/mobile/common/img/default-head.png')}
    {$class = 'btn avatar default'} 
  {else}
    {$html = '<span>' . $user->$nav . '</span>'}
    {$class = 'btn default'} 
  {/if}
  <li>{!html::a($control->createLink('user', 'editInfo', 'field=' . $nav), $lang->user->$nav . '<i class="icon-chevron-right"></i>' . $html, "class='" . $class . "'")}</li>
  {/foreach}
</ul>
{/foreach}
{include TPL_ROOT . 'common/form.html.php'}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
