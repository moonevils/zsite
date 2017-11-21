$(function()
{
    $('.media-placeholder').each(function()
    {
        var $this = $(this);
        $this.attr('style', 'background-color: hsl(' + $this.data('id') * 57 % 360 + ', 80%, 90%)');
    });

    $('[data-toggle="tooltip"]').tooltip({container: 'body'});

    $(document).on('click', '#modeControl a', function()
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
    
    var fieldName = 'order';
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

        $.cookie('productOrderBy[' + v.categoryID + ']', fieldName + '_' + orderType);

        r = Math.random();
        url = config.requestType == 'GET' ? location.href + '&r=' + r + ' #products' : location.href + '?r=' + r + ' #products';
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
        $('#modeControl').find('[data-mode=' + type +']').click();
    }
})
