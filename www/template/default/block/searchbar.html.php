<?php if($isSearchAvaliable):?>
<div id='searchbar' data-ve='search'>
  <form action='<?php echo helper::createLink('search')?>' method='get' role='search'>
    <div class='input-group'>
      <?php echo $this->config->searchWordPlaceHolder;?>
      <?php if($this->config->requestType == 'GET') echo html::hidden($this->config->moduleVar, 'search') . html::hidden($this->config->methodVar, 'index');?>
      <div class='input-group-btn'>
        <button class='btn btn-default' type='submit'><i class='icon icon-search'></i></button>
      </div>
    </div>
  </form>
</div>
<?php endif;?>
