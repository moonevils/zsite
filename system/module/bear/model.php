<?php
/**
 * The model file of bear module of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     bear
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class bearModel extends model
{
    const API_REALTIME = 'reatime';
    const API_BATECH   = 'bactch';
    /**
     * Save setting function.
     * 
     * @access public
     * @return array
     */
    public function saveSetting()
    {
        $bear = fixer::input('post')
            ->setDefault('autoSync', '')
            ->join('autoSync', ',')
            ->get();

        $errors = array();
        if(empty(trim($bear->type))) $errors['type'][] = sprintf($this->lang->error->notempty, $this->lang->bear->type);
        if(empty(trim($bear->name))) $errors['name'][] = sprintf($this->lang->error->notempty, $this->lang->bear->name);
        if(empty(trim($bear->appID))) $errors['appID'][] = sprintf($this->lang->error->notempty, $this->lang->bear->appID);
        if(empty(trim($bear->token))) $errors['token'][] = sprintf($this->lang->error->notempty, $this->lang->bear->token);

        if(!empty($errors)) return array('result' => 'fail', 'message' => $errors);

        $result = $this->loadModel('setting')->setItems('system.common.bear', $bear);
        if($result) return array('result' => 'success', 'message' => $this->lang->saveSuccess);
    }

    /**
     * Submit url to bear.
     * 
     * @param  array    $urlList 
     * @param  string   $type 
     * @param  string   $auto 
     * @access public
     * @return object
     */
    public function submit($objectType, $objectID, $type = 'batch', $auto = 'no')
    {

        switch($objectType)
        {
            case 'article':
                $url = $this->loadModel('article')->createPreviewLink($objectID, 'html', $objectType); 
                break;
            case 'blog':
                $url = $this->loadModel('article')->createPreviewLink($objectID, 'html', $objectType);
                break;
            case 'page':
                $url = $this->loadModel('article')->createPreviewLink($objectID, 'html', $objectType);
                break;
            case 'product':
                $url = $this->loadModel('product')->createPreviewLink($objectID); 
                break;
            case 'book':
                $url = $this->loadModel('book')->createPreviewLink($objectID); 
                break;
            case 'thread':
                $url = commonModel::createFrontLink('thread', 'view', "threadID=$thread->id");
                break;
        }

        $scheme  = zget($this->config->site, 'scheme', 'http');
        $domain  = zget($this->config->site, 'domain', '') ?  zget($this->config->site, 'domain', '') : $this->server->http_host;
        $urlInfo = parse_url($url);
        $query   = !empty($urlInfo['query']) ? "?{$urlInfo['query']}" : '';
        $url     = $scheme . "://" . $domain . $urlInfo['path'] . $query;
        $api = sprintf($this->config->bear->apiList->posturl, $this->config->bear->appID, $this->config->bear->token, $type);

		$curl = curl_init();

		$options =  array();
		$options[CURLOPT_URL]		     = $api;
		$options[CURLOPT_POST]           = true;
		$options[CURLOPT_RETURNTRANSFER] = true;
		$options[CURLOPT_POSTFIELDS]     = $url;
		$options[CURLOPT_HTTPHEADER]     = array('Content-Type: text/plain');

		curl_setopt_array($curl, $options);

		$result = curl_exec($curl);
		curl_close($curl);
        $result = json_decode($result);

        if(!is_object($result)) return false;

        $result->type = $type;
        $result->remain  = zget($result, "remain_{$type}", 0);
        $result->success = zget($result, "success_{$type}", 0);
        $result->status  = $result->success == 1 ? 'success' : 'fail';

        $this->log($type, $objectType, $objectID, $url, $result, $auto);
        return $result;
	}

    /**
     * save submit log function.
     * 
     * @param  int    $objectType 
     * @param  int    $objectID 
     * @param  int    $url 
     * @param  int    $result 
     * @access public
     * @return void
     */
    public function log($type, $objectType, $objectID, $url, $result)
    {
        $data = new stdclass();
        $data->type       = $type;
        $data->account    = $this->app->user->account;
        $data->objectType = $objectType;
        $data->objectID   = $objectID;
        $data->status     = $result->status;
        $data->auto       = 'yes';
        $data->response   = json_encode($result);
        $data->time       = helper::now();
        $this->dao->insert(TABLE_BEARLOG)->data($data)->exec();
        return dao::isError();
    }
}
