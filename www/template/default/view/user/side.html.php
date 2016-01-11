<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<div class='col-md-2'>
  <ul class='nav nav-primary nav-stacked user-control-nav'>
    <li class='nav-heading'><?php echo $lang->user->control->common;?></li>
    <?php foreach($this->config->user->navGroups as $group => $items):?>
    <li class='nav-parent'>
    <?php echo html::a('###', $lang->user->navGroups->$group);?>
    <ul class='nav'>
    <?php $navs = explode(',', $items);?>
    <?php foreach($navs as $nav)
    {
        $class = '';
        $menu = zget($lang->user->control->menus, $nav, '');
        if(empty($menu)) continue;
        list($label, $module, $method) = explode('|', $menu);
        if(!commonModel::isAvailable($module)) continue;
        if($module == $this->app->getModuleName() && $method == $this->app->getMethodName()) $class .= 'active';

        echo '<li class="' . $class . '">' . html::a($this->createLink($module, $method), $label) . '</li>';
    }
    ?>
  </ul>
    </li>
    <?php endforeach;?>
  </ul>
</div>
<style>
.nav-parent ul.nav{padding:0 20px;border:}
.nav-primary.nav-stacked > li > a{background-color:#F8F8F8; border:none;}
li.nav-parent {border: 1px solid #ddd;}
.nav-primary.nav-stacked > li.nav-heading  {font-weight:bold;}
</style>
