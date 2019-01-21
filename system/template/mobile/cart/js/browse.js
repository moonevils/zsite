statAll();
$(document).ready(function()
{
    $(document).on('click', '#checkAll', function()
    {
        $('.check-product').each(function()
        {
            $(this).prop("checked", $('#checkAll').prop("checked"));
        });
        statAll();
    });

    $(document).on('click', '.check-product', function()
    {
        statAll();
    });

    $(document).on('click', '.opt.admin', function()
    {
        $(this).siblings().show();
        $(this).hide();
        $('.total').find('span').hide();
        $('.btn-order-submit').hide();
        $('.btn-order-delete').show();
    });

    $(document).on('click', '.opt.complete', function()
    {
        $(this).siblings().show();
        $(this).hide();
        $('.total').find('span').show();
        $('.btn-order-submit').show();
        $('.btn-order-delete').hide();
    });

    $(document).on('click', '.btn-order-delete', function()
    {
        var products = '';
        $('.check-product:checked').each(function()
        {
            products += $(this).val() + ',';
        });
        $.getJSON(createLink('cart', 'deletes', 'products=' + products), function(data) 
        {
            window.location.reload();
        });
    });
})
function statAll()
{
    var amount = 0;
    var total = 0;
    $('.check-product').each(function()
    {
        var price = $(this).parent().parent().find('.form-control-number').data('price');
        var number = $(this).parent().parent().find('.form-control-number').val();
        $(this).parent().parent().find('.product-amount').text(price*number); 
        if($(this).prop("checked"))
        {
            amount += 1;
            total += parseFloat($(this).parent().parent().find('.product-amount').html()); 
        }
    });
    $('#amount').prev().html(amount);
    $('#amount').html($('#amount').html().substr(0,1) + total);

}
