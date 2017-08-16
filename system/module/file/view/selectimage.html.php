<?php include '../../common/view/header.modal.html.php';?>
<?php js::set('id', $id);?>
<ul class='files-list clearfix'>
  <?php foreach($files as $file):?>
  <?php $fullURL = "{$config->webRoot}file.php?pathname={$file->pathname}&objectType={$file->objectType}&imageSize=extension={$file->extension}";?>
  <?php echo "<li class='file-image file-{$file->extension}'>" . html::a('javascript:void(0);', html::image($fullURL), "onclick=\"selectFile(this, $callback)\" data-url={$fullURL}") . "</li>";?>
  <?php endforeach;?>          
</ul>
<?php include '../../common/view/footer.modal.html.php';?>
