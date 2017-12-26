$(document).ready(function()
{
    $('#clearButton').click(function()
    {
        $(this).text(v.clearing);
       
        var submitButton = $('#clearButton');
        var showPopover = function(type, message) 
        {
            type = type || 'success';
            message = message || response.message;
            submitButton.popover({trigger:'manual', content:message, placement: submitButton.data('placement') || 'right', tipClass: 'popover-' + type + ' popover-ajaxform'}).popover('show');
            setTimeout(function(){submitButton.popover('destroy');}, 2000);
        };
   
        $.getJSON($(this).attr('href'), function(response)
        {
             if(response.result == 'success')
             {
                 $('#clearButton').text(v.clear);
                 showPopover('success', v.cleared);
                 return true;
             }
             else
             {
                 $('#clearButton').text(response.message).removeClass('btn-primary').addClass('btn-danger');
                 $('#clearButton').attr("disabled","disabled")
                 $('#saveCacheSetting').after(v.clearCacheTip);
                 return false;
             }
        });
        return false;
    });
});
