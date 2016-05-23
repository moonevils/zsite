$(function()
{
    $('#backupBtn').click(function()
    {
        $(this).text(v.lang.backuping).prop('disabled', true);
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
        btn     = $(this);
        url     = btn.attr('href') + '&confirm=yes';
        rawText = btn.text();
        bootbox.confirm(v.restore, function(result)
        {
            if(result)
            {
                btn.text(v.lang.restoring);
                $.getJSON(url, function(response)
                {
                    if(response.result == 'success') ($.zui.messager || $.zui.messager).success(response.message);
                    if(response.result == 'fail')    ($.zui.messager || $.zui.messager).warning(response.message);
                    btn.text(rawText)
                });
            }
        });
        return false;
    })
})
