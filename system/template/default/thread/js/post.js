$(document).ready(function()
{
    if(v.oauthLoginLink !== 'undefined')
    {
        bootbox.confirm(v.bindWechatTip, function(result)
        {
            if(result)
            {
                setTimeout(function(){ location.href = v.oauthLoginLink}, 600);
            }
            else
            {
                setTimeout(function(){ location.href = v.backLink}, 600);
            }
        })
    }

    $.setAjaxForm('#threadForm', function(response)
    {
        if(response.result == 'success')
        {
            setTimeout(function(){ location.href = response.locate;}, 1200);
        }
        else
        {
            if(response.reason == 'needChecking')
            {
                $('#captchaBox').html(Base64.decode(response.captcha)).show();
            }
        }
    });

    $('#isLink').change();

    $('.nav-system-forum').addClass('active');
});
