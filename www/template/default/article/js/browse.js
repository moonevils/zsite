$(document).ready(function()
{
    var orderBy = $.cookie('articleOrderBy');
    if(typeof(orderBy) != 'string')
    {
        orderBy = 'place_place';
    }
    else 
    { 
        var fieldName = orderBy.split('_')[0];
        var orderType = orderBy.split('_')[1];
    }
    if(orderType == 'asc')
    {
        $("#articleHeader ." + fieldName).parent().removeClass('header').addClass('headerSortUp');
    }
    if(orderType == 'desc')
    {
        $("#articleHeader ." + fieldName).parent().removeClass('header').addClass('headerSortDown');
    }

    $(".setOrder").click(function(){
        if(this.id == fieldName)
        {
            var setOrderType = 'asc';
            if(orderType == 'asc') setOrderType = 'desc';
            var setOrderBy = fieldName + '_' + setOrderType;
            $.cookie('articleOrderBy', setOrderBy);
        }
        else
        {
            var setOrderType = 'asc';
            if(orderType == 'asc') setOrderType = 'desc';
            var setOrderBy = this.id + '_' + setOrderType;
            $.cookie('articleOrderBy', setOrderBy);
        }
        location.href = location.href;
    });
});
