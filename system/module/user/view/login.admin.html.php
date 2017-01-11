<?php
include '../../common/view/header.lite.html.php';
js::import($jsRoot . 'fingerprint/fingerprint.js');
js::import($jsRoot . 'md5.js');
js::set('scriptName', $_SERVER['SCRIPT_NAME']);
js::set('random', $this->session->random);
?>
<div class='container'>
  <div id='adminLogin'>
    <div id='siteName'>
      <h4 class='text-ellipsis text-rightPadding'>
        <?php echo $this->config->site->name;?>
      </h4>
      <div class='pull-right'>
        <div class='dropdown' id='langs'>
          <button class='btn' data-toggle='dropdown' title='Change Language/更换语言/更換語言'><?php echo $config->langs[$this->app->getClientLang()]; ?> <span class='caret'></span></button>
          <ul class='dropdown-menu'>
            <?php foreach($config->langs as $key => $value):?>
            <li class="<?php echo $key == $this->app->getClientLang() ? 'active' : ''; ?>">
              <a href='###' data-value="<?php echo $key;?>"><?php echo $value;?></a>
            </li>
            <?php endforeach;?>
          </ul>
        </div>
      </div>
    </div>
    <form method='post' id='ajaxForm' data-checkfingerprint='1'>
      <div id='formError' class='alert alert-danger hiding'></div>
      <div class='row'>
        <div class='col-xs-4 text-center'>
        <?php echo html::image($this->config->webRoot . 'theme/default/default/images/main/logo.login.admin.png'); ?>
        </div>
        <div class='col-xs-8'>
          <table class="table table-form">
            <tr>
              <th class='w-60px'><?php echo $lang->user->account?></th>
              <td><?php echo html::input('account','',"class='form-control' placeholder='{$lang->user->inputAccountOrEmail}'");?></td>
            </tr>
            <tr>
              <th><?php echo $lang->user->password?></th>
              <td><?php echo html::password('password','',"class='form-control' placeholder='{$lang->user->inputPassword}'");?></td>
            </tr>
            <tr>
              <th><?php echo html::a('', $lang->save, "data-toggle='modal' class='hidden captchaModal'")?></th>
              <td>
                <?php echo html::submitButton($lang->user->login->common, 'btn btn-primary btn');?>
                <?php 
                  if(!empty($this->config->site->yangcong)) 
                  {        
                    $yangcongConfig = json_decode($this->config->site->yangcong);
                    if(zget($yangcongConfig, 'appID', '')) echo html::a(helper::createLink('yangcong', 'qrcode', "referer=" . helper::safe64Encode($referer)), "<i class='icon icon-qrcode icon-lg'> {$lang->user->yangcongLogin}</i>", "class='btn btn-success' data-toggle='modal'");
                  }
                ?>
              </td>
            </tr>
          </table>
          <?php echo html::hidden('referer', $referer);?>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
if($config->debug) js::import($jsRoot . 'jquery/form/min.js');
if(isset($pageJS)) js::execute($pageJS);
?>
<style>
  #siteName{position:relative;}
  .text-rightPadding{padding-right:80px;}
  .pull-right{position:absolute;top:16px;right:20px;}
</style>
</body>
</html>
