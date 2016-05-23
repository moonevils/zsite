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
                 $('#execButton').next('.total').text(response.message);
                 $('#execButton').removeClass('disabled');
                 setTimeout(function(){$('#execButton').next('.total').hide();}, 2000);
                 return false;
             }   
             else
             {   
                 $('#execButton').next('.total').text(response.completed).show();
                 $('#execButton').attr('href', response.next);
                 return $('#execButton').click();
             }   
        }); 
        return false;
    }); 
})
