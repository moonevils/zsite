<?php
/**
 * The control file of farm of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     farm
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class farm extends control
{
    /**
     * Admin page of farm.
     * 
     * @param  int    $recTotal 
     * @param  int    $recPerPage 
     * @param  int    $pageID 
     * @access public
     * @return void
     */
    public function admin($recTotal = 0, $recPerPage = 10, $pageID = 1)
    {
        $this->app->loadClass('pager', $static = true);
        $pager = new pager($recTotal, $recPerPage, $pageID);
        
        $this->lang->farm->menu = $this->lang->site->menu;
        $this->config->menuGroups->farm = 'setting';
        $this->view->farms = $this->farm->getList($pager);
        $this->view->title = $this->lang->farm->admin;
        $this->view->pager = $pager;
        $this->display();   
    }

    /**
     * Create a farm.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        if($_POST)
        {
            $result = $this->farm->create();
            $this->send($result);
        }

        $this->view->title = $this->lang->farm->create;
        $this->display();
    }

    /**
     * Edit a farm.
     * 
     * @param  int    $farmID 
     * @access public
     * @return void
     */
    public function edit($farmID)
    {
        if($_POST)
        {
            $result = $this->farm->update($farmID);
            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin')));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }

        $this->view->farm  = $this->farm->getByID($farmID);
        $this->view->title = $this->lang->farm->edit;
        $this->display();
    }

    /**
     * Delete a farm.
     * 
     * @param  int    $farmID 
     * @access public
     * @return void
     */
    public function delete($farmID)
    {
        $this->dao->delete()->from(TABLE_FARM)->where('id')->eq($farmID)->exec();
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success', 'message' => $this->lang->deleteSuccess, 'locate' => inlink('admin')));
    }

    /**
     * Register an farm.
     * 
     * @access public
     * @return void
     */
    public function register()
    {
        $user = $this->loadModel('user')->getByAccount($this->get->account);
        if(empty($user)) die(json_encode(array('result' => 'fail', 'error' => 'account')));
        if($user->password != md5($this->get->password . $user->account . $user->join) and $user->password != md5($this->get->password . $user->account)) exit(json_encode(array('result' => 'fail', 'error' => 'account')));
        if($user->admin == 'no') exit(json_encode(array('result' => 'fail', 'error' => 'account')));
        
        $farm = fixer::input('get')->add('private', md5(uniqid()))->get();
        $farm->url = helper::safe64Decode($this->get->url);
        $this->dao->replace(TABLE_FARM)->data($farm, 'account,password')->batchCheck($this->config->farm->require->create, 'notempty')->exec();

        if(dao::isError()) exit(json_encode(array('result' => 'fail', 'error' => 'save', 'message' => dao::getError())));
        echo json_encode(array('result' => 'success', 'private' => $farm->private));
    }

    /**
     *  Get tree api.
     * 
     * @param  string    $type 
     * @access public
     * @return string
     */
    public function apiGetTree()
    {
        $this->farm->checkFarm();
        $categories = $this->loadModel('tree')->getOptionMenu($this->post->type, 0, $removeRoot = true);
        $return = array();
        $return['result'] = 'success';
        $return['data']   = $categories;
        die(json_encode($return));
    }
}
