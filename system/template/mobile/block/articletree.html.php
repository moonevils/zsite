{*php
/**
 * The category front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
/php*}
{$model->loadModel('tree')}
{$block->content  = json_decode($block->content)}
{$type            = str_replace('tree', '', strtolower($block->type))}
{$browseLink      = $type == 'article' ? 'createBrowseLink' : 'create' . ucfirst($type) . 'BrowseLink'}
{$startCategory = 0}
{if(isset($block->content->fromCurrent) and $block->content->fromCurrent)}
    {if($type == 'article' and $model->app->getModuleName() == 'article' and $model->session->articleCategory)}
      {$category = $model->tree->getByID($model->session->articleCategory)}
      {$startCategory = $category->parent}
    {/if}

    {if($type == 'blog' and $model->app->getModuleName() == 'blog' and $model->session->articleCategory)}
      {$category = $model->tree->getByID($model->session->articleCategory)}
      {$startCategory = $category->parent}
    {/if}

    {if($type == 'product' and $model->app->getModuleName() == 'product' and $model->session->productCategory)}
      {category = $model->tree->getByID($model->session->productCategory)}
      {startCategory = $category->parent}
    {/if}
{/if}
{if($block->content->showChildren)}
  {$treeMenu = $model->tree->getTreeMenu($type, $startCategory, array('treeModel', $browseLink))}
  <div id="block{$block->id}" class='panel panel-block panel-block-article-tree {$blockClass}'>
    <div class='panel-heading'>
      <strong>{!echo $icon . $block->title}</strong>
    </div>
    <div class='panel-body'>{$treeMenu}</div>
  </div>
  {noparse}
  <style>
  .tree {padding: 0; margin: 0;}
  .tree li,.tree ul {margin: 0; padding: 0; display: block; position: relative;}
  .tree > li {font-weight: 400; padding-bottom: 8px;}
  .tree > li > ul li {padding: 3px 15px; margin: 0;}
  .tree li:before {display: inline-block; margin-right: 8px; content: '\e6ec'; font-family: ZenIcon; color: #ddd;}
  .tree > li ul {border-left: 1px dashed #ccc; margin-left: 7px; font-weight: normal;}
  .tree > li ul > li:before {content: '\e6e8';}
  .tree > li ul > li:hover:before {content: '\e6ec';}
  .tree > li ul > li:after {position: absolute; display: block; content: ""; width: 15px; left: -1px; top: 12px; height: 20px; border-top: 1px dashed #ccc;}
  .tree > li > ul li:last-child:after {border-left: 1px solid #fff;}
  </style>
  {/noparse}
{else}
  {$topCategories = $model->tree->getChildren($startCategory, $type)}
  <div id="block{$block->id}" class='panel panel-block panel-block-article-tree {$blockClass}'>
    <div class='panel-heading'>
      <strong>{!echo $icon . $block->title}</strong>
    </div>
    <div class='panel-body no-padding'>
      <ul class='nav'>
        {foreach($topCategories as $topCategory)}
          {$browseLink = helper::createLink($type, 'browse', "categoryID={{$topCategory->id}}", "category={{$topCategory->alias}}")}
          {if($type == 'blog')} {$browseLink = helper::createLink('blog', 'index', "categoryID={{$topCategory->id}}", "category={{$topCategory->alias}}")} {/if}
          <li>{!html::a($browseLink, "<i class='icon-folder-close-alt '></i> &nbsp;" . $topCategory->name, "id='category{{$topCategory->id}}'")}</li>
        {/foreach}
      </ul>
    </div>
  </div>
{/if}
