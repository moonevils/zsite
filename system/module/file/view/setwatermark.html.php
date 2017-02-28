<?php
/**
 * The setupload  view file of site module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      xiying Guang <guanxiying@xirangit.com>
 * @package     site
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
$colorPlates = '';
foreach (explode('|', $lang->colorPlates) as $value)
{
    $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
}
?>
<?php include '../../common/view/header.admin.html.php';?>
<?php js::set('rebuildWatermark', $lang->file->rebuildWatermark);?>
<div class='panel'>
  <div class='panel-heading'><strong><i class='icon-globe'></i> <?php echo $lang->file->setWatermark;?></strong></div>
  <div class='panel-body'>
    <form method='post' id='ajaxForm' class='form-inline'>
      <table class='table table-form'>
        <tr>
          <th class='w-100px'><?php echo $lang->file->watermark;?></th>
          <td><?php echo html::radio('watermark', $lang->file->watermarkList, isset($this->config->file->watermark) ? $this->config->file->watermark : 'close', "class='checkbox'");?></td>
        </tr>
        <tr>
          <th><?php echo $lang->file->watermarkContent;?></th>
          <td class='w-500px'>
            <div class='input-group'>
              <?php echo html::input('watermarkContent', !empty($this->config->file->watermarkContent) ? $this->config->file->watermarkContent : $this->config->site->name, "class='form-control'");?>
            </div>
          </td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->file->watermarkSize;?></th>
          <td class='w-200px'>
            <div class='input-group' style='margin-bottom: 10px'>
              <?php echo html::input('watermarkSize', isset($this->config->file->watermarkSize) ? $this->config->file->watermarkSize : '14', "class='form-control'");?>
              <span class="input-group-addon">px</span>
            </div>
          </td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->file->watermarkColor;?></th>
          <td class='w-500px'>
            <div class='input-group colorplate clearfix'>
              <div class='input-group color active' data="<?php echo isset($this->config->file->watermarkColor) ? $this->config->file->watermarkColor : '';?>">
                <label class='input-group-addon'><?php echo $lang->color;?></label>
                <?php echo html::input('watermarkColor', isset($this->config->file->watermarkColor) ? $this->config->file->watermarkColor : '', "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                <span class='input-group-btn' style='border-right: 1px solid rgb(204, 204, 204);'>
                  <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'> <i class='icon icon-question'></i> <span class='caret'></span></button>
                  <div class='dropdown-menu colors'>
                    <?php echo $colorPlates; ?>
                  </div>
                </span>
              </div>
            </div>
          </td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->file->watermarkOpacity;?></th>
          <td class='w-500px'>
            <div class='input-group'>
              <?php echo html::input('watermarkOpacity', !empty($this->config->file->watermarkOpacity) ? $this->config->file->watermarkOpacity : '50', "class='form-control'");?>
            </div>
          </td>
          <td></td>
        </tr>
        <tr>
          <th><?php echo $lang->file->watermarkPosition;?></th>
          <td class='w-500px'>
            <div class='input-group'>
              <?php echo html::select('watermarkPosition', $lang->file->watermarkPositionList, isset($this->config->file->watermarkPosition) ? $this->config->file->watermarkPosition : 'middleMiddle', "class='form-control'");?>
            </div>
          </td>
          <td></td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'>
            <?php echo html::submitButton();?>
            <?php echo html::a(helper::createLink('file', 'rebuildWatermark'), $lang->file->rebuildWatermark, "class='btn btn-primary' id='execButton'");?>
            <span class='alert alert-success total hide'></span>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
