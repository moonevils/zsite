$(function()
{
    $(document).on('click', '.preview-theme', function()
    {
        var $this = $(this);
        var images = $this.data('images').split(',');
        if(!images.length) return;

        var options = $.extend(
        {
            title: $(this).attr('title'),
            icon: '<i class="icon icon-picture"></i>',
            width: '80%',
            showHeader: false,
            name: 'themePreviewModal',
            shown: function() {$('body').addClass('theme-preview-in')},
            onHide: function() {$('body').removeClass('theme-preview-in')}
        }, $this.data());

        // create carousel
        var carouselId = 'carousel-' + new Date().getTime();
        var $indicators = $('<ol class="carousel-indicators"/>');
        var $carouselInner = $('<div class="carousel-inner"/>');
        $.each(images, function(idx, img)
        {
            $indicators.append('<li data-target="#' + carouselId + '" data-slide-to="' + idx + '"' + (idx === 0 ? ' class="active"' : '') + '></li>');
            $carouselInner.append('<div class="item' + (idx === 0 ? ' active' : '') + '"><img alt="' + options.title + '" src="' + $.trim(img) + '"></div>');
        });

        options.custom = $('<div id="' + carouselId + '" class="carousel" data-ride="carousel"/>').append($indicators).append($carouselInner).append('<a class="left carousel-control" href="#' + carouselId + '" data-slide="prev"><span class="icon icon-chevron-left"></span></a><a class="right carousel-control" href="#' + carouselId + '" data-slide="next"><span class="icon icon-chevron-right"></span></a>').append('<a href="javascript:;" class="close-preview-theme" data-dismiss="modal"><i class="icon icon-remove"></i></a>');

        $.zui.modalTrigger.show(options);
    });
});
