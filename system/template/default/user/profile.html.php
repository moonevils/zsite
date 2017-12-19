{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'header')}
{!js::set('confirmUnbind', $lang->user->confirmUnbind)}
<div class='page-user-control'>
  <div class='row'>
    {include TPL_ROOT . 'user/side.html.php'}
    <div class='col-md-10'>
      <div class='panel borderless'>
        <div class='panel-heading borderless'><strong><i class='icon-user'></i> {!echo $lang->user->profile}</strong></div>
          <table class='table table-bordered' id="profileTable">
          <tr>
            <th class='w-100px text-right'>{!echo $lang->user->realname}</th>
            <td>
              {!echo $user->realname}
              {if(isset($user->provider) and isset($user->openID) and strpos($user->account, "{$user->provider}_") === false)}
              <span class='label label-info'>{!echo $lang->user->oauth->typeList[$user->provider]}</span>
              {/if}
            </td>
          </tr>
          <tr>
            <th class='text-right'>{!echo $lang->user->email}</th>
            <td id='emailTD'>{!echo str2Entity($user->email)}</td>
          </tr>
          <tr>
            <th class='text-right'>{!echo $lang->user->company}</th>
            <td>{!echo $user->company}</td>
          </tr>
          <tr>
            <th class='text-right'>{!echo $lang->user->address}</th>
            <td>{!echo $user->address}</td>
          </tr>
          <tr>
            <th class='text-right'>{!echo $lang->user->zipcode}</th>
            <td>{!echo $user->zipcode}</td>
          </tr>
          <tr>
            <th class='text-right'>{!echo $lang->user->mobile}</th>
            <td id='mobileTD'>{!echo str2Entity($user->mobile)}</td>
          </tr>
          <tr>
            <th class='text-right'>{!echo $lang->user->phone}</th>
            <td>{!echo str2Entity($user->phone)}</td>
          </tr>
          <tr>
            <th class='text-right'>{!echo $lang->user->qq}</th>
            <td>{!echo str2Entity($user->qq)}</td>
          </tr>
          <tr>
            <th class='text-right'>{!echo $lang->user->gtalk}</th>
            <td>{!echo $user->gtalk}</td>
          </tr>
          <tr>
            <td class='borderless text-center' id='btnBox' colspan='2'>
              {!html::a(inlink('edit'), $lang->user->editProfile, "class='btn'")}
              {!html::a(inlink('setemail'), $lang->user->setEmail, "class='btn'")}
              {if(isset($user->provider) and isset($user->openID))}
              {if(strpos($user->account, "{$user->provider}_") === false)}
              {!html::a(inlink('oauthUnbind', "account=$user->account&provider=$user->provider&openID=$user->openID"), $lang->user->oauth->lblUnbind, "class='btn unbind'")}
              {else}
              {!html::a(inlink('oauthRegister'), $lang->user->oauth->lblProfile, "class='btn'")}
              {!html::a(inlink('oauthBind'), $lang->user->oauth->lblBind, "class='btn'")}
              {/if}
              {/if}
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer')}
