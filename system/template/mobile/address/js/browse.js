$(function()
{
    $(".manage").on("click", function () {
        if ($(this).children("p[name='operate']").attr("current") === 'manage') {
            $(this).children("p[name='operate']").html($(this).children("input[name='manageDone']").val());
            $(this).children("p[name='operate']").attr("current", "manageDone");
            $(".checkbox-circle").show();
        } else {
            $(this).children("p[name='operate']").html($(this).children("input[name='manage']").val());
            $(this).children("p[name='operate']").attr("current", "manage");
            $(".checkbox-circle").hide();
        }
    })
});
