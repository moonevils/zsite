{$extView=$control->getExtViewFile(__FILE__)}
{if($extView)}
{include="$extView"}
{$tmp=raincall('helper', 'cd')}
{/if}
{$sysURL=rtrim($sysURL, '/')}
{if(isset($mobileURL))}
{$mobileURL=ltrim($mobileURL, '/')}
{/if}
<!DOCTYPE html>
<html xmlns:wb="http://open.weibo.com/wb" lang='{$app->getClientLang()}' class='m-{$thisModuleName} m-{$thisModuleName}-{$thisMethodName}'>
<head profile="http://www.w3.org/2005/10/profile">
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-Control"  content="no-transform">
  <meta name="Generator" content="chanzhi{$config->version} www.chanzhi.org'">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {if(isset($mobileURL))} <link rel="alternate" media="only screen and (max-width: 640px)" href="{$sysURL}/{$mobileURL}"> {/if}
  {if(isset($sourceURL))}
    <link rel="canonical" href="{$sysURL}/{$sourceURL}" >
  {else}
    {if(isset($canonicalURL))}
    <link rel="canonical" href="{$sysURL}/{$canonicalURL}" >
    {/if}
  {/if}
  {if($thisModuleName == 'user' and $thisMethodName == 'deny')}
  <meta http-equiv='refresh' content="5;url='{$url= helper::createLink('index')}'">
  {/if} 
  {if(!isset($title))} {$title=''} {/if}
  {if(!empty($title))} {$title="$title . $lang->minus"} {/if}
  {if(!empty($keywords))} {$keywords=$config->site->keywords} {/if}
  {if(!empty($desc))} {$desc=$title=$config->site->desc} {/if}

  {function="html::title($title . $config->site->name)"}
  {function="html::meta('keywords', $keywords)"}
  {function="html::meta('description', $desc)"}
  {if(isset($config->site->meta))}{$config->site->meta}{/if}

  {function="js::exportConfigVars()"}
  {function="js::set('theme', array('template' => CHANZHI_TEMPLATE, 'theme' => CHANZHI_THEME, 'device' => $app->clientDevice))"}

{if($config->debug)}
    {function="js::import($jsRoot . 'jquery/min.js')"}
    {function="js::import($jsRoot . 'zui/min.js')"}
    {function="js::import($jsRoot . 'chanzhi.js')"}
    {function="js::import($jsRoot . 'my.js')"}
    {function="css::import($webRoot . 'zui/css/min.css')"}
    {function="css::import($themeRoot . 'common/style.css')"}
{else}
    {if($cdnRoot)}
        {function="css::import($cdnRoot . '/theme/default/default/chanzhi.all.css', '', $version = false)"}
        {function=js::import($cdnRoot  . '/js/chanzhi.all.js', $version = false)"}
        {else}
        {function="css::import($themeRoot . 'default/chanzhi.all.css')"}
        {function="js::import($jsRoot     . 'chanzhi.all.js')"}
    {/if}
{/if}
{if(file_exists($customCssFile))}{function="css::import($customCssURI, "id='themeStyle'")"}{/if}
{if(isset($pageCSS))}{function="css::internal($pageCSS)"}{/if}
{function="html::icon($favicon)"}
{function="html::rss(helper::createLink('rss', 'index', '', '', 'xml'), $config->site->name)"}

<!--[if lt IE 9]>
{if($config->debug)}
{function="js::import($jsRoot . 'html5shiv/min.js')"}
{function="js::import($jsRoot . 'respond/min.js')"}
{else}
  {if($cdnRoot)}
    <link href="' . $cdnRoot . '/js/respond/cross-domain/respond-proxy.html" id="respond-proxy" rel="respond-proxy" />
    <link href="/js/respond/cross-domain/respond.proxy.gif" id="respond-redirect" rel="respond-redirect" />
    {function="js::import($jsRoot . 'html5shiv/min.js')"}
    {function="js::import($jsRoot . 'respond/min.js')"}
    {function="js::import($jsRoot . 'respond/cross-domain/respond.proxy.js')"}
  {else}
    js::import($jsRoot . 'chanzhi.all.ie8.js');
    {function="js::import($jsRoot . 'chanzhi.all.ie8.js')"}
  {/if}
{/if}
<![endif]-->
<!--[if lt IE 10]>
{if($config->debug)}
{function="js::import($jsRoot . 'jquery/placeholder/min.js')"}
{else}
{function="js::import($jsRoot . 'chanzhi.all.ie9.js')"}
{/if}
<![endif]-->
{function="js::set('lang', $lang->js)"}
{if(!empty($config->oauth->sina) and !is_object($config->oauth->sina))}
  {$sina=json_decode($config->oauth->sina)}
{/if}
{if(!empty($config->oauth->qq) and !is_object($config->oauth->qq))}
  {$qq=json_decode($config->oauth->qq)}
{/if}
{if(!empty($sina->verification))} {$sina->verification} {/if}
{if(!empty($qq->verification))} {$qq->verification} {/if}
{if(!empty($sina->widget))}
{function="js::import('http://tjs.sjs.sinajs.cn/open/api/js/wb.js')"}
{/if}
{$baseCustom=isset($config->template->custom) ? json_decode($config->template->custom, true) : array()}
{if(!empty($baseCustom[$template][$theme]['js']))}
{function="js::execute($baseCustom[$template][$theme]['js'])"}
{/if}
{function="$control->block->printRegion($layouts, 'all', 'header')"};
</head>
<body>
{if(isset($resultCustomCss) and $resultCustomCss['result'] != 'success')}
  {if(!empty($resultCustomCss['message']))}
    <div class='alert alert-danger'> {$lang->customCssError;} </div>
  {/if}
{/if}
