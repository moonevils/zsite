<?php
/**
 * The index view file of blog module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     blog
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
include TPL_ROOT . 'blog/header.html.php';
if(isset($category)) $path = array_keys($category->pathNames);
if(!empty($path))         js::set('path',  $path);
if(!empty($category->id)) js::set('categoryID', $category->id);
if(!empty($category->id)) js::set('pageLayout', $this->block->getLayoutScope('blog_index', $category->id));
?>
<?php
$root = '<li>' . $this->lang->currentPos . $this->lang->colon .  html::a($this->inlink('index'), $lang->blog->home) . '</li>';
if(!empty($category)) echo $common->printPositionBar($category, '', '', $root);
?>
<?php if(isset($articleIdList)):?>
<script><?php echo "place" . md5(time()). "='" . $config->idListPlaceHolder . $articleIdList . $config->idListPlaceHolder . "';";?></script>
<?php else:?>
<script><?php echo "place" . md5(time()) . "='" . $config->idListPlaceHolder . '' . $config->idListPlaceHolder . "';";?></script>
<?php endif;?>
<div class='row blocks' data-region='blog_index-topBanner'><?php $this->block->printRegion($layouts, 'blog_index', 'topBanner', true);?></div>
<div class='row' id='columns' data-page='blog_index'>
  <?php if(!empty($layouts['blog_index']['side']) and !empty($sideFloat) && $sideFloat != 'hidden'):?>
  <div class="col-md-<?php echo 12 - $sideGrid; ?> col-main<?php if($sideFloat === 'left') echo ' pull-right' ?>">
  <?php else:?>
  <div class="col-md-12">
  <?php endif;?>
    <div class='row blocks' data-region='blog_index-top'><?php $this->block->printRegion($layouts, 'blog_index', 'top', true);?></div>
    <div id='blogList'>
      <?php foreach($sticks as $stick):?>
      <?php if(!isset($category)) $category = array_shift($stick->categories);?>
        <?php $url = inlink('view', "id=$stick->id", "category={$category->alias}&name=$stick->alias"); ?>
        <div class="card" data-ve='blog' id='blog<?php echo $stick->id;?>'>
          <?php if(!empty($stick->image)):?>
          <?php $pull     = (isset($this->config->blog->imagePosition) and $this->config->blog->imagePosition == 'left') ? 'pull-left' : 'pull-right';?>
          <?php $imageURL = !empty($this->config->blog->imageSize) ? $this->config->blog->imageSize . 'URL' : 'smallURL';?>
          <div class='media <?php echo $pull;?>' style="max-width: <?php echo !empty($this->config->blog->imageWidth) ? $this->config->blog->imageWidth . 'px' : '180px';?>">
            <?php
            $title = $stick->image->primary->title ? $stick->image->primary->title : $stick->title;
            echo html::a($url, html::image(helper::createLink('file', 'read', "fileID={$stick->image->primary->id}&type={$imageURL}", '', "{$stick->image->primary->extension}"), "title='{$title}' class='thumbnail'"));
            ?>
          </div>
          <?php endif;?>
          <h4 class='card-heading'>
            <?php echo html::a($url, $stick->title, "style='color:{$stick->titleColor}'");?>
            <span class='label label-danger'><?php echo $lang->article->stick;?></span>
          </h4>
          <div class='card-content text-muted'>
            <?php echo $stick->summary;?>
          </div>
          <div class="card-actions text-muted">
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblAddedDate, formatTime($stick->addedDate));?>'><i class="icon-time"></i> <?php echo date('Y/m/d', strtotime($stick->addedDate));?></span>
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblAuthor, $stick->author);?>'><i class="icon-user"></i> <?php echo $stick->author;?></span>
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblViews, $config->viewsPlaceholder . $stick->id . $config->viewsPlaceholder);?>'><i class="icon-eye-open"></i> <?php echo $config->viewsPlaceholder . $stick->id . $config->viewsPlaceholder;?></span>
            <?php if(commonModel::isAvailable('message') and isset($stick->comments) and $stick->comments):?>&nbsp; <a href="<?php echo $url . '#commentForm'?>"><span data-toggle='tooltip' title='<?php printf($lang->article->lblComments, $stick->comments);?>'><i class="icon-comments-alt"></i> <?php echo $stick->comments;?></span></a><?php endif;?>
            <?php 
              if($config->blog->showCategory)
              {
                if($config->blog->categoryLevel == 'first')
                {
                    echo "<span>[";
                    echo ($config->blog->categoryName == 'full' or empty(zget($topCategoryList, $stick->category->id)->abbr)) ? zget($topCategoryList, $stick->category->id)->name : zget($topCategoryList, $stick->category->id)->abbr;
                    echo "]</span>";
                }
                else
                {
                    echo "<span>[";
                    echo ($config->blog->categoryName == 'full' or empty($stick->category->abbr)) ? $stick->category->name : $stick->category->abbr;
                    echo "]</span>";
                } 
              }            
            ?>
          </div>
        </div>
      <?php unset($articles[$stick->id]);?>
      <?php endforeach;?>
      <?php foreach($articles as $article):?>
      <?php if(!isset($category)) $category = array_shift($article->categories);?>
        <?php $url = inlink('view', "id=$article->id", "category={$category->alias}&name=$article->alias"); ?>
        <div class="card" data-ve='blog' id='blog<?php echo $article->id;?>'>
          <?php if(!empty($article->image)):?>
          <?php $pull     = (isset($this->config->blog->imagePosition) and $this->config->blog->imagePosition == 'left') ? 'pull-left' : 'pull-right';?>
          <?php $imageURL = !empty($this->config->blog->imageSize) ? $this->config->blog->imageSize . 'URL' : 'smallURL';?>
          <div class='media <?php echo $pull;?>' style="max-width: <?php echo !empty($this->config->blog->imageWidth) ? $this->config->blog->imageWidth . 'px' : '180px';?>">
            <?php
            $title = $article->image->primary->title ? $article->image->primary->title : $article->title;
            echo html::a($url, html::image(helper::createLink('file', 'read', "fileID={$article->image->primary->id}&type={$imageURL}", '', "{$article->image->primary->extension}"), "title='{$title}' class='thumbnail'"));
            ?>
          </div>
          <?php endif;?>
          <h4 class='card-heading'><?php echo html::a($url, $article->title, "style='color:{$article->titleColor}'");?></h4>
          <div class='card-content text-muted'>
            <?php echo $article->summary;?>
          </div>
          <div class="card-actions text-muted">
            <span data-toggle='tooltip' title='<?php printf($lang->article->lblAddedDate, formatTime($article->addedDate));?>'><i class="icon-time"></i> <?php echo date('Y/m/d', strtotime($article->addedDate));?></span>
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblAuthor, $article->author);?>'><i class="icon-user"></i> <?php echo $article->author;?></span>
            &nbsp; <span data-toggle='tooltip' title='<?php printf($lang->article->lblViews, $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder);?>'><i class="icon-eye-open"></i> <?php echo $config->viewsPlaceholder . $article->id . $config->viewsPlaceholder;?></span>
            <?php if(commonModel::isAvailable('message') and $article->comments):?>&nbsp; <a href="<?php echo $url . '#commentForm'?>"><span data-toggle='tooltip' title='<?php printf($lang->article->lblComments, $article->comments);?>'><i class="icon-comments-alt"></i> <?php echo $article->comments;?></span></a><?php endif;?>
            <?php 
              if(isset($config->blog->showCategory) and $config->blog->showCategory)
              {
                if($config->blog->categoryLevel == 'first')
                {
                    echo "<span>[";
                    echo ($config->blog->categoryName == 'full' or empty(zget($topCategoryList, $article->category->id)->abbr)) ? zget($topCategoryList, $article->category->id)->name : zget($topCategoryList, $article->category->id)->abbr;
                    echo "]</span>";
                }
                else
                {
                    echo "<span>[";
                    echo ($config->blog->categoryName == 'full' or empty($article->category->abbr)) ? $article->category->name : $article->category->abbr;
                    echo "]</span>";
                } 
              }            
            ?>
          </div>
        </div>
      <?php endforeach;?>
      <div class='clearfix pager'><?php $pager->show('right', 'short');?></div>
    </div>
    <div class='row blocks' data-region='blog_index-bottom'><?php $this->block->printRegion($layouts, 'blog_index', 'bottom', true);?></div>
  </div>
  <?php if(!empty($layouts['blog_index']['side']) and !(empty($sideFloat) || $sideFloat === 'hidden')):?>
  <div class='col-md-<?php echo $sideGrid ?> col-side'>
    <side class='page-side'>
      <div class='blocks' data-region='blog_index-side'><?php $this->block->printRegion($layouts, 'blog_index', 'side');?></div>
    </side>
  </div>
  <?php endif;?>
</div>
<div class='row'><?php $this->block->printRegion($layouts, 'blog_index', 'bottomBanner', true);?></div>
<?php include TPL_ROOT . 'blog/footer.html.php';?>
