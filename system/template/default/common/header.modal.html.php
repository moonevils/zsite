{if(helper::isAjaxRequest())}
{$webRoot   = $config->webRoot}
{$jsRoot    = $webRoot . "js/"}
{$themeRoot = $webRoot . "theme/default/"}
{if(isset($pageCSS)) css::internal($pageCSS)}
<div class="modal-dialog" style="width:{ empty($modalWidth) ? 600 : $modalWidth;?>px;">
  <div class="modal-content">
    <div class="modal-header">
      {!html::closeButton();
      <h4 class="modal-title"> {if(!empty($title))} {$title} {/if}</h4>
    </div>
    <div class="modal-body">
{else}
{$header=TPL_ROOT . 'common'  . DS . 'header.html.php';}
{include $header;}
{/if}
