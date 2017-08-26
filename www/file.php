<?php
$pathname   = isset($_GET['pathname']) ? $_GET['pathname'] : '';
$objectType = isset($_GET['objectType']) ? $_GET['objectType'] : '';
$imageSize  = isset($_GET['imageSize']) ? $_GET['imageSize'] : '';
$extension  = isset($_GET['extension']) ? $_GET['extension'] : '';

$dataRoot = rtrim(dirname($_SERVER['SCRIPT_FILENAME']), '/') . '/data/';

if($objectType == 'source' or $objectType == 'slide')
{
    if($objectType == 'slide' and !preg_match('/^slides\/[0-9_0-9]/', $pathname)) die('The file does not exist!');
    $savePath = $dataRoot;
}
else
{
    if(!preg_match('/^[0-9]{6}\/f_[a-z0-9]{32}/', $pathname)) die('The file does not exist!');
    $savePath = $dataRoot . 'upload/';
}

$realPath = $savePath . $pathname;
if(!file_exists($realPath))
{
    $realPath = $savePath . (strpos($pathname, '.') === false ? $pathname : substr($pathname, 0, strpos($pathname, '.')));
}

$filePath = $realPath;
if($imageSize == 'smallURL')  $filePath = str_replace('f_', 's_', $realPath);
if($imageSize == 'middleURL') $filePath = str_replace('f_', 'm_', $realPath);
if($imageSize == 'largeURL')  $filePath = str_replace('f_', 'l_', $realPath);

if(!file_exists($filePath)) $filePath = $realPath;

if(!file_exists($filePath)) die('The file does not exist!');

$imageExtensions = array('jpeg', 'jpg', 'gif', 'png');
$mime = in_array($extension, $imageExtensions) ? "image/{$extension}" : 'application/octet-stream';
header("Content-type: $mime");

$handle = fopen($filePath, "r");
if($handle)
{
    while(!feof($handle)) echo fgets($handle);
    fclose($handle);
}
