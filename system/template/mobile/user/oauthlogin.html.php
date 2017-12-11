{*php*}
/**
 * The oauth login view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
{*/php*}
{*php*}
foreach($lang->user->oauth->providers as $providerCode => $providerName)
{
    $thisConfig = isset($config->oauth->$providerCode) ? json_decode($config->oauth->$providerCode) : '';
    if(!empty($thisConfig->clientID))
    {
        switch ($providerCode)
        {
            case 'qq':
                $thisConfig->icon = 'qq';
                $thisConfig->accent = 'info';
                break;
            case 'sina':
                $thisConfig->icon = 'weibo';
                $thisConfig->accent = 'danger';
                break;
            default:
                $thisConfig->icon = $providerCode;
                $thisConfig->accent = 'primary';
                break;
        }
        $providerConfig[$providerCode] = $thisConfig;
      }
}
if(!empty($providerConfig)):
{*/php*}
<div class="panel-heading">
  <div class="title"><strong>{!echo $lang->user->oauth->lblWelcome}</strong></div>
</div>
<div class="panel-body">
  <div class="row">
    {$colClassWidth = count($providerConfig) > 1 ? 6 : 12}
    {foreach ($providerConfig as $providerCode => $thisConfig)}
    <div class="col-{!echo $colClassWidth?>">
{*php*}
    $params = "provider=$providerCode&fingerprint=fingerprintval";
    $providerName = $lang->user->oauth->providers[$providerCode];
    if($referer and !strpos($referer, 'login') and !strpos($referer, 'oauth')) $params .= "&referer=" . helper::safe64Encode($referer);
    echo html::a(inlink('oauthLogin', $params), "<i class='icon-{$thisConfig->icon} icon'></i> " . $providerName, "class='btn btn-oauth block {$thisConfig->accent}' data-oauth='{$providerCode}'");
{*/php*}
    </div>
    {/foreach ?>
  </div>
</div>
<script>
$(function()
{
    var fingerprint = $.getFingerprint();
    $('.btn-oauth').each(function()
    {
        var $btn = $(this);
        $btn.attr('href', $btn.attr('href').replace('fingerprintval', fingerprint));
    });
});
</script>
<hr>
{/if}
