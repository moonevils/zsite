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
<?php include '../../common/view/kindeditor.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->user->setting;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->user->registerAgreement;?></th>
          <td><?php echo html::radio('registerAgreement', $lang->user->registerAgreementList, isset($this->config->site->registerAgreement) ? $this->config->site->registerAgreement : 'close');?></td>
        </tr>
        <tr class='<?php if(isset($this->config->site->registerAgreement) and $this->config->site->registerAgreement == 'close') echo 'hidden';?>'>
          <th><?php echo $lang->user->registerAgreementTitle;?></th>
          <td><?php echo html::input('registerAgreementTitle', !empty($this->config->site->registerAgreementTitle) ? $this->config->site->registerAgreementTitle : '', "class='form-control'");?></td>
        </tr>
        <tr class='<?php if(isset($this->config->site->registerAgreement) and $this->config->site->registerAgreement == 'close') echo 'hidden';?>'>
          <th><?php echo $lang->user->registerAgreementContent;?></th>
          <td><?php echo html::textarea('registerAgreementContent', !empty($this->config->site->registerAgreementContent) ? $this->config->site->registerAgreementContent : '', "class='form-control' rows=15");?></td>
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

