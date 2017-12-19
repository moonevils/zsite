{*
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
*}
{$themeRoot = $model->config->webRoot . 'theme/'}

{$content  = json_decode($block->content)}
{$method   = 'get' . ucfirst(str_replace('article', '', strtolower($block->type)))}
{$articles = $model->loadModel('article')->$method(empty($content->category) ? 0 : $content->category, !empty($content->limit) ? $content->limit : 6)}
{if(isset($content->image))} {$articles = $model->loadModel('file')->processImages($articles, 'article')} {/if}
<div id="block{!echo $block->id}" class='panel panel-block {!echo $blockClass}'>
  <div class='panel-heading'>
    <strong>{!echo $icon . $block->title}</strong>
    {if(isset($content->moreText) and isset($content->moreUrl))}
      <div class='pull-right'>{!html::a($content->moreUrl, $content->moreText)}</div>
    {/if}
  </div>
  {if(isset($content->image))}
  {$pull     = $content->imagePosition == 'right' ? 'pull-right' : 'pull-left'}
  {$imageURL = !empty($content->imageSize) ? $content->imageSize . 'URL' : 'smallURL'}
  <div class='panel-body'>
    <div class='items'>
    {foreach($articles as $article)}
      {$url = helper::createLink('article', 'view', "id=$article->id", "category={{$article->category->alias}}&name=$article->alias")}
      <div class='item'>
        <div class='item-heading'>
          {if($article->sticky)}<span class='red'><i class="icon icon-arrow-up"></i></span>{/if}
          {if(isset($content->showCategory) and $content->showCategory == 1)}
            {if($content->categoryName == 'abbr')}
              $blockContent    = json_decode($block->content);
              $blockCategories = '';
              {if(isset($blockContent->category))} {$blockCategories = $blockContent->category} {/if}
       
              $categoryName = $article->category->name;
              {foreach($article->categories as $id => $category)}
                {if(strpos(",$blockCategories,", ",$id,") !== false)}
                   {$categoryName = $category->name}
                   {break}
                {/if}
              {/foreach}
     
              {$categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $categoryName) . '] '}
              {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), $categoryName)}
            {else}
              {!echo '[' . $article->category->name . '] '}
            {/if}
          {/if}
          <strong>{!html::a($url, $article->title, "style='color: {{$article->titleColor}}'")}</strong>
        </div>
        <div class='item-content'>
          
          <div class='text small text-muted'>
            <div class='media {!echo $pull}' style="max-width: {!echo !empty($content->imageWidth) ? $content->imageWidth . 'px' : '100px'}">
            {if(!empty($article->image))}
                {$title = $article->image->primary->title ? $article->image->primary->title : $article->title}
                {!html::a($url, html::image($model->loadModel('file')->printFileURL($article->image->primary->pathname, $article->image->primary->extension, 'article', $imageURL), "title='$title' class='thumbnail'" ))}
            {/if}
            </div>
            <strong class='text-important text-nowrap'>
              {if(isset($content->time))} {!echo "<i class='icon-time'></i> " . formatTime($article->addedDate, DT_DATE4)} {/if}
            </strong> 
            {!echo $article->summary}
          </div>
        </div>
      </div>
    {/foreach}
    </div>
  </div>
  {else}
  <div class='panel-body'>
    <ul class='ul-list'>
      {foreach($articles as $article)}
        {$categoryAlias = isset($article->category->alias) ? $article->category->alias : ''}
        {$alias       = "category={{$categoryAlias}}&name={{$article->alias}}"}
        {$url         = helper::createLink('article', 'view', "id=$article->id", $alias)}
      {if(isset($content->time))}
      <li class='addDataList'>
        <span>
        {if(isset($content->showCategory) and $content->showCategory == 1)}
        {if($content->categoryName == 'abbr')}

        $blockContent    = json_decode($block->content);
        $blockCategories = '';
        if(isset($blockContent->category)) $blockCategories = $blockContent->category;

        $categoryName = '';
        foreach($article->categories as $id => $categorie)
        {
            if(strpos(",$blockCategories,", ",$id,") !== false) 
            {
                $categoryName = $categorie->name;
                break;
            }
        }

        {$categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $categoryName) . '] '}
        {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$categoryAlias}}"), $categoryName)}
        {else}
        {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), '[' . $article->category->name . '] ')}
        {/if}
        {/if}
        {!html::a($url, $article->title, "title='{{$article->title}}' style='color:{{$article->titleColor}}'")}
        {if($article->sticky)}<span class='red'><i class="icon icon-arrow-up"></i></span>{/if}
        </span>
        <span class='pull-right'>{!echo substr($article->addedDate, 0, 10)}</span>
      </li>
      {else}
      <li class='notDataList'>
        {if(isset($content->showCategory) and $content->showCategory == 1)}
        {if($content->categoryName == 'abbr')}

        $blockCntent     = json_decode($block->content);
        $blockCategories = '';
        if(isset($blockCntent->category)) $blockCategories = $blockCntent->category;

        $categoryName = '';
        foreach($article->categories as $id => $categorie)
        {
            if(strpos(",$blockCategories,", ",$id,") !== false) 
            {
                $categoryName = $categorie->name;
                break;
            }
        }

        {$categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $categoryName) . '] '}
          {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), $categoryName)}
        {else}
          {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), '[' . $article->category->name . '] ')}
        {/if}
        {/if}
        {!html::a($url, $article->title, "title='{{$article->title}}' style='color:{{$article->titleColor}}'")}
        <span>{if($article->sticky)}<span class='red'><i class="icon icon-arrow-up"></i></span>{/if}</span>
      </li>
      {/if}
      
      {/foreach}
    </ul>
  </div>
  {/if}
</div>
{noparse}
<style>
    .ul-list .addDataList.withStick{padding-right:126px !important;}
    .ul-list .addDataList.withoutStick{padding-right:80px !important;}
    .ul-list .notDataList.withStick{padding-right:60px !important;}
    .ul-list .notDataList.withoutStick{padding-right:5px !important;}
</style>
{/noparse}

