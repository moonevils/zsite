<?php
js::import($jsRoot . 'videojs/video.min.js');
css::import($jsRoot . 'videojs/video-js.min.css');
?>
<?php
$videoHtml = <<<EOT
<video id="VIDEO_ID"
class="video-js vjs-default-skin vjs-big-play-centered "
controls preload="auto" loop='loop'
width="VIDEO_WIDTH" height="VIDEO_HEIGHT"
poster="http://www.eps.com/data/poster.jpg" >
<source src="VIDEO_SRC" />
</video>
EOT;
?>
<script>
$(function()
{
    var videoContainer = <?php echo json_encode($videoHtml);?>;
    $('embed').hide().each(function(index)
    {
        var $embed = $(this),
            src    = $embed.attr('src'),
            w      = $embed.width(),
            h      = $embed.height(),
            containerID = 'video_' + index;
        $container = videoContainer.replace(/VIDEO_SRC/, src);
        $container = $container.replace(/VIDEO_WIDTH/, w);
        $container = $container.replace(/VIDEO_HEIGHT/, h);
        $container = $container.replace(/VIDEO_ID/, containerID);
        $(this).replaceWith($container);
        $('#'+containerID).width(w);
        $('#'+containerID).height(h);
    })
});
</script>
