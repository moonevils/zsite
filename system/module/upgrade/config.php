<?php
$config->upgrade = new stdclass();

$config->upgrade->navBlockNames['zh-cn'] = '网站导航';
$config->upgrade->navBlockNames['zh-tw'] = '網站導航';
$config->upgrade->navBlockNames['en']    = 'Navigation';

$config->filterParam->get['upgrade']['upgradeLicense']['hold'] = 'agree';
$config->filterParam->get['upgrade']['upgradeLicense']['params']['agree']['reg'] = '/./';
