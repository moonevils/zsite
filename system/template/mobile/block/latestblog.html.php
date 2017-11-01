<?php
/**
 * The latest blog front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php 
/* Set $themRoot. */
$themeRoot = $this->config->webRoot . 'theme/';

/* Decode the content and get articles. */
$content  = json_decode($block->content);
$method   = 'get' . ucfirst(str_replace('blog', '', strtolower($block->type)));
$articles = $this->loadModel('article')->$method(empty($content->category) ? 0 : $content->category, $content->limit, 'blog');
if(isset($content->image)) $articles = $this->loadModel('file')->processImages($articles, 'blog');
?>
<style>
#block<?php echo $block->id;?> .card .thumbnail-cell {padding-left: 8px; padding-right: 0}
#block<?php echo $block->id;?> .card .table-cell + .thumbnail-cell {padding-right: 8px; padding-left: 0}
</style>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
    <?php if(!empty($content->moreText) and !empty($content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText);?></div>
    <?php endif;?>
  </div>
  <?php if(isset($content->image)):?>
  <?php $imageURL = !empty($content->imageSize) ? $content->imageSize . 'URL' : 'smallURL';?>
  <div class='panel-body no-padding'>
    <div class='cards condensed cards-list'>
    <?php
    foreach($articles as $article):
    $url = helper::createLink('blog', 'view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");
    ?>
      <div class='card'>
        <div class='card-heading'>
          <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
          <?php if($content->categoryName == 'abbr'):?>
          <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] ';?>
          <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName, "class='text-special'");?>
          <?php else:?>
          <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . ']', "class='text-special'");?>
          <?php endif;?>
          <?php endif;?>
          <?php if($article->sticky):?><span class='red'><i class="icon icon-arrow-up"></i></span><?php endif;?>
          <strong><?php echo html::a($url, $article->title, "style='color:{$article->titleColor}'");?></strong>
        </div>
        <div class='table-layout'>
          <?php
          if(!empty($article->image))
          {
              $thumbnailTitle = $article->image->primary->title ? $article->image->primary->title : $article->title;
              $thumbnailLink = html::a($url, html::image($this->loadModel('file')->printFileURL($article->image->primary->pathname, $article->image->primary->extension, 'article', $imageURL), "title='{$thumbnailTitle}' class='thumbnail'" ));
              $thumbnailMaxWidth = !empty($content->imageWidth) ? $content->imageWidth . 'px' : '60px';
              $thumbnail = "<div class='table-cell thumbnail-cell' style='max-width: {$thumbnailMaxWidth};'>{$thumbnailLink}</div>";
              if($content->imagePosition == 'left') echo $thumbnail;
          }
          ?>
          <div class='table-cell'>
            <div class='card-content text-muted small'>
              <strong class='text-important'><?php if(isset($content->time)) echo "<i class='icon-time'></i> " . formatTime($article->addedDate, DT_DATE4);?></strong> &nbsp;<?php echo $article->summary;?>
            </div>
          </div>
          <?php if(isset($thumbnail) && $content->imagePosition == 'right') echo $thumbnail; ?>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
  <?php else:?>
  <div class='panel-body no-padding'>
    <div class='list-group simple'>
      <?php foreach($articles as $article): ?>
      <?php 
      $alias = "category={$article->category->alias}&name={$article->alias}";
      $url   = helper::createLink('blog', 'view', "id={$article->id}", $alias);
      ?>
      <?php if(isset($content->time)):?>
      <div class='list-group-item'>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] ';?>
        <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName, "class='text-special'");?>
        <?php else:?>
        <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ', "class='text-special'");?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $article->title, "title='{$article->title}' style='color:{$article->titleColor}'");?>
        <span class='pull-right text-muted'><?php echo substr($article->addedDate, 0, 10);?></span>
      </div>
      <?php else:?>
      <div class='list-group-item'>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] ';?>
        <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName, "class='text-special'");?>
        <?php else:?>
        <?php echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ', "class='text-special'");?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $article->title, "title='{$article->title}' style='color:{$article->titleColor}'");?>
      </div>
      <?php endif;?>
      
      <?php endforeach;?>
    </div>
  </div>
  <?php endif;?>
</div>
