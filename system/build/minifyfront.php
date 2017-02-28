<?php
/**
* This file is used to compress css and js files.
*/

$baseDir = dirname(dirname(dirname(__FILE__)));

//--------------------------------- PROCESS JS FILES ------------------------------ //

/* Set jsRoot and jqueryRoot. */
$jsRoot     = $baseDir . '/www/js/';
$jqueryRoot = $jsRoot . 'jquery/';
$themeRoot  = $baseDir . '/www/theme/default/';

/* Set js files to combined. */
$jsFiles['jquery']     = $jsRoot . 'jquery/min.js';
$jsFiles['jqueryform'] = $jsRoot . 'jquery/form/min.js';
$jsFiles['zui']        = $jsRoot . 'zui/min.js';
$jsFiles['zui.admin']  = $jsRoot . 'zui/admin.min.js';
$jsFiles['chanzhi']    = $jsRoot . 'chanzhi.js';
$jsFiles['my']         = $jsRoot . 'my.js';
$jsFiles['my.admin']   = $jsRoot . 'my.admin.js';

foreach($jsFiles as $file)
{
   if(!file_exists($file)) die($file . "not exists!\n");
}

$frontFiles = array();
$frontFiles[] = 'jquery';
$frontFiles[] = 'jqueryform';
$frontFiles[] = 'zui';
$frontFiles[] = 'chanzhi';
$frontFiles[] = 'my';

$adminFiles = array();
$adminFiles[] = 'jquery';
$adminFiles[] = 'jqueryform';
$adminFiles[] = 'zui';
$adminFiles[] = 'zui.admin';
$adminFiles[] = 'chanzhi';
$adminFiles[] = 'my';
$adminFiles[] = 'my.admin';

/* Combine these js files. */
$allJSFile  = $jsRoot . 'chanzhi.all.js';
$jsCode = '';
foreach($frontFiles as $jsFile)
{
    $file = $jsFiles[$jsFile];
    if(!file_exists($file)) die($file . " [$jsFile] " . "not exists!\n");
    $jsCode .= "\n". file_get_contents($jsFiles[$jsFile]);
}
$result = file_put_contents($allJSFile, $jsCode);
if($result) echo "create chanzhi.all.js success.\n";
`java -jar ~/bin/yuicompressor/build/yuicompressor.jar --type js $allJSFile -o $allJSFile`;

$adminAllJSFile  = $jsRoot . 'chanzhi.all.admin.js';
$jsCode = '';
foreach($adminFiles as $file)
{
    if($jsCode != '') $jsCode .= "\n";
    $jsCode .= file_get_contents($jsFiles[$file]);
}
$result = file_put_contents($adminAllJSFile, $jsCode);
if($result) echo "create chanzhi.all.admin.js success\n";
`java -jar ~/bin/yuicompressor/build/yuicompressor.jar --type js $adminAllJSFile -o $adminAllJSFile`;

$ie8Code = file_get_contents($jsRoot . 'html5shiv/min.js');
$ie8Code .= file_get_contents($jsRoot . 'respond/min.js');

$result = file_put_contents($jsRoot . 'chanzhi.all.ie8.js', $ie8Code);
if($result) echo "create chanzhi.all.ie8.js success\n";

$ie9Code = file_get_contents($jsRoot . 'jquery/placeholder/min.js');

$result = file_put_contents($jsRoot . 'chanzhi.all.ie9.js', $ie9Code);
if($result) echo "create chanzhi.all.ie9.js success\n";

//-------------------------------- PROCESS CSS FILES ------------------------------ //
$cssFiles = array();
$cssFiles['common']    = $baseDir . '/www/theme/default/common/style.css';
$cssFiles['zui']       = $baseDir . '/www/zui/css/min.css';
$cssFiles['zui.admin'] = $baseDir . '/www/zui/css/admin.min.css';
$cssFiles['admin']     = $baseDir . '/www/theme/default/default/admin.css';

foreach($cssFiles as $file)
{
   if(!file_exists($file)) die($file . "not exists!\n");
}

$frontCSS = array();
$frontCSS[] = 'zui';
$frontCSS[] = 'common';

$adminCSS = array();
$adminCSS[] = 'zui';
$adminCSS[] = 'zui.admin';
$adminCSS[] = 'admin';

/* Admin css file. */
$adminCssCode = '';
foreach($adminCSS as $file)
{
    $file = $cssFiles[$file];
    $css = file_get_contents($file);
    if(strpos($file, 'zui') !== false) $css = str_replace('../fonts', '../../../zui/fonts', $css);
    $adminCssCode .= $css;
}

$adminCssFile = $themeRoot . 'default/chanzhi.all.admin.css';
$result = file_put_contents($adminCssFile, $adminCssCode);
if($result) echo "Compress Admin Css success!\n";
`java -jar ~/bin/yuicompressor/build/yuicompressor.jar --type css $adminCssFile -o $adminCssFile`;

/* Front css file. */
$frontCssCode = '';
foreach($frontCSS as $file)
{
    $file = $cssFiles[$file];
    $css = file_get_contents($file);
    if(strpos($file, 'zui') !== false) $css = str_replace('../fonts', '../../../zui/fonts', $css);
    if(strpos($file, 'common') !== false) $css = str_replace('url(images/', 'url(../common/images/', $css);
    $frontCssCode .= $css;
}

$frontCssFile = $themeRoot . 'default/chanzhi.all.css';
$result = file_put_contents($frontCssFile, $frontCssCode);
if($result) echo "Compress Front Css success!\n";
`java -jar ~/bin/yuicompressor/build/yuicompressor.jar --type css $frontCssFile -o $frontCssFile`;
