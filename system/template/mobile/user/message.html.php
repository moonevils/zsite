{*php
/**
 * The message view file of user for mobile template of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV12 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     user
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
/php*}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'header.simple')}
<style>
body.with-appbar-bottom {padding-bottom:0px}
.panel-section {margin:0px;background-color:#f1f1f1}
.panel-heading {margin-bottom:12px}
.panel-body {padding:0px}
.cards-list .card {border:0px;box-shadow:0 0px 0px;margin-bottom:6px}
.card .avatar {float:left;height:40px;width:40px;margin-top:12px;margin-left:10px;position:relative}
.card .avatar > img {height:100%;width:100%}
.card .content {margin-left:52px;padding:12px 12px 2px 12px}
.card .symbol > strong {font-size:1.6rem}
.card .symbol > .text-muted {float:right}
.card .text-body {max-height:40px;overflow:hidden;color:#999999;text-overflow:ellipsis}
.card .dot {width:10px;height:10px;background-color:red;position:absolute;top:-3px;right:-3px;border-radius:50%}
.card .card-footer {height:20px;padding:0px 12px 0px 0px;}
</style>
<div class='panel-section'>
  <div class='panel-heading'>
    {$unreadCount} {$lang->user->message->unread}
  </div>
  <!--<div class='panel-heading' style='margin-bottom:12px'>
    通知 订单 互动
  </div>-->
  <div class='panel-body' id='cardListWarpper'>
    <div class='cards cards-list' id='cardList'>
    {foreach($messages as $message)}
      <div class='card card-block' {if(!$message->readed)} href='{$control->createLink("message", "view", "message=$message->id")}'{/if}>
        <div class='avatar'>
        {!html::image('/theme/mobile/common/img/default-head.png')}
        {if(!$message->readed)}
          <div class='dot'></div>
        {/if}
        </div>
        <div class='content'>
          <div class='symbol'>
            <strong>{$message->from}</strong> &nbsp;
            <small class='text-muted'>{!substr($message->date, 5)}</small>
          </div>
          <div class='text-body'>{$message->content}</div>
        </div>
        <div class='card-footer'>
          <div class="pull-right">
            {!html::a($control->createLink('message', 'batchDelete'), $lang->delete, "class='delete text-danger' data-id='{{$message->id}}'")}
          </div>
        </div>
      </div>
    {/foreach}
    </div>
    {$pager->createPullUpJS('#cardList', $lang->mobile->pullUpHint, helper::createLink('user', 'message', "recTotal=$pager->recTotal&recPerPage=$pager->recPerPage&pageID=\$ID"))}
  </div>
</div>
<script>
$(function()
{
    var readed        = '{$lang->message->readed}';
    var deleteSuccess = '{$lang->deleteSuccess}';

    {noparse}
    $(document).on('click', '.card.card-block', function(e) {
        var $this   = $(this);
        if(!$this.attr('href')) return false;
        var options = $.extend({url: $this.attr('href'), onSuccess: function(response)
        {
            //var $response = $(response);
            window.location.reload();
            //$('#cardList').html($response.find('#cardList').html());
            //$.messager.success(readed);
        }
        }, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    }).on('click', '.delete', function(e) {

        var $this   = $(this);
        var options = $.extend(
        {
            method: 'post',
            url: $this.attr('href'), 
            confirm: window.v.lang.confirmDelete,
            data: "messages[]=" + $this.data('id'),
            onResultSuccess: function(response)
            {
                response.locate = null;
                var $card = $this.closest('.card').addClass('fade');
                setTimeout(function(){$card.remove();}, 300);
                $.messager.success(deleteSuccess)
            }
         }, $this.data());
        e.preventDefault();
        $.ajaxaction(options, $this);
    });
    {/noparse}
});
</script>
{if($source == 'bottom')}
{include $control->loadModel('ui')->getEffectViewFile('mobile', 'common', 'footer')}
{/if}
