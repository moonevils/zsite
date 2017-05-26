<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php if(isset($uiHeader) and $uiHeader) echo '</div>';?>
</div>

<nav class="navbar navbar-default navbar-fixed-bottom hidden-sm hidden-xs" role="navigation">
  <ul class='breadcrumb pull-left' id='positionBar'>
    <li><?php echo html::a(helper::createLink('admin', 'index'), $lang->chanzhiEPSx);?></li>
  </ul>
  <div id='powerby'>
    <?php
    $chanzhiVersion                   = $config->version;
    $isProVersion                     = strpos($chanzhiVersion, 'pro') !== false;
    if($isProVersion) $chanzhiVersion = str_replace('pro', '', $chanzhiVersion);
    ?>
    <?php printf($lang->poweredBy, $config->version, k(), "<span class='" . ($isProVersion ? 'icon-chanzhi-pro' : 'icon-chanzhi') . "'></span> <span class='name'>" . $lang->chanzhiEPSx . '</span>' . $chanzhiVersion);?>
    
  </div>
</nav>

<?php
if($config->debug) js::import($jsRoot . 'jquery/form/min.js');
if(isset($pageJS)) js::execute($pageJS);

/* Load hook files for current page. */
$extPath      = dirname(dirname(dirname(__FILE__))) . '/common/ext/view/';
$extHookRule  = $extPath . 'footer.admin.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;
/* Load hook file for site.*/
$siteExtPath  = dirname(dirname(dirname(__FILE__))) . "/common/ext/_{$this->app->siteCode}/view/";
$extHookRule  = $siteExtPath . 'footer.admin.*.hook.php';
$extHookFiles = glob($extHookRule);
if($extHookFiles) foreach($extHookFiles as $extHookFile) include $extHookFile;
?>
</body>
</html>
