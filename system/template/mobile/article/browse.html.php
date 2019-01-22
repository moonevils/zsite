{*
/**
 * The browse view file of article for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
{$path = array_keys($category->pathNames)}
{!js::import($jsRoot . 'cookie.js')}
{!js::set('path', $path)}
{!js::set('categoryID', $category->id)}
{!js::set('pageLayout', $control->block->getLayoutScope('article_browse', $category->id))}
{if(isset($articleList))}
  <script>{!echo "place" . md5(time()). "='" . $config->idListPlaceHolder . $articleList . $config->idListPlaceHolder . "';"}</script>
{else}
  <script>{!echo "place" . md5(time()) . "='" . $config->idListPlaceHolder . '' . $config->idListPlaceHolder . "';"}</script>
{/if}
<div class='block-region blocks region-top' data-region='article_browse-top'>{$control->loadModel('block')->printRegion($layouts, 'article_browse', 'top')}</div>
<div class='panel panel-section panel-category-article'>
  <div class='block-title vertical-center'>
    <strong class="vertical-center block-title-align">
      <span class='vertical-line'></span>
      <span class="block-title-text">{!$category->name}</span>
    </strong>
    <div class="order-time vertical-center">
      {$lang->article->orderBy->time}&nbsp;
      <div class="order-triangle">
        <span class="up-triangle"></span>
        <span class="down-triangle"></span>
      </div>
    </div>
    <div class="order-hot vertical-center">
      {$lang->article->orderBy->hot}&nbsp;
      <div class="order-triangle">
        <span class="up-triangle"></span>
        <span class="down-triangle"></span>
      </div>
    </div>
  </div>
  <div class='list' id='articles'>
    {$imageURL = !empty($content->imageSize) ? $content->imageSize . 'URL' : 'smallURL'}
    {@$i=0}
    {foreach($articles as $article)}
      {if($pageID > 1)}
      <div class='divider'></div>
      {/if}
      {@$i++}
      {$url = helper::createLink('article', 'view', "id=$article->id", "category={{$article->category->alias}}&name=$article->alias")}
      <div class='article-item vertical-center article-align'>
        <div class="article-content">
          <div class='vertical-start'>
            <strong class="article-title">
              <label class="label-hot vertical-center">{$lang->article->hot}</label>
              {!html::a($url, $article->title, "style='color:{{$article->titleColor}}'")}
              {if($article->sticky && (!formatTime($article->stickTime) || $article->stickTime > date('Y-m-d H:i:s')))}<span class='text-danger'><i class="icon icon-arrow-up"></i></span> {/if}
            </strong>
          </div>
          <div class='article-ext'>
            <span class='views'>
              {$article->views}{$lang->article->views}
            </span>
            <span class='comments'>
              {!html::a($url, html::image('/theme/mobile/default/comments.png'))}&nbsp;{$article->comments}
            </span>
            <span class='pub-time'>
              {$pubTime = strtotime($article->addedDate)}
              {$pubTimeLen = time() - $pubTime}
              {if($pubTimeLen > 86400)}
                {!substr($article->addedDate, 0, 10)}
              {else}
                {$minute = floor($pubTimeLen / 60)}
                {$hour = floor($pubTimeLen / 3600)}
                {if($hour == 0)}
                  {!$minute == 1 ? $lang->article->oneMinuteAgo : $minute . $lang->article->minutesAgo}
                {else}
                  {!$hour == 1 ? $lang->article->oneHourAgo : $hour . $lang->article->hoursAgo}
                {/if}
              {/if}
            </span>
          </div>
        </div>
        <div class='article-img'>
          {if(!empty($article->image))}
          {$title = $article->image->primary->title ? $article->image->primary->title : $article->title}
          {$article->image->primary->objectType = 'article'}
          {!html::image($control->loadModel('file')->printFileURL($article->image->primary, 'smallURL'), "title='{{$title}}' class='thumbnail'")}
          {/if}
        </div>
      </div>
      {if($i < count($articles))}
      <div class='divider'></div>
      {/if}
    {/foreach}
  </div>
</div>

{$pager->createPullUpJS('#articles', $lang->mobile->pullUpHint)}

<div class='block-region blocks region-bottom' data-region='article_browse-bottom'>{$control->loadModel('block')->printRegion($layouts, 'article_browse', 'bottom')}</div>

{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
