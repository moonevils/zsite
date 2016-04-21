<?php include TPL_ROOT . 'common/header.html.php'; ?>
<?php if(isset($node)) $common->printPositionBar($node->origins);?>
<div class='row blocks' data-region='book_browse-topBanner'><?php $this->block->printRegion($layouts, 'book_browse', 'topBanner', true);?></div>
<div class='row'>
  <?php if($this->config->book->chapter == 'left' and isset($hasArticles) and $hasArticles):?>
  <div class='col-md-3'>
    <div class='panel'>
      <?php if(!empty($book) && $book->title): ?>
      <div class='panel-heading'>
        <strong class='title'><?php echo $book->title;?></strong>
        <div class='panel-actions book-menu'>
          <div class='dropdown'>
            <a data-toggle='dropdown' class='dropdown-toggle' href='javascript:;'><i class='icon-list'></i></a>
            <ul role='menu' class='dropdown-menu pull-right'>
              <?php foreach($books as $bookMenu):?>
              <li><?php echo html::a(inlink("browse", "id=$bookMenu->id", "book=$bookMenu->alias"), $bookMenu->title);?></li>
              <?php endforeach;?>
            </ul>
          </div>
        </div>
      </div>
      <?php endif; ?>
      <div class='panel-body'>
        <div class='books'><?php if(!empty($allCatalog)) echo $allCatalog;?></div>
      </div>
    </div>
    <side class='blocks' data-region='book_browse-side'><?php $this->block->printRegion($layouts, 'book_browse', 'side');?></side>
  </div>
  <div class='col-md-9'>
  <?php else:?>
  <div class='col-md-12'>
  <?php endif;?>
    <div class='row blocks' data-region='book_browse-top'><?php $this->block->printRegion($layouts, 'book_browse', 'top', true);?></div>
    <div class='panel' id='bookCatalog' data-id='<?php echo $node->id?>'>
      <?php if(!empty($book) && $book->title): ?>
      <div class='panel-heading'>
        <strong class='title'><?php echo $book->title;?></strong>
        <div class='panel-actions book-menu'>
          <div class='dropdown'>
            <a data-toggle='dropdown' class='dropdown-toggle' href='javascript:;'><i class='icon-list'></i></a>
            <ul role='menu' class='dropdown-menu pull-right'>
              <?php foreach($books as $bookMenu):?>
              <li><?php echo html::a(inlink("browse", "id=$bookMenu->id", "book=$bookMenu->alias"), $bookMenu->title);?></li>
              <?php endforeach;?>
            </ul>
          </div>
        </div>
      </div>
      <?php endif;?>
      <div class='panel-body'>
        <div class='books'><?php if(!empty($catalog)) echo $catalog;?></div>
      </div>
    </div>
    <div class='row blocks' data-region='book_browse-bottom'><?php $this->block->printRegion($layouts, 'book_browse', 'bottom', true);?></div>
  </div>
</div>
<div class='row blocks' data-region='book_browse-bottomBanner'><?php $this->block->printRegion($layouts, 'book_browse', 'bottomBanner', true);?></div>
<?php include TPL_ROOT . 'common/footer.html.php';?>
