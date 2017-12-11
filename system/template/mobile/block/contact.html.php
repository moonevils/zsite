{*php*}
/**
 * The contact front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
$block->content = json_decode($block->content);
{*/php*}
{$contact = $control->loadModel('company')->getContact()}
<div id="block{!echo $block->id}" class='panel-block-contact panel panel-block {!echo $blockClass}'>
  <div class='panel-heading'>
    <strong>{!echo $icon . $block->title}</strong>
    {if(!empty($block->content->moreText) and !empty($block->content->moreUrl))}
    <div class='pull-right'>{!echo html::a($block->content->moreUrl, $block->content->moreText, "data-toggle='modal'")}</div>
    {/if}
  </div>
  <div class='panel-body no-padding'>
    <table class='table table-data'>
      {foreach($contact as $item => $value)}
      <tr>
        <th>{!echo $control->lang->company->$item}</th>
        <td>{!echo $value}</td>
      </tr>
      {/foreach}
    </table>
  </div>
</div>
