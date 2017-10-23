<?php
/**
 * The profile view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');?>
<?php js::import($this->config->webRoot . 'js/fingerprint/fingerprint.js');?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side');?>
<table class="table table-layout">
  <tbody>
    <tr>
      <td colspan='2'><strong><i class='icon icon-user'></i> <?php echo $lang->user->profile?></strong></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->realname;?></th>
      <td>
        <?php echo $user->realname;?>
        <?php if(isset($user->provider) and isset($user->openID) and strpos($user->account, "{$user->provider}_") === false):?>
        <span class='bg-info-pale text-info'><?php echo $lang->user->oauth->typeList[$user->provider];?></span>
        <?php endif;?>
      </td>
    </tr>
    <tr>
      <th><?php echo $lang->user->email;?></th>
      <td><?php if(!empty($user->email)) echo str2Entity($user->email);?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->company;?></th>
      <td><?php echo $user->company;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->address;?></th>
      <td><?php echo $user->address;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->zipcode;?></th>
      <td><?php echo $user->zipcode;?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->mobile;?></th>
      <td><?php echo str2Entity($user->mobile);?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->phone;?></th>
      <td><?php echo str2Entity($user->phone);?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->qq;?></th>
      <td><?php echo str2Entity($user->qq);?></td>
    </tr>
    <tr>
      <th><?php echo $lang->user->gtalk;?></th>
      <td><?php echo $user->gtalk;?></td>
    </tr>
    <tr>
      <td colspan='2'>
        <div class='row'>
          <div class='col-6'><?php echo html::a(inlink('edit'), "<i class='icon-pencil'></i> " . $lang->user->editProfile, "class='btn block primary' data-toggle='modal'");?></div>
          <div class='col-6'><?php echo html::a(inlink('setemail'), "<i class='icon-envelope'></i> " . $lang->user->setEmail, "class='btn block primary' data-toggle='modal'");?></div>
          <?php if(isset($user->provider) and isset($user->openID)):?>
          <?php if(strpos($user->account, "{$user->provider}_") === false):?>
          <div class='col-6'><?php echo html::a(inlink('oauthUnbind', "account=$user->account&provider=$user->provider&openID=$user->openID"), "<i class='icon-unlink'></i> " . $lang->user->oauth->lblUnbind, "class='btn block primary ajaxaction jsoner'");?></div>
          <?php else:?>
          <br>
          <div class='col-6'><?php echo html::a(inlink('oauthRegister'), "<i class='icon-link'></i> " . $lang->user->oauth->lblProfile, "class='btn block primary'");?></div>
          <div class='col-6'><?php echo html::a(inlink('oauthBind'), "<i class='icon-link'></i> " . $lang->user->oauth->lblBind, "class='btn block primary'");?></div>
          <?php endif;?>
          <?php endif;?>
        </div>
      </td>
    </tr>
  </tbody>
</table>

<?php include TPL_ROOT . 'common/form.html.php';?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer');?>
