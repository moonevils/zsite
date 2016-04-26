$(document).ready(function()
{
    $('.nav-system-book').addClass('active');

    if(v.fullScreen)
    {
        $('html, body').css('height', '100%');
        $('#article' + v.objectID).css('font-weight', 'bold');

        curPos = sessionStorage.getItem('curPos');
        if(curPos) $('.fullScreen-catalog').animate({scrollTop: curPos}, 0);

        $('.article').click(function(){sessionStorage.setItem('curPos', $('.fullScreen-catalog').scrollTop());});
    }
});
