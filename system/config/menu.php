<?php
$config->menus = new stdclass();
$config->menus->home    = 'admin,order,message,comment,reply,thread,forumreply';
$config->menus->content = 'article,blog,book,page,contribution';
$config->menus->shop    = 'order,product,express,orderSetting';
$config->menus->user    = 'user,message,comment,reply,forum,wechat,contribution';
$config->menus->promote = 'stat,tag,links,setstat,';
$config->menus->design  = 'ui,logo,slide,nav,block,visual,others';
$config->menus->setting = 'site,company,security';
$config->menus->open    = 'package,themestore';

$config->menuGroups = new stdclass();
foreach($config->menus as $group => $modules)
{
    $menus = explode(',', $modules);
    foreach($menus as $menu)
    {
        if($menu) $config->menuGroups->$menu = $group;
    }
}

$config->menuDependence = new stdclass();
$config->menuDependence->contribution = 'contribution';
$config->menuDependence->page         = 'page';
$config->menuDependence->blog         = 'blog';
$config->menuDependence->express      = 'shop';

$config->menuExtra = new stdclass();
$config->menuExtra->visual = "target='_blank'";

$config->moduleMenu = new stdclass();
