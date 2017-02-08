<?php
/**
 * The model file of misc module of ChanzhiEPS.
 *
 * @copyright   Copyright 2009-2010 QingDao Nature Easy Soft Network Technology Co,LTD (www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv11.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     misc 
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class miscModel extends model
{
    /*
     * Check the version is latest version
     *
     * @param  void
     * @access public 
     * @return bool | string
     */
    public function getLatestVersion()
    {
        if(!function_exists('curl_init')) die('I can\'t fetch anything, please set allow_url_fopen to ture or install curl extension');

        $urlScheme = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
        $url = $urlScheme . '://api.chanzhi.org/latest.php?version=' . $this->config->version . '&type=getLatestVersion';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);

        $result = curl_exec($curl);
        curl_close($curl);
        $result = json_decode(json_decode($result, true), true);
        return $result;
    }
}

