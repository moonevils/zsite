<?php
foreach($this->lang->user->oauth->providers as $providerCode => $providerName)
{
    if(isset($this->config->oauth->$providerCode)) $providerConfig[$providerCode] = json_decode($this->config->oauth->$providerCode);
}
if(!empty($providerConfig)):
?>
  <span class='span-oauth'>
    <span class='login-heading'><?php echo  $this->lang->user->oauth->lblOtherLogin;?></span>
    <?php
    foreach($this->lang->user->oauth->providers as $providerCode => $providerName) 
    {
        $providerConfig = isset($this->config->oauth->$providerCode) ? json_decode($this->config->oauth->$providerCode) : '';
        if(empty($providerConfig->clientID)) continue;
        $params = "provider=$providerCode&fingerprint=fingerprintval";
        if($referer and !strpos($referer, 'login') and !strpos($referer, 'oauth')) $params .= "&referer=" . helper::safe64Encode($referer);

        echo html::a(helper::createLink('user', 'oauthLogin', $params), html::image(getWebRoot() . "theme/default/default/images/main/{$providerCode}login.png", "class='{$providerCode}'"), "class='btn-oauth'");
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
<style>
.span-oauth {margin: 0; line-height:30px;}
.span-oauth a{margin: 0 3px; }
.span-oauth a > img{height: 24px; width:24px;}
.span-oauth a > img.qq{height: 18px; width:18px;}
</style>
