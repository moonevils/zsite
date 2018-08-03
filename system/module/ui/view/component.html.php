<?php
/**
 * The component view file of ui module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yidong Wang <yidong@cnezsoft.com>
 * @package     ui
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
?>
<?php include '../../common/view/header.admin.html.php';?>
<div id='mainMenu' class='clearfix'>
  <div id='navMenu'>
    <?php
    echo html::a($this->createLink('ui', 'component'), $lang->ui->component, "class='active'");
    echo html::a($this->createLink('ui', 'effect'), $lang->effect->common);
    echo html::a($this->createLink('file', 'browsesource'), $lang->file->sourceList);
    ?>
  </div>
</div>
<div id='setLogo' class='component'>
  <div class='panel'>
    <div class='panel-heading'>
      <strong><?php echo $lang->ui->setLogo;?> <i class='icon-certificate'></i></strong>
    </div>
    <div class='panel-body row row-logo'>
      <form method='post' id='logoForm' enctype='multipart/form-data' action='<?php echo $this->createLink('ui', 'setLogo');?>'>
        <div class='col-md-6'>
          <div class='box'>
            <div class='card'>
            <?php if(isset($logo->webPath)) echo html::a('javascript:;', html::image($this->loadModel('file')->printFileURL($logo), "class='logo'"), "class='btn-upload'");?>
            <?php if(!isset($logo->webPath)) echo html::a('javascript:;', $lang->ui->uploadLogo, "class='text-lg btn-upload'");?>
            </div>
            <span class='actions'>
            <?php if(isset($logo->webPath)) echo html::a('javascript:;', "<i class='icon icon-lg icon-edit-sign'> </i>", "class='text-info btn-editor'");?>
            <?php if(isset($logo->webPath)) commonModel::printLink('ui', 'deleteLogo', '', "<i class='icon icon-lg icon-remove-sign'> </i>", "class='text-danger btn-deleter'");?>
            </span>
            <div class='text-important'>
              <?php if($this->app->clientDevice == 'desktop') printf($lang->ui->suitableLogoSize, '50px-80px', '80px-240px');?>
              <?php if($this->app->clientDevice == 'mobile') printf($lang->ui->suitableLogoSize, '<50px', '50px-200px');?>
              <div class='hide'><?php echo html::file('logo', "class='form-control'");?></div>
            </div>
          </div>
        </div>
        <div class='col-md-6'>
          <div class='box'>
            <div class='card'>
              <?php if(!empty($favicon)) $favicon->extension = 'ico';?>
              <?php
              if(isset($favicon->webPath) or $defaultFavicon)
              {
                  $imagePath = isset($favicon->webPath) ? $this->loadModel('file')->printFileURL($favicon) : $config->webRoot . 'favicon.ico';
                  echo html::a('javascript:;', html::image($imagePath, "class='favicon'"), "class='btn-upload'");
              }
              else
              {
                  echo html::a('javascript:;', $lang->ui->uploadFavicon, "class='text-lg btn-upload'");
              }
              ?>
            </div>
            <span class='actions'>
              <?php if(isset($favicon->webPath) or $defaultFavicon) echo html::a('javascript:;', "<i class='icon icon-lg icon-edit-sign'> </i>", "class='text-info btn-editor'");?>
              <?php if($favicon or $defaultFavicon) commonModel::printLink('ui', 'deleteFavicon', '', "<i class='icon icon-lg icon-remove-sign'> </i>", "class='text-danger btn-deleter'");?>
            </span>
  
            <div class='text-important'>
            <?php $langParam = $app->clientLang == 'en' ? '&lang=en' : '';?>
            <?php printf($lang->ui->faviconHelp, "http://api.chanzhi.org/goto.php?item=help_favicon{$langParam}");?>
            </div>
            <div class='hide'><?php echo html::file('favicon', "class='form-control'");?></div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div id='slide' class='component'>
  <div class='panel'>
    <div class='panel-heading'>
      <strong><?php echo $lang->slide->common;?> <i class='icon-th'></i></strong>
    </div>
    <div class='panel-body'>
      <section class='row cards-borderless'>
        <?php foreach($groups as $group):?>
        <div class='col-lg-3 col-md-4 col-sm-6'>
          <a class='card card-slide' href='<?php echo $this->createLink('slide', 'browse', "groupID=$group->id") ?>'>
            <?php $count = count($group->slides); ?>
            <?php $slide = $group->slide;?>
            <div class='slides-holder slides-holder-<?php echo min(5, $count);?>'>
              <?php if(!empty($group->slides)): ?>
              <div class='slide-item'>
                <?php if ($slide->backgroundType == 'image'): ?>
                <?php print(html::image($slide->image));?>
                <?php else: ?>
                <div class='plain-slide' style='<?php echo 'background-color: ' . $slide->backgroundColor;?>'></div>
                <?php endif; ?>
                <div class='slides-count'><i class='icon-picture'></i> <?php echo $count; ?></div>
              </div>
              <?php else: ?>
              <div class='empty-holder'>
                <i class='icon-pencil icon-3x icon'></i>
                <div id='toBeAdded'>
                  <?php echo $lang->toBeAdded;?>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </a>
          <div class='card-heading text-left'>
            <div class='group-title' data-id='<?php echo $group->id;?>' data-action="<?php echo $this->createLink('slide', 'editGroup', "groupID=$group->id");?>">
              <?php echo html::a('javascript:;', "<i class='icon icon-edit'></i>", "class='edit-group-btn'");?>
              <span class='group-name'><?php echo $group->name;?></span>&nbsp;&nbsp;
              <span class='pull-right'>
              <?php echo html::a($this->createLink('slide', 'browse', "groupID=$group->id"), $lang->edit, "class='btn btn-sm'");?>
              <?php echo html::a($this->createLink('slide', 'removeGroup', "groupID=$group->id"), $lang->delete, "class='deleter btn btn-sm'");?>
              </span>
            </div>
          </div>
        </div>
        <?php endforeach;?>
        <div class='col-lg-3 col-md-4 col-sm-6'>
          <?php commonModel::printLink('slide', 'createGroup', "", '<div class="slides-holder create-btn"><div class="empty-holder"><i class="icon-plus-sign icon icon-3x"></i> ' . $lang->slide->createGroup . '</div></div>', "class='card card-slide' data-toggle='modal'");?>
        </div>
      </section>
    </div>
  </div>
  <form id="editGroupForm" class='edit-form' method='post'>
    <div class='editGroup input-group'>
      <?php echo html::input('groupName', $group->name, "class='form-control'");?>
      <span class="input-group-btn fix-border"><?php echo html::submitButton('', 'submit btn btn-primary');?> </span>
      <span class="input-group-btn"><?php echo html::commonButton($lang->cancel, 'btn-close-form btn');?></span>
      <?php echo html::hidden('groupID', '', "class='groupID'");?>
    </div>
  </form>
</div>
<div id='setting' class='component'>
<?php js::set('rebuildThumbs', $lang->ui->rebuildThumbs);?>
<?php js::set('thumbs', $this->config->file->thumbs);?>
<?php js::set('rebuildWatermark', $lang->file->rebuildWatermark);?>
<?php
$colorPlates = '';
foreach (explode('|', $lang->colorPlates) as $value)
{
    $colorPlates .= "<div class='color color-tile' data='#" . $value . "'><i class='icon-ok'></i></div>";
}
$gdInstalled = extension_loaded('gd') ? 1 : 0;
js::set('gdInstalled', $gdInstalled);
?>
  <form method='post' id='settingForm' enctype='multipart/form-data' action='<?php echo $this->createLink('ui', 'others')?>'>
    <div class='panel' id='mainPanel'>
      <div class='panel-heading'>
        <ul class='nav nav-tabs'>
          <?php foreach($lang->ui->settingList as $key => $name):?>
          <li><?php echo html::a('#' . $key . 'Tab', $name, "data-toggle='tab' class='setting-control-tab'");?></li>
          <?php endforeach;?>
        </ul>
      </div>
      <div class='panel-body'>
        <div class='tab-content'>
          <div class='tab-pane setting-control-tab-pane' id='displayTab'>
            <table class='table table-form w-p60 table-fixed'>
              <tr>
                <th class='w-120px'><?php echo $lang->ui->QRCode;?></th>
                <td class='w-p30'><?php echo html::radio('QRCode', $lang->ui->QRCodeList, isset($this->config->ui->QRCode) ? $this->config->ui->QRCode : '1');?></td><td></td>
              </tr>
              <tr>
                <th><?php echo $lang->ui->execInfo;?></th>
                <td class='w-p30'><?php echo html::radio('execInfo', $lang->ui->execInfoOptions, isset($this->config->site->execInfo) ? $this->config->site->execInfo : 'show');?></td><td></td>
              </tr>
              <?php if($this->config->framework->detectDevice[$this->app->clientLang]):?>
              <tr>
                <th><?php echo $lang->ui->mobileBottomNav;?></th>
                <td class='w-p30'><?php echo html::radio('mobileBottomNav', $lang->ui->execInfoOptions, isset($this->config->site->mobileBottomNav) ? $this->config->site->mobileBottomNav : 'show');?></td><td></td>
              </tr>
              <?php endif;?>
            </table>
          </div>
  
          <div class='tab-pane setting-control-tab-pane' id='browseTab'>
            <table class='table table-form w-p60 table-fixed'>
              <?php if(strpos($this->config->site->modules, 'article') !== false):?>
              <tr>
                <th class='w-120px'><?php echo $lang->site->customizableList->article;?></th> 
                <td class='w-p30'><?php echo html::input('articleRec', !empty($this->config->site->articleRec) ? $this->config->site->articleRec : $this->config->article->recPerPage, "class='form-control'");?></td><td></td>
              </tr>
              <?php endif;?>
              <?php if(strpos($this->config->site->modules, 'product') !== false):?>
              <tr>
                <th class='w-120px'><?php echo $lang->site->customizableList->product;?></th> 
                <td class='w-p30'><?php echo html::input('productRec', !empty($this->config->site->productRec) ? $this->config->site->productRec : $this->config->product->recPerPage, "class='form-control'");?></td><td></td>
              </tr>
              <?php endif;?>
              <?php if(strpos($this->config->site->modules, 'blog') !== false):?>
              <tr>
                <th class='w-120px'><?php echo $lang->site->customizableList->blog;?></th> 
                <td class='w-p30'><?php echo html::input('blogRec', !empty($this->config->site->blogRec) ? $this->config->site->blogRec : $this->config->blog->recPerPage, "class='form-control'");?></td><td></td>
              </tr>
              <?php endif;?>
              <?php if(strpos($this->config->site->modules, 'book') !== false):?>
              <tr>
                <th class='w-120px'><?php echo $lang->site->customizableList->book;?></th> 
                <td class='w-p30'><?php echo html::input('bookRec', !empty($this->config->site->bookRec) ? $this->config->site->bookRec : $this->config->book->recPerPage, "class='form-control'");?></td><td></td>
              </tr>
              <?php endif;?>
              <?php if(strpos($this->config->site->modules, 'message') !== false):?>
              <tr>
                <th class='w-120px'><?php echo $lang->site->customizableList->message;?></th> 
                <td class='w-p30'><?php echo html::input('messageRec', !empty($this->config->site->messageRec) ? $this->config->site->messageRec : $this->config->message->recPerPage, "class='form-control'");?></td><td></td>
              </tr>
              <tr>
                <th><?php echo $lang->site->customizableList->comment;?></th> 
                <td><?php echo html::input('commentRec', !empty($this->config->site->commentRec) ? $this->config->site->commentRec : $this->config->message->recPerPage, "class='form-control'");?></td><td></td>
              </tr>
              <?php endif;?>
              <?php if(strpos($this->config->site->modules, 'forum') !== false):?>
              <tr>
                <th class='w-120px'><?php echo $lang->site->customizableList->forum;?></th> 
                <td class='w-p30'><?php echo html::input('forumRec', !empty($this->config->site->forumRec) ? $this->config->site->forumRec : $this->config->forum->recPerPage, "class='form-control'");?></td><td></td>
              </tr>
              <tr>
                <th><?php echo $lang->site->customizableList->reply;?></th> 
                <td><?php echo html::input('replyRec', !empty($this->config->site->replyRec) ? $this->config->site->replyRec : $this->config->reply->recPerPage, "class='form-control'");?></td><td></td>
              </tr>
              <?php endif;?>
              <?php if(strpos($this->config->site->modules, 'blog') !== false):?>
              <tr>
                <th><?php echo $lang->article->blog->category;?></th>
                <td><?php echo html::radio('blog[showCategory]', $lang->article->blog->categoryOptions, isset($this->config->blog->showCategory) ? $this->config->blog->showCategory : '0');?></td>
                <td></td>
              </tr>
              <tr class='blog-setting <?php echo (!isset($this->config->blog->showCategory) || !$this->config->blog->showCategory) ? "hide" : "";?>'>
                <th><?php echo $lang->article->blog->category;?></th>
                <td>
                  <div class='input-group'>
                    <?php echo html::select('blog[categoryName]', $lang->article->blog->categoryNameList, isset($this->config->blog->categoryName) ? $this->config->blog->categoryName : '', "class='form-control'");?>
                    <span class='input-group-addon'><?php echo $lang->article->blog->categoryLevel;?></span>
                    <?php echo html::select('blog[categoryLevel]', $lang->article->blog->categoryLevelList, isset($this->config->blog->categoryLevel) ? $this->config->blog->categoryLevel : '', "class='form-control'");?>
                  </div>
                </td>
                <td></td>
              </tr>
              <tr>
                <th class='w-120px'><?php echo $lang->blog->common . $lang->article->browseImage->common;?></th>
                <td colspan='2'>
                  <div class='input-group'>
                    <?php echo html::select('blog[imagePosition]', $lang->article->browseImage->positionList, isset($this->config->blog->imagePosition) ? $this->config->blog->imagePosition : 'right', "class='form-control'");?>
                    <span class='input-group-addon'></span>
                    <?php echo html::select('blog[imageSize]', $lang->article->browseImage->sizeList, isset($this->config->blog->imageSize) ? $this->config->blog->imageSize : 'small', "class='form-control'");?>
                    <span class='input-group-addon'><?php echo $lang->article->browseImage->maxWidth;?></span>
                    <?php echo html::input('blog[imageWidth]', isset($this->config->blog->imageWidth) ? $this->config->blog->imageWidth : '100', "class='form-control'");?>
                    <span class='input-group-addon'>px</span>
                  </div>
                </td>
              </tr>
              <?php endif;?>
              <?php if(strpos($this->config->site->modules, 'article') !== false):?>
              <tr>
                <th class='w-120px'><?php echo $lang->article->common . $lang->article->browseImage->common;?></th>
                <td colspan='2'>
                  <div class='input-group'>
                    <?php echo html::select('article[imagePosition]', $lang->article->browseImage->positionList, isset($this->config->article->imagePosition) ? $this->config->article->imagePosition : 'right', "class='form-control'");?>
                    <span class='input-group-addon'></span>
                    <?php echo html::select('article[imageSize]', $lang->article->browseImage->sizeList, isset($this->config->article->imageSize) ? $this->config->article->imageSize : 'small', "class='form-control'");?>
                    <span class='input-group-addon'><?php echo $lang->article->browseImage->maxWidth;?></span>
                    <?php echo html::input('article[imageWidth]', isset($this->config->article->imageWidth) ? $this->config->article->imageWidth : '100', "class='form-control'");?>
                    <span class='input-group-addon'>px</span>
                  </div>
                </td>
              </tr>
              <?php endif;?>
              <?php if(strpos($this->config->site->modules, 'product') !== false):?>
              <tr>
                <th><?php echo $lang->product->list;?></th>
                <td colspan='2'>
                  <div class='input-group'>
                    <span class='input-group-addon'><?php echo $lang->ui->viewMode;?></span>
                    <?php echo html::select('product[browseType]', $lang->product->browseOptions, isset($this->config->product->browseType) ? $this->config->product->browseType : 'card', "class='form-control'");?>
                    <span class='input-group-addon'><?php echo $lang->ui->productView;?></span>
                    <?php echo html::select('product[showViews]', $lang->product->viewsOptions, isset($this->config->product->showViews) ? $this->config->product->showViews : '1', "class='form-control'");?>
                    <span class='input-group-addon'><?php echo $lang->product->price;?></span>
                    <?php echo html::select('product[showPrice]', $lang->product->priceOptions, isset($this->config->product->showPrice) ? $this->config->product->showPrice : '1', "class='form-control'");?>
                    <span class='input-group-addon'><?php echo $lang->product->name;?></span>
                    <?php echo html::select('product[namePosition]', $lang->product->namePositionOptions, isset($this->config->product->namePosition) ? $this->config->product->namePosition : 'left', "class='form-control'");?>
                  </div>
                </td>
              </tr>
              <?php endif;?>
            </table>
          </div>
  
          <div class='tab-pane setting-control-tab-pane' id='thumbTab'>
            <table class='table table-form w-p60 table-fixed'>
              <tr>
                <th class='w-120px'><?php echo $lang->site->setImageSize;?></th>
                <td colspan='2'>
                  <?php foreach($this->config->file->thumbs as $key => $thumb):?> 
                  <div class='input-group' style='margin-bottom: 10px'>
                    <span class='input-group-addon'><?php echo $lang->site->imageSize[$key];?></span>
                    <span class='input-group-addon'><?php echo $lang->site->image['width'];?></span>
                    <?php echo html::input("thumbs[$key][width]", $thumb['width'], "class='form-control fix-border' placeholder='{$thumb['width']}'");?>
                    <span class="input-group-addon">px</span>
                    <span class='input-group-addon fix-border'><?php echo $lang->site->image['height'];?></span>
                    <?php echo html::input("thumbs[$key][height]", $thumb['height'], "class='form-control' placeholder='{$thumb['height']}'");?>
                    <span class="input-group-addon">px</span>
                  </div>
                  <?php endforeach;?>
                </td>
              </tr>
            </table>
          </div>
  
          <div class='tab-pane setting-control-tab-pane' id='watermarkTab'>
            <table class='table table-form w-p65'>
              <?php if(!$gdInstalled):?>
              <tr class='gd-check'>
                <td>
                  <p class='text-danger'><?php echo $lang->ui->gdTip;?></p>
                  <p><?php echo html::a($config->ui->gdHelpLink, $lang->ui->gdHelp, "target='_blank'")?></p>
                </td>
              </tr>
              <?php else:?>
  
              <!--watermark open or close -->
              <tr>
                <th class='w-120px'><?php echo $lang->file->watermark;?></th>
                <td><?php echo html::radio('files[watermark]', $lang->file->watermarkList, isset($this->config->file->watermark) ? $this->config->file->watermark : 'close');?></td>
              </tr>
  
              <?php $waterHide = (!isset($this->config->file->watermark) || $this->config->file->watermark == 'close') ? "hide" : "";?>
  
              <!--watermark content -->
              <tr class='watermark-info <?php echo $waterHide;?>'>
                <th class='w-120px'><?php echo $lang->file->watermarkContent;?></th> 
                <td class='w-p30'><?php echo html::input('files[watermarkContent]', !empty($this->config->file->watermarkContent) ? $this->config->file->watermarkContent : $this->config->site->name, "class='form-control'");?></td><td></td>
              </tr>
  
              <!--watermark color -->
              <tr class='watermark-info <?php echo $waterHide;?>'>
                <th class='w-120px'><?php echo $lang->color;?></th> 
                <td class='w-p30'>
                  <div class='colorplate clearfix'>
                    <?php $watermarkColor = !empty($this->config->file->watermarkColor) ? $this->config->file->watermarkColor : '#fff';?>
                    <div class='input-group color ctive' data='<?php echo $watermarkColor;?>'>
                      <?php echo html::input('files[watermarkColor]', $watermarkColor, "class='form-control input-color text-latin' placeholder='" . $lang->colorTip . "'");?>
                      <span class='input-group-btn'>
                        <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'> <i class='icon icon-question'></i> <span class='caret'></span></button>
                        <div class='dropdown-menu colors'>
                          <?php echo $colorPlates; ?>
                        </div>
                      </span>
                    </div>
                  </div>
                </td>
              </tr>
  
              <!--watermark opacity -->
              <tr class='watermark-info <?php echo $waterHide;?>'>
                <th class='w-120px'><?php echo $lang->file->watermarkOpacity;?></th> 
                <td class='w-p30'>
                  <div class='input-group'>
                    <?php echo html::input('files[watermarkOpacity]', !empty($this->config->file->watermarkOpacity) ? $this->config->file->watermarkOpacity : '50', "class='form-control'");?>
                    <span class='input-group-addon'><?php echo $lang->percent;?></span>
                  </div>
                </td>
              </tr>
  
              <!--watermark size -->
              <tr class='watermark-info <?php echo $waterHide;?>'>
                <th class='w-120px'><?php echo $lang->file->watermarkSize;?></th> 
                <td class='w-p30'>
                  <div class='input-group'>
                  <?php echo html::input('files[watermarkSize]', isset($this->config->file->watermarkSize) ? $this->config->file->watermarkSize : '14', "class='form-control'");?>
                  <span class='input-group-addon'>px</span>
                  </div>
                </td>
              </tr>
  
              <!--watermark position -->
              <tr class='watermark-info <?php echo $waterHide;?>'>
                <th><?php echo $lang->file->watermarkPosition;?></th> 
                <td>
                  <?php echo html::select('files[watermarkPosition]', $lang->file->watermarkPositionList, isset($this->config->file->watermarkPosition) ? $this->config->file->watermarkPosition : 'middleMiddle', "class='form-control'");?>
                </td>
              </tr>
  
              <tr>
                <th></th>
                <td colspan='3'>
                  <div class='alert alert-info' style='margin: 1px;'><?php printf($lang->file->fontPosition, $fontsPath);?></div>
                </td>
              </tr>
              <?php endif;?>
            </table>
          </div>
        </div>
  
        <div class='form-footer'>
          <?php echo html::submitButton();?>
          <div class='thumb-footer hidden'>
            <?php echo html::a(helper::createLink('file', 'rebuildthumbs'), $lang->ui->rebuildThumbs, "class='btn btn-primary' id='thumbExecButton'");?>
            <span class='alert alert-success total hide'></span>
          </div>
          <div class='watermark-footer hidden'>
            <?php if(isset($this->config->file->watermark) and $this->config->file->watermark == 'open') echo html::a(helper::createLink('file', 'rebuildWatermark'), $lang->file->rebuildWatermark, "class='btn btn-primary' id='watermarkExecButton'");?>
            <span class='alert alert-success total hide'></span>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
