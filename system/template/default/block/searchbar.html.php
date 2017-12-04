{if($isSearchAvaliable)}
<div id='searchbar' data-ve='search'>
  <form action='{!echo helper::createLink('search')?>' method='get' role='search'>
    <div class='input-group'>
      {!echo $lang->searchWordPlaceHolder}
      {if($lang->requestType == 'GET')} {!echo html::hidden($lang->moduleVar, 'search') . html::hidden($lang->methodVar, 'index')} {/if}
      <div class='input-group-btn'>
        <button class='btn btn-default' type='submit'><i class='icon icon-search'></i></button>
      </div>
    </div>
  </form>
</div>
{/if}
