<?php
if(isset($this->config->site->front) and $this->config->site->front == 'login')
{
    include  TPL_ROOT . 'user/login.admin.html.php';
}
else
{
    include $this->loadModel('ui')->getEffectViewFile('mobile', 'user', 'login.front');
}
