{include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header.lite');}
{if(isset($locate))} 
<meta http-equiv='refresh' content=\"5;url=$locate\">
{/if}
<style>
.alert.with-icon > .icon, .alert.with-icon > .icon + .content {padding: 20px 20px 20px;}
.alert.with-icon > .icon {padding-left: 35px;}
.alert-deny {max-width: 500px; margin: 8% auto; padding: 0; background-color: #FFF; border: 1px solid #DDD; box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.2); border-radius: 6px;}
.btn-link {border-color: none!important}
#mainInfo{padding:10px 0; font-size:14px;}
.btn-redirec{margin-left:14px;}
</style>
<div class='container w-600px'>
  <div class='alert with-icon alert-deny'>
    <i class='icon-info-sign icon'></i>
    <div class='content'>
      <div id='mainInfo'>{$reason}</div>
      <div class='actions'>{!printf($lang->redirecting, $locate)}</div>
    </div>
  </div>
</div>
</body>
</html>
