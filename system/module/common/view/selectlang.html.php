<?php
$clientLang  = $this->app->getClientLang();
$enableLangs = explode(',', $config->enabledLangs);
$enableLangs = array_flip($enableLangs);
$langs       = $config->langs;

if(isset($config->cn2tw) and $config->cn2tw) unset($langs['zh-tw']);
foreach($langs as $key => $value)
{
    if(!isset($enableLangs[$key])) unset($langs[$key]);
}
if(count($langs) > 1):
?>
<a href='###' class='dropdown-toggle' data-toggle='dropdown'><i class='icon-globe icon-large'></i> &nbsp;<?php echo $langs[$clientLang]?><span class='caret'></span></a>
<ul class='dropdown-menu'>
  <?php
  unset($langs[$clientLang]);
  foreach($langs as $langKey => $currentLang) echo "<li>" . html::a($this->createLink('admin', 'switchLang', "lang=$langKey"), $currentLang) . "</li>";
  ?>
</ul>
<?php endif;?>
