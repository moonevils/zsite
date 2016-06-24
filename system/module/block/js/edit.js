$(document).ready(function()
{
    /* Set ajaxform for create and edit. */
    $.setAjaxForm('#blockForm', function(data)
    {   
        if(data.result == 'success')
        {
            $.reloadAjaxModal(1500);
        }
        else if(data.result == 'fail' && data.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
    });

    $('#type').change(function()
    {
        location.href = createLink('block', 'edit', 'id=' + v.id + '&type=' + $(this).val() );
    });
    $.setAjaxForm('#editForm', function(response)
    {   
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }   
    }); 

    $('.reloadModal').click(function(){$.reloadAjaxModal()});

    $('[name*=group]').change(function()
    {
       $('#title').val($(this).find("option:selected").text()); 
    });
})
