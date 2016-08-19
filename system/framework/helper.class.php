<?php
/**
 * Helper类从baseHelper类继承而来，您可以在这个文件中对其进行扩展。
 * This helper class extends from the baseHelper class, and you can
 * extend it by change this helper.class.php file.
 *
 * @package framework
 *
 * The author disclaims copyright to this source code. In place of
 * a legal notice, here is a blessing:
 * 
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */
include FRAME_ROOT . '/base/helper.class.php';
class helper extends baseHelper
{
    /**
     * Create a link to a module's method.
     * 
     * This method also mapped in control class to call conveniently.
     * <code>
     * <?php
     * helper::createLink('hello', 'index', 'var1=value1&var2=value2');
     * helper::createLink('hello', 'index', array('var1' => 'value1', 'var2' => 'value2');
     * ?>
     * </code>
     * @param string       $moduleName     module name
     * @param string       $methodName     method name
     * @param string|array $vars           the params passed to the method, can be array('key' => 'value') or key1=value1&key2=value2) or key1=value1&key2=value2
     * @param string|array $alias          the alias  params passed to the method, can be array('key' => 'value') or key1=value1&key2=value2) or key1=value1&key2=value2
     * @param string       $viewType       the view type
     * @static
     * @access public
     * @return string the link string.
     */
    static public function createLink($moduleName, $methodName = 'index', $vars = '', $alias = array(), $viewType = '')
    {
        global $app, $config;
        $clientLang = $app->getClientLang();
        $lang       = $config->langCode;

        /* Set viewType is mhtml if visit with mobile.*/
        if(!$viewType and RUN_MODE == 'front' and $app->clientDevice == 'mobile' and $methodName != 'oauthCallback') $viewType = 'mhtml';

        /* Set vars and alias. */
        if(!is_array($vars)) parse_str($vars, $vars);
        if(!is_array($alias)) parse_str($alias, $alias);
        foreach($alias as $key => $value) $alias[$key] = urlencode($value);

        /* Seo modules return directly. */
        if($config->requestType != 'GET' and method_exists('uri', 'create' . $moduleName . $methodName))
        {
            if($config->requestType == 'PATH_INFO2') $config->webRoot = $_SERVER['SCRIPT_NAME'] . '/';
            $link = call_user_func_array('uri::create' . $moduleName . $methodName, array('param'=> $vars, 'alias'=>$alias, 'viewType'=>$viewType));

            /* Add client lang. */
            if($lang and $link) $link = $config->webRoot .  $lang . '/' . substr($link, strlen($config->webRoot));

            if($config->requestType == 'PATH_INFO2') $config->webRoot = getWebRoot();
            if($link) return $link;
        }
        
        /* Set the view type. */
        if(empty($viewType)) $viewType = $app->getViewType();
        if($config->requestType == 'PATH_INFO')  $link = $config->webRoot;
        if($config->requestType == 'PATH_INFO2') $link = $_SERVER['SCRIPT_NAME'] . '/';
        if($config->requestType == 'GET') $link = $_SERVER['SCRIPT_NAME'];
        if($config->requestType != 'GET' and $lang) $link .= "$lang/";

        /* Common method. */
        if($config->requestType != 'GET')
        {
            /* If the method equal the default method defined in the config file and the vars is empty, convert the link. */
            if($methodName == $config->default->method and empty($vars))
            {
                /* If the module also equal the default module, change index-index to index.html. */
                if($moduleName == $config->default->module)
                {
                    $link .= 'index.' . $viewType;
                }
                elseif($viewType == $app->getViewType())
                {
                    $link .= $moduleName . '/';
                }
                else
                {
                    $link .= $moduleName . '.' . $viewType;
                }
            }
            else
            {
                $link .= "$moduleName{$config->requestFix}$methodName";
                foreach($vars as $value) $link .= "{$config->requestFix}$value";
                $link .= '.' . $viewType;
            }
        }
        else
        {
            $link .= "?{$config->moduleVar}=$moduleName&{$config->methodVar}=$methodName";
            if($viewType != 'html') $link .= "&{$config->viewVar}=" . $viewType;
            foreach($vars as $key => $value) $link .= "&$key=$value";
            if($lang and RUN_MODE != 'admin') $link .= "&l=$lang";
        }
        return $link;
    }

    /**
     * Get exec infomation.
     * 
     * @access public
     * @return string
     */
    public static function getExecInfo()
    {
        global $app, $lang;
        list($second, $millisecond) = explode(' ', STARTED_TIME);
        $started = (float) $second + (float) $millisecond;
        list($second, $millisecond) = explode(' ', microtime());
        $ended = (float) $second + (float) $millisecond;

        $execTime = round($ended - $started, 2);
        $memoryUsage = memory_get_peak_usage(true);
        $memoryUsage = number_format(round($memoryUsage / 1024 / 1024, 2), 2);

        $html = "<span style='cursor:pointer;' id='execIcon'><i class='icon icon-dashboard'> </i></span>";
        if($app->clientDevice == 'desktop')
        {
            $html .= sprintf($lang->execInfo, count(dao::$querys), $memoryUsage . 'MB', $execTime);
            $html .= '<script>';
            $html .= "$().ready(function() { $('#execIcon').tooltip({title:$('#execInfoBar').html(), html:true, placement:'right'}); }); ";
            $html .= '</script>';
        }

        if($app->clientDevice == 'mobile')
        {
            $html .= '<script>';
            $html .= "$().ready(function() { ";
            $html .= "$('#execIcon').click(function(){ $('#execInfoBar').toggle();});";
            $html .= "}); ";
            $html .= '</script>';
            $lang->execInfo = str_replace('<br>', '', $lang->execInfo);
            $html .= sprintf($lang->execInfo, count(dao::$querys), $memoryUsage . 'MB', $execTime);
        }

        return $html;
    }

    /**
     * Get browser.
     * 
     * @access public
     * @return string
     */
    public static function getBrowser()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $agent = $_SERVER["HTTP_USER_AGENT"];

        if(strpos($agent, 'MSIE') !== false || strpos($agent, 'rv:11.0')) return "ie";

        /* Chrome should checked before safari.*/
        if(strpos($agent, 'Chrome') !== false)  return "chrome";
        if(strpos($agent, 'Safari') !== false)  return 'safari';
        if(strpos($agent, 'Firefox') !== false) return "firefox";
        if(strpos($agent, 'Opera') !== false)   return 'opera';

        return 'unknown';
    }

    /**
     * Get browser version. 
     * 
     * @access public
     * @return string
     */
    public static function getBrowserVersion()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $agent = $_SERVER['HTTP_USER_AGENT'];   
        if(preg_match('/MSIE\s(\d+)\..*/i', $agent, $regs))       return $regs[1];
        if(preg_match('/FireFox\/(\d+)\..*/i', $agent, $regs))    return $regs[1];
        if(preg_match('/Opera[\s|\/](\d+)\..*/i', $agent, $regs)) return $regs[1];
        if(preg_match('/Chrome\/(\d+)\..*/i', $agent, $regs))     return $regs[1];

        if((strpos($agent,'Chrome') == false) && preg_match('/Safari\/(\d+)\..*$/i', $agent, $regs)) return $regs[1];
        if(preg_match('/rv:(\d+)\..*/i', $agent, $regs)) return $regs[1];

        return 'unknow';
    }

    /**
     * Get client os from agent info. 
     * 
     * @static
     * @access public
     * @return string
     */
    public static function getOS()
    {
        if(empty($_SERVER['HTTP_USER_AGENT'])) return 'unknow';

        $osList = array();
        $osList['/windows nt 10/i']      = 'Windows 10';
        $osList['/windows nt 6.3/i']     = 'Windows 8.1';
        $osList['/windows nt 6.2/i']     = 'Windows 8';
        $osList['/windows nt 6.1/i']     = 'Windows 7';
        $osList['/windows nt 6.0/i']     = 'Windows Vista';
        $osList['/windows nt 5.2/i']     = 'Windows Server 2003/XP x64';
        $osList['/windows nt 5.1/i']     = 'Windows XP';
        $osList['/windows xp/i']         = 'Windows XP';
        $osList['/windows nt 5.0/i']     = 'Windows 2000';
        $osList['/windows me/i']         = 'Windows ME';
        $osList['/win98/i']              = 'Windows 98';
        $osList['/win95/i']              = 'Windows 95';
        $osList['/win16/i']              = 'Windows 3.11';
        $osList['/macintosh|mac os x/i'] = 'Mac OS X';
        $osList['/mac_powerpc/i']        = 'Mac OS 9';
        $osList['/linux/i']              = 'Linux';
        $osList['/ubuntu/i']             = 'Ubuntu';
        $osList['/iphone/i']             = 'iPhone';
        $osList['/ipod/i']               = 'iPod';
        $osList['/ipad/i']               = 'iPad';
        $osList['/android/i']            = 'Android';
        $osList['/blackberry/i']         = 'BlackBerry';
        $osList['/webos/i']              = 'Mobile';

        foreach ($osList as $regex => $value)
        { 
            if(preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) return $value; 
        }   

        return 'unknown';
    }
}

/**
 * Get home root.
 * 
 * @param  string $langCode 
 * @access public
 * @return string
 */
function getHomeRoot($langCode = '')
{
    global $config, $app;
    $requestType = $config->requestType;
    if(RUN_MODE == 'admin') $config->requestType = zget($config, 'frontRequestType', $config->requestType);

    $langCode = $langCode == '' ? $config->langCode : $langCode;
    $defaultLang = isset($config->site->defaultLang) ?  $config->site->defaultLang : $config->default->lang;
    if($langCode == $config->langsShortcuts[$defaultLang])
    {
        $config->requestType = $requestType;
        return $config->webRoot;
    }
    $homeRoot = $config->webRoot;

    if($langCode and $config->requestType == 'PATH_INFO') $homeRoot = $config->webRoot . $langCode; 
    if($langCode and $config->requestType == 'PATH_INFO2') $homeRoot = $config->webRoot . 'index.php/' . "$langCode";
    if($langCode and $config->requestType == 'GET') $homeRoot = $config->webRoot . 'index.php?l=' . "$langCode";
    if($config->requestType != 'GET') $homeRoot = rtrim($homeRoot, '/') . '/';

    $config->requestType = $requestType;
    return $homeRoot;
}

/**
 * Check admin entry. 
 * 
 * @access public
 * @return string
 */
function checkAdminEntry()
{
    if(strpos($_SERVER['PHP_SELF'], '/admin.php') === false) return true; 

    $path  = dirname($_SERVER['SCRIPT_FILENAME']);
    $files = scandir($path);
    $defaultFiles = array('admin.php', 'index.php', 'install.php', 'loader.php', 'upgrade.php');
    foreach($files as $file)
    {
        if(strpos($file, '.php') !== false and !in_array($file, $defaultFiles))
        {
            $contents = file_get_contents($path . '/' . $file);
            if(strpos($contents, "'RUN_MODE', 'admin'") && strpos($_SERVER['PHP_SELF'], '/admin.php') !== false) die(header("location: " . getWebRoot()));
        }
    }
}

/**
 * Format time.
 * 
 * @param  int    $time 
 * @param  string $format 
 * @access public
 * @return void
 */
function formatTime($time, $format = '')
{
    $time = str_replace('0000-00-00', '', $time);
    $time = str_replace('00:00:00', '', $time);
    if($format) return date($format, strtotime($time));
    return trim($time);
}

/**
 * Key for chanzhi.
 * 
 * @access public
 * @return string
 */
function k()
{
    global $app, $lang;

    $codeLen  = strlen($app->siteCode);
    $keywords = explode(';', $lang->k);
    $count    = count($keywords);

    $sum = 0;
    for($i = 0; $i < $codeLen; $i++) $sum += ord($siteCode{$i});

    $key = $sum % $count;
    return $keywords[$key];
}
