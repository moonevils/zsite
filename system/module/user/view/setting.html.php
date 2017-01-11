<?php
/**
 * The setting view file of user module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->user->setting;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-150px'><?php echo $lang->user->filterUsernameSensitive;?></th>
          <td><?php echo html::radio('filterUsernameSensitive', $lang->user->filterUsernameSensitiveList, isset($this->config->user->filterUsernameSensitive) ? $this->config->user->filterUsernameSensitive : 'close');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->user->usernameSensitive;?></th>
          <td><?php echo html::textarea('usernameSensitive', !empty($this->config->user->usernameSensitive) ? $this->config->user->usernameSensitive : '', "class='form-control' rows=4");?></td>
        </tr>
        <tr>
          <th></th>
          <td><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>

