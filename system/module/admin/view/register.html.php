<?php
/**
 * The view file of bug module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     admin
 * @version     $Id: view.html.php 2568 2012-02-09 06:56:35Z shiyangyangwork@yahoo.cn $
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php if($register):?>
<div class='alert alert-success'>
<?php printf($lang->admin->registerInfo, $register->account, html::a(inlink('unbind'), $lang->admin->rebind, "id='rebindBtn'"));?>
</div>
<?php else:?>
<div class='col-md-6'>
  <div class='panel' id='registerPanel'>
    <div class='panel-heading'>
      <strong><?php echo $lang->admin->register->caption;?></strong>
    </div>
    <div class='panel-body'>
      <form method="post" id='registerForm'>
        <table class='table table-form'>
          <tr>
            <th class='w-100px'><?php echo $lang->user->account;?></th>
            <td>
              <div class="required required-wrapper"></div>
              <?php echo html::input('account', '', "class='form-control' placeholder='{$lang->admin->register->lblAccount}'");?>
            </td>
          </tr>
          <tr>
            <th><?php echo $lang->user->realname;?></th>
            <td>
              <div class="required required-wrapper"></div>
              <?php echo html::input('realname', '', "class='form-control'");?>
            </td>
          </tr>
          <tr>
            <th><?php echo $lang->user->company;?></th>
            <td><?php echo html::input('company', '', "class='form-control'");?></td>
          </tr>
          <tr>
            <th><?php echo $lang->user->phone;?></th>
            <td><?php echo html::input('phone', '', "class='form-control'");?></td>
          </tr>  
          <tr>
            <th><?php echo $lang->user->email;?></th>
            <td><div class="required required-wrapper"></div><?php echo html::input('email', '', "class='form-control'");?></td>
          </tr>  
          <tr>
            <th><?php echo $lang->user->password;?></th>
            <td>
              <div class="required required-wrapper"></div>
              <?php echo html::password('password1', '', "class='form-control' placeholder='{$lang->admin->register->lblPasswd}'");?>
            </td>
          </tr>  
          <tr>
            <th><?php echo $lang->user->password2;?></th>
            <td><?php echo html::password('password2', '', "class='form-control'") . '<span class="star">*</span>';?></td>
          </tr> 
          <tr>
            <th></th>
            <td colspan="2">
              <?php echo html::submitButton($lang->admin->register->submit);?>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<div class='col-md-6'>
  <div class='panel' id='bindPanel'>
    <div class='panel-heading'>
      <strong><?php echo $lang->admin->bind->caption;?></strong>
    </div>
    <div class='panel-body'>
      <form id='bindForm' action="<?php echo inlink('bind');?>" method="post">
        <table class='table table-form w-500px'>
          <tr>
            <th class='w-100px'><?php echo $lang->user->account;?></th>
            <td>
              <?php echo html::input('account', '', "class='form-control'");?>
            </td>
          </tr>
          <tr>
            <th><?php echo $lang->user->password;?></th>
            <td>
              <?php echo html::password('password', '', "class='form-control'");?>
            </td>
          </tr>
          <tr>
            <th></th><td><?php echo html::submitButton($lang->admin->bind->submit);?></td>
          </tr>

        </table>
      </form>
    </div>
  </div>
</div>
<?php endif;?>
<?php include '../../common/view/footer.admin.html.php';?>
