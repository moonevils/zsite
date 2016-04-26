<?php
$config->cacher = 'file';

$config->cache = new stdclass();

global $app;
$config->cache->file = new stdclass();
$config->cache->file->expired  = 600;
$config->cache->file->savePath = $app->getTmpRoot() . "cache";
if($config->multi) $config->cache->file->savePath = $app->getTmpRoot() . "cache" . DS . $app->getSiteCode() . DS;
