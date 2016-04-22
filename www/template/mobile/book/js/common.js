$(document).ready(function()
{
    if(v.fullScreen)
    {
        $('body').css('margin', '0');
        $('body').css('padding', '0');
        var string = "<div class='fullScreen-book'>";
        if($('.book').length || $('#bookCatalog').length)
        {
            string += "<div class='fullScreen-content'>";
            string += "<div class='fullScreen-inner'>";
            if($('.book').length) string += $('.book').html();
            if($('#bookCatalog').length)  string += $('#bookCatalog').html();
            string += "</div></div>";
        }
        string += "</div>";
        $('body').html(string);
    }
});
