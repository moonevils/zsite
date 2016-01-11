<style>
.user-control-nav li.nav-parent {border: 1px solid #ddd;}
.user-control-nav > li > span {background-color:#f5f5f5; border:none; color: #808080; padding: 8px 15px; display: block;}
.user-control-nav > li.nav-heading {font-weight:bold;}
.user-control-nav li > a > .nav-icon  {display: inline-block; width: 30px}
.user-control-nav.nav-primary.nav-stacked > li > a {border: none}
</style>

<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<div class='col-md-2'>
  <ul class='nav nav-primary nav-stacked user-control-nav'>
    <li class='nav-heading'><?php echo $lang->user->control->common;?></li>
    <?php foreach($this->config->user->navGroups as $group => $items):?>
    <li class='nav-parent'>
    <span><?php echo $lang->user->navGroups->$group;?></span>
    <ul class='nav'>
    <?php $navs = explode(',', $items);?>
    <?php foreach($navs as $nav)
    {
        $class = '';
        $menu = zget($lang->user->control->menus, $nav);
        list($label, $module, $method) = explode('|', $menu);
        if(!commonModel::isAvailable($module)) continue;
        if($module == $this->app->getModuleName() && $method == $this->app->getMethodName()) $class .= 'active';

        echo '<li class="nav-icon ' . $class . '">' . html::a($this->createLink($module, $method), $label) . '</li>';
    }
    ?>
  </ul>
    </li>
    <?php endforeach;?>
  </ul>
</div>

