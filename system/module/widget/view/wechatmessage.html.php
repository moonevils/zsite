<?php
$this->loadModel('wechat');
$limit  = zget($widget->params, 'limit', 10);
$messages = $this->wechat->getListForWidget($limit);
?>
<table class='table table-data table-hover table-fixed'>
  <?php foreach($messages as $message):?>
  <tr>
    <td>
    <?php
    $href = helper::createLink("wechat", "reply", "message={$message->id}");  
    echo $message->fromUserName . $lang->colon . html::a($href, $message->content, "data-toggle='modal'");
    ?>
    </td>
</tr>
  <?php endforeach;?>
</table>
