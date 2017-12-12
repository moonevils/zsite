{*php*}
if(isset($control->config->site->front) and $control->config->site->front == 'login')
{
    include  TPL_ROOT . 'user/login.admin.html.php';
}
{else}
{
    include $control->loadModel('ui')->getEffectViewFile('mobile', 'user', 'login.front');
}
