<?php
/**
 * The slide form view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php $publicList = $this->loadModel('wechat')->getList();?>
<?php if(!empty($publicList)):?>
<tr>
  <th><?php echo $lang->block->image;?></th>
  <td>
    <div class='input-group' style='width:290px;'>
      <?php echo html::select('params[imageType]', $lang->block->imageTypeList, isset($block->content->imageType) ? $block->content->imageType : 'wechat', "class='form-control'");?>
    </div>
  </td>
</tr>
<tr class=''>
  <th><?php echo $lang->block->uploadImage;?></th>
  <td>
    <input type='file' name='params[customImage]' id='file' class='form-control'>
  </td>
</tr>
<?php else:?>
<tr>
  <th><?php echo $lang->block->image;?></th>
  <td>
  </td>
</tr>
<?php endif;?>
