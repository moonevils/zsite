<?php
/**
 * The control file of misc of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     misc
 * @version     $Id$
 * @link        http://www.zentao.net
 */
class misc extends control
{
    public function ping()
    {
        die();
    }

    /**
     * Create qrcode for mobile visit.
     *
     * @access public
     * @return void
     */
    public function qrcode()
    {
        $this->app->loadClass('qrcode');
        QRcode::png($this->server->http_referer, false, 4, 6);
        exit;
    }

    /**
     * Show about info of chanzhi.
     *
     * @access public
     * @return void
     */
    public function about()
    {
        $this->view->title = $this->lang->about;
        $this->display();
    }

    /**
     * The thanks page.
     *
     * @access public
     * @return void
     */
    public function thanks()
    {
        $this->view->modalWidth = 700;
        $this->display();
    }

    /**
     * Print topbar.
     * 
     * @access public
     * @return void
     */
    public function printTopbar()
    {
        echo commonModel::printTopBar();
        echo commonModel::printLanguageBar();
        exit;
    }
    
    /**
     * Auto upgrade the chanzhi 
     *
     * @access public
     * @return void
     */
    public function autoUpgrade()
    {
        $this->config->version = '5.6';
        $isLatestVersion = true;
        $latestVersion = $this->misc->getLatestVersion();
        if(isset($latestVersion) and is_array($latestVersion))
        {
            if(version_compare($this->config->version, $latestVersion['version']) < 0) 
            {
                $isLatestVersion = false;
                $this->view->latestVersion = $latestVersion;
            }
        }

        $this->view->isLatestVersion = $isLatestVersion;
        $this->view->title           = $this->lang->misc->upgrade;
        $this->display();
    }

    /**
     * Prepare the download of package
     *
     * @access public
     * @param  void
     * @return string
     */
    public function prepareDownload()
    {
        $upgradePath = $this->app->getTmpRoot() . 'upgrade/';
        if(!is_dir($upgradePath)) mkdir($upgradePath, 0777, true);
        
        if(!is_dir($upgradePath)) $this->send(array('result' => 'fail', 'message' => $this->lang->misc->invalidUpgradePath['no_dir']));
        if(!is_writable($upgradePath)) $this->send(array('result' => 'fail', 'message' => $this->lang->misc->invalidUpgradePath['not_writable']));
        $this->send(array('result' => 'success'));
    }

    /**
     * Start the download of package
     *
     * @access public
     * @param  void
     * @return void
     */
    public function startDownload($url)
    {
        $tmpPath = $this->app->getTmpRoot() . 'upgrade/chanzhieps.zip';
        set_time_limit(0);
        //touch($tmpPath);
        
        if ($fp = fopen($url, "rb")) 
        {
            if (!$downloadFp = fopen($tmpPath, "wb")) 
            {
                exit;
            }
            while (!feof($fp)) 
            {
                if (!file_exists($tmpPath)) 
                {
                    fclose($downloadFp);
                    exit;
                }
                fwrite($downloadFp, fread($fp, 1024 * 8 ), 1024 * 8);
            }
            fclose($downloadFp);
            fclose($fp);
        }
    }
    /**
     * Get the download progress
     * @access public 
     * @param  void
     * @return array
     */
    public function getDownloadProgress()
    {
        $tmpPath = $this->app->getTmpRoot() . 'upgrade/chanzhieps.zip';
        if(is_file($tmpPath))
        {
            $this->send(array('size' => filesize($tmpPath)));
        }
        else
        {
            $this->send(array('size' => 0));
        }
    } 

    /**
     * Get the full size of download
     *
     * @access public 
     * @param  void
     * @return array
     */
    public function getDownloadFullSize($url)
    {
        $urlHeader = get_headers($url, true);
        if(isset($urlHeader['Content-Length']))
        {
            $this->send(array('fullsize' => $urlHeader['Content-Length']));
        }
        else
        {
            $this->send(array('fullsize' => 0));
        }
    }
}
