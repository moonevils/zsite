{*php
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
/php*}
{$themeRoot = $model->config->webRoot . 'theme/'}
{$content  = json_decode($block->content)}
{$method   = 'get' . ucfirst(str_replace('article', '', strtolower($block->type)))}
{$articles = $model->loadModel('article')->$method(empty($content->category) ? 0 : $content->category, $content->limit)}
{$articles = $model->loadModel('article')->computeComments($articles)}
{if(isset($content->image))} {$articles = $model->loadModel('file')->processImages($articles, 'article')} {/if}
{noparse}
<style>
#block{$block->id} .card .thumbnail-cell {padding-left: 8px; padding-right: 0}
#block{$block->id} .card .table-cell + .thumbnail-cell {padding-right: 8px; padding-left: 0}
</style>
{/noparse}
<div id="block{$block->id}" class='panel panel-block {$blockClass}'>
  {if(isset($content->image))}
    {$imageURL = !empty($content->imageSize) ? $content->imageSize . 'URL' : 'smallURL'}
    <div class='panel-body'>
      <div class='block-title'>
        <strong class="vertical-center block-title-align">
          {if(empty($icon))}
          <span class='vertical-line'></span>
          {else}
          {!$icon}
          {/if}
          <span class="block-title-text">{!$block->title}</span>
        </strong>
        {if(isset($content->moreText) and isset($content->moreUrl))}
        <div class='pull-right'>{!html::a($content->moreUrl, $content->moreText)}</div>
        {/if}
      </div>

      <div class='list'>
      {foreach($articles as $article)}
        {$url = helper::createLink('article', 'view', "id=$article->id", "category={{$article->category->alias}}&name=$article->alias")}
        <div class='item vertical-center article-align'>
          {if($content->imagePosition == 'left')}
          <div class='article-img' style="margin-right: 10px">
            {if(!empty($article->image))}
            {$thumbnailTitle    = $article->image->primary->title ? $article->image->primary->title : $article->title}
            {$article->image->primary->objectType = 'article'}
            {$thumbnailLink     = html::a($url, html::image($model->loadModel('file')->printFileURL($article->image->primary, $imageURL), "title='{{$thumbnailTitle}}' class='thumbnail'" ))}
            {$thumbnail = "<div class='table-cell thumbnail-cell' style='max-width: 100%;'>{{$thumbnailLink}}</div>"}
            {$thumbnail}
            {/if}
          </div>
          {/if}
          <div class="article-content">
            <div class='vertical-start'>
              <strong class="article-title">
                <label class="label-hot vertical-center">{$lang->block->article->hot}</label>
                {!html::a($url, $article->title, "style='color:{{$article->titleColor}}'")}
                {if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')))}<span class='text-danger'><i class="icon icon-arrow-up"></i></span> {/if}
              </strong>
            </div>
            <div class='article-ext'>
              <span class='views'>
                {$article->views}{$lang->block->article->views}
              </span>
              <span class='comments'>
                <i class="icon-chat-dot"></i>&nbsp;{$article->comments}
              </span>
              <span class="category">
                {if(isset($content->showCategory) and $content->showCategory == 1)}
                  {if($content->categoryName == 'abbr')}
                    {$categoryName = $article->category->abbr ? $article->category->abbr : $article->category->name}
                    {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), $categoryName)}
                  {else}
                    {$article->category->name}
                  {/if}
                {/if}
              </span>
            </div>
          </div>
          {if($content->imagePosition == 'right')}
          <div class='article-img'>
            {if(!empty($article->image))}
            {$thumbnailTitle    = $article->image->primary->title ? $article->image->primary->title : $article->title}
            {$article->image->primary->objectType = 'article'}
            {$thumbnailLink     = html::a($url, html::image($model->loadModel('file')->printFileURL($article->image->primary, $imageURL), "title='{{$thumbnailTitle}}' class='thumbnail'" ))}
            {$thumbnail = "<div class='table-cell thumbnail-cell' style='max-width: 100%;'>{{$thumbnailLink}}</div>"}
            {$thumbnail}
            {/if}
          </div>
          {/if}
        </div>
        <div class='divider'></div>
        {/foreach}
      </div>
    </div>
  {else}
    <div class='panel-body no-padding'>
      <div class='list-group simple'>
        {foreach($articles as $article)}
          {$alias = "category={{$article->category->alias}}&name={{$article->alias}}"}
          {$url   = helper::createLink('article', 'view', "id={{$article->id}}", $alias)}
          {if(isset($content->time))}
          <div class='list-group-item'>
            {if(isset($content->showCategory) and $content->showCategory == 1)}
              {if($content->categoryName == 'abbr')}
                {$categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] '}
                {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), $categoryName, "class='text-special'")}
              {else}
                {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), '[' . $article->category->name . '] ', "class='text-special'")}
              {/if}
            {/if}
            {$bold = ''}
            {if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')) and $article->stickBold)}{$bold = 'font-weight:bold;'}{/if}
            {!html::a($url, $article->title, "title='{{$article->title}}' style='{{$bold}}color:{{$article->titleColor}}'")}
            {if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')))}<span class='text-danger'><i class="icon icon-arrow-up"></i></span> {/if}
            <span class='pull-right text-muted'>{!substr($article->addedDate, 0, 10)}</span>
          </div>
          {else}
          <div class='list-group-item'>
            {if(isset($content->showCategory) and $content->showCategory == 1)}
              {if($content->categoryName == 'abbr')}
                {$categoryName = '[' . ($article->category->abbr ? $article->category->abbr : $article->category->name) . '] '}
                {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), $categoryName, "class='text-special'")}
              {else}
                {!html::a(helper::createLink('article', 'browse', "categoryID={{$article->category->id}}", "category={{$article->category->alias}}"), '[' . $article->category->name . '] ', "class='text-special'")}
              {/if}
            {/if}
            {$bold = ''}
            {if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')) and $article->stickBold)}{$bold = 'font-weight:bold;'}{/if}
            {!html::a($url, $article->title, "title='{{$article->title}}' style='{{$bold}}color:{{$article->titleColor}}'")}
            {if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')))}<span class='text-danger'><i class="icon icon-arrow-up"></i></span>{/if}
          </div>
          {/if}
        {/foreach}
      </div>
    </div>
  {/if}
</div>
