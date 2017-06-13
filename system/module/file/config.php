<?php
$config->file->require = new stdclass();
$config->file->require->edit = 'title';

if(!isset($config->file->thumbs))
{
    $config->file->thumbs = array();
    $config->file->thumbs['s'] = array('width' => '80',  'height' => '80');
    $config->file->thumbs['m'] = array('width' => '300', 'height' => '300');
    $config->file->thumbs['l'] = array('width' => '800', 'height' => '600');
}
else
{
    $config->file->thumbs = json_decode($config->file->thumbs, true);
}

$config->file->imageExtensions  = array('jpeg', 'jpg', 'gif', 'png');
$config->file->videoExtensions  = array('flv', 'webmv', 'wav', 'rtmp', 'ogg', 'mp3', 'mp4', 'm4v', 'swf');

$config->file->mediaTypes = new stdclass();
$config->file->mediaTypes->flv  = 'flv';
$config->file->mediaTypes->mp3  = 'mp3';
$config->file->mediaTypes->mp4  = 'm4v';
$config->file->mediaTypes->m4v  = 'm4v';
$config->file->mediaTypes->webm = 'webmv';
$config->file->mediaTypes->ogg  = 'ogg';
$config->file->mediaTypes->rtmp = 'rtmp';
$config->file->mediaTypes->wav  = 'wav';

$config->file->editorExtensions = array_merge($config->file->imageExtensions, $config->file->videoExtensions);

$config->file->mimes['default'] = 'application/octet-stream';

$config->file->tables   = array();
$config->file->tables[] = 'file.pathname';
$config->file->tables[] = 'article.content';
$config->file->tables[] = 'block.content';
$config->file->tables[] = 'book.content';
$config->file->tables[] = 'product.content';
$config->file->tables[] = 'reply.content';
$config->file->tables[] = 'thread.content';
$config->file->tables[] = 'wx_message.content';
$config->file->tables[] = 'slide.image';

$config->filterParam->get['file']['fileManager']['hold'] = 'order,path';
$config->filterParam->get['file']['fileManager']['params']['order']['reg'] = '/^[a-zA-Z\-]+$/';
$config->filterParam->get['file']['fileManager']['params']['path']['reg'] = '/^[a-zA-Z0-9/=_\-]+$/';
