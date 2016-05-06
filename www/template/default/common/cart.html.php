<script>
    function loadCartInfo(twinkle)
    {
        $('#cartBox').load(createLink('user', 'printTopBar'),
            function()
            {
                if(twinkle) 
                {
                    bootbox.dialog(
                    {  
                        message: v.addToCartSuccess,  
                        buttons:
                        {  
                            back:
                            {  
                                label:     v.lang.continueShopping,
                                className: 'btn-primary',  
                                callback:  function(){location.reload();}  
                            },
                            cart:
                            {  
                                label:     v.gotoCart,  
                                className: 'btn-primary',  
                                callback:  function(){location.href = createLink('cart', 'browse');}  
                            }  
                        }  
                    });
                }
            }
        );
    }

$(document).ready(function()
{
    loadCartInfo(false);
})
</script>
