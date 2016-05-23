<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header'); ?>
<?php if(isset($node)) $common->printPositionBar($node->origins);?>
<?php js::set('fullScreen', (!empty($this->config->book->fullScreen) or $this->get->fullScreen) ? 1 : 0);?>
<div class='row blocks' data-region='book_browse-topBanner'><?php $this->block->printRegion($layouts, 'book_browse', 'topBanner', true);?></div>
<div class='panel' id='bookCatalog' data-id='<?php echo $node->id?>'>
  <?php if(!empty($book) && $book->title): ?>
  <div class='panel-heading clearfix'>
    <div class='dropdown'>
      <a data-toggle='dropdown' class='dropdown-toggle' href='javascript:;'><strong><?php echo $book->title;?></strong> <span class='caret'></span></a>
      <ul role='menu' class='dropdown-menu'>
        <?php foreach($books as $bookMenu):?>
        <li><?php echo html::a(inlink("browse", "id=$bookMenu->id", "book=$bookMenu->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), $bookMenu->title);?></li>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
  <?php endif;?>
  <div class='panel-body'>
    <div class='books'><?php if(!empty($catalog)) echo $catalog;?></div>
  </div>
</div>
<div class='row blocks' data-region='book_browse-bottomBanner'><?php $this->block->printRegion($layouts, 'book_browse', 'bottomBanner', true);?></div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
