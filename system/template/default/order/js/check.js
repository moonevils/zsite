$(document).ready(function()
{
    $('[name=payment]').eq(0).prop('checked', true);

    $.setAjaxForm('#checkForm', function(response)
    {
        if(response.result == 'success')
        {
            if(response.payment == 'COD')
            {
                location.href == response.locate;
            }
            else
            {
                $('.locate2pay').attr('href', response.locate);;
                $('.locate2pay')[0].click();

                bootbox.dialog(
                {  
                    message: v.goToPay,  
                    buttons:
                    {  
                        paySuccess:
                        {
                            label:     v.paid,  
                            className: 'btn-primary',  
                            callback:  function() { setTimeout(function(){location.href = createLink('order', 'browse');}, 600); }  
                        }
                    }
                });
            }
        }
    });
});
