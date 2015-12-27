<?php
$config->menus = new stdclass();
$config->menus->home    = 'admin';
$config->menus->content = 'article,blog,book,page';
$config->menus->shop    = 'product,order,';
$config->menus->promote = 'stat,tag,link';
$config->menus->design  = 'block,ui,slide';
$config->menus->setting = 'site,company,security';
$config->menus->user    = 'user,feedback,forum,reply';
$config->menus->open    = 'package';

$config->menuGroups = new stdclass();
foreach($config->menus as $group => $modules)
{
    $menus = explode(',', $modules);
    foreach($menus as $menu)
    {
        if($menu) $config->menuGroups->$menu = $group;
    }
}
