<?php
$config->menus = new stdclass();
$config->menus->index   = 'admin';
$config->menus->content = 'article,blog,book,page';
$config->menus->shop    = 'product,order,';
$config->menus->promote = 'stat,tag,links';
$config->menus->design  = 'ui,logo,slide,block';
$config->menus->setting = 'site,company,security';
$config->menus->user    = 'user,feedback,message,forum,reply';
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
