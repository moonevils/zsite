<?php include '../../common/view/header.admin.html.php';?>
<?php include '../../common/view/codeeditor.html.php';?>
<?php js::import($jsRoot . 'less/min.js'); ?>
<div class='col-xs-12'>
<?php if(!$hasPriv):?>
<div class='alert alert-danger'>
  <div>
    <?php echo $errors;?>
    <span class='pull-right'><?php commonModel::printLink('ui', 'customtheme', "theme={$theme}&template={$template}", $lang->ui->template->reload, "class='btn btn-primary'");?></span>
  </div>
</div>
<?php else:?>
<form method='post' action='<?php echo inlink('customtheme', "theme={$theme}&template={$template}");?>' id='customThemeForm' class='form' data-theme='<?php echo $theme?>' data-template='<?php echo $template?>'>
  <div class='panel' id='mainPanel'>
    <div class='panel-heading'>
      <ul class='nav nav-tabs'>
        <?php foreach($lang->ui->groups as $group => $name):?>
        <li><?php echo html::a('#' . $group . 'Tab', $name, "data-toggle='tab' class='theme-control-tab'");?></li>
        <?php endforeach;?>
        <li><a href='#cssTab' data-toggle='tab'><?php echo $lang->ui->theme->extraStyle; ?></a></li>
        <li><a href='#jsTab' data-toggle='tab'><?php echo $lang->ui->theme->extraScript; ?></a></li>

        <li class='pull-right text-right w-150px'><button type='button' id='resetTheme' class='btn btn-link btn-sm text-danger' data-success-tip='<?php echo $lang->ui->theme->resetTip?>'><?php echo $lang->ui->theme->reset?></button></li>
      </ul>
    </div>
    <div class='panel-body'>
      <div class='tab-content'>
        <?php foreach($lang->ui->groups as $group => $name):?>
        <div class='tab-pane theme-control-tab-pane' id='<?php echo $group?>Tab'>
          <table class='table table-form borderless'>
            <?php
            $options = isset($config->ui->themes[$theme][$group]) ? $config->ui->themes[$theme][$group] : '';
            if($options) foreach($options as $selector => $attributes):
            ?>
            <tr class='theme-control-group'>
              <th><?php echo $lang->ui->{$selector};?></th>
              <td>
                <div class='row'>
                  <?php foreach($attributes as $label => $params):?>
                  <?php $value = isset($setting[$params['name']]) ? $setting[$params['name']] : '';?>
                  <div class='col-sm-3' title='@<?php echo $params['name']?>'><?php $this->ui->printFormControl($label, $params, $value);?></div>
                  <?php endforeach;?>
                </div>
              </td>
            </tr>
            <?php endforeach;?>
          </table>
        </div>
        <?php endforeach;?>
        <div class='tab-pane theme-control-tab-pane' id='cssTab'>
          <?php echo html::textarea('css', isset($setting['css']) ? $setting['css'] : '', "rows=20 class='form-control codeeditor' data-mode='css' data-height='250'");?>
          <p class='text-info text-tip'><?php echo $lang->ui->theme->customStyleTip; ?></p>
        </div>
        <div class='tab-pane theme-control-tab-pane' id='jsTab'>
          <?php echo html::textarea('js', isset($setting['js']) ? $setting['js'] : '', "rows=20 class='form-control codeeditor' data-mode='css' data-height='250'");?>
          <p class='text-info text-tip'><?php echo $lang->ui->theme->customScriptTip; ?></p>
        </div>
      </div>
      <div class="form-footer">
        <?php echo html::hidden('theme', $theme) . html::hidden('template', $template) . html::submitButton();?>
      </div>
    </div>
  </div>
</form>
<?php endif;?>
</div>
<?php include '../../common/view/footer.admin.html.php';?>
