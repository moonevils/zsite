<?php
/**
 * The edit view file of block module of xirangEPS.
 *
 * @copyright   Copyright 2013-2013 QingDao XiRang Network Infomation Co,LTD (www.xirang.biz)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.xirang.biz
 */
?>
<?php 
$type = empty($_GET['type']) ? $block->type : $this->get->type;
if(empty($type) or $type == 'html') unset($config->block->editor);
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<script type='text/javascript'>
<?php
$indexof = strrpos($_SERVER['REQUEST_URI'], '&type');
$url = $indexof === false ? $this->server->request_uri : substr($this->server->request_uri, 0, $indexof);
?>
var url = "<?php echo $url?>";
</script>
<form method='post' target='hiddenwin'>
  <table align='center' class='table-1'>
    <caption><?php echo $lang->block->edit;?></caption>
    <tr>
      <th class='w-id'><?php echo $lang->block->type;?></th>
      <td><?php echo html::select('type', $lang->block->typeList, $type, 'class=select-3');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->block->title;?></th>
      <td><?php echo html::input('title', $block->title, 'class=text-1');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->block->content;?></th>
      <td><?php echo html::textarea('content', $block->content, 'rows=20 class=area-1');?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'><?php echo html::submitButton();?></td>
    </tr>
  </table>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
