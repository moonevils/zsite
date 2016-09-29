<?php
/**
 * The model file of farm module of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     farm
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class farmModel extends model
{
    /**
     * Check farm by url and private;
     * 
     * @access public
     * @return void
     */
    public function checkFarm()
    {
        $result = true;
        if(!$this->post->private or !$this->post->from) $result = false;
        $farm = $this->getByUrl(helper::safe64Decode($this->post->from));
        if(empty($farm)) $result = false;
        if($farm->private != $this->post->private) $result = false;
        if(!$result) die('Farm private error.');
        return true;
    }

    /**
     * Get farm by ID.
     * 
     * @param  int    $id 
     * @access public
     * @return array
     */
    public function getByID($farmID)
    {
        return $this->dao->select('*')->from(TABLE_FARM)->where('id')->eq($farmID)->fetch();
    }

    /**
     * Get farm by url.
     * 
     * @param  string    $url 
     * @access public
     * @return array
     */
    public function getByUrl($url)
    {
        return $this->dao->select('*')->from(TABLE_FARM)->where('url')->eq($url)->fetch();
    }

    /**
     * Get farm list.
     * 
     * @param  object    $pager 
     * @access public
     * @return array
     */
    public function getList($pager = null)
    {
        return $this->dao->select('*')->from(TABLE_FARM)->page($pager)->fetchAll('id');
    }

    /**
     * Create a farm site.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        $params = new stdclass();
        $params->m = 'farm';
        $params->f = 'register';
        $params->account  = $this->post->account;
        $params->password = md5($this->post->password);
        $params->url      = helper::safe64Encode(commonModel::getSysUrl() . $this->server->script_name);
        $params->name     = $this->config->site->name;

        $registerUrl = $this->post->url . '?'. http_build_query($params);
        if(substr($registerUrl, 0, 6) != 'http:') $registerUrl = 'http://' . $registerUrl;
        $result = file_get_contents($registerUrl);
        $result = json_decode($result);

        if(!is_object($result)) return array('result' => 'fail', 'message' => zget($this->lang->farm->errors, 'referer'));
        if($result->result !== 'success') return array('result' => 'fail', 'message' => zget($this->lang->farm->errors, $result->error));

        $farm = fixer::input('post')->add('private', $result->private)->get();
        if(substr($farm->url, 0, 4) != 'http') $registerUrl = 'http://' . $registerUrl;

        $this->dao->replace(TABLE_FARM)->data($farm, 'account,password')->batchCheck($this->config->farm->require->create, 'notempty')->exec();
        if(dao::isError()) return array('result' => 'fail', 'message' => dao::getError());
        return array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin'));
    }

    /**
     * Update a farm.
     * 
     * @param  int    $farmID 
     * @access public
     * @return void
     */
    public function update($farmID)
    {
        $farm = fixer::input('post')->get();
        $this->dao->update(TABLE_FARM)->data($farm)->where('id')->eq($farmID)->exec();
        return !dao::isError();
    }

    /**
     * Get tree of a farm
     * 
     * @param  int    $farmID 
     * @param  string    $type 
     * @access public
     * @return void
     */
    public function getTreeFromFarm($farmID, $type)
    {
        $params = new stdclass();
        $params->type = $type;
        $result = $this->post($farmID, 'apigetTree', $params);
        if(!is_object($result)) return false;
        if($result->result == 'success') return $result->data;
        return false;
    }

    /**
     * Post a farm request.
     * 
     * @param  int       $farmID 
     * @param  string    $method 
     * @param  object    $params 
     * @access public
     * @return object
     */
    public function post($farmID, $method, $params)
    {
        $http = $this->app->loadClass('http');

        $farm = $this->getByID($farmID);       
        if(empty($farm)) return false;
        $params->private = $farm->private;
        $params->from    = helper::safe64Encode(commonModel::getSysUrl() . $this->server->script_name);
        $api = $farm->url . "?m=farm&f=$method";
        $result = $http->post($api, $params);
        return json_decode($result);
    }
}
