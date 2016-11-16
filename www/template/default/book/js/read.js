$(document).ready(function()
{
    $('body').tooltip(
    {
        html: true,
        selector: "[data-toggle=tooltip]",
        container: "body"
    });  
    //scroll
    function yrScroll(){
        if( $("#book").offset() ){
            var headerHeight = $("#book").offset().top;
        }
        var listTitleHeight = $(".book-catalog .panel-heading").height();
        //init
        $(".book-catalog").css({
            "max-height":"600px",
            "overflow":"auto"
        });
        var listScrollTop =  $(".books .active").position().top;
        var listMoveSize = listScrollTop > ( $(".bookScrollListsBox").height() - listTitleHeight ) / 2 ? listScrollTop : 0;
        var scrollMoveSize = listMoveSize / $(".books").height(); 
        $(".bookScrollListsBox").scrollTop(
            $(".bookScrollListsBox .books").height() * scrollMoveSize -($(".bookScrollListsBox").height() / 2 - $(".bookScrollListsBox .panel-heading").height() - 47)
        );
        //scroll event
        $(document).on("scroll", function (){
             //minHeight
             $(".page-wrapper").css({"min-height":$(".book-catalog").height()})
             if($(document).scrollTop() > headerHeight ){
                $(".book-catalog").css({
                    "position":"fixed",
                    "top":"0",
                    "width":"276"
                });
             }else if( $(document).scrollTop() < headerHeight ){
                $(".book-catalog").css({
                    "position":"relative"
                });
            }
        });
    };
    yrScroll();
    //scroll end


});
