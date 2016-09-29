<?php include '../../common/view/header.modal.html.php';?>
<form method='post' class='form-inline' id='ajaxForm' action="<?php echo inlink('edit', "farmID={$farm->id}");?>">
    <table class='table table-form'>
      <tr>
        <th class='w-80px'><?php echo $lang->farm->name;?></th>
        <td class='w-p60'><?php echo html::input('name', $farm->name, "class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->farm->url;?></th>
        <td><?php echo html::input('url', $farm->url, "class='form-control'");?></td>
      </tr>
      <tr>
        <th><?php echo $lang->farm->private;?></th>
        <td><?php echo html::input('private', $farm->private, "class='form-control' placeholder='{$lang->farm->placeholder->admin}'");?> </td>
        <td></td>
      </tr>
      <tr><th></th><td><?php echo html::submitButton();?></td><td></td></tr>
    </table>
  </form>
<?php include '../../common/view/footer.modal.html.php';?>
