<?php
$this->loadModel('message');
$limit  = zget($widget->params, 'limit', 10);
$messages = $this->message->getListForWidget($limit);
$messageCount = 0;
$commentCount = 0;
$replyCount   = 0;
foreach($messages as $message)
{
    if($message->type == 'message') $messageCount += 1;
    if($message->type == 'comment') $commentCount += 1;
    if($message->type == 'reply')   $replyCount   += 1;
}
?>
<table class='table table-data table-hover table-fixed'>
  <?php foreach($messages as $message):?>
  <tr>
    <td>
    <?php
    $href = helper::createLink('message', 'reply', "id={$message->id}");
    echo $message->from . $lang->colon . html::a($href, $message->content, "data-toggle='modal'");
    ?>
    </td>
  </tr>
  <?php endforeach;?>
</table>
<script>
$(document).ready(function()
{
    var panel = $('#widget' + <?php echo $widget->order;?>);
    if(panel.find('.panel-actions > .panel-action').length == 0)
    {
        var count = '';
        count += "<a class='panel-action' href='/admin.php?m=message&f=admin&type=message'><?php echo $lang->widget->message . '[' . $messageCount . ']';?></a>";
        count += "<a class='panel-action' href='/admin.php?m=message&f=admin&type=comment'><?php echo $lang->widget->comment . '[' . $commentCount . ']';?></a>";
        count += "<a class='panel-action' href='/admin.php?m=message&f=admin&type=reply'><?php echo $lang->widget->reply . '[' . $replyCount . ']';?></a>";
        panel.find('.panel-actions').prepend(count);
    }
})
</script>
