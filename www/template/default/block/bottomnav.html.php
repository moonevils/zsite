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
?>
<div id="block<?php echo $block->id;?>" class='panel panel-block <?php echo $blockClass;?>'>
  <div class='panel-heading'>
    <strong><?php echo $icon . $block->title;?></strong>
  </div>
  <div class='panel-body'>
    <?php $navs = $this->loadModel('nav')->getNavs('desktop_bottom');?>
    <ul style='display: table; width: 100%;'>
      <?php $width = 100 / count($navs) . '%';?>
      <?php foreach($navs as $nav):?>
      <li style='display:table-cell;  width: <?php echo $width;?>'>
        <h5><?php echo html::a($nav->url, $nav->title);?></h5>
        <?php if(!empty($nav->children)):?>
        <ul>
          <?php foreach($nav->children as $child):?>
          <li style='list-style-type:none'><?php echo html::a($child->url, $child->title);?></li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
      </li>
      <?php endforeach;?>
    </ul>
  </div>
</div>
