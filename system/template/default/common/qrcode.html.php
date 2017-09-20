{if(isset($config->wechatPublic->hasPublic) and $config->wechatPublic->hasPublic)} 
{$publicList=$loadModel('wechat')->getList()}
{/if}
<div id='rightDocker' class='hidden-xs'>
  {if(!empty($publicList) or extension_loaded('gd'))}
  <button id='rightDockerBtn' class='btn' data-toggle="popover" data-placement="left" data-target='$next'><i class='icon-qrcode'></i></button>
  {/if}
  <div class='popover fade'>
    <div class='arrow'></div>
    <div class='popover-content docker-right'>
      <table class='table table-borderless'>
        <tr>
          {if(isset($publicList))}
            {loop="publicList"}
              {if(!$value->qrcode)} {continue} {/if}
              {$qrcode=$value->qrcode}
              <td>
                <div class='heading'><i class='icon-weixin'>&nbsp;</i> {$value->name}</div>
                {function="html::image('javascript:;', "data-src='$qrcode' width='200' height='200'")"}
              </td>
            {/loop}
          {/if}
          {if(extension_loaded('gd'))}
            <td>
              <div class='heading'>
                <i class='icon-mobile-phone'></i>
                {$lang->qrcodeTip}
              </div>
              {function="html::image('data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7', "width='200' height='200' data-src='" . helper::createLink('misc', 'qrcode') . "'")"}
            </td>
          {/if}
        </tr>
      </table>
    </div>
  </div>
</div>
