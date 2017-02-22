<?php
/**
 * The setting view file of book module of Chanzhi.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     book
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div class='col-md-12'>
  <div class='panel'>
    <div class='panel-heading'><strong><i class='icon-cog'></i> <?php echo $lang->article->blog->setting;?></strong></div>
    <form method='post' id='ajaxForm' class='form-inline' style='margin-top:10px;'>
      <table class='table table-form'>
        <tr>
          <th><?php echo $lang->article->blog->showCategory;?></th>
          <td>
            <div class='input-group'>
              <span class='input-group-addon'>
                    <input type='checkbox' name='showCategory' <?php if(isset($config->blog->showCategory) and $config->blog->showCategory)  echo 'checked';?>  value='1' />
              </span>
              <?php echo html::select('categoryAbbr', $lang->article->blog->showCategoryList, isset($config->blog->categoryAbbr) ? $config->blog->categoryAbbr : '', "class='form-control'");?>
            </div>
          </td>
        </tr>
        <tr>
          <th class='w-120px'><?php echo $lang->article->blog->categoryLevel;?></th>
          <td class='w-p40'><?php echo html::select('categoryLevel', $lang->article->blog->categoryLevelList, isset($this->config->blog->categoryLevel) ? $this->config->blog->categoryLevel : '', "class='form-control'");?></td>
          <td></td>
        </tr>
        <tr>
          <th></th>
          <td colspan='2'><?php echo html::submitButton();?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
