<?php
/**
 * The set registration agreement file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/kindeditor.html.php';?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->site->setRegAgreement;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->site->regAgreement;?></th>
          <td><?php echo html::radio('regAgreement', $lang->site->agreementList, isset($this->config->site->regAgreement) ? $this->config->site->regAgreement : 'close');?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->agreementTitle;?></th>
          <td><?php echo html::input('regAgreementTitle', !empty($this->config->site->regAgreementTitle) ? $this->config->site->regAgreementTitle : '', "class='form-control'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->site->agreementContent;?></th>
          <td><?php echo html::textarea('regAgreementContent', !empty($this->config->site->regAgreementContent) ? $this->config->site->regAgreementContent : '', "class='form-control' rows=15");?></td>
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
