<?php
/**
 * The logo view file of ui module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='panel'>
  <div class='panel-heading'>
    <strong><i class='icon-certificate'></i><?php echo $lang->ui->setLogo;?></strong>
  </div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' enctype='multipart/form-data'>
      <table class='table table-form table-'>
        <tr>
          <th class='w-100px' rowspan='2'><?php echo $lang->ui->logo . $lang->colon;?></th>
          <td>
            <?php if(isset($logo->webPath)) echo html::image($logo->webPath, "class='logo'");?>
            <?php if(!isset($logo->webPath)) echo "<div class='alert alert-info w-200px text-center'>{$lang->ui->noLogo}</div>";?>
          </td>
        </tr>
        <tr>
          <td><?php echo html::file('logo', "class='form-control'");?></td>
          <td><?php echo html::select('theme', $lang->ui->logoList, '', "class='form-control'");?></td>
          <td>
            <strong class='text-info'>
              <?php if($this->device == 'desktop') printf($lang->ui->suitableLogoSize, '50px-80px', '80px-240px');?>
              <?php if($this->device == 'mobile') printf($lang->ui->suitableLogoSize, '<50px', '50px-200px');?>
            </strong>
          </td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <th class='w-100px' rowspan='2'><?php echo $lang->ui->favicon;?></th>
          <td class=''>
            <?php if(isset($favicon->webPath)) echo html::image($favicon->webPath, "class='favicon'");?>
            <?php if(!isset($favicon->webPath)) echo "<div class='alert alert-danger w-120px text-center'>{$lang->ui->noFavicon}</div>";?>
          </td>
        </tr>
        <tr>
          <td><?php echo html::file('favicon', "class='form-control'");?></td>
        </tr>
        <tfoot>
        <tr>
          <th></th>
          <td class=''>
            <?php echo html::submitButton();?>
            <?php if($favicon or $defaultFavicon) commonModel::printLink('ui', 'deleteFavicon', '', $lang->ui->deleteFavicon, "class='btn'");?>
            <?php if(isset($logo->webPath)) commonModel::printLink('ui', 'deleteLogo', '', $lang->ui->deleteLogo, "class='btn'");?>
          </td>
        </tr>
        </tfoot>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
