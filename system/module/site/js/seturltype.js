$(document).ready(function()
{
    $.setAjaxForm('#setSystemForm', function(response)
    {
        if(response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }
        if('success' == response.result) 
        {
          $.get(location.href, function(){window.location.reload();});
        }
    });

    $('[name^=requestType]').change(function()
    {
        if(!$('[value=PATH_INFO]').prop('checked'))
        {
            $.ajax(
            {
                type: 'get',
                url: '/index',
                dataType: 'json',
                success: function(data){return false;},  
                error: function(data)
                {
                    if(data.status == '200') 
                    {
                        $('#requestTypeTip').fadeIn();
                    }
                }
            });
        }
        else
        {
            $('#requestTypeTip').hide();
        }
    });

    $('[name^=requestType]').change();
});
