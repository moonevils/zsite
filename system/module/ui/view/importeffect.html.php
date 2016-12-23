<?php
/**
 * The importeffect view file of ui module of ChanZhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php include '../../common/view/chosen.html.php';?>
<form method='post' action= '<?php echo inlink('importeffect', "id={$id}");?>' id='ajaxForm'>
  <table class='table table-form'>
    <tr>
      <th class='w-60px'><?php echo $lang->effect->blockName;?></th>
      <td><?php echo html::input('block', $effect->name, "class='form-control'");?></td>
    </tr>
    <tr>
      <th></th>
      <td><?php echo html::submitButton()?></td>
    </tr>
  </table>
</form>
<?php include '../../common/view/footer.modal.html.php';?>
