<?php
/**
 * The router, config and lang class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 *
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

define('FRAME_ROOT', dirname(__FILE__));
include FRAME_ROOT . '/base/router.class.php';

/**
 * The router class.
 *
 * @package framework
 */
class router extends baseRouter
{ 
    /**
     * The construct function.
     * 
     * Prepare all the paths, classes, super objects and so on.
     * Notice: 
     * 1. You should use the createApp() method to get an instance of the router.
     * 2. If the $appRoot is empty, the framework will comput the appRoot according the $appName
     *
     * @param string $appName   the name of the app 
     * @param string $appRoot   the root path of the app
     * @access protected
     * @return void
     */
    public function __construct($appName = 'demo', $appRoot = '')
    {
        parent::__construct($appName, $appRoot);
        $this->fixLangConfig();
    }

    /**
     * 创建一个应用。
     * Create an application.
     * 
     * @param string $appName   应用名称。  The name of the app.
     * @param string $appRoot   应用根路径。The root path of the app.
     * @param string $className 应用类名，如果对router类做了扩展，需要指定类名。When extends router class, you should pass in the child router class name.
     * @static
     * @access public
     * @return object   the app object
     */
    public static function createApp($appName = 'demo', $appRoot = '', $className = '')
    {
        if(empty($className)) $className = __CLASS__;
        return new $className($appName, $appRoot);
    }
    
    /**
     * Get template root.
     * 
     * @access public
     * @return string
     */
    public function getTplRoot()
    {
        return $this->wwwRoot . 'template' . DS;
    }

    /**
     * Load cache class.
     * 
     * @access public
     * @return void
     */
    public function loadCacheClass()
    {
        $this->loadClass('cache', $static = true);
        $this->config->cache->file->savePath = $this->getTmpRoot() . 'cache';
        if($this->config->multi) $this->config->cache->file->savePath = $this->getTmpRoot() . 'cache' . DS . $this->app->siteCode;

        $cacheConfig = zget($this->config->cache, $this->config->cache->type);
        if(is_object($cacheConfig)) $cacheConfig->lang = $this->getClientLang();

        $this->cache = cache::factory($this->config->cache->type, $cacheConfig);
    }

    /**
     * Clear caches.
     * 
     * @access public
     * @return void
     */
    public function clearCache()
    {
        if(empty(dao::$changedTables)) return true;
        foreach(dao::$changedTables as $table)
        {
            $items = zget($this->config->cache->relation, $table);
            $blocks[] = zget($items, 'blocks');
            $pages[]  = zget($items, 'pages');
        }

        $blocks = join(',', $blocks);
        $pages  = join(',', $pages);
        
        $blocks = array_unique(explode(',', $blocks));
        $pages  = array_unique(explode(',', $pages));

        foreach($blocks as $block) 
        {
            if(empty($block)) continue;
            $this->cache->clear("block/{$block}*");
        }

        if($this->config->cache->cachePage != 'close')
        {
            foreach($pages as $page) 
            {
                if(empty($page)) continue;
                $key = 'page' . DS . $this->clientDevice . $page . '*';
                $this->cache->clear($key);
            }
        }
        return true;
    }

    /**
     * Set lang code.
     * 
     * @access public
     * @return void
     */
    public function fixLangConfig()
    {
        $langCode = $this->clientLang == $this->config->default->lang ? '' : $this->config->langsShortcuts[$this->clientLang];
        $this->config->langCode = $langCode;
    }

    /**
     * The entrance of parseing request. According to the requestType, call related methods.
     * 
     * @access public
     * @return void
     */
    public function parseRequest()
    {
        if($this->config->requestType != 'GET')
        {
            $this->parsePathInfo();

            $langCode = $this->config->langsShortcuts[$this->clientLang];
            if(strpos($this->URI, $langCode) === 0) $this->URI = substr($this->URI, strlen($langCode) + 1);

            $this->URI = seo::parseURI($this->URI);

            $this->setRouteByPathInfo();
        }
        elseif($this->config->requestType == 'GET')
        {
            $this->parseGET();
            $this->setRouteByGET();
        }
        else
        {
            $this->triggerError("The request type {$this->config->requestType} not supported", __FILE__, __LINE__, $exit = true);
        }
        if(defined('REAL_REQUEST_TYPE') and strpos('PATH_INFO2', REAL_REQUEST_TYPE) !== false) $this->config->requestType = REAL_REQUEST_TYPE;
    }

    /**
     * Extend page cache logics.
     * 
     * @access public
     * @return void
     */
    public function loadModule()
    {
        if(RUN_MODE == 'front' and $this->config->cache->type != 'close' and $this->config->cache->cachePage == 'open')
        {
            $key   = 'page' . DS . $this->clientDevice . DS . md5($_SERVER['REQUEST_URI']);
            $cache = $this->cache->get($key);
            if($cache)
            {
                $siteNav = commonModel::printTopBar() . commonModel::printLanguageBar();
                $cache = str_replace($this->config->siteNavHolder, $siteNav, $cache);
                if($this->config->site->execInfo == 'show') $cache = str_replace($this->config->execPlaceholder, helper::getExecInfo(), $cache);
                die($cache);
            }
        }
        parent::loadModule();
    }

    /**
     * loadLang 
     * 
     * @param  int    $moduleName 
     * @param  string $appName 
     * @access public
     * @return void
     */
    public function loadLang($moduleName, $appName = '')
    {
        $lang = parent::loadLang($moduleName, $appName);
        $langPath = $this->getTplRoot() . $this->config->template->{$this->clientDevice}->name . DS . '_lang' . DS . $moduleName . DS; 
        $templateLangFile = $langPath . $this->clientLang . '.php';
        if(file_exists($templateLangFile)) include $templateLangFile;
        return $lang;
    }

    /**
     * Set the language used by the client user.
     * 
     * @param   string $lang  zh-cn|zh-tw|en
     * @access  public
     * @return  void
     */
    public function setClientLang($lang = '')
    {
        $langCookieVar = RUN_MODE . 'Lang';
        if((RUN_MODE == 'front' or RUN_MODE == 'admin') and $this->config->installed)
        {
            $records = $this->dbh->query("select `key`,value from " . TABLE_CONFIG . " where owner = 'system' and module = 'common' and section = 'site' and `key` in ('defaultLang', 'lang', 'cn2tw')")->fetchAll();
            foreach($records as $record)
            {
                if($record->key == 'lang')        $enabledLangs  = $record->value;
                if($record->key == 'defaultLang') $defaultLang   = $record->value;
                if($record->key == 'cn2tw') $this->config->cn2tw = $record->value;
            }

            if(!empty($enabledLangs))
            {
                $enabledLangs = explode(',', $enabledLangs);
                foreach($this->config->langs as $code => $title)
                {
                   if(!in_array($code, $enabledLangs)) unset($this->config->langs[$code]);
                }
            }
            
            if(isset($this->config->langs[$defaultLang])) $this->config->default->lang = $defaultLang;
        }

        if(!isset($this->config->langs[$this->config->default->lang])) $this->config->default->lang = current(array_keys($this->config->langs));

        if(empty($lang) and RUN_MODE == 'front')
        {
            if(strpos($this->server->http_referer, 'm=visual') !== false and !empty($_COOKIE['adminLang'])) 
            {
                $lang = $_COOKIE['adminLang'];
            }
            else
            {
                $flipedLangs = array_flip($this->config->langsShortcuts);
                if($this->config->requestType == 'GET' and !empty($_GET[$this->config->langVar])) $lang = $flipedLangs[$_GET[$this->config->langVar]];
                if($this->config->requestType != 'GET')
                {
                    $pathInfo = $this->getPathInfo();
                    foreach($this->config->langsShortcuts as $language => $code)
                    {
                        if(strpos(trim($pathInfo, '/'), $code) === 0) $lang = $language;
                    }
                }
            }
        }

        if(empty($lang) and RUN_MODE == 'admin' and isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            $lang = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], ',') === false ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], ','));
        }

        if(!empty($lang) and isset($this->config->langs[$lang])) 
        {
            $this->clientLang = $lang;
        }
        else
        {
            $this->clientLang = $this->config->default->lang;
        }

        setcookie($langCookieVar, $this->clientLang, $this->config->cookieLife, $this->config->cookiePath);
        if(!isset($_COOKIE[$langCookieVar])) $_COOKIE[$langCookieVar] = $this->clientLang;
        
        return $this->clientLang;
    }
   
    /**
     * The shutdown handler.
     * 
     * @access public
     * @return void
     */
    public function shutdown()
    {
        /* If cache on, clear caches. */
        if($this->config->cache->type != 'close') $this->clearCache();
        parent::shutdown();
    }
}
