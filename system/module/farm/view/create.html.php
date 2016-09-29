<?php include '../../common/view/header.modal.html.php';?>
<form method='post' class='form-inline' id='ajaxForm' action="<?php echo inlink('create');?>">
    <table class='table table-form'>
      <tr>
        <th class='w-80px'><?php echo $lang->farm->name;?></th>
        <td class='w-p60'><?php echo html::input('name', '', "class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->farm->url;?></th>
        <td><?php echo html::input('url', '', "class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->farm->account;?></th>
        <td><?php echo html::input('account', '', "class='form-control' placeholder='{$lang->farm->placeholder->admin}'");?> </td>
        <td></td>
      </tr>
      <tr>
        <th><?php echo $lang->farm->password;?></th>
        <td> <?php echo html::input('password', '', "class='form-control' placeholder='{$lang->farm->placeholder->password}'");?> </td>
        <td></td>
      </tr>
      <tr><th></th><td><?php echo html::submitButton();?></td><td></td></tr>
    </table>
  </form>
<?php include '../../common/view/footer.modal.html.php';?>
