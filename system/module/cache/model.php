<?php
/**
 * The model file of cache module of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     cache
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class cacheModel extends model
{

    /**
     * __construct function get instance of caceh class.
     * 
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->app->loadClass('cache', true);
        if($this->config->cacher) $this->cacher = cache::factory($this->config->cacher, zget($this->config->cache, $this->config->cacher));
    }

    /**
     * Get one item from cache.
     * 
     * @param  string    $key 
     * @access public
     * @return mix cache content
     */
    public function get($key)
    {
        return $this->config->cacher ? $this->cacher->get($key) : false;
    }

    /**
     * Set one cache item.
     * 
     * @param  string    $key 
     * @param  mix       $value 
     * @access public
     * @return void
     */
    public function set($key, $value)
    {
        return $this->config->cacher ?  $this->cacher->set($key, $value) : false;
    }
}
