<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'header');?>
<div class='page-user-control'>
  <div class='row'>
    <?php include TPL_ROOT . 'user/side.html.php';?>
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-envelope-alt'></i> <?php echo $lang->user->submission;?></strong>
          <div class='panel-actions'><?php commonModel::printLink('article', 'post', '', '<i class="icon-plus"></i> ' . $lang->article->post, 'class="btn btn-primary"');?></div>
        </div>
        <?php if(!empty($articles)):?>
        <table class='table table-hover table-striped tablesorter'>
          <thead>
            <tr>
              <th class='text-center w-50px'><?php echo $lang->article->id;?></th>
              <th class='text-center'><?php echo $lang->article->title;?></th>
              <th class='text-center w-160px'><?php echo $lang->article->submissionTime;?></th>
              <th class='text-center w-60px'><?php echo $lang->article->status;?></th>
              <th class='text-center w-60px'><?php echo $lang->article->views;?></th>
              <th class="text-center w-120px"><?php echo $lang->actions;?></th>
            </tr>
          </thead>
          <tbody>
            <?php $maxOrder = 0; foreach($articles as $article):?>
            <tr>
              <td class='text-center'><?php echo $article->id;?></td>
              <td>
                <?php 
                    if($article->submission == 2)
                    {
                        if($article->type == 'book')
                        {
                            echo html::a($this->article->createPreviewLink($article->bookID, '', $article->type), $article->title, "target='_blank'");
                        }
                        else
                        {
                            echo html::a($this->article->createPreviewLink($article->id), $article->title, "target='_blank'");
                        }
                    }
                    else 
                    {
                        echo $article->title;
                    }
                ?>
              </td>
              <td class='text-center'><?php echo $article->editedDate;?></td>
              <td class='text-center'><?php echo $lang->submission->status[$article->submission];?></td>
              <td class='text-center'><?php echo $article->views;?></td>
              <td class='text-center'>
                <?php
                    if($article->submission != 2)
                    {
                        commonModel::printLink('article', 'modify', "articleID=$article->id", $lang->edit);
                        commonModel::printLink('article', 'delete', "articleID=$article->id", $lang->delete, 'class="deleter"');
                    }
                    else echo html::a('javascript:;', $lang->edit, "class='disabled'") . html::a('javascript:;', $lang->delete, "class='disabled'");
                ?>
              </td>
            </tr>
            <?php endforeach;?>
          </tbody>
          <tfoot><tr><td colspan='6'><?php $pager->show();?></td></tr></tfoot>
        </table>
        <?php else:?>
        <div class='panel-body'>
          <?php echo $lang->article->noSubmission;?>
          <?php echo html::a(inlink('post'), "<i class='icon icon-plus'> </i>{$lang->article->post}", "class='btn btn-success'");?>
        </div>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<?php include $this->loadModel('ui')->getEffectViewFile('default', 'common', 'footer');?>
