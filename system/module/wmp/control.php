<?php
/**
 * The control file of wmp module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     wmp
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class wmp extends control
{
    /**
     * Set wechat applet.
     * 
     * @access public
     * @return void
     */
    public function setting()
    {
        $this->lang->menuGroups->wmp = 'interface';

        if(!empty($_POST))
        {
            $setting = fixer::input('post')->get();
            if(!isset($this->config->wmp->private)) $setting->private = md5(rand());

            $result = $this->loadModel('setting')->setItems('system.common.wmp', $setting);

            if($result) $this->send(array('result' => 'success', 'message' => $this->lang->setSuccess, 'locate' => inlink('setting')));
            $this->send(array('result' => 'fail', 'message' => $this->lang->fail));
        }

        $this->view->title = $this->lang->wmp->setting;
        $this->display();
    }

    /**
     * Download wmp package.
     * 
     * @access public
     * @return void
     */
    public function downloadPackage()
    {
        $libRoot           = $this->app->getCoreLibRoot();
        $tmpRoot           = $this->app->getTmpRoot();
        $wmpPath           = $libRoot . 'wmp';
        $wmpTmpPath        = $tmpRoot . 'wmp';
        $projectConfigFile = $tmpRoot . 'wmp/project.config.json';
        $myConfigFile      = $tmpRoot . 'wmp/config/my.js';
        $wmpZipfile        = $tmpRoot . 'wmp.zip';

        $commads   = array();
        $commads[] = "rm -f {$wmpZipfile}";
        $commads[] = "rm -rf {$wmpTmpPath}";

        $commads[] = "cp -rf {$wmpPath} {$tmpRoot}";

        foreach($commads as $commad) `$commad`;

        $projectConfigContent = file_get_contents($projectConfigFile);
        if(isset($this->config->wmp->appID))       $projectConfigContent = preg_replace("/appid.*/", 'appid": "' . $this->config->wmp->appID . '",', $projectConfigContent);
        if(isset($this->config->wmp->projectName)) $projectConfigContent = preg_replace("/projectname.*/", 'projectname": "' . $this->config->wmp->projectName . '",', $projectConfigContent);
        file_put_contents($projectConfigFile, $projectConfigContent);

        $webRoot = getWebRoot(true);
        $myConfigContent = file_get_contents($myConfigFile);
        if(isset($this->config->wmp->private))  $myConfigContent = preg_replace("/token.*/", 'token: \'' . $this->config->wmp->private . '\',', $myConfigContent);
        if(isset($this->config->company->name)) $myConfigContent = preg_replace("/siteName.*/", 'siteName: \'' . $this->config->company->name . '\',', $myConfigContent);
        $myConfigContent = preg_replace("/root.*/", 'root: \'' . getWebRoot($full = true) . '\',', $myConfigContent);
        $myConfigContent = preg_replace("/requestType.*/", 'requestType: \'' . $this->config->requestType . '\',', $myConfigContent);
        file_put_contents($myConfigFile, $myConfigContent);

        `cd {$tmpRoot}; zip -r wmp.zip wmp`;

        header('Content-Description: File Transfer');
        header('Content-type: application/octet-stream');
        header("Content-Disposition: attachment; filename=wmp.zip");
        header('Content-Length: ' . filesize($wmpZipfile));
        readfile($wmpZipfile);
    }
}
