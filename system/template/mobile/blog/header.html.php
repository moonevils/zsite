{if($extView = $control->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.lite')}
<div class='block-region region-all-top blocks' data-region='all-top'>{$control->block->printRegion($layouts, 'all', 'top')}</div>
<header class='appbar fix-top' id='appbar'>
  <div class='appbar-title'>
    <a href='{!echo $webRoot}'>
{*php*}
      $logoSetting = isset($control->config->site->logo) ? json_decode($control->config->site->logo) : new stdclass();
      $logo        = false;
      if(isset($logoSetting->$templateName->themes->all))        $logo = $logoSetting->$templateName->themes->all;
      if(isset($logoSetting->$templateName->themes->$themeName)) $logo = $logoSetting->$templateName->themes->$themeName; 
      if($logo)
      {
          $logo->extension = $control->loadModel('file')->getExtension($logo->pathname);
          echo html::image($control->loadModel('file')->printFileURL($logo->pathname, $logo->extension), "class='logo' alt='{$control->config->company->name}' title='{$control->config->company->name}'");
      }
{else}
      {
          echo '<h4>' . $control->config->site->name . '</h4>';
      }
{*/php*}
    </a>
  </div>
  <div class='appbar-actions'>
    {if(commonModel::isAvailable('search'))}
    <div class='dropdown'>
      <button type='button' class='btn' data-toggle='dropdown' id='searchToggle'><i class='icon-search'></i></button>
      <div class='dropdown-menu fade search-bar' id='searchbar'>
        <form action='{!echo helper::createLink('search')?>' method='get' role='search'>
          <div class='input-group'>
            {$keywords = ($control->app->getModuleName() == 'search') ? $control->session->serachIngWord : ''}
            {!echo html::input('words', $keywords, "class='form-control' placeholder=''")}
            {if($control->config->requestType == 'GET') echo html::hidden($control->config->moduleVar, 'search') . html::hidden($control->config->methodVar, 'index')}
            <div class='input-group-btn'>
              <button class='btn default' type='submit'><i class='icon icon-search'></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
    {/if}
    <div class='dropdown'>
      {if(!isset($control->config->site->type) or $control->config->site->type != 'blog')}
      {!echo html::a($config->webRoot, '<i class="icon-home icon-large"></i>', "class='btn'")}
      {/if}

      <button type='button' class='btn' data-toggle='dropdown'><i class='icon-bars'></i></button>
      <ul class='dropdown-menu dropdown-menu-right'>
        {!echo $control->config->siteNavHolder;}
      </ul>
    </div>
  </div>
</header>

{$navs = $control->loadModel('nav')->getNavs('mobile_blog')}
<nav class='appnav fix-top appnav-auto' id='appnav'>
  <div class='mainnav'>
    <ul class='nav'>
    {$subnavs = ''}
    {foreach($navs as $nav1)}
      <li class='{!echo $nav1->class?>'>
{*php*}
      if(empty($nav1->children))
      {
          echo html::a($nav1->url, $nav1->title, ($nav1->target != 'modal') ? "target='$nav1->target'" : "data-toggle='modal'");
      }
{else}
      {
          echo html::a("#sub-{$nav1->class}", $nav1->title . " <i class='icon-caret-down'></i>", ($nav1->target != 'modal') ? "target='$nav1->target'" : "data-toggle='modal'");
          $subnavs .= "<ul class='nav' id='sub-{$nav1->class}'>\n";
          foreach($nav1->children as $nav2)
          {
              $subnavs .= "<li class='{$nav2->class}'>";
              if(empty($nav2->children))
              {
                  $subnavs .= html::a($nav2->url, $nav2->title, ($nav2->target != 'modal') ? "target='$nav2->target'" : "data-toggle='modal' class='text-important'");
              }
{else}
              {
                  $subnavs .= html::a("javascript:;", $nav2->title . " <i class='icon-caret-down'></i>", "data-toggle='dropdown' class='text-important'");
                  $subnavs .= "<ul class='dropdown-menu'>";
                  foreach($nav2->children as $nav3)
                  {
                      $subnavs .= "<li>" . html::a($nav3->url, $nav3->title, ($nav3->target != 'modal') ? "target='$nav3->target'" : "data-toggle='modal' class='text-important'") . '</li>';
                  }
                  $subnavs .= "</ul>\n";
              }
              $subnavs .= "</li>\n";
          }
          $subnavs .= "</ul>\n";
      }
{*/php*}
      </li>
    {/foreach}<!-- end nav1 -->
    </ul>
  </div>
  <div class='subnavs fade'>
    {!echo $subnavs}
  </div>
</nav>

<div class='block-region region-all-banner blocks' data-region='all-banner'>
  {$control->block->printRegion($layouts, 'all', 'banner')}
</div>
