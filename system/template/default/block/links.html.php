{*
/**
 * The link front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
*}
{if($app->getModuleName() != 'links' and !empty($lang->links->index))}
<div id="block{!echo $block->id}" class='panel panel-block {!echo $blockClass}'>
  <div class='panel-heading'>
    <strong><i class='icon'>{!echo $icon}</i>{!echo $block->title}</strong>
    <div class='pull-right'>
      {if(trim(strip_tags($lang->links->all, '<a>')))}
      {!echo html::a(helper::createLink('links', 'index'), $lang->more)}
      {/if}
    </div>
  </div>
  <div class='panel-body'>
    <div id='links{!echo $block->id}' data-ve='links'>{!echo $lang->links->index}</div>
  </div>
</div>
{/if}
