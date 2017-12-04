<div class='panel thread'>
  <div class='panel-heading'>
    <i class='icon-comment-alt pull-left'></i>
    <div class='panel-actions'>
      {if($thread->readonly)} {!echo "<span class='label'><i class='icon-lock'></i> " . $lang->thread->readonly . "</span> &nbsp;"} {/if}
    </div>
    <strong>{!echo $thread->title}</strong>
    <div class='text-muted'>{!echo $thread->addedDate}</div>
  </div>
  <table class='table'>
    <tr>
      <td class='speaker'>
        {if(isset($speakers[$thread->author]))}
          {$control->thread->printSpeaker($speakers[$thread->author])}
        {else}
            {!echo $thread->author}
        {/if}
      </td>
      <td id='{!echo $thread->id}' class='thread-wrapper'>
        <div class='thread-content article-content'>{!echo $thread->content}</div>
        {if(!empty($thread->files))}
        <div class='article-files'>{$control->thread->printFiles($thread, $control->thread->canManage($board->id, $thread->author))}</div>
        {/if}
      </td>
    </tr>
  </table>
  <div class='thread-foot'>
    {if(commonModel::isAvailable('score') and !empty($thread->scoreSum))}
    <span >{!echo sprintf($lang->thread->scoreSum, $thread->scoreSum)}</span>
    {/if}
    {if($thread->editor)}
    <small class='text-muted'>{!printf($lang->thread->lblEdited, $thread->editorRealname, $thread->editedDate)}</small>
    {/if}
    <div class='pull-right thread-actions'>
      {if($control->app->user->account != 'guest')}
        {if($control->thread->canManage($board->id))}
          <span class='thread-more-actions'>
            <span class='dropdown dropup'>
              <a data-toggle='dropdown' href='###'><i class='icon-flag-alt'></i> {!echo $lang->thread->sticks[$thread->stick]} <span class='caret'></span></a>
              <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
                {foreach($lang->thread->sticks as $stick => $label)}
                  {if($thread->stick != $stick)}
                      {!echo '<li>' . html::a(inlink('stick', "thread=$thread->id&stick=$stick"), $label, "class='stickJsoner'") . '</li>'}
                  {else}
                      {!echo '<li class="active"><a href="###">' . $label . '</a></li>'}
                  {/if}
                {/foreach}
              </ul>
            </span>
            {if(commonModel::isAvailable('score') and $control->thread->canManage($board->id))}
              {$account = helper::safe64Encode($thread->author)}
              {!echo html::a(inlink('addScore', "account={{$account}}]&objectType=thread&objectID={{$thread->id}}"), $lang->thread->score, "data-toggle=modal")}
            {/if}
            {if($thread->hidden)}
                {!echo html::a(inlink('switchstatus',   "threadID=$thread->id"), '<i class="icon-eye-open"></i> ' . $lang->thread->show, "class='switcher'")}
            {else}
                {!echo html::a(inlink('switchstatus',   "threadID=$thread->id"), '<i class="icon-eye-close"></i> ' . $lang->thread->hide, "class='switcher'")}
            {/if}
            {!echo html::a(inlink('delete', "threadID=$thread->id"), '<i class="icon-trash"></i> ' . $lang->delete, "class='deleter'")}
            {!echo html::a(inlink('transfer',   "threadID=$thread->id"), '<i class="icon-location-arrow"></i> ' . $lang->thread->transfer, "data-toggle='modal'")}
          </span>
        {/if}
        {if($control->thread->canManage($board->id, $thread->author))} {!echo html::a(inlink('edit', "threadID=$thread->id"), '<i class="icon-pencil"></i> ' . $lang->edit)} {/if}
        <a href='#reply' class='thread-reply-btn'><i class='icon-reply'></i> {!echo $lang->reply->common}</a>
     {else}
        <a href="{!echo $control->createLink('user', 'login', 'referer=' . helper::safe64Encode($control->app->getURI(true) . '#reply'))}" class="thread-reply-btn"><i class="icon-reply"></i> {!echo $lang->reply->common}</a>
     {/if}
    </div>
  </div>
</div>
