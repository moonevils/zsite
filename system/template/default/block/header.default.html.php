{*
/**
 * The header view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
*}
<header id='header' class='compatible clearfix {if($isSearchAvaliable)} with-searchbar {/if}'>
  <div id='headNav'>
    <div class='wrapper'>
      {include $model->loadModel('ui')->getEffectViewFile('default', 'block', 'sitenav')}
    </div>
  </div>
  <div id='headTitle'>
    <div class="wrapper">
      {if($logo)}
        <div id='siteLogo' data-ve='logo'>
          {!echo html::a(helper::createLink('index'), html::image($model->loadModel('file')->printFileURL($logo->pathname, $logo->extension)), "class='logo' alt='{{$lang->company->name}}' title='{{$lang->company->name}}'")}
        </div>
      {else}
        <div id='siteName' data-ve='logo'><h2>{!echo html::a(helper::createLink('index'), $config->site->name)}</h2></div>
      {/if}
      <div id='siteSlogan' data-ve='slogan'><span>{!echo $config->site->slogan}</span></div>
    </div>
  </div>
  {include $model->loadModel('ui')->getEffectViewFile('default', 'block', 'searchbar')}
</header>
{include $model->loadModel('ui')->getEffectViewFile('default', 'block', 'nav')}
