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
    public function printLayoutItem($item, $region, $page)
    {
        if(!isset($item['title']))
        {
            if($item['type'] === 'placeholder')
            {
                $item['title'] = $this->lang->visual->design->placeholders[$item['name']];
            }
            else if($item['type'] !== 'col')
            {
                $item['title'] = $region[$item['name']];
            }
        }

        $attrs = '';
        $class = '';
        switch ($item['type'])
        {
            case 'placeholder':
                $class .= 'layout-placeholder';
                break;
            case 'row':
                $class .= 'layout-row row';
                break;
            case 'col':
                $class .= 'layout-col col';
                $attrs .= " style='width: {$item['colWidth']}'";
                break;
            default:
                $class .= 'layout-container';
                break;
        }

        echo "<div class='layout-item type-{$item['type']} {$class}' data-title='{$item['title']}' data-name='{$item['name']}' {$attrs}>";
        $footer = '';

        if($item['type'] === 'grid')
        {
            echo '<div class="row">';
            $footer = '</div>';
        }
        else if($item['type'] === 'col')
        {
            echo '<div class="col-container">';
            $footer = '</div>';
        }
        else if($item['type'] === 'row')
        {
            echo '<div class="actions">' . html::a(helper::createLink('block', 'setColumns', "page={$page}"), '<i class="icon icon-columns"></i> ' . $this->lang->visual->design->setColumns, "data-toggle='modal' data-type='iframe' data-width='600'") . '</div>';
        }
        
        if($item['children'])
        {
            foreach ($item['children'] as $child)
            {
                $this->printLayoutItem($child, $region, $page);
            }
        }
        
        echo $footer;
        echo '</div>';
    }
}