{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'header')}
<div class='row blocks' data-grid='4' data-region='forum_index-top'>{$control->block->printRegion($layouts, 'forum_index', 'top', true)}</div>
{$common->printPositionBar($control->app->getModuleName())}
<div id='boards'>
{foreach($boards as $parentBoard)}
  <div class='panel'>
    <div class='panel-heading'>
      <strong><i class='icon-comments icon-large'></i> {!echo $parentBoard->name}</strong>
    </div>
    <table class='table table-hover table-striped'>
      <thead>
        <tr class='text-center hidden-xxxs'>
          <th colspan='2'>&nbsp;{!echo $lang->forum->board}</th>
          <th class='hidden-xs'>{!echo $lang->forum->owners}</th>
          <th>{!echo $lang->forum->threadCount}</th>
          <th class='hidden-xxs'>{!echo $lang->forum->postCount}</th>
          <th class='hidden-xs'>{!echo $lang->forum->lastPost}</th>
        </tr>  
      </thead>
      <tbody>
        {foreach($parentBoard->children as $childBoard)}
        <tr class='text-center text-middle'>
          <td class='w-20px'>{!echo $control->forum->isNew($childBoard) ? "<span class='text-success'><i class='icon-comment icon-large'></i></span>" : "<span class='text-muted'><i class='icon-comment icon-large'></i></span>"}</td>
          <td class='text-left'>
            <strong>{!echo html::a(inlink('board', "id=$childBoard->id", "category={$childBoard->alias}"), $childBoard->name)}</strong><br />
            <small class='text-muted'>{!echo $childBoard->desc}</small>
          </td>
          <td class='w-120px hidden-xs'><strong><nobr>{foreach($childBoard->moderators as $moderators) echo $moderators . ' '}</nobr></strong></td>
          <td class='w-70px hidden-xxxs'>{!echo $childBoard->threads}</td>
          <td class='w-70px hidden-xxs'>{!echo $childBoard->posts}</td>
          <td class='w-150px hidden-xs'>
            <?php
            if($childBoard->postedBy)
            {
                echo substr($childBoard->postedDate, 5, -3) . '<br/>'; 
                echo html::a($control->createLink('thread', 'locate', "threadID={$childBoard->postID}&replyID={$childBoard->replyID}"), $childBoard->postedByRealname);
            }
            ?>
          </td>
        </tr>
        {/foreach}
      </tbody>
    </table>
  </div>
{/foreach}
</div>
<div class='blocks' data-region='forum_index-bottom'>{$control->block->printRegion($layouts, 'forum_index', 'bottom')}</div>
{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer')}
