<?php
/**
 * The control file of menu module of XiRangEPS.
 *
 * @copyright   Copyright 2013-2013 QingDao XiRang Network Infomation Co,LTD (www.xirang.biz)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     menu
 * @version     $Id$
 * @link        http://www.xirang.biz
 */
class menu extends control
{
    /**
     * menu setting function
     *
     * @access public
     * @return void
     */
    public function index()
    {   
        if($_POST)
        {
            $menus = $_POST['menu'];
            foreach($menus as $key => $menu)
            {
                $menus[$key] = $this->menu->organizeMenu($menu);
            }
            //a($menus);exit;
            if(isset($menus['2'])) $menus['2'] = $this->menu->group($menus['2']);
            if(isset($menus['3'])) $menus['3'] = $this->menu->group($menus['3']);
            $result = $this->loadModel('setting')->setItems('system.common.menu', array('mainMenu' => json_encode($menus)));
            if($result) $this->send(array('return' => 'success', 'message' => $this->lang->setSuccess));
            $this->send(array('result' => 'fail', 'message' => $this->lang->faild));
 
        }
        $this->view->menus = $menus = json_decode($this->config->menu->mainMenu,true);
        $this->view->types = $this->lang->menu->types; 
        $this->view->articleTree  = $this->loadModel('tree')->getOptionMenu('article');
        if(empty($this->view->menus) or $_REQUEST['t'] == 1)
        {
            $this->view->menus =Array( 1 => Array ( 0 => Array ( 'menuType' => 'common', 'title' => '首页', 'key' => '0' )));
        }
        $this->display();
    }   
}
