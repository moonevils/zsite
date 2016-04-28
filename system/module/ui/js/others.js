$(document).ready(function()
{
    $('#execButton').click(function()
    {   
        $(this).text(v.lang.doing);
        $(this).addClass('disabled');

        $.getJSON($(this).attr('href'), function(response)
        {   
            if(response.result == 'finished')
            {   
                 $('#execButton').attr('href', createLink('file', 'rebuildthumbs'));
                 $('#execButton').text(v.rebuildThumbs);
                 $('#execButton').removeClass('disabled');
                 $('#execButton').popover({trigger:'manual', content:response.message, placement:'right'}).popover('show');
                 $('#execButton').next('.popover').addClass('popover-success');
                 setTimeout(function(){$('#execButton').popover('destroy');}, 2000);
                 return false;
             }   
             else
             {   
                 $('#execButton').attr('href', response.next);
                 return $('#execButton').click();
             }   
        }); 
        return false;
    }); 
})
