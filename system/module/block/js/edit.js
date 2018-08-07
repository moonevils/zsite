$(document).ready(function()
{
    /* Set ajaxform for create and edit. */
    $.setAjaxForm('#blockForm', function(data)
    {   
        if(data.result == 'success') setTimeout($.closeModal, 1500);
    });

    $.setAjaxForm('#editForm', function(response)
    {   
        if(response.result == 'success' && response.locate != '')
        {
            location.href = response.locate;
        }
        if(response.result == 'fail' && response.reason == 'captcha')
        {
            $('.captchaModal').click();
        }
    }); 

    $('.closeModal').click(function(){$.closeModal()});
    $('.reloadModal').click(function(){$.reloadAjaxModal()});

    $('[name*=group]').change(function()
    {
       $('#title').val($(this).find("option:selected").text()); 
    });

    $(document).on('change', '[name*=imageType]', function()
    {
        if($(this).find('option:selected').val() == 'custom')
        {
            $('tr.custom-image').removeClass('hidden');
        }
        else
        {
            $('tr.custom-image').addClass('hidden');
        }
    });

    $('[name*=imageType]').change();
})
