<?php
/**
 * The header view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
?>
<?php $setting = json_decode($block->content);?>
<?php $isSearchAvaliable = commonModel::isAvailable('search'); ?>
<?php $device      = helper::getDevice();?>
<?php $template    = $this->config->template->{$device}->name;?>
<?php $theme       = $this->config->template->{$device}->theme;?>
<?php $logoSetting = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();?>
<?php $logo        = isset($logoSetting->$template->themes->$theme) ? $logoSetting->$template->themes->$theme : (isset($logoSetting->$template->themes->all) ? $logoSetting->$template->themes->all : false);?>
<?php if($setting->nav == 'row' and $setting->slogan == 'besideLogo' and $setting->searchbar == 'besideSlogan'):?>
<?php include "header.default.html.php";?>
<?php else:?>
<?php include "header.layout.html.php";?>
<?php endif;?>
