<?php
/**
 * The html block form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php include '../../common/view/kindeditor.html.php';?>

<?php if(!isset($block)) $block = new stdclass();?>
<?php if(!isset($block->content)) $block->content = new stdclass();?>
<tr>
  <th rowspan='2'><?php echo $lang->block->header->top->common;?></th>
  <td class='w-p45'>
    <div class='input-group'>
      <span class='input-group-addon'><?php echo $lang->block->header->top->left;?></span>
      <?php echo html::select('params[top][left]', $lang->block->header->top->leftOptions, isset($block->content->top->left) ? $block->content->top->left : '', "class='form-control'");?>
    </div>
  </td>
</tr>
<tr class='topLeft hide'>
  <td><?php echo html::textarea("params[topLeftContent]", isset($block->content->topLeftContent) ? $block->content->topLeftContent : '', "class='form-control'");?></td>
</tr>
<tr>
  <td>
    <div class='input-group'>
      <span class='input-group-addon'><?php echo $lang->block->header->top->right;?></span>
      <?php echo html::select('params[top][right]', $lang->block->header->top->rightOptions, isset($block->content->top->right) ? $block->content->top->right : '', "class='form-control'");?>
    </div>
  </td>
  <td></td>
</tr>
<tr>
  <th><?php echo $lang->block->header->middle->common;?></th>
  <td colsapn='2'>
    <div class='input-group'>
      <span class='input-group-addon'><?php echo $lang->block->header->middle->left;?></span>
      <?php echo html::select('params[middle][left]', $lang->block->header->middle->leftOptions, isset($block->content->middle->left) ? $block->content->middle->left : 'logo', "class='form-control'");?>
      <span class='input-group-addon'><?php echo $lang->block->header->middle->center;?></span>
      <?php echo html::select('params[middle][center]', $lang->block->header->middle->centerOptions, isset($block->content->middle->center) ? $block->content->middle->center : 'logo', "class='form-control'");?>
      <span class='input-group-addon'><?php echo $lang->block->header->middle->right;?></span>
      <?php echo html::select('params[middle][right]', $lang->block->header->middle->rightOptions, isset($block->content->middle->right) ? $block->content->middle->right : 'logo', "class='form-control'");?>
    </div>
  </td>
</tr>
<tr>
  <th><?php echo $lang->block->header->bottom->common;?></th>
  <td><?php echo html::select('params[bottom]', $lang->block->header->bottomOptions, isset($block->content->bottom) ? $block->content->bottom : 'nav', "class='form-control'");?></td>
  <td></td>
</tr>
<tr>
  <th></th>
  <td colspan='2'>
    <div class='checkbox'><label><input style='margin-top: 3px' type='checkbox' id='compatible'  name='params[compatible]' value='1'<?php if(zget($block->content, 'compatible', 0)) echo " checked='checked'" ?>> <?php echo $lang->block->headerLayout->compatibleEnable ?></label></div>
  </td>
</tr>
<script>
$(function()
{
    $("[name*=params][name*=top][name*=left]").change(function()
    {
        if($(this).val() == 'custom')
        {
            $('tr.topLeft').show();
            $(this).parents('tr').find('th').attr('rowspan', '3');
        }
        else
        {
            $('tr.topLeft').hide();
            $(this).parents('tr').find('th').attr('rowspan', '2');
        }
    })

    $("[name*=params][name*=top][name*=left]").change();
})
</script>
