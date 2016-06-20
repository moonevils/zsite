<?php
$this->loadModel('message');
$limit  = zget($widget->params, 'limit', 10);
$messages = $this->message->getListForWidget($limit);
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
