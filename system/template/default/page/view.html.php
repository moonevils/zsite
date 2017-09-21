<?php 
if($page->onlyBody):
include TPL_ROOT . 'common/header.lite.html.php';
js::set('pageID', $page->id);
css::internal($page->css);
js::execute($page->js);
echo $page->content;
else:
include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');
js::set('pageID', $page->id);
css::internal($page->css);
js::execute($page->js);
js::set('pageLayout', $this->block->getLayoutScope('page_view', $page->id));
?>
<?php $common->printPositionBar($page);?>
<div class='row blocks' data-region='page_view-topBanner'><?php $this->block->printRegion($layouts, 'page_view', 'topBanner', true);?></div>
<div class='row' id='columns' data-page='page_view'>
  <?php if(!empty($layouts['page_view']['side']) and !empty($sideFloat) && $sideFloat != 'hidden'):?>
  <div class="col-md-<?php echo 12 - $sideGrid; ?> col-main<?php if($sideFloat === 'left') echo ' pull-right' ?>">
  <?php else:?>
  <div class="col-md-12">
  <?php endif;?>
    <div class='row blocks' data-region='page_view-top'><?php $this->block->printRegion($layouts, 'page_view', 'top', true);?></div>
    <div class='article' id='page<?php echo $page->id;?>' data-ve='page'>
      <header>
        <h1><?php echo $page->title;?></h1>
      </header>
      <section class='article-content'>
        <?php echo $page->content;?>
      </section>
      <?php if(!empty($page->files)):?>
      <section><?php $this->loadModel('file')->printFiles($page->files);?></section>
      <?php endif;?>
      <?php if($page->keywords):?>
      <footer>
        <p class='small'><strong class="text-muted"><?php echo $lang->article->keywords;?></strong><span class="article-keywords"><?php echo $lang->colon . $page->keywords;?></span></p>
      </footer>
      <?php endif;?>
    </div>
    <div class='row blocks' data-region='page_view-bottom'><?php $this->block->printRegion($layouts, 'page_view', 'bottom', true);?></div>
  </div>
  <?php if(!empty($layouts['page_view']['side']) and !(empty($sideFloat) || $sideFloat === 'hidden')):?>
  <div class='col-md-<?php echo $sideGrid ?> col-side'><side class='page-side blocks blocks' data-region='page_view-side'><?php $this->block->printRegion($layouts, 'page_view', 'side');?></side></div>
  <?php endif;?>
</div>
<div class='row blocks' data-region='page_view-bottomBanner'><?php $this->block->printRegion($layouts, 'page_view', 'bottomBanner', true);?></div>
<?php if(strpos($page->content, '<embed ') !== false) include TPL_ROOT . 'common/video.html.php';?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'); ?>
<?php endif;?>
