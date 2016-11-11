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
        var headerHeight = $("#book").offset().top;
        var listTitleHeight = $(".book-catalog .panel-heading").height();
        //init
        $(".book-catalog").css({
            "max-height":"600px",
            "overflow":"auto"
        });
        var listScrollTop =  $(".books .active").position().top;
        var listMoveSize = listScrollTop > ( $(".book-catalog").height() - listTitleHeight ) / 2 ? listScrollTop : 0;
        var scrollMoveSize = listMoveSize / $(".books").height(); 
        $(".book-catalog").scrollTop(
            $(".book-catalog .books").height() * scrollMoveSize - ( $(".book-catalog").height() / 2 - listTitleHeight )
        );
        console.log(listMoveSize)
        console.log($(".book-catalog .book").height() * scrollMoveSize)
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
