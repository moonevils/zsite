$(function()
{
    $('#backupBtn').click(function()
    {
        url = $(this).attr('href');
        $.getJSON(url, function(response)
        {
            bootbox.alert(response.message, function()
            {
                if(response.result == 'success') location.reload();
            });
        });
        return false;
    })

    $('.restore').click(function()
    {
        url = $(this).attr('href') + '&confirm=yes';
        bootbox.confirm(v.restore, function(result)
        {
            if(result)
            {
                $.getJSON(url, function(response)
                {
                    if(response.result == 'success') ($.zui.messager || $.zui.messager).success(response.message);
                    if(response.result == 'fail')    ($.zui.messager || $.zui.messager).warning(response.message);
                });
            }
        });
        return false;
    })
})
