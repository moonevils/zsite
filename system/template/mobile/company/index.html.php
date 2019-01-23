{*php
/**
 * The aboutus view file of company for mobile template of chanzhiEPS.
 * The view should be used as ajax content
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     company
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header')}
<div class='block-region region-top no-padding blocks' data-region='company_index-top'>{$control->block->printRegion($layouts, 'company_index', 'top')}</div>

<div class='panel panel-section panel-company'>
    <div class='block-title vertical-center'>
      <strong class="vertical-center block-title-align">
        <span class='vertical-line'></span>
        <span class="block-title-text">公司简介</span>
      </strong>
      <span class="more">更多</span>
    </div>
    <div class='company-desc'>
      <div class="title">
        <strong>{$company->name}</strong>
      </div>
      <div class="desc">
        <p>
          {$company->desc}
        </p>
      </div>
    </div>
</div>

<div class='panel panel-section panel-company'>
  <div class='block-title vertical-center'>
    <strong class="vertical-center block-title-align">
      <span class='vertical-line'></span>
      <span class="block-title-text">联系我们</span>
    </strong>
    <span class="more">更多</span>
  </div>
  <div class='contact'>
    <div class="vertical-center">
      <strong>联系人</strong><span>{$contact->contacts}</span>
    </div>
    <div class="vertical-center">
      <strong>电话</strong><span>{$contact->phone}</span>
    </div>
    <div class="vertical-center">
      <strong>Email</strong><span>{$contact->email}</span>
    </div>
    <div class="vertical-center">
      <strong>QQ</strong><span>{$contact->qq}</span>
    </div>
    <div class="vertical-center">
      <strong>微信</strong><span>{$contact->weixin}</span>
    </div>
    <div class="vertical-center">
      <strong>网址</strong><span>{$contact->site}</span>
    </div>
    <div class="vertical-center">
      <strong>地址</strong><span>{$contact->address}</span>
    </div>
  </div>
</div>

<div class='block-region region-bottom no-padding blocks' data-region='company_index-bottom'>{$control->block->printRegion($layouts, 'company_index', 'bottom')}</div>
