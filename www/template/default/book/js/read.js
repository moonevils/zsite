$(document).ready(function()
{
    $('body').tooltip(
    {
         html: true,
         selector: "[data-toggle=tooltip]",
         container: "body"
    });  

    /* Scroll function. */
    function yrScroll()
    {
         if( $("#book").offset()) var headerHeight = $("#book").offset().top;
         if( $('.col-md-9').offset()) { var footerHeight = $('.col-md-9').offset().top + $('.col-md-9').height() - $(window).height();}

         var listTitleHeight = $(".book-catalog .panel-heading").height();

         var catalogWidth  = $('.book-catalog').width();
         var catalogHeight = $(window).height() - 10;
         $(".book-catalog").css({'max-height': catalogHeight, 'overflow-y': 'auto', 'overflow-x': 'hidden'});

         if($('.books .active').length)
         {
             var listScrollTop =  $(".books .active").position().top;
             var listMoveSize = listScrollTop > ( $(".bookScrollListsBox").height() - listTitleHeight ) / 2 ? listScrollTop : 0;
             var scrollMoveSize = listMoveSize / $(".books").height(); 
             $(".bookScrollListsBox").scrollTop
             (
                 $(".bookScrollListsBox .books").height() * scrollMoveSize -($(".bookScrollListsBox").height() / 2 - $(".bookScrollListsBox .panel-heading").height() - 47)
             );
         }


         /* Bind scroll event */
         $(document).on("scroll", function ()
         {
              $(".page-wrapper").css({"min-height":$(".book-catalog").height()})
              if($(document).scrollTop() > headerHeight )
              {
                   $('.book-catalog').css({'position': 'fixed', 'top':'0', 'width': catalogWidth});

                   if($(document).scrollTop() > footerHeight)
                   {
                       catalogHeight2 = $(window).height() - $('.blocks.all-bottom').outerHeight() - $('#footer').outerHeight() - 60;
                       $('.book-catalog').css({'max-height': catalogHeight2, 'overflow-y': 'auto', 'overflow-x': 'hidden'});
                   }
                   else
                   {
                       $('.book-catalog').css({'max-height': catalogHeight, 'overflow-y': 'auto', 'overflow-x': 'hidden'});
                   }
              }
              else if( $(document).scrollTop() < headerHeight )
              {
                   $('.book-catalog').css({'position': 'relative' });
              }
         });
    };
    yrScroll();

    $('.previous > a, .next > a').css('width', (($('.pager').width() - $('.pager > .back > a').width()) * 0.45));

    previousSpanWidth = $('.previous > a').width() - 17;
    nextSpanWidth     = $('.next > a').width() - 17;
    $('.previous > a > span').css('width', previousSpanWidth);
    $('.next > a > span').css('width', nextSpanWidth);
});
