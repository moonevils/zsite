$(function()
{
    $.get(v.updateViewsLink);  
    $('.nav-page-' + v.pageID).first().addClass('active');
});
