{if(helper::isAjaxRequest())}
  {$templateName       = CHANZHI_TEMPLATE}
  {$themeName          = CHANZHI_THEME}
  {$templateRoot       = TPL_ROOT}
  {$templateThemeRoot  = "{{$templateRoot}}theme/"}
  {$templateCommonRoot = "{{$templateThemeRoot}}common/"}
  {$thisModuleName     = $control->app->getModuleName()}
  {$thisMethodName     = $control->app->getMethodName()}
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
        <h5 class='modal-title'>{!echo !empty($title) ? $title : ''}</h5>
      </div>
      <div class='modal-body'>
{else}
  {include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.lite')}
  <style>
  body.with-appnav.with-appbar-top {padding-top:58px;}
  .appnav {border-bottom:0px}
  .mainnav {padding:10px 0px} 
  .both-sides {border:0.4px solid #ddd;border-radius:20px}
  .both-sides.left {float:left}
  .both-sides.right {float:right}
  .both-sides .icon-block {padding:5px 10px;float:left}
  .both-sides .icon-block img {width:24px;height:24px}
  .both-sides .divider-line {margin:10px 0px 10px 0px;border-left:1px solid #ddd;float:left;height:18px}
  .middle-title {width:50%;margin:0 auto;line-height:38px;font-size:2rem;text-align:center}
  </style>
  <div class='block-region region-all-top blocks' data-region='all-top'>
  <nav class='appnav fix-top appnav-auto' id='appnav' data-ve='navbar' data-type='mobile_top' style='top:0px;background:#fff;box-shadow: 0 0px 0px;'>
  <div class='mainnav'>
    <div class='both-sides left'>
      <div class='icon-block'><a href='window.location.go(-1)'><img src='/theme/mobile/common/img/left.png'></img></a></div>
      <div class='divider-line'></div>
      <div class='icon-block'><a href='{$control->config->webRoot}'><img src='/theme/mobile/common/img/home.png'></img></a></div>
    </div>
    <div class='both-sides right'>
      <div class='icon-block'><img src='/theme/mobile/common/img/ellipsis.png'></img></div>
      <div class='divider-line'></div>
      <div class='icon-block'><img src='/theme/mobile/common/img/circle.png'></img></div>
    </div>
    <div class='middle-title'>{$mobileTitle}</div>
  </div>
  <div class='subnavs fade'>
    {$subnavs}
  </div>
</nav>
  </div>
  <div class='block-region region-all-banner blocks' data-region='all-banner'>
    {$control->block->printRegion($layouts, 'all', 'banner')}
  </div>
{/if}
