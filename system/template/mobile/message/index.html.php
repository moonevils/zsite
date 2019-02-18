{*php
/**
 * The index view file of message for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     message
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{* TODO: check follow methods: showDetail and hideDetail *}
<div class='block-region region-top blocks' data-region='message_index-top'>{$control->loadModel('block')->printRegion($layouts, 'message_index', 'top')}</div>
{if(commonModel::isAvailable('message'))}
<div class='commentBox' id='commentBox'>
  {$control->fetch('message', 'comment', "objectType=message&objectID=0")}
</div>
{/if}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
