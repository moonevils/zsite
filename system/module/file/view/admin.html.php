<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading' style='height:39px;'>
    <ul id='typeNav' class='nav nav-tabs'>
      <li class='<?php echo $type == 'valid' ? 'active' : '';?>' data-type='internal' ><?php echo html::a(inlink('admin', "type=valid"), $lang->file->fileList);?></li>
      <li class='<?php echo $type == 'invalid' ? 'active' : '';?>' data-type='internal' ><?php echo html::a(inlink('admin', "type=invalid"), $lang->file->invalidFile);?></li>
    </ul>
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
          <td class='text-center'>
            <?php 
              if($file->isImage and $file->existStatus == 'yes')
              {
                echo html::a(helper::createLink('file', 'download', "fileID=$file->id"), html::image($file->fullURL, "class='image-small'"), "target='_blank' data-toggle='lightbox'");
              }
              else
              {
                echo html::a(inlink('download', "id=$file->id"), $file->title, "target='_blank'");
              }
            ?>
          </td>
          <td class='text-left 
            <?php 
              if(isset($file->existStatus)) 
              {
                echo $file->existStatus == 'no' ? 'red' : ''; 
              }
            ?>'>
            <?php echo $file->pathname;?>
          </td>
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
    <tfoot><tr><td colspan='3' class='text-left'><?php echo $lang->file->fileTip;?></td><td colspan='5'><?php $pager->show('right', 'lite');?></td></tr></tfoot>
    <?php else:?>
    <thead>
      <tr class='text-center'>
        <th><?php echo $lang->file->common;?></th>
        <th class='w-100px'><?php echo $lang->file->extension;?></th>
        <th class='w-100px'><?php echo $lang->file->size;?></th>
        <th class='w-160px'><?php echo $lang->file->addedDate;?></th>
        <th class='w-100px'><?php echo $lang->actions;?></th>
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
    <tfoot><tr><td colspan='5'><?php $pager->show('right', 'lite');?></td></tr></tfoot>
    <?php endif;?>
  </table>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
