$(document).ready(function()
{
    $.get("/pathinfo.html", function(result)
    {
        $('#requestType').val('PATH_INFO');
    });
});     
