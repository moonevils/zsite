{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'header')}
<div class='row blocks' data-grid='4' data-region='forum_index-top'>{$control->block->printRegion($layouts, 'forum_index', 'top', true)}</div>
{$common->printPositionBar($control->app->getModuleName())}

<ul class='nav nav-pills'>
  <li {if($mode == 'board')}  {!echo "class='active'"} {/if}>{!echo html::a(inlink('index', "mode=board"),  $lang->forum->indexModeOptions['board'])}</li>
  <li {if($mode == 'latest')} {!echo "class='active'"} {/if}>{!echo html::a(inlink('index', "mode=latest"), $lang->forum->indexModeOptions['latest'])}</li>
  <li {if($mode == 'stick')}  {!echo "class='active'"} {/if}>{!echo html::a(inlink('index', "mode=stick"),  $lang->forum->indexModeOptions['stick'])}</li>
</ul>
{if($mode == 'latest' or $mode == 'stick')}
  <div class='panel'>
    <table class='table table-hover table-striped'>
      <thead>
        <tr class='text-center hidden-xxxs'>
          <th>{!echo $lang->thread->title}</th>
          <th class='w-150px hidden-xxs'>{!echo $lang->thread->author}</th>
          <th class='w-100px hidden-xs'>{!echo $lang->thread->postedDate}</th>
          <th class='w-50px hidden-xs'>{!echo $lang->thread->views}</th>
          <th class='w-50px'>{!echo $lang->thread->replies}</th>
          <th class='w-200px hidden-sm hidden-xs'>{!echo $lang->thread->lastReply}</th>
        </tr>  
      </thead>
      <tbody>
        {foreach($threads as $thread)}
        {$style = $thread->color ? "style='color:{{$thread->color}}'" : ''}
        <tr class='text-center'>
          <td class='text-left'>
            {!echo ($mode == 'latest' && $thread->isNew) ? "<i class='icon-comment-alt icon-large text-success'> </i>" : "<i class='icon-comment-alt icon-large text-muted'> </i>"}
            <span data-ve='thread' id='thread{!echo $thread->id}'>{!echo '[' . zget($boards, $thread->board, $thread->board). '] ' . html::a($control->createLink('thread', 'view', "id=$thread->id"), $thread->title, $style)}</span>
          </td>
          <td class='hidden-xxs'><strong>{!echo $thread->authorRealname}</strong></td>
          <td class='hidden-xs'>{!echo substr($thread->addedDate, 5, -3)}</td>
          <td class='hidden-xs'>{!echo $thread->views}</td>
          <td class='hidden-xxxs'>{!echo $thread->replies}</td>
          <td class='hidden-sm hidden-xs'>
          {if($thread->replies)}
            {!echo substr($thread->repliedDate, 5, -3) . ' '}
            {!echo html::a($control->createLink('thread', 'locate', "threadID={{$thread->id}}&replyID={{$thread->replyID}}"), $thread->repliedByRealname)}
          {/if}
          </td>  
        </tr>  
        {/foreach}
      </tbody>
      <tfoot>
        <tr><td colspan='7'>{$pager->show('right', 'short')}</td></tr>
      </tfoot>
    </table>
  </div>
{else}
  <div id='boards'>
    {foreach($boards as $parentBoard)}
    <div class='panel'>
      <table class='table table-hover table-striped'>
        <thead>
          <tr class='text-center hidden-xxxs'>
            <th class='text-left'><i class='icon-comments icon-large'> </i>{!echo $parentBoard->name}</th>
            <th class='hidden-xs'>{!echo $lang->forum->owners}</th>
            <th>{!echo $lang->forum->threadCount}</th>
            <th class='hidden-xxs'>{!echo $lang->forum->postCount}</th>
            <th class='hidden-xs'>{!echo $lang->forum->lastPost}</th>
          </tr>  
        </thead>
        <tbody>
          {foreach($parentBoard->children as $childBoard)}
          <tr class='text-center text-middle'>
            <td class='text-left'>
              {!echo $control->forum->isNew($childBoard) ? "<i class='icon-comment icon-large text-success'> </i>" : "<i class='icon-comment icon-large text-muted'> </i>"}
              {!echo html::a(inlink('board', "id=$childBoard->id", "category={{$childBoard->alias}}"), $childBoard->name)}<br />
              <small class='text-muted'>{!echo $childBoard->desc}</small>
            </td>
            <td class='w-120px hidden-xs'><strong><nobr>{foreach($childBoard->moderators as $moderators)} {!echo $moderators . ' '} {/foreach}</nobr></strong></td>
            <td class='w-70px hidden-xxxs'>{!echo $childBoard->threads}</td>
            <td class='w-70px hidden-xxs'>{!echo $childBoard->posts}</td>
            <td class='w-150px hidden-xs'>
              {if($childBoard->postedBy)}
                  {!echo substr($childBoard->postedDate, 5, -3) . '<br/>'}
                  {!echo html::a($control->createLink('thread', 'locate', "threadID={{$childBoard->postID}}&replyID={{$childBoard->replyID}}"), $childBoard->postedByRealname)}
              {/if}
            </td>
          </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
    {/foreach}
  </div>
{/if}
<div class='blocks' data-region='forum_index-bottom'>{$control->block->printRegion($layouts, 'forum_index', 'bottom')}</div>
{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer')}
