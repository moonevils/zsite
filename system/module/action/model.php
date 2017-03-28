<?php
/**
 * The model file of action module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     action
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class actionModel extends model
{
    /**
     * Create a action.
     * 
     * @param  string $objectType 
     * @param  int    $objectID 
     * @param  string $actionType 
     * @param  string $comment 
     * @param  string $extra        the extra info of this action, according to different modules and actions, can set different extra.
     * @access public
     * @return int
     */
    public function create($objectType, $objectID, $actionType, $comment = '', $extra = '', $actor = '')
    {
        $action = new stdclass();
        $action->objectType = strtolower($objectType);
        $action->objectID   = $objectID;
        $action->actor      = $actor ? $actor : $this->app->user->account;
        $action->action     = strtolower($actionType);
        $action->date       = helper::now();
        $action->comment    = $comment;
        $action->extra      = $extra;

        $this->dao->insert(TABLE_ACTION)->data($action)->autoCheck()->exec();
        return $this->dbh->lastInsertID();
    }

    /**
     * Get actions of an object.
     * 
     * @param  int    $objectType 
     * @param  int    $objectID 
     * @access public
     * @return array
     */
    public function getList($objectType, $objectID, $action = '', $pager = null, $origin = '')
    {
        return $this->dao->select('*')->from(TABLE_ACTION)
            ->where('objectType')->eq($objectType)
            ->andWhere('objectID')->eq($objectID)
            ->beginIF($action)->andWhere('action')->eq($action)->fi()
            ->orderBy('id_desc')
            ->page($pager)
            ->fetchAll('id');
    }

    /**
     * Get an action record.
     * 
     * @param  int    $actionID 
     * @access public
     * @return object
     */
    public function getById($actionID)
    {
        return $this->dao->findById((int)$actionID)->from(TABLE_ACTION)->fetch();
    }

    /**
     * Print actions of an object.
     * 
     * @param  array    $action 
     * @access public
     * @return void
     */
    public function printAction($action)
    {
        $objectType = $action->objectType;
        $actionType = strtolower($action->action);

        /**
         * Set the desc string of this action.
         *
         * 1. If the module of this action has defined desc of this actionType, use it.
         * 2. If no defined in the module language, search the common action define.
         * 3. If not found in the lang->action->desc, use the $lang->action->desc->common or $lang->action->desc->extra as the default.
         */
        if(isset($this->lang->$objectType->action->$actionType))
        {
            $desc = $this->lang->$objectType->action->$actionType;
        }
        elseif(isset($this->lang->action->desc->$actionType))
        {
            $desc = $this->lang->action->desc->$actionType;
        }
        else
        {
            $desc = $action->extra ? $this->lang->action->desc->extra : $this->lang->action->desc->common;
        }
        /* Cycle actions, replace vars. */
        foreach($action as $key => $value)
        {
            /* Desc can be an array or string. */
            if(is_array($desc))
            {
                if($key == 'extra') continue;
                $desc['main'] = str_replace('$' . $key, $value, $desc['main']);
            }
            else
            {
                $desc = str_replace('$' . $key, $value, $desc);
            }
        }
        /* If the desc is an array, process extra. Please bug/lang. */
        if(is_array($desc))
        {
            $extra = strtolower($action->extra);
            if(isset($desc['extra'][$extra])) 
            {
                echo str_replace('$extra', $desc['extra'][$extra], $desc['main']);
            }
            else
            {
                echo str_replace('$extra', $action->extra, $desc['main']);
            }
        }
        else
        {
            if($action->action == 'valuated')
            {
                echo $desc . $this->lang->action->valuate . $this->lang->request->valuates[$action->extra];
            }
            else
            {
                echo $desc; 
            }
        }
    }

    /**
     * Update comment of a action.
     * 
     * @param  int    $actionID 
     * @access public
     * @return void
     */
    public function updateComment($actionID)
    {
        $this->dao->update(TABLE_ACTION)
            ->set('date')->eq(helper::now())
            ->set('comment')->eq($this->post->lastComment)
            ->where('id')->eq($actionID)
            ->exec();
    }

}
