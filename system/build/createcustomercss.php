<?php
$baseRoot    = dirname(dirname(dirname(__File__)));
$systemRoot = $baseRoot . "/system/";
$wwwRoot     = $baseRoot . "/www/";

$config = new stdclass();
$config->ui = new stdclass();
include $systemRoot . 'module/ui/config.php';

include $systemRoot . 'lib/lessc/lessc.class.php';
$lessc = new lessc();

$params = array();
foreach($config->ui->themes['default'] as $theme => $defaults)
{
    if(strpos(',default,clean,tartan,wide,', $theme) === false) continue;
    foreach($defaults as $section => $selector)
    {
        foreach($selector as $attr => $settings)
        {
            foreach($settings as $setting) $params[$setting['name']] = $setting['default'];
        }
    }

    unset($params['background-image-position']);
    unset($params['navbar-background-image-position']);

    $lessc->setVariables($params);
    $zhcnFile     = $wwwRoot . 'data/css/default_' . $theme . '_zh-cn.css';
    $zhtwFile     = $wwwRoot . 'data/css/default_' . $theme . '_zh-tw.css';
    $enFile       = $wwwRoot . 'data/css/default_' . $theme . '_en.css';
    $lessTemplate = $wwwRoot . 'theme/default/' . $theme . '/style.less';
    $lessc->compileFile($lessTemplate, $zhcnFile);
    print_r($zhcnFile . " Createed \n");
    $lessc->compileFile($lessTemplate, $zhtwFile);
    print_r($zhtwFile . " Createed \n");
    $lessc->compileFile($lessTemplate, $enFile);
    print_r($enFile . " Createed \n");
}

foreach($config->ui->themes['mobile'] as $theme => $defaults)
{
    if($theme == 'blank') continue;
    foreach($defaults as $section => $selector)
    {
        foreach($selector as $attr => $settings)
        {
            foreach($settings as $setting) $params[$setting['name']] = $setting['default'];
        }
    }

    unset($params['background-image-position']);
    unset($params['navbar-background-image-position']);

    $lessc->setVariables($params);
    $zhcnFile     = $wwwRoot . 'data/css/mobile_' . $theme . '_zh-cn.css';
    $zhtwFile     = $wwwRoot . 'data/css/mobile_' . $theme . '_zh-tw.css';
    $enFile       = $wwwRoot . 'data/css/mobile_' . $theme . '_en.css';
    $lessTemplate = $wwwRoot . 'theme/mobile/' . $theme . '/style.less';
    $lessc->compileFile($lessTemplate, $zhcnFile);
    print_r($zhcnFile . " Createed \n");
    $lessc->compileFile($lessTemplate, $zhtwFile);
    print_r($zhtwFile . " Createed \n");
    $lessc->compileFile($lessTemplate, $enFile);
    print_r($enFile . " Createed \n");
}
