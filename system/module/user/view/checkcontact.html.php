<?php include '../../common/view/header.modal.html.php';?>
<table class='table table-form'>
  <tr>
    <th class='w-80px'><?php echo $lang->user->account;?></th>
    <td><?php echo $user->account;?></td>
  </tr> 
  <tr>
    <th class='w-80px'><?php echo $lang->user->realname;?></th>
    <td><?php echo $user->realname;?></td>
  </tr> 
  <tr>
    <th class='w-80px'><?php echo $lang->user->email;?></th>
    <td><?php echo $user->email;?></td>
  </tr> 
  <?php if(!empty($user->phone)):?>
  <tr>
    <th class='w-80px'><?php echo $lang->user->phone;?></th>
    <td><?php echo $user->phone;?></td>
  </tr> 
  <?php endif;?>
  <?php if(!empty($user->qq)):?>
  <tr>
    <th class='w-80px'><?php echo $lang->user->qq;?></th>
    <td><?php echo $user->qq;?></td>
  </tr> 
  <?php endif;?>
  <?php if(!empty($user->company)):?>
  <tr>
    <th class='w-80px'><?php echo $lang->user->company;?></th>
    <td><?php echo $user->company;?></td>
  </tr> 
  <?php endif;?>
</table>
<?php include '../../common/view/footer.modal.html.php';?>
