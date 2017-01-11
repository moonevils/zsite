$(document).ready(function()
{
    $('[name=filterUsernameSensitive]').change(function()
    {
        var filterUsernameSensitive = $('[name=filterUsernameSensitive]:checked').val(); 
        if(filterUsernameSensitive == 'close')$('#usernameSensitive').parents('tr').addClass('hide');
        else $('#usernameSensitive').parents('tr').removeClass('hide');
    });
    $('[name=filterUsernameSensitive]').change();
});
