<?php
/**
 * The set view file of widget module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     widget
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
?>
<?php
if($type == 'html')
{
    $webRoot   = $config->webRoot;
    $jsRoot    = $webRoot . "js/";
    $themeRoot = $webRoot . "theme/";
    include '../../common/view/kindeditor.html.php';
}
?>
<form method='post' id='widgetForm' class='form form-horizontal' action='<?php echo $this->createLink('widget', 'set', "index=$index&type=$type&widgetID=$widgetID")?>'>
  <table class='table table-form'>
    <tbody>
      <?php include 'publicform.html.php';?>
      <?php if($type == 'rss'):?>
      <tr>
        <th><?php echo $lang->widget->lblRss?></th>
        <td><?php echo html::input('params[link]', $widget ? $widget->params->link : '', "class='form-control'")?></td>
      </tr>
      <tr>
        <th><?php echo $lang->widget->lblNum?></th>
        <td><?php echo html::input('params[num]', $widget ? $widget->params->num : 0, "class='form-control'")?></td>
      </tr>
      <?php elseif($type == 'html'):?>
      <tr>
        <th class='w-100px'><?php echo $lang->widget->lblHtml;?></th>
        <td><?php echo html::textarea('html', $widget ? $widget->params->html : '', "class='form-control' rows='10'")?></td>
      </tr>
      <?php endif;?>
    </tbody>
    <tfoot><tr><td colspan='2' class='text-center'><?php echo html::submitButton()?></td></tr></tfoot>
  </table>
</form>
