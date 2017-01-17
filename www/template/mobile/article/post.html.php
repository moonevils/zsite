<?php
/**
 * The post view file of article for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2016 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<div class='modal-dialog'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span></button>
      <h5 class='modal-title'><i class='icon-edit'></i> <?php echo $lang->submission->common;?></h5>
    </div>
    <div class='modal-body'>
      <form id='postArticleForm' method='post' action="<?php echo inlink('post');?>">
        <div class='row'>
          <div class='col-6'>
            <div class='form-group'>
              <label for='author' class='control-label'><?php echo $lang->article->author;?></label>
              <?php echo html::input('author', $this->app->user->account, "class='form-control'");?>
            </div>
          </div>
          <div class='col-6'>
            <div class='form-group'>
              <label for='source' class='control-label'><?php echo $lang->article->source;?></label>
              <?php echo html::select('source', $lang->article->sourceList, 'original', "class='form-control'");?>
            </div>
          </div>
        </div>
        <div class='row hidden' style='margin-bottom: 10px' id='sourceRow'>
          <div class='col-6'><?php echo html::input('copySite', '', "class='form-control' placeholder='{$lang->article->copySite}'"); ?></div>
          <div class='col-6'><?php echo html::input('copyURL',  '', "class='form-control' placeholder='{$lang->article->copyURL}'"); ?></div>
        </div>
        <div class='form-group'>
          <label for='title' class='control-label'><?php echo $lang->article->title;?></label>
          <?php echo html::input('title', '', "class='form-control'");?>
        </div>
        <div class='form-group'>
          <label for='keywords' class='control-label'><?php echo $lang->article->keywords;?></label>
          <?php echo html::input('keywords', '', "class='form-control' placeholder='{$lang->keywordsHolder}'");?>
        </div>
        <div class='form-group'>
          <label for='summary' class='control-label'><?php echo $lang->article->summary;?></label>
          <?php echo html::textarea('summary', '', "rows='2' class='form-control'");?>
        </div>
        <div class='form-group'>
          <label for='content' class='control-label'><?php echo $lang->article->content;?></label>
          <?php echo html::textarea('content', '', "rows='10' class='form-control'");?>
        </div>
        <div class='form-group'>
          <?php echo html::submitButton('', 'btn primary block');?>
        </div>
      </form>
    </div>
  </div>
</div>
<style>
.form-group > .form-control + .form-control {margin-top: 5px}
</style>
<script>
$(function()
{
    $('#source').on('change', function()
    {
        $('#sourceRow').toggleClass('hidden', $(this).val() === 'original');
    });

    var $postArticleForm = $('#postArticleForm');
    $postArticleForm.ajaxform({onSuccess: function(response)
    {
        if(response.result == 'success')
        {
            $.closeModal();
        }
    }});
});
</script>
