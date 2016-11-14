$(document).ready(function()
{
    $.get(v.updateViewsLink);  
    $('body').tooltip(
    {
        html: true,
        selector: "[data-toggle=tooltip]",
        container: "body"
    }); 
});
