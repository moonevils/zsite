$(document).ready(function()
{
    var fieldName = 'addedDate';
    var orderType = 'desc';

    $(document).on('click', '.setOrder', function()
    {
        if($(this).data('field') == fieldName)
        {
            orderType = orderType == 'asc' ? 'desc' : 'asc';
            fieldName = $(this).data('field');
        }
        else
        {
            orderType = 'desc';
            fieldName = $(this).data('field');
        }

        url = createLink('article', 'browse', 'category=' + v.categoryID + '&orderBy=' + fieldName + '_' + orderType) + ' #articleList';

        $('#mainContainer').load(url, function(){ setSorterClass()});
    });

    function setSorterClass()
    {
        if(orderType == 'asc')
        {
            $("[data-field=" + fieldName + "]").parent().removeClass('header').addClass('headerSortUp');
        }
        if(orderType == 'desc')
        {
            $("[data-field=" + fieldName + "]").parent().removeClass('header').addClass('headerSortDown');
        }
    }
});
