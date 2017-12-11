{*php*}
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
{*/php*}
{*php*}
/* Set $themRoot. */
$themeRoot = $control->config->webRoot . 'theme/';

/* Decode the content and get articles. */
$content  = json_decode($block->content);
$method   = 'get' . ucfirst(str_replace('blog', '', strtolower($block->type)));
$articles = $control->loadModel('article')->$method(empty($content->category) ? 0 : $content->category, $content->limit, 'blog');
if(isset($content->image)) $articles = $control->loadModel('file')->processImages($articles, 'blog');
{*/php*}
<style>
#block{!echo $block->id} .card .thumbnail-cell {padding-left: 8px; padding-right: 0}
#block{!echo $block->id} .card .table-cell + .thumbnail-cell {padding-right: 8px; padding-left: 0}
</style>
<div id="block{!echo $block->id}" class='panel panel-block {!echo $blockClass}'>
  <div class='panel-heading'>
    <strong>{!echo $icon . $block->title}</strong>
    {if(!empty($content->moreText) and !empty($content->moreUrl))}
    <div class='pull-right'>{!echo html::a($content->moreUrl, $content->moreText)}</div>
    {/if}
  </div>
  {if(isset($content->image))}
  {$imageURL = !empty($content->imageSize) ? $content->imageSize . 'URL' : 'smallURL'}
  <div class='panel-body no-padding'>
    <div class='cards condensed cards-list'>
{*php*}
    foreach($articles as $article):
    $url = helper::createLink('blog', 'view', "id=$article->id", "category={$article->category->alias}&name=$article->alias");
{*/php*}
      <div class='card'>
        <div class='card-heading'>
          {if(isset($content->showCategory) and $content->showCategory == 1)}
          {if($content->categoryName == 'abbr')}
          {$categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] '}
          {!echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName, "class='text-special'")}
          {else}
          {!echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . ']', "class='text-special'")}
          {/if}
          {/if}
          {if($article->sticky)}<span class='red'><i class="icon icon-arrow-up"></i></span>{/if}
          <strong>{!echo html::a($url, $article->title, "style='color:{$article->titleColor}'")}</strong>
        </div>
        <div class='table-layout'>
{*php*}
          if(!empty($article->image))
          {
              $thumbnailTitle = $article->image->primary->title ? $article->image->primary->title : $article->title;
              $thumbnailLink = html::a($url, html::image($control->loadModel('file')->printFileURL($article->image->primary->pathname, $article->image->primary->extension, 'article', $imageURL), "title='{$thumbnailTitle}' class='thumbnail'" ));
              $thumbnailMaxWidth = !empty($content->imageWidth) ? $content->imageWidth . 'px' : '60px';
              $thumbnail = "<div class='table-cell thumbnail-cell' style='max-width: {$thumbnailMaxWidth};'>{$thumbnailLink}</div>";
              if($content->imagePosition == 'left') echo $thumbnail;
          }
{*/php*}
          <div class='table-cell'>
            <div class='card-content text-muted small'>
              <strong class='text-important'>{if(isset($content->time)) echo "<i class='icon-time'></i> " . formatTime($article->addedDate, DT_DATE4)}</strong> &nbsp;{!echo $article->summary}
            </div>
          </div>
          {if(isset($thumbnail) && $content->imagePosition == 'right') echo $thumbnail}
        </div>
      </div>
      {/foreach}
    </div>
  </div>
  {else}
  <div class='panel-body no-padding'>
    <div class='list-group simple'>
      {foreach($articles as $article)}
{*php*}
      $alias = "category={$article->category->alias}&name={$article->alias}";
      $url   = helper::createLink('blog', 'view', "id={$article->id}", $alias);
{*/php*}
      {if(isset($content->time))}
      <div class='list-group-item'>
        {if(isset($content->showCategory) and $content->showCategory == 1)}
        {if($content->categoryName == 'abbr')}
        {$categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] '}
        {!echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName, "class='text-special'")}
        {else}
        {!echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ', "class='text-special'")}
        {/if}
        {/if}
        {!echo html::a($url, $article->title, "title='{$article->title}' style='color:{$article->titleColor}'")}
        <span class='pull-right text-muted'>{!echo substr($article->addedDate, 0, 10)}</span>
      </div>
      {else}
      <div class='list-group-item'>
        {if(isset($content->showCategory) and $content->showCategory == 1)}
        {if($content->categoryName == 'abbr')}
        {$categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] '}
        {!echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), $categoryName, "class='text-special'")}
        {else}
        {!echo html::a(helper::createLink('blog', 'index', "categoryID={$article->category->id}", "category={$article->category->alias}"), '[' . $article->category->name . '] ', "class='text-special'")}
        {/if}
        {/if}
        {!echo html::a($url, $article->title, "title='{$article->title}' style='color:{$article->titleColor}'")}
      </div>
      {/if}
      
      {/foreach}
    </div>
  </div>
  {/if}
</div>
