$(document).ready(function()
{
    $('[name=checkIP]').change(function()
    {
        var checkIP = $('[name=checkIP]:checked').val(); 
        if(checkIP == 'close') $('#allowedIP').parents('tr').addClass('hide');
        else $('#allowedIP').parents('tr').removeClass('hide');
    });
    $('[name=checkIP]').change();

    $('[name=checkLocation]').change(function()
    {
        var checkIP = $('[name=checkLocation]:checked').val(); 
        if(checkIP == 'close') $('#allowedLocation').parents('tr').addClass('hide');
        else $('#allowedLocation').parents('tr').removeClass('hide');
    });
    $('[name=checkLocation]').change();

    $('#useLocation').click(function()
    {
        $('#allowedLocationShow').val(v.location);
        $('#allowedLocation').val(v.location);
        return false;
    });

    $('[name=filterSensitive]').change(function()
    {
        var filterSensitive = $('[name=filterSensitive]:checked').val(); 
        if(filterSensitive == 'close')$('#sensitive').parents('tr').addClass('hide');
        else $('#sensitive').parents('tr').removeClass('hide');
    });
    $('[name=filterSensitive]').change();
});
