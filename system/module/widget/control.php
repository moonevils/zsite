<?php
/**
 * The control file of widget module of RanZhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     widget
 * @version     $Id$
 * @link        http://www.ranzhico.com
 */
class widget extends control
{
    /**
     * Create a widget.
     * 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function create($type = '')
    {
        if($_POST)
        {
            $this->widget->create($type);
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::geterror()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => $this->createLink('admin', 'index')));
        }

        $this->view->title = $this->lang->widget->create;
        $this->view->type  = $type;
        $this->display();
    }

    /**
     * edit a widget. 
     * 
     * @param  int    $id 
     * @access public
     * @return void
     */
    public function edit($id, $type = '')
    {
        if($_POST)
        {
            $this->widget->update($id);
            if(dao::isError())  $this->send(array('result' => 'fail', 'message' => dao::geterror()));
            $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => $this->createLink('admin', 'index')));
        }

        $widget = $this->widget->getByID($id);
        $hiddenWidgets = $this->widget->getHiddenWidgets();

        if($type) $widget->type = $type;
        $this->view->widget = $widget;
        $this->view->title  = $this->lang->widget->editWidget;
        $this->view->type   = $widget->type;
        $this->display();
    }

    /**
     * Print widget. 
     *
     * @param  int    $widget 
     * @access public
     * @return void
     */
    public function printWidget($widget)
    {
        $widget = $this->widget->getByID($widget);
        if(empty($widget)) return false;

        if($widget->type == 'html')
        {
            die( "<div class='article-content'>" . htmlspecialchars_decode($widget->params->html) .'</div>');
        }
        elseif($widget->type == 'rss')
        {
            die($this->widget->getRss($widget));
        }

        $this->app->loadClass('pager', true);
        $this->view->widget = $widget;       
        $this->display();
    }

    /**
     * Sort widget.
     * 
     * @param  string    $oldOrder 
     * @param  string    $newOrder 
     * @param  string    $app 
     * @access public
     * @return void
     */
    public function sort($oldOrder, $newOrder, $app = 'sys')
    {
        $oldOrder  = explode(',', $oldOrder);
        $newOrder  = explode(',', $newOrder);
        $orderList = $this->widget->getWidgetList($app);

        foreach($oldOrder as $key => $oldIndex)
        {
            if(!isset($orderList[$oldIndex])) continue;
            $order = $orderList[$oldIndex];
            $order->order = $newOrder[$key];
            $this->dao->replace(TABLE_BLOCK)->data($order)->exec();
        }

        if(dao::isError()) $this->send(array('result' => 'fail'));
        $this->send(array('result' => 'success'));
    }

    /**
     * Delete widget 
     * 
     * @param  int    $index 
     * @param  string $sys 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function delete($id)
    {
        $this->dao->delete()->from(TABLE_BLOCK)->where('`id`')->eq($index)->andWhere('account')->eq($this->app->user->account)->exec();
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success'));
    }

    /**
     * Hide a widget.
     * 
     * @param  int    $index 
     * @param  string $sys 
     * @param  string $type 
     * @access public
     * @return void
     */
    public function hide($id)
    {
        $this->dao->update(TABLE_BLOCK)->set('hidden')->eq(1)->where('`order`')->eq($index)->andWhere('account')->eq($this->app->user->account)->andWhere('app')->eq($app)->exec();
        if(dao::isError()) $this->send(array('result' => 'fail', 'message' => dao::getError()));
        $this->send(array('result' => 'success'));
    }
}
