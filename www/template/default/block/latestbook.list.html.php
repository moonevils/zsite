<div class='panel-body'>
  <ul class='ul-list'>
    <?php foreach($books as $book):?>
    <li class='addDataList'>
      <?php echo html::a(helper::createLink('book', 'browse', "nodeID=$book->id", "book=$book->alias"), $book->title);?>
      <span class='pull-right'><?php echo substr($book->addedDate, 0, 10);?></span>
    </li>
    <?php endforeach;?>
  </ul>
</div>
