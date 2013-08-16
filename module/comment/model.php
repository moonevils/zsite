<?php
/**
 * The model file of comment module of xirangEPS.
 *
 * @copyright   Copyright 2013-2013 青岛息壤网络信息有限公司 (QingDao XiRang Network Infomation Co,LTD www.xirangit.com)
 * @license     LGPL
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     comment
 * @version     $Id$
 * @link        http://www.xirang.biz
 */
class commentModel extends model
{
    /**
     * Get comments of one object.
     * 
     * @param  string $objectType    the object type
     * @param  int    $objectID      the object id
     * @access public
     * @return array
     */
    public function getByObject($objectType, $objectID, $pager = null)
    {
        $userComments = $this->cookie->cmts;
        $comments = $this->dao->select('*')->from(TABLE_COMMENT)
            ->where('objectType')->eq($objectType)
            ->andWhere('objectID')->eq($objectID)
            ->andWhere("(INSTR('$userComments', CONCAT('_',id,'_')) != 0 or status != '0' or author = '{$this->app->user->account}')")
            ->orderBy('id_desc')
            ->page($pager, false)
            ->fetchAll('id', false);
        if(!$comments) return array();
        return array_values($comments);
    }

    /**
     * Get comment list.
     * 
     * @param int    $status    the comment status
     * @param object $pager 
     * @access public
     * @return void
     */
    public function getList($status, $pager = null)
    {
        $comments = $this->dao->select('*')->from(TABLE_COMMENT)
            ->where('status')->eq($status)
            ->orderBy('id_desc')
            ->page($pager)
            ->fetchAll('id');

        /* Get article titls and id. */
        $articles = array();
        foreach($comments as $comment) $articles[] = $comment->objectID;
        $articleTitles = $this->dao->select('id, title')->from(TABLE_ARTICLE)->where('id')->in($articles)->fetchPairs('id', 'title');

        foreach($comments as $comment)
        {
            $comment->objectTitle = isset($articleTitles[$comment->objectID]) ? $articleTitles[$comment->objectID] : '';
        }

        return $comments;
    }

    /**
     * Post a comment.
     * 
     * @access public
     * @return void
     */
    public function post()
    {
        $comment = fixer::input('post')
            ->specialChars('content')
            ->add('date', helper::now())
            ->add('ip', $this->server->REMOTE_ADDR)
            ->get();

        $this->dao->insert(TABLE_COMMENT)
            ->data($comment, $skip = 'captcha')
            ->autoCheck()
            ->check('captcha', 'captcha')
            ->checkIF($comment->email, 'email', 'email')
            ->batchCheck('author, content', 'notempty')
            ->exec();

        $commentID = $this->dao->lastInsertId();
        return $commentID;
    }

    /**
     * Delete a comment.
     * 
     * @param string $commentID 
     * @param string $type 
     * @access public
     * @return void
     */
    public function delete($commentID, $type)
    {
        $comment = $this->dao->select('status')->from(TABLE_COMMENT)->where('id')->eq($commentID)->fetch('', false);
        if($comment->status == 0)
        {
            $this->dao->delete()
                ->from(TABLE_COMMENT)
                ->where('status')->eq(0)
                ->beginIF($type == 'single')->andWhere('id')->eq($commentID)->fi()
                ->beginIF($type == 'pre')->andWhere('id')->ge($commentID)->fi()
                ->exec(false);
        }
        else
        {
            $this->dao->delete()->from(TABLE_COMMENT)->where('id')->eq($commentID)->exec(false);
        }
    }

    /**
     * Pass comments.
     * 
     * @param string $commentID 
     * @param string $type          single|pr
     * @access public
     * @return void
     */
    public function pass($commentID, $type)
    {
        $this->dao->update(TABLE_COMMENT)
            ->set('status')->eq(1)
            ->where('status')->eq(0)
            ->beginIF($type == 'single')->andWhere('id')->eq($commentID)->fi()
            ->beginIF($type == 'pre')->andWhere('id')->ge($commentID)->fi()
            ->exec(false);
    }

    /**
     * Set the comemnt id the user posted to the cookie. Thus before approvaled, the user can view these comments.
     * 
     * @param string $commentID
     * @access public
     * @return void
     */
    public function setCookie($commentID)
    {
        $commentID = '_' . $commentID . '_';
        $comments = $this->cookie->cmts;
        if(!$comments)
        {
            $comments = $commentID;
        }
        else
        {
            if(strpos($comments, $commentID) === false)
            {
                $comments .= $commentID;
            }
        }
        setcookie('cmts', $comments);
    }

    /**
     * Get the link of the object of one comment.
     * 
     * @param string $comment 
     * @access public
     * @return sting
     */
    public function getObjectLink($comment)
    {
        if($comment->objectType == 'doc')
        {
            $link = helper::createLink('help', 'read', "articleID=$comment->objectID");
        }
        else
        {
            $link = helper::createLink('article', 'view', "articleID=$comment->objectID");
        }

        return $link;
    }
}
