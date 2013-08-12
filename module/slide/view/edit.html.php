<?php
/**
 * The edit view file of slide of xirangEPS.
 *
 * @copyright   Copyright 2013-2013 QingDao XiRang Network Infomation Co,LTD (www.xirang.biz)
 * @author      Xiying Guan<guanxiying@xirangit.com>
 * @package     slide
 * @version     $Id$
 * @link        http://www.xirang.biz
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<form id='ajaxForm' method='post' class='form-inline' enctype='multipart/form-data'>
  <table class='table table-bordered'>
    <caption><?php echo $lang->slide->edit;?></caption>
    <tr>
      <th class="w-100px"><?php echo $lang->slide->title;?></th>
      <td><?php echo html::input('title', $slide->title, 'class=text-1');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->slide->url;?></th>
      <td><?php echo html::input('url', $slide->url, 'class=text-1');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->slide->image;?></th>
      <td>
        <?php echo html::image($slide->image, "class='image-small'");?>
        <?php echo html::file('files[]', "tabindex='-1'");?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->slide->label;?></th>
      <td><?php echo html::input('label', $slide->lable, 'class=text-1');?></td>
    </tr>
    <tr>
      <th><?php echo $lang->slide->summary;?></th>
      <td><?php echo html::textarea('summary', $slide->summary, 'class=area-1');?></td>
    </tr>
    <tr>
      <td colspan='2' class='a-center'>
        <?php echo html::hidden('id', $id);?>
        <?php echo html::hidden('image', $slide->image);?>
        <?php echo html::submitButton();?>
      </td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.admin.html.php';?>
