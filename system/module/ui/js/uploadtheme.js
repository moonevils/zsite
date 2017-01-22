$(document).ready(function()
{
    $.setAjaxForm('#uploadForm', function(response) 
    {
        if(response.result == 'success')
        {
            setTimeout(function()
            {
                $('#ajaxModal').attr('ref', response.locate).load(response.locate, function()
                {
                    $.ajustModalPosition();
                });
            }, 2000);
        }
    });

    $.setAjaxLoader('.okFile', '#ajaxModal');

    $('[name=type]').change(function()
    {
        if($(this).val() == 'full') 
        {
            if($(this).parents('#typeCheckBox').find('#typeTip').size() == 0) $(this).parent().after(" <span id='typeTip' class='text-danger'>" + v.lang.fullImportTip + '</span>');
        }
    })
});
