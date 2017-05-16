<?php
/**
 * The latest article front view file of block module of chanzhiEPS.
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
$method   = 'get' . ucfirst(str_replace('article', '', strtolower($block->type)));
$articles = $this->loadModel('article')->$method(empty($content->category) ? 0 : $content->category, $content->limit);
if(isset($content->image)) $articles = $this->loadModel('file')->processImages($articles, 'article');
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
    <?php if(isset($content->moreText) and isset($content->moreUrl)):?>
    <div class='pull-right'><?php echo html::a($content->moreUrl, $content->moreText);?></div>
    <?php endif;?>
  </div>
  <?php if(isset($content->image)):?>
  <?php $pull     = $content->imagePosition == 'right' ? 'pull-right' : 'pull-left';?>
  <?php $imageURL = !empty($content->imageSize) ? $content->imageSize . 'URL' : 'smallURL';?>
  <div class='panel-body'>
    <div class='items'>
    <?php
    foreach($articles as $article):
    $url = helper::createLink('article', 'view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");
    ?>
    <div class='item'>
      <div class='item-heading'>
        <?php if($article->sticky):?><span class='red'><i class="icon icon-arrow-up"></i></span><?php endif;?>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $block->title) . '] ';?>
        <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName);?>
        <?php else:?>
        <?php echo '[' . $article->category->name . '] ';?>
        <?php endif;?>
        <?php endif;?>
        <strong><?php echo html::a($url, $article->title, "style='color: {$article->titleColor}'");?></strong>
      </div>
      <div class='item-content'>
        
        <div class='text small text-muted'>
          <div class='media <?php echo $pull;?>' style="max-width: <?php echo !empty($content->imageWidth) ? $content->imageWidth . 'px' : '100px';?>">
          <?php 
          if(!empty($article->image))
          {
              $title = $article->image->primary->title ? $article->image->primary->title : $article->title;
              echo html::a($url, html::image($article->image->primary->$imageURL, "title='{$title}' class='thumbnail'" ));
          }
          ?>
          </div>
          <strong class='text-important'>
            <?php if(isset($content->time)) echo "<i class='icon-time'></i> " . formatTime($article->addedDate, DT_DATE4);?>
          </strong> 
          <?php echo $article->summary;?>
        </div>
      </div>
    </div>
    <?php endforeach;?>
    </div>
  </div>
  <?php else:?>
  <div class='panel-body'>
    <ul class='ul-list'>
      <?php foreach($articles as $article):?>
      <?php 
      $article->category->alias = isset($article->category->alias) ? $article->category->alias : '';
      $article->alias = isset($article->alias) ? $article->alias : '';
      $alias       = "category={$article->category->alias}&name={$article->alias}";
      $url         = helper::createLink('article', 'view', "id={$article->id}", $alias);
      ?>
      <?php if(isset($content->time)):?>
      <li class='addDataList'>
        <span>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $block->title) . '] ';?>
        <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName);?>
        <?php else:?>
        <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ');?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $article->title, "title='{$article->title}' style='color:{$article->titleColor}'");?>
        <?php if($article->sticky):?><span class='red'><i class="icon icon-arrow-up"></i></span><?php endif;?>
        </span>
        <span class='pull-right'><?php echo substr($article->addedDate, 0, 10);?></span>
      </li>
      <?php else:?>
      <li class='notDataList'>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
        <?php if($content->categoryName == 'abbr'):?>
        <?php $categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $block->title) . '] ';?>
        <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName);?>
        <?php else:?>
        <?php echo html::a(helper::createLink('article', 'browse', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ');?>
        <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $article->title, "title='{$article->title}' style='color:{$article->titleColor}'");?>
        <span><?php if($article->sticky):?><span class='red'><i class="icon icon-arrow-up"></i></span><?php endif;?></span>
      </li>
      <?php endif;?>
      
      <?php endforeach;?>
    </ul>
  </div>
  <?php endif;?>
</div>
<style>
    .ul-list .addDataList.withStick{padding-right:126px !important;}
    .ul-list .addDataList.withoutStick{padding-right:80px !important;}
    .ul-list .notDataList.withStick{padding-right:60px !important;}
    .ul-list .notDataList.withoutStick{padding-right:5px !important;}
</style>

