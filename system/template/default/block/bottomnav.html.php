<?php
/**
 * The about front view file of block module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Yidong wang <yidong@cnezsoft.com>
 * @package     block
 * @version     $Id$
 * @link        http://www.chanzhi.org
*/
$block->content = json_decode($block->content);
$this->loadModel('nav');
$navs = $block->content->nav;
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
  </div>
  <div class='panel-body'>
    <ul class='nav nav-bottom nav-justified'>
      <?php foreach($navs as $nav):?>
      <li>
        <?php echo html::a($this->nav->getUrl($nav), $nav->title, $nav->target ? "target='{$nav->target}'" : '');?>
        <?php if(!empty($nav->children)):?>
        <ul class='nav nav-stacked'>
          <?php foreach($nav->children as $child):?>
          <li><?php echo html::a($this->nav->getUrl($child), $child->title, $child->target ? "target='{$child->target}'" : '');?></li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
      </li>
      <?php endforeach;?>
    </ul>
  </div>
</div>
