$(document).ready(function()
{
    $('select#book').change(function()
    {
        var bookID=$(this).children('option:selected').val();
        $('select#parent').empty();

        $.each(v.optionMenus[bookID],function(index,value)
        {
            if(v.path[1] == bookID && index == v.nodeParent)
            {
                $('select#parent').append("<option value=\"" + index + "\" selected=\"selected\">" + value + "</option>");
                return true;
            }

            $('select#parent').append("<option value=\"" + index + "\">" + value + "</option>");
        })
    });

    $('#isLink').change(function()
    {   
        if($('#isLink').prop('checked'))
        {   
            $('tr#isLinked').hide();
            $('#trlink').show();
        }   
        else
        {   
            $('tr#isLinked').show();
            $('#trlink').hide();
        }
    }); 

    $('#isLink').change();
});
