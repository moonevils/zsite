<?php
$config->cacher = 'file';

$config->cache = new stdclass();

$config->cache->file = new stdclass();
$config->cache->file->expired  = 600;
