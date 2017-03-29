$(function()
{
    $('.media-placeholder').each(function()
    {
        var $this = $(this);
        $this.attr('style', 'background-color: hsl(' + $this.data('id') * 57 % 360 + ', 80%, 90%)');
    });

    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    $('#modeControl a').click(function()
    {
        $('#modeControl a').removeClass('active');
        $(this).addClass('active');
        $('#modeControl').parents('.list-condensed').find('section').hide();
        $('#' + $(this).data('mode') + 'Mode').show();
        $.cookie('productViewType', $(this).data('mode'), {path: "/"});
    })

    var type = $.cookie('productViewType');
    if(typeof(type) == 'undefined' || type == '') type = 'card';
    $('#modeControl').find('[data-mode=' + type +']').click();

    $('.price').each(function()
    {
         if($(this).find('strong').length > 0)
         {
             $('.price').css('height', '30px');
             return false;
         }
    });
    
    var orderBy = $.cookie('productOrderBy');
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
        $("#productHeader ." + fieldName).parent().removeClass('header').addClass('headerSortUp');
    }
    else 
    {
        $("#productHeader ." + fieldName).parent().removeClass('header').addClass('headerSortDown');
    }

    $(".setOrder").click(function(){
        if(this.id == fieldName)
        {
            var setOrderType = 'asc';
            if(orderType == 'asc') setOrderType = 'desc';
            var setOrderBy = fieldName + '_' + setOrderType;
            $.cookie('productOrderBy', setOrderBy);
        }
        else
        {
            var setOrderType = 'asc';
            if(orderType == 'asc') setOrderType = 'desc';
            var setOrderBy = this.id + '_' + setOrderType;
            $.cookie('productOrderBy', setOrderBy);
        }
        location.href = location.href;
    });
})
