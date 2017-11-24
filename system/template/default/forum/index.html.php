<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header'); ?>
<div class='row blocks' data-grid='4' data-region='forum_index-top'><?php $this->block->printRegion($layouts, 'forum_index', 'top', true);?></div>
<?php $common->printPositionBar($this->app->getModuleName());?>

<ul class='nav nav-pills'>
  <li <?php if($mode == 'board')  echo "class='active'";?>><?php echo html::a(inlink('index', "mode=board"),  $lang->forum->indexModeOptions['board']);?></li>
  <li <?php if($mode == 'latest') echo "class='active'";?>><?php echo html::a(inlink('index', "mode=latest"), $lang->forum->indexModeOptions['latest']);?></li>
  <li <?php if($mode == 'stick')  echo "class='active'";?>><?php echo html::a(inlink('index', "mode=stick"),  $lang->forum->indexModeOptions['stick']);?></li>
</ul>
<?php if($mode == 'latest' or $mode == 'stick'):?>
<div class='panel'>
  <table class='table table-hover table-striped'>
    <thead>
      <tr class='text-center hidden-xxxs'>
        <th><?php echo $lang->thread->title;?></th>
        <th class='w-150px hidden-xxs'><?php echo $lang->thread->author;?></th>
        <th class='w-100px hidden-xs'><?php echo $lang->thread->postedDate;?></th>
        <th class='w-50px hidden-xs'><?php echo $lang->thread->views;?></th>
        <th class='w-50px'><?php echo $lang->thread->replies;?></th>
        <th class='w-200px hidden-sm hidden-xs'><?php echo $lang->thread->lastReply;?></th>
      </tr>  
    </thead>
    <tbody>
      <?php foreach($threads as $thread):?>
      <?php $style = $thread->color ? "style='color:{$thread->color}'" : '';?>
      <tr class='text-center'>
        <td class='text-left'>
          <?php echo ($mode == 'latest' && $thread->isNew) ? "<i class='icon-comment-alt icon-large text-success'> </i>" : "<i class='icon-comment-alt icon-large text-muted'> </i>";?>
          <span data-ve='thread' id='thread<?php echo $thread->id;?>'><?php echo '[' . zget($boards, $thread->board, $thread->board). '] ' . html::a($this->createLink('thread', 'view', "id=$thread->id"), $thread->title, $style);?></span>
        </td>
        <td class='hidden-xxs'><strong><?php echo $thread->authorRealname;?></strong></td>
        <td class='hidden-xs'><?php echo substr($thread->addedDate, 5, -3);?></td>
        <td class='hidden-xs'><?php echo $thread->views;?></td>
        <td class='hidden-xxxs'><?php echo $thread->replies;?></td>
        <td class='hidden-sm hidden-xs'>
          <?php 
          if($thread->replies)
          {
              echo substr($thread->repliedDate, 5, -3) . ' ';
              echo html::a($this->createLink('thread', 'locate', "threadID={$thread->id}&replyID={$thread->replyID}"), $thread->repliedByRealname);
          }
          ?>
        </td>  
      </tr>  
      <?php endforeach;?>
    </tbody>
    <tfoot>
      <tr><td colspan='7'><?php $pager->show('right', 'short');?></td></tr>
    </tfoot>
  </table>
</div>
<?php else:?>
<div id='boards'>
  <?php foreach($boards as $parentBoard):?>
  <div class='panel'>
    <table class='table table-hover table-striped'>
      <thead>
        <tr class='text-center hidden-xxxs'>
          <th class='text-left'><i class='icon-comments icon-large'> </i><?php echo $parentBoard->name;?></th>
          <th class='hidden-xs'><?php echo $lang->forum->owners;?></th>
          <th><?php echo $lang->forum->threadCount;?></th>
          <th class='hidden-xxs'><?php echo $lang->forum->postCount;?></th>
          <th class='hidden-xs'><?php echo $lang->forum->lastPost;?></th>
        </tr>  
      </thead>
      <tbody>
        <?php foreach($parentBoard->children as $childBoard):?>
        <tr class='text-center text-middle'>
          <td class='text-left'>
            <?php echo $this->forum->isNew($childBoard) ? "<i class='icon-comment icon-large text-success'> </i>" : "<i class='icon-comment icon-large text-muted'> </i>"; ?>
            <?php echo html::a(inlink('board', "id=$childBoard->id", "category={$childBoard->alias}"), $childBoard->name);?><br />
            <small class='text-muted'><?php echo $childBoard->desc;?></small>
          </td>
          <td class='w-120px hidden-xs'><strong><nobr><?php foreach($childBoard->moderators as $moderators) echo $moderators . ' ';?></nobr></strong></td>
          <td class='w-70px hidden-xxxs'><?php echo $childBoard->threads;?></td>
          <td class='w-70px hidden-xxs'><?php echo $childBoard->posts;?></td>
          <td class='w-150px hidden-xs'>
            <?php
            if($childBoard->postedBy)
            {
                echo substr($childBoard->postedDate, 5, -3) . '<br/>'; 
                echo html::a($this->createLink('thread', 'locate', "threadID={$childBoard->postID}&replyID={$childBoard->replyID}"), $childBoard->postedByRealname);
            }
            ?>
          </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
  <?php endforeach;?>
</div>
<?php endif;?>
<div class='blocks' data-region='forum_index-bottom'><?php $this->block->printRegion($layouts, 'forum_index', 'bottom');?></div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer'); ?>
