<?php
/**
 * The router file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     chanzhiEPS
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/* Turn off error reporting first. */
error_reporting(0);

/* Start output buffer. */
ob_start();

/* Define the run mode as front. */
define('RUN_MODE', 'front');

/* Load the framework. */
include 'loader.php';

if(isset($_GET['requestType']) && $_GET['requestType'] == 'pathinfo') die('pathinfo');

/* Instance the app and run it. */
$app = router::createApp('chanzhi', $systemRoot);
$config = $app->config;

/* Connect to db, load module. */
$common = $app->loadCommon();
$common->checkDomain();

/* Check the reqeust is getconfig or not. Check installed or not. */
if(isset($_GET['mode']) and $_GET['mode'] == 'getconfig') die($app->exportConfig());
if(!isset($config->installed) or !$config->installed) die(header('location: install.php'));

/* Check site status. */
if($app->config->site->status == 'pause')
{
    die("<div style='text-align:center'>" . htmlspecialchars_decode($app->config->site->pauseTip, ENT_QUOTES) . '</div>');
}

/* Check site static status. */
if(empty($_SERVER['REQUEST_URI']) or strpos($_SERVER['REQUEST_URI'], '/index.php?') !== 0)
{
    if(isset($app->config->site->staticStatus) && $app->config->site->staticStatus == 'open' && isset($app->config->site->staticDeploy) && $app->config->site->staticDeploy == 'localhost')
    {
        $pathInfo   = $app->getPathInfo();
        $staticRoot = $app->getTmpRoot() . 'www' . DS;
        if($app->clientDevice == 'mobile')
        {
            $mobileRoot = $staticRoot . 'mobile' . DS;
            if($pathInfo)
            {
                if(strpos($pathInfo, '.mhtml') === false && strpos($pathInfo, '.xml') === false)
                {
                    $filePath = $mobileRoot . $pathInfo . DS . 'index.mhtml';
                }
                else
                {
                    $filePath = $mobileRoot . $pathInfo;
                }  
            }
            else
            {
                $filePath = $mobileRoot . 'index.mhtml';
            }
            if(is_file($filePath)) die(file_get_contents($filePath));
        }
        $desktopRoot = $staticRoot . 'desktop' . DS;
        if($pathInfo)
        {
            if(strpos($pathInfo, '.html') === false && strpos($pathInfo, '.xml') === false)
            {
                $filePath = $desktopRoot . $pathInfo . DS . 'index.html';
            }
            else
            {
                $filePath = $desktopRoot . $pathInfo;
            }  
        }
        else
        {
            $filePath = $desktopRoot . 'index.html';
        }
        if(is_file($filePath)) die(file_get_contents($filePath));
    }
}

$app->parseRequest();
$common->checkPriv();
$app->loadModule();

/* Flush the buffer. */
echo helper::removeUTF8Bom(ob_get_clean());
