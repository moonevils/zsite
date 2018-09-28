<?php
/**
 * The control file of bear of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     bear
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class bear extends control
{
    /**
     * bear setting function.
     * 
     * @access public
     * @return void
     */
    public function setting()
    {
        if($_POST)
        {
            $result = $this->bear->saveSetting();
            $this->send($result);
        }

        $this->view->title = $this->lang->bear->setting;
        $this->view->bear  = $this->config->bear;
        $this->display();
    }

    /**
     * Submit 
     * 
     * @param  int    $objectType 
     * @param  int    $objectID 
     * @access public
     * @return void
     */
    public function submit($objectType, $objectID)
    {
        if($_POST)
        {
            $result = $this->bear->submit($objectType, $objectID, $this->post->type, 'no');
            if($result->success) $this->send(array('result' => 'success', 'message' => $this->lang->bear->submitSuccess, 'locate' => $this->server->http_referer));
            $error = $this->lang->bear->submitFail;
            if(isset($result->not_same_site) and !empty($result->not_same_site)) $error .= $lang->clone . sprintf($this->lang->bear->notices['not_same_site'], join(',', $result->not_same_site)); 
            if(isset($result->not_valid) and !empty($result->not_same_site)) $error .= $lang->clone . $this->lang->bear->notices['not_valid']; 
            $this->send(array('result' => 'fail', 'message' => $error));
        }

        $this->view->title = $this->lang->bear->submit;
        $this->view->objectType = $objectType;
        $this->view->objectID   = $objectID;
        $this->display();
    }

}
