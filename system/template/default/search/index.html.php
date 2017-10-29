<?php 
if(isset($config->site->type) and $config->site->type == 'blog')
{
    include TPL_ROOT . 'blog/header.html.php';
}
else
{
    include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');
}
?>
<?php echo $common->printPositionBar('search', null, $words);?>
<div class='row'>
  <div class='col-md-12'>
    <div class='list list-condensed'>
      <header>
        <h2><?php echo $lang->search->index;?></h2>
      </header>
      <section class='items items-hover'>
        <?php foreach($results as $object):?>
        <div class='item'>
          <div class='item-heading'>
            <div class="text-muted pull-right">
              <span title="<?php echo $lang->object->addedDate;?>"><i class='icon-time'></i> <?php echo substr($object->editedDate, 0, 10);?></span>
            </div>
            <h4><?php echo html::a($object->url, $object->title);?></h4>
          </div>
          <div class='item-content'>
            <?php if(!empty($object->image->primary)):?>
            <div class='media pull-right'>
              <?php
              $title = $object->image->primary->title ? $object->image->primary->title : strip_tags($object->title);
              echo html::a($object->url, html::image("{$config->webRoot}file.php?f={$object->image->primary->pathname}&o={$object->objectType}&s=smallURL&t={$object->image->primary->extension}&v={$this->config->site->lastUpload}", "title='{$title}' class='thumbnail'" ));
              ?>
            </div>
            <?php endif;?>
            <div class='text text-muted'><?php echo $object->summary;?></div>
          </div>
        </div>
        <?php endforeach;?>
      </section>
      <footer class='clearfix'>
        <?php echo str_replace($words, urlencode($words), $pager->get('right', 'short'));?>
        <span class='execute-info text-muted'><?php printf($lang->search->executeInfo, $pager->recTotal, $consumed);?></span> 
      </footer>
    </div>
  </div>
</div>
<?php 
if(isset($config->site->type) and $config->site->type == 'blog')
{
    include TPL_ROOT . 'blog/footer.html.php';
}
else
{
    include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');
}
?>
