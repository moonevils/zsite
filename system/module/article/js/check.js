$(document).ready(function()
{
    $('.blogTD').hide();
    $('tr.trBook').hide();

    $('[name=type]').change(function()
    {
        type = $(this).val();
        if(type == 'book')
        {
            $('tr#categories').hide();
            $('tr.trBook').show();
        }
        else
        {
            $('tr#categories').show();
            $('tr.trBook').hide();

            $('.articleTD, .blogTD').hide();
            $('.' + type + 'TD').show();
        }
    });

    $('select#bookList').change(function()
    {   
        var bookID=$(this).children('option:selected').val();
        $('select#bookCatalogs').empty();

        $.each(v.bookCatalogs[bookID],function(index,value)
        {   
            $('select#bookCatalogs').append("<option value=\"" + index + "\">" + value + "</option>");
        })  
    }); 

    $('#source').change();
    $(document).on('click', '.rejecter', function()
    {
        var deleter = $(this);
        bootbox.confirm(v.confirmReject, function(result)
        {
            if(result)
            {
                deleter.text(v.lang.doing);

                $.getJSON(deleter.attr('href'), function(data)
                {
                    if(data.result == 'success')
                    {
                        location.href = data.locate;
                        return true;
                    }
                    else
                    {
                        alert(data.message);
                    }
                });
            }
            return true;
       });
       return false;
    })
});
