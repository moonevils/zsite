<?php
$yangcongConfig = json_decode(zget($this->config->site, 'yangcong', array()));
foreach($lang->user->oauth->providers as $providerCode => $providerName)
{
    if(isset($config->oauth->$providerCode)) $providerConfig[$providerCode] = json_decode($config->oauth->$providerCode);
}
if(!empty($providerConfig['qq']->clientID) or !empty($providerConfig['sina']->clientID) or !empty($yangcongConfig->appID)):
?>
<span class='login-images'>
<?php
echo "<span class='login-heading'>" . $lang->user->oauth->lblOtherLogin . "</span>";
foreach($lang->user->oauth->providers as $providerCode => $providerName) 
{
    $providerConfig = isset($config->oauth->$providerCode) ? json_decode($config->oauth->$providerCode) : '';
    if(empty($providerConfig->clientID)) continue;
    $params = "provider=$providerCode&fingerprint=fingerprintval";
    if($referer and !strpos($referer, 'login') and !strpos($referer, 'oauth')) $params .= "&referer=" . helper::safe64Encode($referer);
    echo html::a(inlink('oauthLogin', $params), "<img class='login-image " . $providerCode . "' src='../../../theme/default/default/images/main/" . $providerCode . "login.png'>");  
}
if(zget($yangcongConfig, 'appID', 0)) 
{
    echo html::a(helper::createLink('yangcong', 'qrcode', "referer=" . helper::safe64Encode($referer)), "<img class='login-image' src='../../../theme/default/default/images/main/yangconglogin.png'>", "data-toggle='modal'");
}
?>
</span>
<?php endif;?>
<script>
$().ready(function()
{
    $('a.btn-oauth').each(function()
    {
        fingerprint = getFingerprint();
        $(this).attr('href', $(this).attr('href').replace('fingerprintval', fingerprint) )
    })
});
</script>
