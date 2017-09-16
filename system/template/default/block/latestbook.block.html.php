<div class='panel-body'>
  <div class='cards cards-custom'>
    <?php foreach($books as $book):?>
    <?php $recPerRow = $content->recPerRow;?>
    <div class='pull-left with-padding' style="width:<?php echo 100 / $recPerRow;?>%" data-recperrow="<?php echo $recPerRow;?>">
      <div class='card with-margin'>
        <div class='card-heading text-center'>
          <?php echo html::a(helper::createLink('book', 'browse', "nodeID=$book->id", "book=$book->alias") . ($this->get->fullScreen ? "?fullScreen={$this->get->fullScreen}" : ''), $book->title);?>
        </div>
        <div class='card-content text-muted text-center'><?php echo $book->content;?></div>
        <div class='card-actions'>
          <span class='text-muted'><i class='icon-user'></i> <?php echo $book->author;?></span>
          <span class='text-muted'><i class='icon-time'></i> <?php echo formatTime($book->addedDate, 'Y-m-d');?></span>
        </div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
</div>
<style>
.card .card-heading{height: 100px; font-size: 15px; white-space: normal; display: table; width: 100%;}
.card .card-heading a{display: table-cell; vertical-align: middle;}
.card-content{height: 80px;}
.card-actions{position: relative; bottom:5px; right: 5px;}
</style>
