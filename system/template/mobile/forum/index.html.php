{*php*}
/**
 * The index view file of forum for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     forum
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
{*/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<div class='block-region region-top blocks' data-region='forum_index-top'>{$control->loadModel('block')->printRegion($layouts, 'forum_index', 'top')}</div>
<div id='boards'>
{foreach($boards as $parentBoard)}
<div class='panel-section'>
  <div class='panel-heading page-header'>
    <div class='title'><i class='icon icon-comments'></i> <strong>{!echo $parentBoard->name}</strong></div>
  </div>
  <div class='panel-body'>
    <div class='cards cards-list'>
    {foreach($parentBoard->children as $childBoard)}
{*php*}
      $isNewBoard = $control->forum->isNew($childBoard);
      $moderators = '';
      foreach($childBoard->moderators as $moderator)
      {
          if(!empty($moderator))
          {
              $moderators .= $moderator . ' ';
          }
      }
{*/php*}
      <a class='card' href='{!echo inlink('board', "id=$childBoard->id", "category={$childBoard->alias}")}'>
        <div class='table-layout'>
          <div class='table-cell'>
            <div class='card-heading'>
              <h5>
{*php*}
                echo $childBoard->name;
                if(!empty($moderators)) printf('<small>' . $lang->forum->lblOwner . '</small>', $moderators);
{*/php*}
              </h5>
            </div>
            <div class='card-content text-muted small'>{!echo $childBoard->desc}</div>
{*php*}
            if($childBoard->postedBy)
            {
                echo "<div class='card-footer small text-muted'>{$lang->forum->lastPost}: ";
                echo substr($childBoard->postedDate, 5, -3) . " {$childBoard->postedByRealname}";
                echo '</div>';
            }
{*/php*}
          </div>
          <div class='table-cell middle thumbnail-cell text-right'>
            <div class='counter text-center'><div class='title{if($isNewBoard) echo ' text-success'}'>{!echo $childBoard->threads}</div><div class='caption text-muted small'>{!echo $lang->forum->threadCount}</div></div>
          </div>
        </div>
      </a>
    {/foreach}
    </div>
  </div>
</div>
{/foreach}
</div>
<div class='block-region region-bottom blocks' data-region='forum_index-bottom'>{$control->loadModel('block')->printRegion($layouts, 'forum_index', 'bottom')}</div>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
