$(document).ready(function()
{
    $.setAjaxForm('#editForm', function(response) 
    {
        if(response.result == 'fail')
        {
            bootbox.alert(response.warning);
        }
    });

    $.setAjaxLoader('.okFile', '#ajaxModal');

    $('#resetBtn').click(function()
    {
       $('#content').val($('#rawContent').val());
    });
});
