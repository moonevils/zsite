<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <?php echo $lang->file->sourceList?>
  </div>
  <div id='listView' class='panel-body'>
    <table class='table table-bordered'>
      <thead>
        <tr class='text-center'>
          <th class=' w-60px'><?php echo $lang->file->id;?></th>
          <th><?php echo $lang->file->source;?></th>
          <th><?php echo $lang->file->sourceURI;?></th>
          <th class='w-60px'><?php echo $lang->file->extension;?></th>
          <th class='w-80px'><?php echo $lang->file->size;?></th>
          <th class='w-100px'><?php echo $lang->file->addedBy;?></th>
          <th class='w-160px'><?php echo $lang->file->addedDate;?></th>
          <th class='w-80px'><?php echo $lang->actions;?></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
