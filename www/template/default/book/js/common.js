$(document).ready(function()
{
    $('.nav-system-book').addClass('active');

    if(v.fullScreen)
    {
        $('.full-screen').remove();

        $('html, body').css('height', '100%');
        var string = "<div class='fullScreen-book'>";
        if($('.book-catalog').length || $('#bookCatalog').length)
        {
            string += "<div class='fullScreen-catalog'>";
            if($('.book-catalog').length) string += $('.book-catalog').html();
            if($('#bookCatalog').length)  string += $('#bookCatalog').html();
            string += "</div>";
        }

        if($('.book-content').length)
        {
            string += "<div class='fullScreen-content'>";
            string += "<div class='fullScreen-inner'>";
            string += $('.book-content').html();
            string += "</div></div>";
        }

        string += "</div>";

        $('body').html(string);

        $('.previous, .next').css('top', $('body').height() / 2);
        if(!$('.fullScreen-catalog').length)
        {
          $('.fullScreen-content').css('left', 0);
          $('.previous').css('left', '5px');
        }
    }
});
