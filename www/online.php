<?php 
include('pclzip.class.php');
session_start();

$config = new stdclass;
if(!isset($_SESSION['checked']) or $_SESSION['checked'] == false)
{
    $_SESSION['checked'] = false;
    $config->userChecked = false;
    if(isset($_SESSION['filename']) and isset($_SESSION['filecontent']))
    {
        $toCheckFile = __DIR__ . '/' . $_SESSION['filename'] . '.txt';
        if(file_exists($toCheckFile) and trim(file_get_contents($toCheckFile)) == $_SESSION['filecontent'])
        {
            $_SESSION['checked'] = true;
            $config->userChecked = true;
        }
    }
}
else
{
    $config->userChecked = true; 
}
if(file_exists(__DIR__ . '/upgrade.php'))
{
    $config->type = 'upgrade';
    if(file_exists( __DIR__ . '/../VERSION'))
    {
        $currentVersion = file_get_contents(__DIR__ . '/../VERSION');
    }
}
else
{
    $config->type = 'install';
}
if(!is_writable(__DIR__))
{
    $config->envReady     = false;
}
else
{
    $config->envReady     = true;
}

$config->product      = 'chanzhi';
$config->urlScheme    = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
$config->extractPath  = __DIR__;
$config->extractFile  = 'chanzhieps.zip';
$config->extractedDir = 'chanzhieps';

$config->latestApi = array();
$config->latestApi['chanzhi'] = 'api.chanzhi.org/latest.php?version=5.5&type=getLatestVersion';

$config->url = array();
$baseFileName = basename(__FILE__);
$config->url['prepare-download']   = $baseFileName . '?action=prepare-download';
$config->url['start-download']     = $baseFileName . '?action=start-download';
$config->url['get-file-size']      = $baseFileName . '?action=get-file-size';
$config->url['get-full-file-size'] = $baseFileName . '?action=get-full-file-size';
$config->url['check-file']         = $baseFileName . '?action=check-file';
$config->url['extract-file']       = $baseFileName . '?action=extract-file';
$config->url['prepare-install']    = $baseFileName . '?action=prepare-install';
$config->url['prepare-upgrade']    = $baseFileName . '?action=prepare-upgrade';

$lang = new stdclass;
$lang->product = '蝉知';
$lang->install = '安装';
$lang->upgrade = '升级';
?>
<?php 
  $apiUrl = $config->urlScheme . '://' . $config->latestApi['chanzhi'];
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $apiUrl);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
  $result = curl_exec($curl);
  curl_close($curl);
  $result = json_decode(json_decode($result, true), true);

  function copyDir($source, $destination)
  {
      if(!is_dir($destination) and $destination != '.')
      {
          mkdir($destination, 0777, true);
      }
      $handle=dir($source);
      while($entry=$handle->read())
      {
          if(($entry != ".") && ($entry != ".."))
          {
              if(is_dir($source."/".$entry))
              {
                  copyDir($source."/".$entry, $destination."/".$entry);
              }
              else
              {
                  copy($source."/".$entry, $destination."/".$entry);
              }
          }
      }
      return true;
  }
?>
<?php
  $action = @$_GET['action'];
  if(!isset($action)) $action = '';
  $downloadPath = __DIR__;
  $downloadFile = $downloadPath . '/' . $config->extractFile;
  $packageUrl   = $result['releasePackage'];
  switch($action) 
  {
      case 'prepare-download':
          if(is_writable($downloadPath)) 
          {
              echo json_encode(array('result' => 'success'));
          }
          else
          {
              echo json_encode(array('result' => 'fail', 'message' => $downloadPath . '不可写，请运行命令 sudo chmod -R 777 ' . $downloadPath));
          }
          die();
      case 'start-download':
          set_time_limit(0);
          if ($fp = fopen($packageUrl, "rb")) 
          {
              if(!$downloadFp = fopen($downloadFile, "wb")) 
              {
                  exit('fail');
              }

              while(!feof($fp)) 
              {
                  if (!file_exists($downloadFile)) 
                  {
                      fclose($downloadFp);
                      exit;
                  }
                  fwrite($downloadFp, fread($fp, 1024 * 8 ), 1024 * 8);
              }
              fclose($downloadFp);
              fclose($fp);
          } 
          else 
          {
              exit;
          }
          die();
      case 'get-file-size':
          if (file_exists($downloadFile)) 
          {
              $fileSize = filesize($downloadFile);
              echo json_encode(array('size' => $fileSize));
              die();
          }
          else
          {
              echo json_encode(array('size' => '0'));
              die();
          }
          break;
      case 'get-full-file-size':
          $urlHeader = get_headers($packageUrl, true);
          if (isset($urlHeader['Content-Length'])) 
          {
              echo json_encode(array('fullSize' => $urlHeader['Content-Length']));
              die();
          }
          else
          {
              echo json_encode(array('fullSize' => '0'));
              die();
          }
          break;
      case 'check-file':
          echo json_encode(array('result' => 'success'));
          die();
      case 'extract-file':
          if(!file_exists($config->extractPath . '/' . $config->extractFile)) echo json_encode(array('result' => 'fail', 'message' => '文件不存在'));
          $zip = new pclzip($config->extractPath . '/' . $config->extractFile);
          if($zip->extract(PCLZIP_OPT_PATH, $config->extractPath . '/') == 0)
          {
              echo json_encode(array('result' => 'fail', 'message' => $zip->errorInfo()));
              die();
          }
          echo json_encode(array('result' => 'success'));
          die();
      case 'prepare-install':
          if($config->product == 'chanzhi')
          {
              $wwwDir = $config->extractPath . '/chanzhieps/www';
              $sysDir = $config->extractPath . '/chanzhieps/system';
              copyDir($wwwDir, '.');
              copyDir($sysDir, './system');
              echo json_encode(array('result' => 'success'));
              die();
          }
      case 'prepare-upgrade':
          if($config->product == 'chanzhi')
          {
              if(file_exists(__DIR__ . '/system'))
              {
                 $wwwDir = $config->extractPath . '/chanzhieps/www';
                 $sysDir = $config->extractPath . '/chanzhieps/system';
                 copyDir($wwwDir, '.');
                 copyDir($sysDir, './system');
                 echo json_encode(array('result' => 'success'));
                 die();
              }
              elseif(file_exists(__DIR__ . '/../system'))
              {
                  if(!is_writable(__DIR__ . '/../system'))
                  {
                      echo json_encode(array('result' => 'fail', 'message' => '权限不足，运行命令sudo chmod 777 -R ' . realpath(__DIR__ . '/../system')));
                      die();
                  }     
                  else
                  {
                      $wwwDir = $config->extractPath . '/chanzhieps/www';
                      $sysDir = $config->extractPath . '/chanzhieps/system';
                      copyDir($wwwDir, '.');
                      copyDir($sysDir, '../system');
                      echo json_encode(array('result' => 'success'));
                      die();
                  }
              }

          }
          die();
      default:
          break;
  }
?>
<!DOCTYPE html>
<html lang='zh-cn'>
<head profile="http://www.w3.org/2005/10/profile">
  <meta charset="utf-8">
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Cache-Control"  content="no-transform">
  <title>蝉知安装程序</title>
  <link rel="stylesheet" href="//cdn.bootcss.com/zui/1.5.0/css/zui.min.css">
  <style>
    body{background:white; margin-top:50px; padding-top:60px;}
    .main-body{border:1px solid rgba(0,0,0,.2);border-radius:3px;background-color:#fff;box-shadow: 0 5px 15px rgba(0,0,0,.5)}
    .box-header{border-bottom: 1px solid #e5e5e5; padding: 15px; min-height: 16px;}
    .box-body{border-bottom: 1px solid #e5e5e5; padding: 15px;}
    .box-footer{border-bottom: 1px solid #e5e5e5; padding: 15px;}
    .action-btn{margin-left:auto;margin-right:auto;width:78px;}
    .autoSelect{overflow:hidden; resize:none;}
    .w-500px{width:500px;}
  </style>
</head>
<body>
  <div class='container'> 
    <div class='row'>
      <div class='col-md-8 col-md-offset-2 main-body'>   
        <div class='box-header'>
          <h3><?php echo $lang->product . $lang->{$config->type};?></h3> 
        </div>
        <div class='box-body'>
          <?php if($config->type == 'install'):?>
          <p><?php echo $lang->product . "最新版本是；{$result['version']}" . "，在{$result['releaseDate']}发布，";?><a id='latestVersionUrl' href='<?php echo $result['url'];?>' target='__blank'>查看</a><p>
          <?php elseif($config->type == 'upgrade'):?>
          <p><?php if(isset($currentVersion)) {echo '当前版本：' . $currentVersion . '，';}echo "最新版本是；{$result['version']}" . "，在{$result['releaseDate']}发布，";?><a id='latestVersionUrl' href='<?php echo $result['url'];?>' target='__blank'>查看更新内容</a><p>
          <?php endif;?>
          <?php if($config->envReady and $config->userChecked):?>
          <ul class='result-box'>
            <li id='hasError' class='hidden'><span id='error'>ssssssssssss</span></li>
            <li id='downloading' class='hidden'><?php echo '正在下载安装包';?> <span id='progress'>0</span>%</li>
            <li id='downloaded' class='hidden'><?php echo '安装包下载完成';?></li>
            <li id='checking' class='hidden'><?php echo '正在校验安装包';?></li>
            <li id='checked' class='hidden'><?php echo '安装包校验完成';?></li>
            <li id='extracting' class='hidden'><?php echo '正在解压安装包';?></li>
            <li id='extracted' class='hidden'><?php echo '安装包解压完成';?></li>
          </ul>
          <?php else:?>
          <div class='error-box'>
              <?php if(!$config->userChecked):?>
              <?php 
              $checkFilename = substr(md5(time() . mt_rand()), 0, 5);
              $checkFileContent = substr(md5(time() . mt_rand()), 0, 5);
              if(!isset($_SESSION['filename'])) $_SESSION['filename']    = $checkFilename;
              if(!isset($_SESSION['filecontent'])) $_SESSION['filecontent'] = $checkFileContent;
              ?>
              <strong>请确认您的身份</strong>
              <p>在网站服务器上创建文件<?php echo __DIR__ . '/' . $_SESSION['filename'] . '.txt';?>，并写入内容<?php echo $_SESSION['filecontent'];?></p>
              <?php elseif(!$config->envReady):?>
              <strong>修改文件夹写入权限</strong>
              <code >chmod -R 777 <?php echo __DIR__;?></code>
              <?php endif;?>
          </div>
          <?php endif;?>
        </div>
        <div class='box-footer'>
          <div class='action-btn'>
            <?php if($config->envReady and $config->userChecked):?>
            <button class="btn btn-primary" id='btn-prepare' type="button">
              <?php echo '准备' . $lang->{$config->type};?>
            </button>
            <button class="btn btn-primary hidden" id='btn-start' type="button">
              <?php echo '开始' . $lang->{$config->type};?>
            </button>
            <?php else:?>
            <button class="btn btn-primary " id='btn-refresh' type="button">
              <?php echo '刷新';?>
            </button>
            <?php endif;?>
          </div>
        </div>
      </div> 
    </div>
  </div>
<script src="//cdn.bootcss.com/zui/1.5.0/lib/jquery/jquery.js"></script>
<script src="//cdn.bootcss.com/zui/1.5.0/js/zui.min.js"></script>
<script>
$(document).ready(function()
{
    $('#btn-prepare').click(function()
    {
        $(this).text('准备中');
        $.getJSON('<?php echo $config->url['prepare-download'];?>', function(response)
        {
            if(response.result == 'success')
            {
                $('#downloading').removeClass('hidden');
                $.getJSON('<?php echo $config->url['get-full-file-size'];?>', function(response)
                {
                    fullSize = response.fullSize;
                });
                var timerID = window.setInterval(function()
                {
                    $.getJSON('<?php echo $config->url['get-file-size'];?>', function(response)
                    {
                        size = response.size;
                        progress = size / fullSize;
                        console.log(progress.toFixed(2));
                        progress = progress * 100;
                        progress = progress.toFixed(2);
                        $('#progress').text(progress);
                        if(parseInt(size) == parseInt(fullSize) && parseInt(size) != 0)
                        {
                            clearInterval(timerID);
                            $('#downloaded').removeClass('hidden');
                            $('#downloading').addClass('hidden');
                            $('#checking').removeClass('hidden');
                            $.getJSON('<?php echo $config->url['check-file'];?>', function(response)
                            {
                                if(response.result == 'success')
                                {
                                    $('#checking').addClass('hidden');
                                    $('#checked').removeClass('hidden');
                                    $('#extracting').removeClass('hidden');
                                    $.getJSON('<?php echo $config->url['extract-file'];?>', function(response)
                                    {
                                        if(response.result == 'success')
                                        {
                                            $('#extracting').addClass('hidden');
                                            $('#extracted').removeClass('hidden');
                                            $('#btn-prepare').addClass('hidden');
                                            $('#btn-start').removeClass('hidden');
                                        }
                                        else
                                        {
                                            $('#error').text(response.message);
                                        }
                                    });
                                }
                                else
                                {
                                    $('#error').text(response.message);
                                }
                            });
                        }
                    });
                }, 500);
                $.get('<?php echo $config->url['start-download'];?>');
            }
            else
            {
                $('#error').text(response.message);
                $('#hasError').removeClass('hidden');
                return false;
            }
        });
    });
    $('#btn-start').click(function()
    {
        $.getJSON('<?php echo $config->type == 'install' ? $config->url['prepare-install'] : $config->url['prepare-upgrade'];?>', function(response)
        {
            if(response.result == 'success')
            {
                <?php if($config->type == 'install'):?>
                location.href = './install.php';
                <?php else:?>
                location.href = './upgrade.php';
                <?php endif;?>
            }
            else
            {
                $('#error').text(response.message);
                $('#hasError').removeClass('hidden');
            }
        });

    });
    $('#btn-refresh').click(function()
    {
        location.href = location.href;
    });
});
</script>
</body>
