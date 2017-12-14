{if($extView = $control->getExtViewFile(__FILE__))}
  {include $extView}
  {@helper::cd()}
{/if}
{!css::import($jsRoot . 'jquery/chosen/min.css')}
{!js::import($jsRoot . 'jquery/chosen/min.js');}
{$clientLang = $control->app->getClientLang();}
<script language='javascript'> 
$(document).ready(function()
{
    $(".chosen").chosen({no_results_text: '{$lang->noResultsMatch}', placeholder_text:' ', disable_search_threshold: 10, width: '100%', search_contains: true});
    $('select.chosen-icons').chosenIcons({lang: '{$clientLang}'});
});
</script>
