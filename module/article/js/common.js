$(document).ready(function()
{
    $(".article-img img").fixImage();

    /* Set the orginal and copySite, copyURL fields. */
    $('#original').change(function()
    {
        $('#copyBox').hide().find(':input').attr('disabled', true);
        if($(this).val() == 0) $('#copyBox').show().find(':input').attr('disabled', false);
    });
    
    /* Set current active topNav. */
    if(v.categoryPath && v.categoryPath.length)
    {
        $.each(eval(v.categoryPath), function(index, category) 
        { 
            $('#topNav .article_' + category).addClass('active');
        })
    }
});
