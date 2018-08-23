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
        $tmpRoot           = $this->app->getTmpRoot();
        $wmpZipfile        = $tmpRoot . '/wmp.zip';
        $wmpPath           = $tmpRoot . '/wmp';
        $projectConfigFile = $tmpRoot . '/wmp/project.config.json';

        $commads   = array();
        $commads[] = "rm -f {$wmpZipfile}";
        $commads[] = "rm -rf {$wmpPath}";

        $commads[] = "mkdir -p {$wmpPath}";
        $commads[] = "touch {$projectConfigFile}";

        foreach($commads as $commad) `$commad`;

        file_put_contents($projectConfigFile, sprintf($this->config->wmp->projectConfigContent, $this->config->company->name, $this->config->wmp->appID, $this->config->wmp->projectName));

        `cd {$tmpRoot}; zip -r wmp.zip wmp`;

        header('Content-Description: File Transfer');
        header('Content-type: application/octet-stream');
        header("Content-Disposition: attachment; filename=wmp.zip");
        header('Content-Length: ' . filesize($wmpZipfile));
        readfile($wmpZipfile);
    }
}
