<?php
$config->book->require = new stdclass();
$config->book->require->book = 'title, alias';
$config->book->require->node = 'title';

$config->book->editor = new stdclass();
$config->book->editor->edit   = array('id' => 'content', 'tools' => 'full');
$config->book->editor->create = array('id' => 'content', 'tools' => 'full');

$config->book->chapter = 'left';
