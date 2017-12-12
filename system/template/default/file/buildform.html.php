{if(!$writeable)}
<h5 class='text-danger a-left'> {!echo $control->lang->file->errorUnwritable} </h5>
{else}
<div class="file-form" id='fileform'>
  <?php 
  /* Define the html code of a file row. */
  $fileRow = <<<EOT
  <table class='fileBox' id='fileBox\$i'>
    <tr>
      <td class='w-p45'><div class='form-control file-wrapper'><input type='file' name='files[]' class='fileControl'  tabindex='-1' /></div></td>
      <td class=''><input type='text' name='labels[]' class='form-control' placeholder='{$lang->file->label}' tabindex='-1' /></td>
      <td class='w-30px'><a href='javascript:void()' onclick='addFile(this)' class='btn btn-block'><i class='icon-plus'></i></a></td>
      <td class='w-30px'><a href='javascript:void()' onclick='delFile(this)' class='btn btn-block'><i class='icon-remove'></i></a></td>
    </tr>
  </table>
EOT;
  for($i = 1; $i <= $fileCount; $i ++) echo str_replace('$i', $i, $fileRow);
  $fileLimit = trim(ini_get('upload_max_filesize'), 'M') > trim(ini_get('post_max_size'), 'M') ? trim(ini_get('post_max_size'), 'M') : trim(ini_get('upload_max_filesize'), 'M');
  if(!is_numeric($fileLimit)) $fileLimit = $control->config->file->maxSize / 1024 / 1024;  
  printf($lang->file->sizeLimit, $fileLimit);
  ?>
</div>
{/if}

<script language='javascript'>
/**
 * Add a file input control.
 * 
 * @param  object $clickedButton 
 * @access public
 * @return void
 */
function addFile(clickedButton)
{
    fileRow = {!echo json_encode($fileRow)};
    fileRow = fileRow.replace('$i', $('.fileID').size() + 1);
    $(clickedButton).closest('.fileBox').after(fileRow);

    updateID();
}

/**
 * Delete a file input control.
 * 
 * @param  object $clickedButton 
 * @access public
 * @return void
 */
function delFile(clickedButton)
{
    if($('.fileBox').size() == 1) return;
    $(clickedButton).closest('.fileBox').remove();
    updateID();
}

/**
 * Update the file id labels.
 * 
 * @access public
 * @return void
 */
function updateID()
{
    i = 1;
    $('.fileID').each(function(){$(this).html(i ++)});
}
</script>
