<?php
$this->loadModel('message');
$limit  = zget($widget->params, 'limit', 10);
$messages = $this->message->getListForWidget($limit);
?>
<table class='table table-data table-hover table-fixed'>
  <?php foreach($messages as $message):?>
  <tr>
    <td><?php echo $message->from . $lang->colon . html::a($message->objectViewURL, $message->content, "target='_blank'");?></td>
    <td class='w-30px text-center'><?php echo html::a(helper::createLink('message', 'reply', "id={$message->id}"), "<i class='icon icon-reply'> </i>", "data-toggle='modal'");?></td>
  </tr>
  <?php endforeach;?>
</table>
