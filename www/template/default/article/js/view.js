$(document).ready(function()
{
    function basename(str)
    {
        var pos = str.lastIndexOf('/');
        return str.substring(pos + 1,str.length);
    }

    $('body').tooltip(
    {
        html: true,
        selector: "[data-toggle=tooltip]",
        container: "body"
    }); 

    $('.article-content img').click(function(){
        var itemSrc  = $(this).attr('src');
        var itemName = basename(itemSrc).split('.')[0];
        if(typeof(itemName) == 'string')
        {
            $('.article-files .' + itemName).click();
        }
    });
});
