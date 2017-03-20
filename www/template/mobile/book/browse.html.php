<?php
/**
 * The browse view file of book for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php if(!empty($this->config->book->fullScreen) or $this->get->fullScreen):?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.lite');?>
<?php js::set('fullScreen', 1);?>
<?php $bookModel = $this->loadModel('book'); ?>
<div class='fullScreen-book'>
  <div class='fullScreen-content panel'>
    <div class='fullScreen-inner'>
      <div class='panel-body'>
        <div class='dropdown selector'>
          <a data-toggle='dropdown' href='###' class='btn strong block primary text-left'><i class='icon icon-book'></i> <?php if(!empty($book) && $book->title) echo $book->title; else echo $lang->book->list; ?><div class='pull-right'><i class='icon-caret-down pull-right'></i></div></a>
          <?php if(!empty($books)): ?>
          <ul class='dropdown-menu responsive'>
            <li class='dropdown-header'><?php echo $lang->book->list;?></li>
            <?php foreach($books as $menu): ?>
            <li<?php echo $menu->title == $book->title ? " class='active'" : ''; ?>><?php echo html::a(inlink('browse', "bookID=$menu->id", "book=$menu->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), '<i class="icon-book"></i> &nbsp;' . $menu->title);?></li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
        <?php $orginsTree = $bookModel->getOriginsTree($node); ?>
        <?php if(!empty($orginsTree)): ?>
        <?php foreach ($orginsTree as $originTree):?>
        <div class='dropdown selector'>
          <a href='###' data-toggle='dropdown' class='btn strong block default text-left'><i class='icon icon-list-ul'></i> <?php echo $serials[$originTree->current->id] . " {$originTree->current->title}" ?><div class='pull-right'><i class='icon-caret-down pull-right'></i></div></a>
          <ul class='dropdown-menu responsive'>
            <?php foreach ($originTree->nodes as $nodeChild)
            {
              if($nodeChild->type != 'book') $serial = $serials[$nodeChild->id];

              if($nodeChild->type == 'chapter') $link = helper::createLink('book', 'browse', "nodeID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : '');
              if($nodeChild->type == 'article') $link = helper::createLink('book', 'read', "articleID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : '');
              $class =  $originTree->current->id === $nodeChild->id ? " class='active'" : '';
              echo "<li{$class}>" . html::a($link, ($nodeChild->type == 'chapter' ? "<i class='icon icon-list-ul'></i>" : "<i class='icon icon-file-text-o'></i>") . " {$serial} &nbsp;{$nodeChild->title}") . '</li>';
            }
            ?>
          </ul>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <hr class="space">
        <div class='list-group'>
          <?php
          foreach ($bookModel->getChildren($node->id) as $nodeChild)
          {
              if($nodeChild->type != 'book') $serial = $serials[$nodeChild->id];

              if($nodeChild->type == 'chapter') $link = helper::createLink('book', 'browse', "nodeID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : '');
              if($nodeChild->type == 'article') $link = helper::createLink('book', 'read', "articleID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : '');
              echo html::a($link, ($nodeChild->type == 'chapter' ? "<i class='icon icon-list-ul'></i>" : "<i class='icon icon-file-text-o'></i>") . " {$serial} &nbsp;{$nodeChild->title} <i class='pull-right icon-chevron-right'></i>", "class='list-group-item" . ($nodeChild->type == 'chapter' ? ' strong' : '') . "'");
          }
          ?>
          <?php if(!$this->get->fullScreen):?>
          <a href='/' class='btn block text-left default home'><i class='icon-home'></i> <?php echo $lang->book->goHome;?></a>
          <?php endif;?>
        </div>
      </div>
    </div>
    <div class='block-region region-bottom blocks' data-region='book_browse-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'book_browse', 'bottom');?></div>
  </div>
</div>
<?php if(isset($pageJS)) js::execute($pageJS);?>
</body>
</html>
<?php else:?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');?>
<?php js::set('fullScreen', 0);?>
<?php $bookModel = $this->loadModel('book'); ?>
<div class='block-region region-top blocks' data-region='book_browse-top'><?php $this->loadModel('block')->printRegion($layouts, 'book_browse', 'top');?></div>
<hr class='space'>
<div class='panel-section panel' id='bookCatalog' data-id='<?php echo $node->id?>'>
  <div class='panel-body'>
    <div class='dropdown selector'>
      <a data-toggle='dropdown' href='###' class='btn strong block primary text-left'><i class='icon icon-book'></i> <?php if(!empty($book) && $book->title) echo $book->title; else echo $lang->book->list; ?><div class='pull-right'><i class='icon-caret-down pull-right'></i></div></a>
      <?php if(!empty($books)): ?>
      <ul class='dropdown-menu responsive'>
        <li class='dropdown-header'><?php echo $lang->book->list;?></li>
        <?php foreach($books as $menu): ?>
        <li<?php echo $menu->title == $book->title ? " class='active'" : ''; ?>><?php echo html::a(inlink('browse', "bookID=$menu->id", "book=$menu->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), '<i class="icon-book"></i> &nbsp;' . $menu->title);?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div>
    <?php $orginsTree = $bookModel->getOriginsTree($node); ?>
    <?php if(!empty($orginsTree)): ?>
    <?php foreach ($orginsTree as $originTree):?>
    <div class='dropdown selector'>
      <a href='###' data-toggle='dropdown' class='btn strong block default text-left'><i class='icon icon-list-ul'></i> <?php echo $serials[$originTree->current->id] . " {$originTree->current->title}" ?><div class='pull-right'><i class='icon-caret-down pull-right'></i></div></a>
      <ul class='dropdown-menu responsive'>
        <?php foreach ($originTree->nodes as $nodeChild)
        {
          if($nodeChild->type != 'book') $serial = $serials[$nodeChild->id];

          if($nodeChild->type == 'chapter') $link = helper::createLink('book', 'browse', "nodeID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : '');
          if($nodeChild->type == 'article') $link = helper::createLink('book', 'read', "articleID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : '');
          $class =  $originTree->current->id === $nodeChild->id ? " class='active'" : '';
          echo "<li{$class}>" . html::a($link, ($nodeChild->type == 'chapter' ? "<i class='icon icon-list-ul'></i>" : "<i class='icon icon-file-text-o'></i>") . " {$serial} &nbsp;{$nodeChild->title}") . '</li>';
        }
        ?>
      </ul>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>

    <hr class="space">
    <div class='list-group'>
      <?php
      foreach ($bookModel->getChildren($node->id) as $nodeChild)
      {
          if($nodeChild->type != 'book') $serial = $serials[$nodeChild->id];

          if($nodeChild->type == 'chapter') $link = helper::createLink('book', 'browse', "nodeID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : '');
          if($nodeChild->type == 'article') $link = helper::createLink('book', 'read', "articleID=$nodeChild->id", "book=$book->alias&node=$nodeChild->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : '');
          echo html::a($link, ($nodeChild->type == 'chapter' ? "<i class='icon icon-list-ul'></i>" : "<i class='icon icon-file-text-o'></i>") . " {$serial} &nbsp;{$nodeChild->title} <i class='pull-right icon-chevron-right'></i>", "class='list-group-item" . ($nodeChild->type == 'chapter' ? ' strong' : '') . "'");
      }
      ?>
    </div>
  </div>
</div>
<div class='block-region region-bottom blocks' data-region='book_browse-bottom'><?php $this->loadModel('block')->printRegion($layouts, 'book_browse', 'bottom');?></div>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer');?>
<?php endif;?>
