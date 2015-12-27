<?php
$config->menus = new stdclass();
$config->menus->index    = 'admin';
$config->menus->content = 'article,blog,book,page';
$config->menus->shop    = 'product,order,';
$config->menus->promote = 'stat,tag,link';
$config->menus->design  = 'block,ui,slide,';
$config->menus->setting = 'site,company,security,';
$config->menus->user    = 'user,feedback,forum,';
$config->menus->open    = 'package';

$config->menuGroups = new stdclass();
$config->menuGroups->admin    = 'home';

$config->menuGroups->article  = 'content';
$config->menuGroups->blog     = 'content';
$config->menuGroups->book     = 'content';
$config->menuGroups->page     = 'content';

$config->menuGroups->product  = 'shop';
$config->menuGroups->order    = 'shop';

$config->menuGroups->feedback = 'user';
$config->menuGroups->user     = 'user';
$config->menuGroups->forum    = 'user';
$config->menuGroups->message  = 'user';

$config->menuGroups->stat     = 'promote';
$config->menuGroups->tag      = 'promote';

$config->menuGroups->block    = 'design';
$config->menuGroups->ui       = 'design';
$config->menuGroups->slide    = 'design';

$config->menuGroups->mail     = 'setting';
$config->menuGroups->nav      = 'setting';
$config->menuGroups->links    = 'setting';
$config->menuGroups->wechat   = 'setting';
$config->menuGroups->group    = 'setting';
$config->menuGroups->search   = 'setting';
$config->menuGroups->company  = 'setting';
$config->menuGroups->site     = 'setting';
$config->menuGroups->security = 'setting';

$config->menuGroups->package  = 'open';
