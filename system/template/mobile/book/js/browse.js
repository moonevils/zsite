$(document).ready(function()
{
    function scrollCenter()
    {
        var left = $('.book.active').position().left;
        $('.book-nav').scrollLeft(left - $(window).width()/2 + $('.book.active').width()/2);
    }
    scrollCenter();

    $('.chapter').on('click', function()
    {
        $('.chapter').removeClass('active');
        $('.chapter .down-triangle').removeClass('active');
        $(this).addClass('active');
        $(this).find('.down-triangle').addClass('active');
        if($(this).parent().attr('open') === true) $(this).find('.down-triangle').removeClass('active');;
    });
});
