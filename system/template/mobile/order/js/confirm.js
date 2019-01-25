$().ready(function()
{
    $(document).on('click', '.item', function ()
    {
        if($(this).find('input[name="deliveryAddress"]').attr('checked') === false)
        {
            $(this).find('input[name="deliveryAddress"]').attr('checked', true);
        }
        else
        {
            $(this).find('input[name="deliveryAddress"]').removeAttr('checked');
        }
    });
});
