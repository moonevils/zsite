<?php
/**
 * The control file of admin module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     admin
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class admin extends control
{
    /**
     * The index page of admin panel, print the sites.
     * 
     * @access public
     * @return void
     */
    public function index()
    {
        $widgets = $this->loadModel('widget')->getWidgetList();

        /* Init widget when vist index first. */
        if(empty($widgets) and empty($this->config->widgetInited))
        {
            if($this->widget->initWidget()) die(js::reload());
        }

        foreach($widgets as $key => $widget)
        {
            $widget->params = json_decode($widget->params);
            if(empty($widget->params)) $widget->params = new stdclass();

            $widget->moreLink = zget($this->config->widget->moreLinkList, $widget->type, '');
        }

        $this->view->ignoreUpgrade = isset($this->config->global->ignoreUpgrade) and $this->config->global->ignoreUpgrade;
        $this->view->checkLocation = $this->loadModel('user')->checkAllowedLocation();
        $this->view->widgets        = $widgets;
        $this->display();
    }

    /**
     * Ignore the upgrade notice.
     *
     * @access public
     * return void
     **/
    public function ignoreUpgrade()
    {
        $result = $this->loadModel('setting')->setItems('system.common.global', array('ignoreUpgrade' => true), 'all');
        if($result) $this->send(array('result' => 'success', 'locate' => inlink('index')));
        $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
    }

    /**
     * Ignore the admin entry warning.
     *
     * @access public
     * return void
     **/
    public function ignore()
    {
        $result = $this->loadModel('setting')->setItems('system.common.global', array('ignoreAdminEntry' => true));
        if($result) $this->send(array('result' => 'success', 'locate' => inlink('index')));
        $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
    }

    /**
     * Switch lang.
     * 
     * @param  string    $lang 
     * @access public
     * @return void
     */
    public function switchLang($lang)
    {
        setcookie('adminLang', $lang, $this->config->cookieLife, $this->config->cookiePath);

        $user = $this->app->user;
        $user->rights = $this->loadModel('user')->authorize($user);
        $this->session->set('user', $user);
        $this->app->user = $this->session->user;
        die(js::locate('back'));
    }

    /**
     * Register chanzhi.
     * 
	 * @access public
	 * @return void
	 */
	public function register()
	{
		$registerInfo = $this->admin->getRegisterInfo();
		if($_POST)
		{
			$response = $this->admin->registerByAPI();

			if($response == 'success') 
			{
                $bindResult = $this->admin->bindByAPI();
                if($bindResult->result == 'success')
                {
                    $this->admin->setCommunity($bindResult->data->account, $bindResult->data->private);
                }
                $this->send(array('result' => 'success', 'message' => $this->lang->admin->register->success, 'locate' => inlink('register')));
			}
            $this->send(array('result' => 'fail', 'message' => json_decode($response)));
		}

        $this->lang->menuGroups->admin = 'community';
        $this->view->title    = $this->lang->admin->register->caption;
		$this->view->register = $registerInfo;
		$this->display();
	}

	/**
	 * Bind zentao.
	 * 
	 * @access public
	 * @return void
	 */
	public function bind()
	{
        if($_POST)
        {
            $response = $this->admin->bindByAPI();
            if($response->result == 'success')
            {
                $this->admin->setCommunity($response->data->account, $response->data->private);
                $this->send(array('result' => 'success', 'message' => $this->lang->admin->register->success, 'locate' => inlink('register')));
            }

            $this->send(array('result' => 'fail', 'message' => $response->message));
        }
        exit;
    }
    
    /**
     * Unbind chanzhi account.
     * 
     * @access public
     * @return void
     */
    public function unbind()
    {
        $this->admin->setCommunity('', '');
        $this->locate(inlink('register'));
    }
}
