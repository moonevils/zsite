<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading' style='height:39px;'>
    <ul id='typeNav' class='nav nav-tabs pull-left'>
      <li data-type='internal' <?php echo $type == 'valid' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "type=valid"), $lang->file->fileList);?>
      </li>
      <li data-type='internal' <?php echo $type == 'invalid' ? "class='active'" : '';?>>
        <?php echo html::a(inlink('admin', "type=invalid"), $lang->file->invalidFile);?>
      </li>
    </ul> 
    <div class='panel-actions' style='height:32px;'>
      <?php if($type == 'invalid') commonModel::printLink('file', 'deleteAllInvalid', '', $lang->file->clearAllInvalid, "class='btn btn-primary deleter'");?>
    </div>
  </div>
  <table class='table table-hover table-striped tablesorter table-fixed' id='orderList'>
    <?php if($type == 'valid'):?>
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
      <?php foreach($files as $file):?>
        <tr class='text-center text-middle'>
          <td><?php echo $file->id;?></td>
          <td><?php echo html::a(inlink('download', "id=$file->id"), $file->title, "target='_blank'");?></td>
          <td class='text-left'><?php echo $file->pathname;?></td>
          <td><?php echo $file->extension;?></td>
          <td><?php echo number_format($file->size / 1024 , 1) . 'K';?></td>
          <td><?php echo isset($file->addedBy) ? $file->addedBy : '';?></td>
          <td><?php echo $file->addedDate;?></td>
          <td class='text-center'>
            <?php
            commonModel::printLink('file', 'edit',   "fileID=$file->id", $lang->edit, "data-toggle='modal'");
            commonModel::printLink('file', 'delete', "fileID=$file->id", $lang->delete, "class='deleter'");
            ?>
          </td>
        </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot><tr><td colspan='8'><?php $pager->show();?></td></tr></tfoot>
    <?php else:?>
    <thead>
      <tr class='text-center'>
        <th><?php echo $lang->file->common;?></th>
        <th class='w-60px'><?php echo $lang->file->extension;?></th>
        <th class='w-80px'><?php echo $lang->file->size;?></th>
        <th class='w-160px'><?php echo $lang->file->addedDate;?></th>
        <th class='w-80px'><?php echo $lang->actions;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($files as $file):?>
        <tr class='text-center text-middle'>
          <td class='text-left'><?php echo $file->pathname;?></td>
          <td><?php echo $file->extension;?></td>
          <td><?php echo number_format($file->size / 1024 , 1) . 'K';?></td>
          <td><?php echo $file->addedDate;?></td>
          <td class='text-center'>
            <?php 
              $pathname = urlencode($file->pathname);
              commonModel::printLink('file', 'deleteInvalidFile', "pathname=" . $pathname, $lang->delete, "class='deleter'");
            ?>
          </td>
        </tr>
      <?php endforeach;?>
    </tbody>
    <?php endif;?>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
