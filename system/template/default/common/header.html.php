{if(helper::isAjaxRequest())}
  {if(isset($pageCSS))} {function="css::internal($pageCSS)"} {/if}
  {$modalWidth=empty($modalWidth) ? 1000 : $modalWidth;}
  <div class="modal-dialog" style="width:{$modalWidth}px;">
    <div class="modal-content">
      <div class="modal-header">
        {function="html::closeButton()"}
        <strong class="modal-title">{if(!empty($title))} {$title} {/if}</strong>
        {if(!empty($subtitle))}
        <small>{$subtitle}</small>
        {/if}
      </div>
      <div class="modal-body">
{else}
  {$extView=$control->getExtViewFile(__FILE__)}
  {if($extView)}
    {include $extView}
    {$tmp=helper::cd()}
  {/if}
  {$headerLite=$control->loadModel('ui')->getEffectViewFile('default', 'common', 'header.lite')}
  {include $headerLite}
  <div class='page-container'>
    <div class='blocks' data-region='all-top'>{function="$control->block->printRegion($layouts, 'all', 'top')"}</div>
    <div class='page-wrapper'>
      <div class='page-content'>
        <div class='blocks row' data-region='all-banner'>{function="$control->block->printRegion($layouts, 'all', 'banner', true)"}</div>
{/if}
