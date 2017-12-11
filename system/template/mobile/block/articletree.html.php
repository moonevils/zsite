{*php*}
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
{*/php*}
{*php*}
$control->loadModel('tree');
$block->content  = json_decode($block->content);
$type            = str_replace('tree', '', strtolower($block->type));
$browseLink      = $type == 'article' ? 'createBrowseLink' : 'create' . ucfirst($type) . 'BrowseLink';
$startCategory = 0;
if(isset($block->content->fromCurrent) and $block->content->fromCurrent)
{
    if($type == 'article' and $control->app->getModuleName() == 'article' and $control->session->articleCategory)
    {
        $category = $control->tree->getByID($control->session->articleCategory);
        $startCategory = $category->parent;
    }

    if($type == 'blog' and $control->app->getModuleName() == 'blog' and $control->session->articleCategory)
    {
        $category = $control->tree->getByID($control->session->articleCategory);
        $startCategory = $category->parent;
    }

    if($type == 'product' and $control->app->getModuleName() == 'product' and $control->session->productCategory)
    {
        $category = $control->tree->getByID($control->session->productCategory);
        $startCategory = $category->parent;
    }
}
{*/php*}
{if($block->content->showChildren)}
{$treeMenu = $control->tree->getTreeMenu($type, $startCategory, array('treeModel', $browseLink))}
<div id="block{!echo $block->id}" class='panel panel-block panel-block-article-tree {!echo $blockClass}'>
  <div class='panel-heading'>
    <strong>{!echo $icon . $block->title}</strong>
  </div>
  <div class='panel-body'>{!echo $treeMenu}</div>
</div>
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
{else}
{$topCategories = $control->tree->getChildren($startCategory, $type)}
<div id="block{!echo $block->id?>" class='panel panel-block panel-block-article-tree {!echo $blockClass}'>
  <div class='panel-heading'>
    <strong>{!echo $icon . $block->title}</strong>
  </div>
  <div class='panel-body no-padding'>
    <ul class='nav'>
{*php*}
      foreach($topCategories as $topCategory)
      {
          $browseLink = helper::createLink($type, 'browse', "categoryID={$topCategory->id}", "category={$topCategory->alias}");
          if($type == 'blog') $browseLink = helper::createLink('blog', 'index', "categoryID={$topCategory->id}", "category={$topCategory->alias}");
          echo '<li>' . html::a($browseLink, "<i class='icon-folder-close-alt '></i> &nbsp;" . $topCategory->name, "id='category{$topCategory->id}'") . '</li>';
      }
{*/php*}
    </ul>
  </div>
</div>
{/if}
