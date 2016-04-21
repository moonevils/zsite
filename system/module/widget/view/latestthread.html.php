<?php
$this->loadModel('thread');
$limit  = zget($widget->params, 'limit', 10);
$threads = $this->thread->getListForWidget($limit);
?>
<table class='table table-data table-hover table-fixed'>
  <?php foreach($threads as $thread):?>
  <tr>
    <td class='w-150px'>
      <?php echo html::a(commonModel::createFrontLink('thread', 'view', "id={$thread->id}"), $thread->title, "target='_blank'");?>
    </td>
    <td><?php echo $thread->author;?></td>
    <?php if($this->config->forum->postReview == 'open'):?>
    <td><?php echo zget($lang->thread->statusList, $thread->status);?></td>
    <?php else:?>
    <td><?php echo $thread->replies == 0 ? $lang->thread->unreplied : '';?></td>
    <?php endif;?>
    <td><?php echo formatTime($thread->addedDate, 'm-d H:i');?></td>
  </tr>
  <?php endforeach;?>
</table>
