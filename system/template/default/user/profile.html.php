<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');?>
<?php js::set('confirmUnbind', $lang->user->confirmUnbind);?>
<div class='page-user-control'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel borderless'>
        <div class='panel-heading borderless'><strong><i class='icon-user'></i> <?php echo $lang->user->profile;?></strong></div>
          <table class='table table-bordered' id="profileTable">
          <tr>
            <th class='w-100px text-right'><?php echo $lang->user->realname;?></th>
            <td>
              <?php echo $user->realname;?>
              <?php if(isset($user->provider) and isset($user->openID) and strpos($user->account, "{$user->provider}_") === false):?>
              <span class='label label-info'><?php echo $lang->user->oauth->typeList[$user->provider];?></span>
              <?php endif;?>
            </td>
          </tr>
          <tr>
            <th class='text-right'><?php echo $lang->user->email;?></th>
            <td id='emailTD'><?php echo $user->email;?></td>
          </tr>
          <tr>
            <th class='text-right'><?php echo $lang->user->company;?></th>
            <td><?php echo $user->company;?></td>
          </tr>
          <tr>
            <th class='text-right'><?php echo $lang->user->address;?></th>
            <td><?php echo $user->address;?></td>
          </tr>
          <tr>
            <th class='text-right'><?php echo $lang->user->zipcode;?></th>
            <td><?php echo $user->zipcode;?></td>
          </tr>
          <tr>
            <th class='text-right'><?php echo $lang->user->mobile;?></th>
            <td id='mobileTD'><?php echo $user->mobile;?></td>
          </tr>
          <tr>
            <th class='text-right'><?php echo $lang->user->phone;?></th>
            <td><?php echo $user->phone;?></td>
          </tr>
          <tr>
            <th class='text-right'><?php echo $lang->user->qq;?></th>
            <td><?php echo $user->qq;?></td>
          </tr>
          <tr>
            <th class='text-right'><?php echo $lang->user->gtalk;?></th>
            <td><?php echo $user->gtalk;?></td>
          </tr>
          <tr>
            <td class='borderless text-center' id='btnBox' colspan='2'>
              <?php echo html::a(inlink('edit'), $lang->user->editProfile, "class='btn'");?>
              <?php echo html::a(inlink('setemail'), $lang->user->setEmail, "class='btn'");?>
              <?php if(isset($user->provider) and isset($user->openID)):?>
              <?php if(strpos($user->account, "{$user->provider}_") === false):?>
              <?php echo html::a(inlink('oauthUnbind', "account=$user->account&provider=$user->provider&openID=$user->openID"), $lang->user->oauth->lblUnbind, "class='btn unbind'");?>
              <?php else:?>
              <?php echo html::a(inlink('oauthRegister'), $lang->user->oauth->lblProfile, "class='btn'");?>
              <?php echo html::a(inlink('oauthBind'), $lang->user->oauth->lblBind, "class='btn'");?>
              <?php endif;?>
              <?php endif;?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
