<?php
if(!isset($this->config->site->modules) or strpos($this->config->site->modules, 'message') === false) die();

$config->message = new stdclass();
$config->message->types = 'comment,message,notice,reply';
$config->message->recPerPage = 10;

$config->message->require = new stdclass();
$config->message->require->post  = 'from, type, content';
$config->message->require->reply = 'from, type, content';

$config->filterParam->cookie['message']['common']['hold'] = 'cmts';
$config->filterParam->cookie['message']['common']['params']['cmts']['reg'] = '/./'; 
