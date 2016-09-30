<?php
/**
 * The model file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class siteModel extends model
{
    /**
     * Set the site user visiting.
     *
     * @access public
     * @return void
     */
    public function setSite()
    {
        if(!isset($this->config->site->name))  $this->config->site->name = $this->lang->chanzhiEPS;
    }
    
    /**
     * Set the site syetem options.
     *
     * @access public
     * @return void
     */
    public function setSystem()
    {
        $errors ='';
        $data   = fixer::input('post')->get();

        $configRoot   = $this->app->getConfigRoot();
        $systemConfig = $configRoot . 'custom.php';
        
        if(!file_exists($systemConfig))
        {
            $command = "touch $configRoot";
            $error   = sprintf($this->lang->site->fileRequired, $command);
            $errors['submit'] = $error;
            return array('result' => 'fail', 'message' => $errors);
        }
        
        if(file_exists($systemConfig) and is_writable($systemConfig) !== true)
        {
            $error = sprintf($this->lang->site->fileAuthority, 'chmod o=rwx ' . $systemConfig);
            $errors['submit'] = $error;
            return array('result' => 'fail', 'message' => $errors);
        }        
        if(file_exists($systemConfig) and is_writable($systemConfig))
        {
            file_put_contents($systemConfig, "<?php\n");
            
            $content = '';
            foreach($data as $type => $option)
            {
                if($type == 'enabledLangs')
                {
                    $content .= '$config->enabledLangs = \'';
                    foreach($option as $item)
                    {
                        $content .= "$item,";
                    }
                    $content  = rtrim($content, ',');
                    $content .= "';\n";
                }
                if((in_array('zh-tw', $data->enabledLangs) == true) and $type == 'cn2tw')
                {
                    $content .= '$config->cn2tw = ' . $option[0] . ";\n";
                }
                if($type == 'defaultLang')
                {
                    $content .= '$config->defaultLang = \'' . $option . "';\n";
                }
                if($type == 'requestType')
                {
                    $content .= '$config->requestType = \'' . $option. "';\n";
                }
            }
            file_put_contents($systemConfig, $content, FILE_APPEND);
            return array('result' => 'success', 'message' => $this->lang->saveSuccess); 
        }
    }
}
