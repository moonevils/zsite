<?php
include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');
$path = array_keys($category->pathNames);
js::set('path', $path);
js::set('categoryID', $category->id);
js::set('pageLayout', $this->block->getLayoutScope('article_browse', $category->id));
?>
<?php echo $common->printPositionBar($category);?>
<?php if(isset($articleList)):?>
<script><?php echo "place" . md5(time()). "='" . $config->idListPlaceHolder . $articleList . $config->idListPlaceHolder . "';";?></script>
<?php else:?>
<script><?php echo "place" . md5(time()) . "='" . $config->idListPlaceHolder . '' . $config->idListPlaceHolder . "';";?></script>
<?php endif;?>
<div class='row blocks' data-region='article_browse-topBanner'><?php $this->block->printRegion($layouts, 'article_browse', 'topBanner', true);?></div>
<div class='row' id='columns' data-page='article_browse'>
  <?php if(!empty($layouts['article_browse']['side']) and !empty($sideFloat) && $sideFloat != 'hidden'):?>
  <div class="col-md-<?php echo 12 - $sideGrid; ?> col-main<?php if($sideFloat === 'left') echo ' pull-right' ?>">
  <?php else:?>
  <div class="col-md-12">
  <?php endif;?>
    <div class='list list-condensed'>
    <div class='row blocks' data-region='article_browse-top'><?php $this->block->printRegion($layouts, 'article_browse', 'top', true);?></div>
      <header id='articleHeader'>
        <h2><?php echo $category->name;?></h2>
        <?php 
        echo "<div class='header'>" . html::a('javascript:;', $lang->article->orderBy->time, "id='id' class='id setOrder'") . "</div>";
        echo "<div class='header'>" . html::a('javascript:;', $lang->article->orderBy->hot, "id='views' class='views setOrder'") . "</div>";
        ?>
      </header>
      <section class='items items-hover' id='articles'>
        <?php foreach($articles as $article):?>
        <?php $url = inlink('view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");?>
        <div class='item' id="article<?php echo $article->id?>" data-ve='article'>
          <?php if(!empty($article->image)):?>
          <?php $pull     = (isset($this->config->article->imagePosition) and $this->config->article->imagePosition == 'left') ? 'pull-left' : 'pull-right';?>
          <?php $imageURL = !empty($this->config->article->imageSize) ? $this->config->article->imageSize . 'URL' : 'smallURL';?>
          <div class='media <?php echo $pull;?>' style="max-width: <?php echo !empty($this->config->article->imageWidth) ? $this->config->article->imageWidth . 'px' : '120px';?>">
            <?php
            $title = $article->image->primary->title ? $article->image->primary->title : $article->title;
            echo html::a($url, html::image($article->image->primary->$imageURL, "title='{$title}' class='thumbnail'"));
            ?>
          </div>
          <?php endif;?>
          <div class='item-heading'>
            <div class="text-muted pull-right">
              <span title="<?php echo $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder;?>"><i class='icon-eye-open'></i> <?php echo $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder;?></span> &nbsp;
              <?php if(commonModel::isAvailable('message') and $article->comments):?><span title="<?php echo $lang->article->comments;?>"><i class='icon-comments-alt'></i> <?php echo $article->comments;?></span> &nbsp;<?php endif;?>
              <span title="<?php echo $lang->article->addedDate;?>"><i class='icon-time'></i> <?php echo substr($article->addedDate, 0, 10);?></span>
            </div>
            <h4>
              <?php echo empty($article->titleColor) ? html::a($url, $article->title) : html::a($url, $article->title, "style='color:$article->titleColor;'");?>
              <?php if($article->sticky):?><span class='label label-danger'><?php echo $lang->article->stick;?></span><?php endif;?>
            </h4>
          </div>
          <div class='item-content'>
            <div class='text text-muted'><?php echo helper::substr($article->summary, 120, '...');?></div>
          </div>
        </div>
        <?php endforeach;?>
      </section>
      <footer class='clearfix'><?php $pager->show('right', 'short');?></footer>
    </div>
    <div class='row blocks' data-region='article_browse-bottom'><?php $this->block->printRegion($layouts, 'article_browse', 'bottom', true);?></div>
  </div>
  <?php if(!empty($layouts['article_browse']['side']) and !(empty($sideFloat) || $sideFloat === 'hidden')):?>
  <div class='col-md-<?php echo $sideGrid ?> col-side'><side class='page-side blocks' data-region='article_browse-side'><?php $this->block->printRegion($layouts, 'article_browse', 'side');?></side></div>
  <?php endif;?>
</div>
<div class='row blocks' data-region='article_browse-bottomBanner'><?php $this->block->printRegion($layouts, 'article_browse', 'bottomBanner', true);?></div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
