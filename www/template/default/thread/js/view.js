$(document).ready(function()
{
    $.setAjaxForm('#replyForm');

    $.setAjaxForm('#addScoreForm');

    $.setAjaxJSONER('.stickJsoner', function(response){ bootbox.alert(response.message, function(){location.href = response.locate; return true;});});
    $.setAjaxJSONER('.switcher', function(response){ bootbox.alert(response.message, function(){location.href = response.locate; return false;});});
    $('.nav-system-forum').addClass('active');

    /* remove empty element */
    $('.speaker > ul > li > span:empty').closest('li').remove();
});
