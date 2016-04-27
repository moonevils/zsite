<?php
$config->cachePages = '';

$config->cache = new stdclass();
$config->cache->expired = 86400;

$config->cache->type = 'file';
$config->cache->cachedPages = 'index.index,article.browse,product.browse,book.browse';

$config->cache->file = new stdclass();
$config->cache->file->expired = $config->cache->expired;
