<div class='block-region region-all-bottom blocks' data-region='all-bottom'>{$control->loadModel('block')->printRegion($layouts, 'all', 'bottom')}</div>
<footer  class="appbar fix-bottom">
  <ul class="nav">
    <li>{!echo html::a(helper::createLink('rss', 'index', 'type=blog', '', 'xml'), "<i class='icon-rss text-warning'></i> ", "target='_blank' class='text-important'")}</li>
    {if(!isset($control->config->site->type) or $control->config->site->type != 'blog')}
    <li>{!echo html::a($config->webRoot, "<i class='icon icon-home'></i> {$lang->blog->siteHome}", "class='text-primary'")}</li>
    {/if}
  </ul>
</footer>
{if(isset($pageJS)) js::execute($pageJS)}
<div class='block-region region-all-footer hidden blocks' data-region='all-footer'>{$control->loadModel('block')->printRegion($layouts, 'all', 'footer')}</div>
{include TPL_ROOT . 'common/log.html.php'}
</body>
</html>
