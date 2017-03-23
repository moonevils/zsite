<?php if(!empty($this->config->book->fullScreen) or $this->get->fullScreen):?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header.lite'); ?>
<?php js::set('objectType', 'book');?>
<?php js::set('objectID', $article->id);?>
<?php js::set('fullScreen', 1);?>
<div class='fullScreen-book'>
  <div class='fullScreen-catalog pANeli bookScrollListsBox'>
    <?php if(!empty($book) && $book->title): ?>
    <div class='panel-heading clearfix'>
      <div class='dropdown pull-left'>
        <a href='javascript:;' data-toggle='dropdown' class='dropdown-toggle'><strong><?php echo $book->title;?></strong> <i class='caret-down'></i></a>
        <ul role='menu' class='dropdown-menu'>
          <?php foreach($books as $bookMenu):?>
          <li><?php echo html::a(inlink("browse", "id=$bookMenu->id", "book=$bookMenu->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), $bookMenu->title);?></li>
          <?php endforeach;?>
        </ul>
      </div>
      <?php if(!$this->get->fullScreen):?>
      <div class='pull-right home'><a href='/' title='<?php echo $lang->book->goHome;?>'><i class='icon-home'></i></a></div>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    <div class='panel-body'>
      <div class='books'>
        <?php 
          if(!empty($bookInfoLink) and !empty($book->content)) echo "<span id='bookInfoLink'>" . $bookInfoLink . "</span>";   
          if(!empty($allCatalog)) echo $allCatalog;
        ?>
      </div>
      <div class='powerby'><?php printf($lang->poweredBy, $config->version, k(), "<span class='icon icon-chanzhi'><i class='ic1'></i><i class='ic2'></i><i class='ic3'></i><i class='ic4'></i><i class='ic5'></i><i class='ic6'></i><i class='ic7'></i></span> <span class='name'>" . $lang->chanzhiEPSx . '</span>' . $config->version); ?></div>
    </div>
  </div>
  <div class='fullScreen-content panel'>
    <div class='fullScreen-inner'>
      <header>
        <h2><?php echo $article->title;?></h2>
        <dl class='dl-inline'>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblAddedDate, formatTime($article->addedDate));?>'><i class='icon-time icon-large'></i> <?php echo formatTime($article->addedDate);?></dd>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblAuthor, $article->author);?>'><i class='icon-user icon-large'></i> <?php echo $article->author; ?></dd>
          <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblViews, $article->views);?>'><i class='icon-eye-open'></i> <?php echo $config->viewsPlaceholder; ?></dd>
          <?php if($article->editor):?>
          <dd data-toggle='tooltip' data-placement='top' ><i class='icon-edit icon-large'></i><?php printf($lang->book->lblEditor, $this->loadModel('user')->getByAccount($article->editor)->realname, formatTime($article->editedDate));?></dd>
          <?php endif;?>
        </dl>
        <?php if($article->summary and $article->type != 'book'):?>
        <section class='abstract'><strong><?php echo $lang->book->summary;?></strong><?php echo $lang->colon . $article->summary;?></section>
        <?php endif; ?>
      </header>
      <section class='article-content'>
        <?php if(isset($content)) echo $content;?>
      </section>
      <section><?php $this->loadModel('file')->printFiles($article->files);?></section>
      <footer>
        <?php if($article->keywords):?>
        <p class='small'><strong class='text-muted'><?php echo $lang->book->keywords;?></strong><span class='article-keywords'><?php echo $lang->colon . $article->keywords;?></span></p>
        <?php endif; ?>
        <?php if(isset($prevAndNext)):?>
        <?php extract($prevAndNext);?>
        <ul class='pager pager-justify'>
          <?php if($prev): ?>
          <li class='previous'><?php echo html::a(inlink('read', "articleID=$prev->id", "book={$book->alias}&node={$prev->alias}") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), "<i class='icon-arrow-left'></i> " . $prev->title); ?></li>
          <?php else: ?>
          <li class='previous disabled'><a href='###'><i class='icon-arrow-left'></i> <?php print($lang->book->none); ?></a></li>
          <?php endif; ?>
          <?php if($this->config->book->chapter == 'home' or !$this->get->fullScreen):?>
          <li class='back'><?php echo html::a(inlink('browse', "bookID={$parent->id}", "book={$book->alias}&title={$parent->alias}") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), "<i class='icon-list-ul'></i> " . $lang->book->chapter);?></li>
          <?php endif; ?>
          <?php if($next):?>
          <li class='next'><?php echo html::a(inlink('read', "articleID=$next->id", "book={$book->alias}&node={$next->alias}") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), $next->title . " <i class='icon-arrow-right'></i>"); ?></li>
          <?php else:?>
          <li class='next disabled'><a href='###'> <?php print($lang->book->none); ?><i class='icon-arrow-right'></i></a></li>
          <?php endif; ?>
        </ul>
        <?php endif;?>
      </footer>
      <?php if(commonModel::isAvailable('message')):?>
      <div id='commentBox'>
        <?php echo $this->fetch('message', 'comment', "objectType=book&objectID={$article->id}");?>
      </div>
      <?php endif;?>
      <div class='blocks' data-region='book_read-bottom'><?php $this->block->printRegion($layouts, 'book_read', 'bottom');?></div>
    </div>
  </div>
</div>
<?php include TPL_ROOT . 'common/jplayer.html.php'; ?>
<?php if($config->debug) js::import($jsRoot . 'jquery/form/min.js');?>
<?php if(isset($pageJS)) js::execute($pageJS);?>
</body>
</html>
<?php else:?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');?>
<?php js::set('objectType', 'book');?>
<?php js::set('objectID', $article->id);?>
<div class='row blocks' data-region='book_read-top'><?php $this->block->printRegion($layouts, 'book_read', 'top', true);?></div>
<?php $common->printPositionBar($article->origins);?>
<?php if($this->config->book->chapter == 'left'):?>
<div class='row'>
  <div class='col-md-3'>
    <div class='panel book-catalog bookScrollListsBox'>
      <?php if(!empty($book) && $book->title): ?>
      <div class='panel-heading clearfix'>
        <div class='dropdown pull-left'>
        <a href='javascript:;' data-toggle='dropdown' class='dropdown-toggle'><i class="icon icon-book"></i><strong><?php echo $book->title;?></strong> <span><?php echo $lang->book->more;?><i class='icon icon-caret-down'></i></span></a>
          <ul role='menu' class='dropdown-menu'>
            <?php foreach($books as $bookMenu):?>
            <li><?php echo html::a(inlink("browse", "id=$bookMenu->id", "book=$bookMenu->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), $bookMenu->title);?></li>
            <?php endforeach;?>
          </ul>
        </div>
        <div class='pull-right home hide'><a href='/' title='<?php echo $lang->book->goHome;?>'><i class='icon-home'></i></a></div>
      </div>
      <?php endif; ?>
      <div class='panel-body'>
        <div class='books'>
        <?php
          if(!empty($bookInfoLink) and !empty($book->content)) echo "<span id='bookInfoLink'>" . $bookInfoLink . "</span>";   
          if(!empty($allCatalog)) echo $allCatalog;
        ?>
        </div>
      </div>
    </div>
  </div>
  <div class='col-md-9'>
<?php endif;?>
<div class='article book-content' id='book' data-id='<?php echo $article->id?>'>
  <header>
    <h2><?php echo $article->title;?></h2>
    <dl class='dl-inline'>
      <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblAddedDate, formatTime($article->addedDate));?>'><i class='icon-time icon-large'></i> <?php echo formatTime($article->addedDate);?></dd>
      <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblAuthor, $article->author);?>'><i class='icon-user icon-large'></i> <?php echo $article->author; ?></dd>
      <dd data-toggle='tooltip' data-placement='top' data-original-title='<?php printf($lang->book->lblViews, $article->views);?>'><i class='icon-eye-open'></i> <?php echo $config->viewsPlaceholder; ?></dd>
      <?php if($article->editor):?>
      <dd data-toggle='tooltip' data-placement='top' ><i class='icon-edit icon-large'></i><?php printf($lang->book->lblEditor, $this->loadModel('user')->getByAccount($article->editor)->realname, formatTime($article->editedDate));?></dd>
      <?php endif;?>
    </dl>
    <?php if($article->summary and $article->type != 'book'):?>
    <section class='abstract'><strong><?php echo $lang->book->summary;?></strong><?php echo $lang->colon . $article->summary;?></section>
    <?php endif; ?>
  </header>
  <section class='article-content'>
    <?php if(isset($content) and $article->type != 'book') echo $content;?>
    <?php if($article->type == 'book') echo $article->content;?>
  </section>
  <section><?php $this->loadModel('file')->printFiles($article->files);?></section>
  <footer>
    <?php if($article->keywords):?>
    <p class='small'><strong class='text-muted'><?php echo $lang->book->keywords;?></strong><span class='article-keywords'><?php echo $lang->colon . $article->keywords;?></span></p>
    <?php endif; ?>
    <?php if(isset($prevAndNext)):?>
    <?php extract($prevAndNext);?>
    <ul class='pager pager-justify'>
      <?php if($prev): ?>
      <li class='previous'><?php echo html::a(inlink('read', "articleID=$prev->id", "book={$book->alias}&node={$prev->alias}") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), "<i class='icon-arrow-left'></i> " . $prev->title); ?></li>
      <?php else: ?>
      <li class='previous disabled'><a href='###'><i class='icon-arrow-left'></i> <?php print($lang->book->none); ?></a></li>
      <?php endif; ?>
      <?php if($this->config->book->chapter == 'home' or !$this->get->fullScreen):?>
      <li class='back'><?php echo html::a(inlink('browse', "bookID={$parent->id}", "book={$book->alias}&title={$parent->alias}") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), "<i class='icon-list-ul'></i> " . $lang->book->chapter);?></li>
      <?php endif; ?>
      <?php if($next):?>
      <li class='next'><?php echo html::a(inlink('read', "articleID=$next->id", "book={$book->alias}&node={$next->alias}") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), $next->title . " <i class='icon-arrow-right'></i>"); ?></li>
      <?php else:?>
      <li class='next disabled'><a href='###'> <?php print($lang->book->none); ?><i class='icon-arrow-right'></i></a></li>
      <?php endif; ?>
    </ul>
    <?php endif;?>
  </footer>
</div>
<?php if(commonModel::isAvailable('message')) echo "<div id='commentBox'>" . $this->fetch('message', 'comment', "objectType=book&objectID={$article->id}") . "</div>";?>
<div class='blocks' data-region='book_read-bottom'><?php $this->block->printRegion($layouts, 'book_read', 'bottom');?></div>
<?php if($this->config->book->chapter == 'left'):?>
  </div>
</div>
<?php endif;?>
<?php include TPL_ROOT . 'common/jplayer.html.php'; ?>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'); ?>
<?php endif;?>
