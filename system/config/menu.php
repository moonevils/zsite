<?php
$config->menus = new stdclass();
$config->menus->home   = 'admin,order,message,comment,reply,thread,forumreply';
$config->menus->content = 'article,blog,book,page';
$config->menus->shop    = 'order,product,express,orderSetting';
$config->menus->user    = 'user,message,reply,forum,wechat';
$config->menus->promote = 'stat,tag,links,setstat,';
$config->menus->design  = 'ui,logo,slide,block,nav,themestore';
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
