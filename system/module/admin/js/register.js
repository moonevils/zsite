$(document).ready(function()
{
    $.setAjaxForm('#registerForm');
    $.setAjaxForm('#bindForm');
    $('#bindPanel').height($('#registerPanel').height());
    $('#rebindBtn').click(function()
    {
        bootbox.confirm(v.lang.confirmRebind, function(result)
        {
            if(result) location.href = $('#rebindBtn').attr('href');
        });    
        return false;
    });
});
