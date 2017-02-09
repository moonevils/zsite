<?php
/**
 * The auto upgrade file of upgrade module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     article
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.modal.html.php';?>
<?php if(!$isLatestVersion) js::set('url', $latestVersion['releasePackage']);?>
<?php if(!$isLatestVersion) js::set('downloadingpackage', $lang->misc->downloadingpackage);?>
<div>
  <?php if($isLatestVersion):?>
  <div class='versionBox'>
    <strong><?php echo $lang->misc->isLatestVersion;?></strong>
  </div>
  <?php else:?>
  <div class='versionBox'>
    <p>
      <?php 
        echo $lang->misc->currentVersion . $config->version . ', ';
        echo $lang->misc->autoUpgradeTip . $latestVersion['version'] . ', '; 
        echo html::a($latestVersion['url'], $lang->misc->checkUpgradeInfo, "target=_blank");
      ?>
    </p>
    <p><?php echo html::a(inlink('preparedownload'), $lang->misc->startUpgrade, "class='btn btn-primary' id='upgradeBtn'");?></p>
  </div>
  <div class='upgradeBox'>
    <ul class='resultBox'>
      <li id='hasError' class='hidden'><span id='error'>ssssssssssss</span></li>
      <li id='downloading' class='hidden'><?php echo $lang->misc->downloadingPackage;?> <span id='progress'>0</span>%</li>
      <li id='downloaded' class='hidden'><?php echo $lang->misc->downloadedPackage;?></li>
      <li id='checking' class='hidden'><?php echo $lang->misc->checkingPackage;?></li>
      <li id='checked' class='hidden'><?php echo $lang->misc->checkedPackage;?></li>
      <li id='extracting' class='hidden'><?php echo $lang->misc->extractingPackage;?></li>
    </ul>
  </div>
  <?php endif;?>
</div>
<?php include '../../common/view/footer.modal.html.php';?>
