$(document).ready(function()
{
    $.setAjaxForm('#replyForm', function(response)
    {
        if(response.result == 'success')
        {
            bootbox.dialog(
            {  
                message: response.replySuccess,  
                buttons:
                {  
                    lastPage:
                    {  
                        label:     v.toLastPage,
                        className: 'btn-primary',  
                        callback:  function(){location.href = response.locate;}  
                    },
                    back:
                    {  
                        label:     v.goback,  
                        className: 'btn-primary',  
                        callback:  function(){location.href = removeAnchor(location.href) + '#' + response.replyID;}  
                    }  
                }  
            });
        }
        else
        {
            if(response.reason == 'needChecking')
            {
                $('#captchaBox').html(Base64.decode(response.captcha)).show();
            }
        }
    });

    $.setAjaxForm('#addScoreForm');

    $.setAjaxJSONER('.stickJsoner', function(response){ bootbox.alert(response.message, function(){location.href = response.locate; return true;});});
    $.setAjaxJSONER('.switcher', function(response){ bootbox.alert(response.message, function(){location.href = response.locate; return false;});});
    $('.nav-system-forum').addClass('active');

    /* remove empty element */
    $('.speaker > ul > li > span:empty').closest('li').remove();

    $('.thread-reply-btn').click(function()
    {
        if($(this).data('reply')) $('input[name=reply]').val($(this).data('reply'));
    })

    $(document).on('click', '.quote', function()
    {
        var $quote     = $(this).parents('.panel.reply');
        var date       = $quote.find('.panel-heading span.muted')[0].childNodes[1].textContent;
        var user       = $quote.find('.table .speaker .thread-author')[0].childNodes[1].textContent;
        var quoteTitle = v.quoteTitle.replace('\%\s', user).replace('%s', date);
        
        var quoteContent = '[quote]';
        quoteContent += quoteTitle;
        quoteContent += $quote.find('.table .thread-wrapper .thread-content').html();
        quoteContent += '[/quote]';
        $('#content').val(quoteContent);

        location.reload(); 
    })
});
