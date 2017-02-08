$(document).ready(function()
{
    $('#upgradeBtn').click(function()
    {
        $(this).text(v.lang.updating);    
        $.getJSON($(this).attr('href'), function(response)
        {
            if(response.result == 'fail')
            {
                $('#error').text(response.message);
                $('#hasError').removeClass('hidden');
                return false;
            }
            else
            {
                $('#downloading').removeClass('hidden');
                $.getJSON(createLink('misc', 'getDownloadFullSize', 'url=' + v.url), function(response)
                {
                    fullSize = response.fullsize;
                });
                window.setInterval(function()
                {
                    $.getJSON(createLink('misc', 'getDownloadProgress'), function(response)
                    {
                        size = response.size;
                        progress = (size / fullSize).toFixed(2);
                        $('#progress').text(progress);
                    });
                }, 300);
                //$.getJSON(createLink('misc', 'startdownload', 'url=' + v.url));
            }
        });
        return false;
    });
})
