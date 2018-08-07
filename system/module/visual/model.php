<?php
/**
 * The model file of visual module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     visual
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php
class visualModel extends model
{
    /**
     * Get templates available.
     *
     * @access public
     * @return void
     */
    public function printLayoutItem($item)
    {
        echo "<div class='layout-item type-{$item['type']}' data-title='{$item['title']}' data-name='{$item['name']}'>";
        $footer = '';

        if($item['type'] === 'grid' || $item['type'] === 'row')
        {
            echo '<div class="row">';
            $footer = '</div>';
        }
        else if($item['type'] === 'col')
        {
            echo '<div class="col" style=>';
        }
        

        echo $footer;
        echo '</div>';
        switch ($item['type'])
        {
            default:
                echo "<div class='layout-item type-{$item['type']}' data-title='{$item['title']}'></div>";
                break;
        }
    }
}