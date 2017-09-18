<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header');?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'user', 'side');?>
<div class='panel-section'>
  <div class='panel-heading'>
    <button type='button' class='btn primary block' data-toggle='modal' data-remote="<?php echo inlink('post');?>"><i class='icon-plus'></i> <?php echo $lang->article->post;?></button>
  </div>
  <div class='panel-heading'>
    <div class='title strong'><i class='icon icon-envolope-alt'></i> <?php echo $lang->user->submission;?></div>
  </div>
  <div class='cards condensed cards-list'>
    <?php foreach($articles as $article):?>
    <div class='card' id="article<?php echo $article->id?>" data-ve='article'>
      <div class='card-heading'>
        <div class='pull-right'>
          <small class='bg-danger-pale text-danger'><?php echo $lang->submission->status[$article->submission];?></small>
        </div>
        <h5>
          <?php 
          if($article->submission == 2) echo html::a($this->article->createPreviewLink($article->id), $article->title, "target='_blank'");
          if($article->submission != 2) echo $article->title;
          ?>
        </h5>
      </div>
      <div class='table-layout'>
        <div class='table-cell'>
          <div class='card-content'>
            <div class='pull-right'>
              <?php if($article->submission != 2): ?>
              <?php echo html::a(helper::createLink('article', 'modify', "articleID={$article->id}"), $lang->edit, "class='editor text-primary' data-toggle='modal'");?>&nbsp;&nbsp;
              <?php echo html::a(helper::createLink('article', 'delete', "articleID={$article->id}"), $lang->delete, "class='deleter text-danger' data-locate='self'");?>
              <?php else: ?>
              <a class='disabled'><?php echo $lang->edit ?></a>
              <a class='disabled'><?php echo $lang->delete ?></a>
              <?php endif; ?>
            </div>
            <div class='text-muted small'>
              <span title="<?php echo $lang->article->views;?>"><i class='icon-eye-open'></i> <?php echo $article->views;?></span>
              &nbsp;&nbsp; <span title="<?php echo $lang->article->submissionTime;?>"><i class='icon-time'></i> <?php echo $article->editedDate;?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <div class='panel-footer'><?php $pager->show('justify');?></div>
</div>
<?php include TPL_ROOT . 'common/form.html.php';?>
<?php include $this->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer');?>
