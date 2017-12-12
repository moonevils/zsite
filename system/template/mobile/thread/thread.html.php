<div class='panel panel-section panel-body cards cards-list'>
  <div class='card thread'>
    <div class='card-heading with-icon'>
      <i class='icon-comment-alt icon'></i>
      <div class='pull-right'>
        {if($thread->stick)}
        <small class='bg-danger-pale text-danger'><i class='icon-flag'></i> {!echo $lang->thread->sticks[$thread->stick]}</small>
        {/if}
        {if($thread->readonly)}
        &nbsp; <small class='bg-info-pale text-info'><i class='icon icon-lock'></i> {!echo $lang->thread->readonly}</small>
        {/if}
      </div>
      <h4>{!echo $thread->title}</h4>
      <div class='caption text-muted'>
        <span class='text-danger'><i class='icon-user'></i> {!echo isset($speakers[$thread->author]) ? $speakers[$thread->author]->realname : $thread->author ?></span> &nbsp; <small><i class='icon-time'></i> {!echo $thread->addedDate}</small>
      </div>
    </div>
    <section class='card-content article-content'>{!echo $thread->content}</section>
    {if(!empty($thread->files))}
    <div class='card-content'>{$control->thread->printFiles($thread, $control->thread->canManage($board->id, $thread->author))}</div>
    {/if}
    <div class="card-footer">
      {if(commonModel::isAvailable('score') and !empty($thread->scoreSum))}
      <span>{!echo sprintf($lang->thread->scoreSum, $thread->scoreSum)}</span>
      {/if}
      {if($thread->editor)}
      <small class='hide last-edit'><i class="icon-pencil"></i> {!printf($lang->thread->lblEdited, $thread->editorRealname, $thread->editedDate)}</small>
      {/if}
      {if($control->app->user->account != 'guest')}
      <div class="actions text-right pull-right">
        {if($control->thread->canManage($board->id))}
        <span class='dropdown dropup'>
          <a data-toggle='dropdown' href='###' class='text-muted'><i class='icon-flag-alt'></i> {!echo $lang->thread->sticks[$thread->stick]} <i class='icon-caret-up'></i></a>
          <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>
{*php*}
          foreach($lang->thread->sticks as $stick => $label)
          {
              if($thread->stick != $stick)
              {
                  echo '<li>' . html::a(inlink('stick', "thread=$thread->id&stick=$stick"), $label, "class='ajaxaction'") . '</li>';
              }
{else}
              {
                  echo '<li class="active"><a href="###">' . $label . '</a></li>';
              }
          }
{*/php*}
          </ul>
        </span> &nbsp;
        {if(commonModel::isAvailable('score') and $control->thread->canManage($board->id))}
        {$account = helper::safe64Encode($thread->author)}
        {!echo html::a(inlink('addScore', "account={$account}&objectType=thread&objectID={$thread->id}"), $lang->thread->score, "data-toggle=modal class='text-muted'")}
        {/if}
{*php*}
        if($thread->hidden)
        {
            echo html::a(inlink('switchstatus',   "threadID=$thread->id"), '<i class="icon-eye-open"></i> ' . $lang->thread->show, "class='switcher ajaxaction text-muted'") . ' &nbsp; ';
        }
{else}
        {
            echo html::a(inlink('switchstatus',   "threadID=$thread->id"), '<i class="icon-eye-close"></i> ' . $lang->thread->hide, "class='switcher ajaxaction text-muted'") . ' &nbsp; ';
        }
        echo html::a(inlink('delete', "threadID=$thread->id"), '<i class="icon-trash"></i> ' . $lang->delete, "class='deleter text-muted'") . ' &nbsp; ';
        echo html::a(inlink('transfer',   "threadID=$thread->id"), '<i class="icon-location-arrow"></i> ' . $lang->thread->transfer, "data-toggle='modal' class='text-muted'") . ' &nbsp; ';
{*/php*}
        {/if}
        {if($control->thread->canManage($board->id, $thread->author)) echo html::a(inlink('edit', "threadID=$thread->id"), '<i class="icon-pencil"></i> ' . $lang->edit, 'data-toggle="modal" class="text-muted"')}
      </div>
      {/if}
    </div>
  </div>
  {if($thread->readonly)}
  <div class='alert bg-primary-pale text-primary'>{!echo $lang->thread->readonlyMessage}</div>
  {else}
    {if($control->app->user->account == 'guest')}
    <a href="{!echo $control->createLink('user', 'login', 'referer=' . helper::safe64Encode($control->app->getURI(true)))}#reply" class="thread-reply-btn btn primary block"><i class="icon-reply"></i> {!echo $lang->reply->common}</a>
    {else}
    <a href='#replyDialog' data-toggle='modal' class='thread-reply-btn btn primary block'><i class='icon-reply'></i> {!echo $lang->reply->common}</a>
    {/if}
  {/if}
</div>
