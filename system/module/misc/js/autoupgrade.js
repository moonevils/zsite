$(document).ready(function()
{
    $('#upgradeBtn').click(function()
    {
        $(this).text(v.downloadingpackage);    
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
                var timerID = window.setInterval(function()
                {
                    $.getJSON(createLink('misc', 'getDownloadProgress'), function(response)
                    {
                        size = response.size;
                        progress = size / fullSize;
                        console.log(progress.toFixed(2));
                        progress = progress.toFixed(2);
                        progress = progress * 100;
                        $('#progress').text(progress);
                        if(parseInt(size) == parseInt(fullSize) && parseInt(size) != 0)
                        {
                            clearInterval(timerID);
                            $('#downloaded').removeClass('hidden');
                            $('#downloading').addClass('hidden');
                            $('#checking').removeClass('hidden');
                            $.getJSON(createLink('misc', 'checkDownloadedPackage'), function(response)
                            {
                                if(response.result == 'success')
                                {
                                    $('#checking').addClass('hidden');
                                    $('#checked').removeClass('hidden');
                                    $('#extracting').removeClass('hidden');
                                    $.get(createLink('misc', 'extractDownloadedPackage'));
                                }
                                else
                                {
                                    $('#error').text(response.message);
                                }
                            });
                        }
                    });
                }, 500);
                $.get(createLink('misc', 'startdownload', 'url=' + v.url));
            }
        });
        return false;
    });
})
