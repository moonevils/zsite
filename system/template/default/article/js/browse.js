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

        $.cookie('articleOrderBy[' + v.categoryID + ']', fieldName + '_' + orderType);

        r = Math.ceil(Math.random() * 1000000);
        url = location.href;
        url = url.indexOf('r=') != -1 ? url.substring(0, url.indexOf('r=') - 1) : url;
        if(config.requestType == 'GET' && url.indexOf('pageID') < 0) url = url + '&pageID=1';
        url = config.requestType == 'GET' ? url + '&r=' + r + ' #articleList' : url + '?r=' + r + ' #articleList';
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
