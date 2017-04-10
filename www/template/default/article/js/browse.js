$(document).ready(function()
{
    var orderBy = $.cookie('articleOrderBy' + v.categoryID);
    if(typeof(orderBy) != 'string')
    {
        orderBy = 'place_place';
    }

    var fieldName = orderBy.split('_')[0];
    var orderType = orderBy.split('_')[1];

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
    setSorterClass();
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

        $.cookie('articleOrderBy' + v.categoryID, fieldName + '_' + orderType);

        $('#mainContainer').load(location.href + ' #articleList', function(){ setSorterClass()});
    });
});
