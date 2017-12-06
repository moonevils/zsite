{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'header')}
<div class='row'>
  {include TPL_ROOT . 'user/side.html.php'}
  <div class='col-md-10'>
    <div class='panel'>
      <div class='panel-heading'><strong>{!echo $lang->score->confirm}</strong></div>
      <table class='table'>
        <tr>
          <th>{!echo $lang->score->id}</th>
          <th>{!echo $lang->score->product}</th>
          {if(!empty($order->ip))}
          <th>IP</th>
          {/if}
          {if(!empty($order->hostID))}
          <th>MAC</th>
          {/if}
          <th width='50'>{!echo $lang->score->amount}</th>
        </tr>
        <tr class='text-center'> 
          <td>{!echo $order->humanOrder}</td>
          <td>{!echo $order->subject}</td>
          {if(!empty($order->ip))}
          <td>{!echo $order->ip}</td>
          {/if}
          {if(!empty($order->hostID))}
          <td>{!echo $order->hostID}</td>
          {/if}
          <td>{!echo $order->amount}</td>
        </tr>
        <tr class='text-center'>
          <td colspan='5'>{!echo html::a($payLink, $lang->score->alipay, "class='btn btn-primary btn-lg'")}</td>
        </tr>
      </table>
    </div>
  </div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer')}
