<style>
.user-control-nav {padding: 0 7px 4px; border-bottom: 1px solid #e5e5e5; margin-top: 10px; margin-bottom: 10px;}
.user-control-nav > li {float: left; margin: 0 3px 6px;}
.user-control-nav > li > a {float: left; border: 1px solid #f1f1f1; border-radius: 2px; min-width: 100px;}
.user-control-nav > li.active > a {background-color: #ebf2f9; color: #3280fc; border-color: #3280fc;}
.user-control-nav > li > a > .icon-chevron-right {display: none}
.user-control-nav > li > a > [class*='icon-'] {color: #666;}
.user-control-nav > li.active > a > [class*='icon-'] {color: #3280fc;}
</style>
<?php $this->loadModel('user')->fixMenus();?>
<ul class='nav user-control-nav clearfix'>
<?php if($thisMethodName !== 'control'): ?>
  <li><?php echo html::a($this->createLink('user', 'control'), "<i class='icon-th-large'></i> " . $lang->user->control->common, "class='btn default'"); ?></li>
<?php endif; ?>
<?php foreach($this->config->user->navGroups as $group => $items):?>
    <?php $navs = explode(',', $items);?>
    <?php foreach($navs as $nav)
    {
        $class = '';
        $menu = zget($lang->user->control->menus, $nav, '');
        if(empty($menu)) continue;
        list($label, $module, $method) = explode('|', $menu);
        $module = strtolower($module);
        $method = strtolower($method);
        $menuInfo = explode('|', $menu);
        $params   = zget($menuInfo, 3 ,''); 
        if(!commonModel::isAvailable($module)) continue;
        if($module == $this->app->getModuleName() && $method == $this->app->getMethodName()) $class .= 'active';
        echo '<li class="' . $class . '">' . html::a($this->createLink($module, $method, $params), $label, "class='btn default'") . '</li>';
    }
    ?>
<?php endforeach;?>
</ul>
