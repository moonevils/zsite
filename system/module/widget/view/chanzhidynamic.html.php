<?php
$content  = file_get_contents('http://api.chanzhi.org/goto.php?item=dynamics');
$content  = json_decode($content);
$articles = $content->articles;
?>
<table class='table table-data table-hover table-fixed'>
  <?php foreach($articles as $article):?>
  <tr>
    <td> <?php echo html::a($article->url, $article->title, "target='_blank'");?> </td>
    <td class='w-100px'><?php echo formatTime($article->addedDate, 'Y-m-d');?></td>
  </tr>
  <?php endforeach;?>
</table>
